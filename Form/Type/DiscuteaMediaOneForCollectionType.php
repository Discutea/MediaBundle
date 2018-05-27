<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/05/18
 * Time: 10:25
 */

namespace Discutea\MediaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Discutea\MediaBundle\Form\DataTransformer\MediaToIdTransformer;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class DiscuteaMediaOneForCollectionType extends AbstractType
{
    /**
     * @var MediaToIdTransformer
     */
    private $transformer;

    /**
     * DiscuteaMediaOneForCollectionType constructor.
     * @param MediaToIdTransformer $transformer
     */
    public function __construct(MediaToIdTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addModelTransformer($this->transformer);
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'contexts' => false,
            'allowed_extensions' => array(),
            'filter' => null,
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return HiddenType::class;
    }

    /**
     * {@inheritDoc}
     */
    public function getExtendedType()
    {
        return HiddenType::class;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'discutea_media_one_for_collection';
    }
}
