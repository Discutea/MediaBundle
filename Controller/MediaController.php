<?php

namespace Discutea\MediaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class MediaController extends Controller
{
    /**
     * @Method({"POST"})
     * @Route("/post", name="discutea_media_image_post")
     */
    public function postImageAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        // TODO: Create upoad


        return new JsonResponse(array('id' => 1));
    }
}
