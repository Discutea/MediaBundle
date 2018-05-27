<?php

namespace Discutea\MediaBundle\Twig;

use Discutea\MediaBundle\Manager\MediaManagerInterface;
use Discutea\MediaBundle\Model\MediaInterface;

class MediaExtension extends \Twig_Extension
{
    /**
     * @var MediaManagerInterface
     */
    private $mediaManager;

    /**
     * MediaExtension constructor.
     * @param MediaManagerInterface $mediaManager
     */
    public function __construct(MediaManagerInterface $mediaManager)
    {
        $this->mediaManager = $mediaManager;
    }

    /**
     * @return array|\Twig_Filter[]
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('media_url', array($this, 'mediaUrlFilter')),
        );
    }

    /**
     * @param MediaInterface|null $media
     * @param null $alias
     * @return string
     */
    public function mediaUrlFilter(MediaInterface $media = null, $alias = null): string
    {
        return $this->mediaManager->getUrl($media, $alias);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'discutea_media_extension';
    }
}
