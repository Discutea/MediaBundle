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

    private $environment;

    /**
     * MediaExtension constructor.
     * @param MediaManagerInterface $mediaManager
     */
    public function __construct(\Twig_Environment $environment, MediaManagerInterface $mediaManager)
    {
        $this->mediaManager = $mediaManager;
        $this->environment = $environment;
    }

    /**
     * @return array|\Twig_Filter[]
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('media_url', array($this, 'mediaUrlFilter')),
            new \Twig_SimpleFilter('media_html', array($this, 'mediaHtmlFilter'))
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

    public function mediaHtmlFilter($media): string
    {
        return $this->environment->render('@DiscuteaMedia/Media/carousel.html.twig', array(
            'medias' => $media
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'discutea_media_extension';
    }
}
