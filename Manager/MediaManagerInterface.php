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

    public function __construct(AliasManager $aliasManager, FileManager $fileManager, Config $config);

    public function getUrl(MediaInterface $media = null, $alias = null): string;

    public function create(UploadedFile $file): MediaInterface;
}
