<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/05/18
 * Time: 12:14
 */

namespace Discutea\MediaBundle\Listener;

use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Templating\EngineInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\Templating\Helper\CoreAssetsHelper;
use Symfony\Component\Templating\DelegatingEngine;
use Symfony\Component\HttpKernel\HttpKernel;


class MediaContentListener
{
    private $assetsHelper;

    private $templating;

    public function __construct(Packages $assetsHelper, EngineInterface $engine)
    {
        $this->assetsHelper = $assetsHelper;
        $this->templating = $engine;
    }

    /**
     * Detect if the response has media field in her content,
     * and add css, js and templates for mustaches.
     *
     * @param FilterResponseEvent $event
     *
     * @return FilterResponseEvent
     */
    public function addContent(FilterResponseEvent $event)
    {
        if (HttpKernel::MASTER_REQUEST != $event->getRequestType()) {
            return;
        }
        $response = $event->getResponse();
        $content = $response->getContent();

        if (strpos($content, 'data-discutea-media="') !== false) {
            $css = sprintf(
                '<link rel="stylesheet" type="text/css"  href="%s" />',
                $this->assetsHelper->getUrl('bundles/discuteamedia/css/main.css')
            );

            $js = sprintf(
                '<script src="%s" />',
                $this->assetsHelper->getUrl('bundles/discuteamedia/js/main.js')
            );

            $content = preg_replace('#</head>#', $css.'</head>', $content);
            $content = preg_replace('#</body>#', $js.'</body>', $content);
            $response->setContent($content);
            $event->setResponse($response);
        }
    }
}
