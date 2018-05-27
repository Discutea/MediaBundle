<?php

namespace Discutea\MediaBundle\Controller;

use Discutea\MediaBundle\Manager\MediaManagerInterface;
use Discutea\MediaBundle\Services\Config;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\SerializerInterface;

class MediaController extends Controller
{
    /**
     * @Method({"POST"})
     * @Route("/post", name="discutea_media_image_post")
     */
    public function postImageAction(Request $request, MediaManagerInterface $manager)
    {
        $file = $request->files->get('file');
        $media = $manager->create($file);

        $em = $this->getDoctrine()->getManager();
        $em->persist($media);
        $em->flush();

        $data =  $this->get('serializer')->serialize($media, 'json');

        $response = new Response($data);
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}
