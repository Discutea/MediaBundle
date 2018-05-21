<?php

namespace Discutea\MediaBundle\Manager;

use Discutea\MediaBundle\Model\MediaInterface;

class MediaManager implements MediaManagerInterface
{
    public function getUrl(MediaInterface $media, $alias = null): string
    {
        return 'ok';
    }
}
