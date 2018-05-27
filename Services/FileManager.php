<?php

namespace Discutea\MediaBundle\Services;

use Discutea\MediaBundle\Manager\MediaManagerInterface;
use Discutea\MediaBundle\Model\MediaInterface;
use Imagine\Gd\Imagine;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class FileManager
{
    private $config;

    private $aliasManager;

    private $media;

    private $directory;

    private $aliasAndKey;

    private $url;

    private $original;

    private $notFound = false;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function build(MediaInterface $media = null, AliasManager $aliasManager): FileManager
    {
        $this->aliasManager = $aliasManager;
        $this->media = $media;

        if (null === $media) {
            $reference = 'noimage.jpg';
        } else {
            $reference = $media->getReference();
        }

        $this->aliasAndKey = $this->aliasManager->getName() . '/' . $reference;
        $this->directory = $this->config->get('path') . $this->aliasAndKey;
        $this->url = $this->config->get('url') . $this->aliasAndKey;
        $this->original = $this->config->get('path') . 'original/' . $reference;

        if (!file_exists($this->directory)) {
            $this->crop();
        }

        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    private function crop()
    {
        if (!file_exists($this->original)) {
            if (null === $this->media) {
                if (true === $this->notFound) {
                    throw new \LogicException($this->original . ' is not found');
                }

                $this->notFound = true;
            }

            return $this->build(null, $this->aliasManager);
        }

        $imagine = new Imagine();
        $size    = new Box(
            $this->aliasManager->getAlias()['width'] ,
            $this->aliasManager->getAlias()['height']
        );

        $mode = ImageInterface::THUMBNAIL_INSET;

        $imagine->open($this->original)
            ->thumbnail($size, $mode)
            ->save($this->directory)
        ;

        return $this;
    }
}
