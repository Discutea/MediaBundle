<?php

namespace Discutea\MediaBundle\Manager;

use Discutea\MediaBundle\Model\MediaInterface;
use Discutea\MediaBundle\Services\AliasManager;
use Discutea\MediaBundle\Services\Config;
use Discutea\MediaBundle\Services\FileManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class MediaManager implements MediaManagerInterface
{
    /**
     * @var AliasManager
     */
    private $aliasManager;

    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var Config
     */
    private $config;

    /**
     * MediaManager constructor.
     * @param AliasManager $aliasManager
     * @param FileManager $fileManager
     * @param Config $config
     */
    public function __construct(AliasManager $aliasManager, FileManager $fileManager, Config $config)
    {
        $this->aliasManager = $aliasManager;
        $this->fileManager = $fileManager;
        $this->config = $config;
    }

    /**
     * @param MediaInterface|null $media
     * @param null $alias
     * @return string
     */
    public function getUrl(MediaInterface $media = null, $alias = null): string
    {
        $this->aliasManager->buildAlias($alias);
        $this->fileManager->build($media, $this->aliasManager);

        return $this->fileManager->getUrl();
    }

    /**
     * @param UploadedFile $file
     * @return MediaInterface
     * @throws \Exception
     */
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
