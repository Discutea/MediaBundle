<?php

namespace Discutea\MediaBundle\Manager;

use Discutea\MediaBundle\Model\MediaInterface;
use Discutea\MediaBundle\Services\AliasManager;
use Discutea\MediaBundle\Services\Config;
use Discutea\MediaBundle\Services\FileManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaManager implements MediaManagerInterface
{
    private $path;

    private $originalDir;

    private $aliasManager;

    private $fileManager;

    private $config;

    public function __construct(AliasManager $aliasManager, FileManager $fileManager, Config $config)
    {
        $this->aliasManager = $aliasManager;
        $this->fileManager = $fileManager;
        $this->config = $config;
    }

    public function getUrl(MediaInterface $media = null, $alias = null): string
    {
        $this->aliasManager->buildAlias($alias);
        $this->fileManager->build($media, $this->aliasManager);

        return $this->fileManager->getUrl();
    }

    public function create(UploadedFile $file): MediaInterface
    {
        $class = $this->config->get('media_class');
        $media = new $class();

        if (!$media instanceof MediaInterface) {
            throw new \Exception('PhpStorm autocompletion!');
        }

        $media->setName($file->getClientOriginalName())
              ->setSize($file->getSize())
              ->setMimeType($file->getMimeType())
              ->setExtension($file->getExtension())
              ->setReference(md5(uniqid()).'.'.$file->guessExtension())
        ;

        $file->move(
            $this->config->get('path') . self::ORIGINAL_DIR,
            $media->getReference()
        );

        return $media;
    }

}
