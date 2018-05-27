<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/05/18
 * Time: 10:32
 */

namespace Discutea\MediaBundle\Form\DataTransformer;

use Discutea\MediaBundle\Services\Config;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\ORM\EntityManagerInterface;
use Discutea\MediaBundle\Model\MediaInterface;

class MediaToIdTransformer implements DataTransformerInterface
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * MediaToIdTransformer constructor.
     * @param EntityManagerInterface $entityManager
     * @param Config $config
     */
    public function __construct(EntityManagerInterface $entityManager, Config $config)
    {
        $this->entityManager = $entityManager;
        $this->config = $config;
    }

    /**
     * @param $media
     * @return int|null|string
     */
    public function transform($media)
    {
        if (!$media instanceof MediaInterface) {
            return '';
        }

        return $media->getId();
    }

    /**
     * @param int $id
     * @return MediaInterface|null
     */
    public function reverseTransform($id): ?MediaInterface
    {
        if (!$id) {
            return null;
        }

        $media = $this->entityManager
            ->getRepository($this->config->get('media_class'))
            ->find($id)
        ;

        if (!$media instanceof MediaInterface) {
            throw new TransformationFailedException(sprintf(
                'Media "%s" is not found !',
                $id
            ));
        }

        return $media;
    }
}
