<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/05/18
 * Time: 12:14
 */

namespace Discutea\MediaBundle\Listener;

use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpKernel\HttpKernel;

class MediaContentListener
{
    /**
     * @var Packages
     */
    private $assetsHelper;

    /**
     * MediaContentListener constructor.
     * @param Packages $assetsHelper
     */
    public function __construct(Packages $assetsHelper)
    {
        $this->assetsHelper = $assetsHelper;

    }

    /**
     * Detect if the response has media field in her content,
     * and add css, js and templates for mustaches.
     *
     * @param FilterResponseEvent $event
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
