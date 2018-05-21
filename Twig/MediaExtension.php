<?php

namespace Discutea\MediaBundle\Twig;

use Discutea\MediaBundle\Manager\MediaManagerInterface;
use Discutea\MediaBundle\Model\MediaInterface;

class MediaExtension extends \Twig_Extension
{
    private $mediaManager;

    public function __construct(MediaManagerInterface $mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('media_url', array($this, 'mediaUrlFilter')),
        );
    }

    public function mediaUrlFilter(MediaInterface $media, $alias = null)
    {
        return $this->mediaManager->getUrl($media, $alias);
    }

    public function getName()
    {
        return 'discutea_media_extension';
    }
}
