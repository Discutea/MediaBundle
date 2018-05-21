<?php

namespace Discutea\MediaBundle\Manager;

use Discutea\MediaBundle\Model\MediaInterface;

interface MediaManagerInterface
{
    public function getUrl(MediaInterface $media, $alias = null): string;
}
