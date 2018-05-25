<?php

namespace Discutea\MediaBundle\Manager;

use Discutea\MediaBundle\Model\MediaInterface;
use Discutea\MediaBundle\Services\AliasManager;
use Discutea\MediaBundle\Services\FileManager;

class MediaManager implements MediaManagerInterface
{
    private $path;

    private $originalDir;

    private $aliasManager;

    private $fileManager;

    public function __construct(AliasManager $aliasManager, FileManager $fileManager)
    {
        $this->aliasManager = $aliasManager;
        $this->fileManager = $fileManager;
    }

    public function getUrl(MediaInterface $media = null, $alias = null): string
    {
        $this->aliasManager->buildAlias($alias);
        $this->fileManager->build($media, $this->aliasManager);

        return $this->fileManager->getUrl();
    }
}
