<?php

namespace Discutea\MediaBundle\Manager;

use Discutea\MediaBundle\Model\MediaInterface;
use Discutea\MediaBundle\Services\AliasManager;
use Discutea\MediaBundle\Services\FileManager;

interface MediaManagerInterface
{
    const ORIGINAL_DIR = 'original';

    public function __construct(AliasManager $aliasManager, FileManager $fileManager);

    public function getUrl(MediaInterface $media = null, $alias = null): string;
}
