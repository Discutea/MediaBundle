<?php

namespace Discutea\MediaBundle\Manager;

use Discutea\MediaBundle\Model\MediaInterface;
use Discutea\MediaBundle\Services\AliasManager;
use Discutea\MediaBundle\Services\Config;
use Discutea\MediaBundle\Services\FileManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

interface MediaManagerInterface
{
    const ORIGINAL_DIR = 'original';

    /**
     * MediaManagerInterface constructor.
     * @param AliasManager $aliasManager
     * @param FileManager $fileManager
     * @param Config $config
     */
    public function __construct(AliasManager $aliasManager, FileManager $fileManager, Config $config);

    /**
     * @param MediaInterface|null $media
     * @param null $alias
     * @return string
     */
    public function getUrl(MediaInterface $media = null, $alias = null): string;

    /**
     * @param UploadedFile $file
     * @return MediaInterface
     */
    public function create(UploadedFile $file): MediaInterface;
}
