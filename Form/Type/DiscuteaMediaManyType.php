<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/05/18
 * Time: 10:17
 */

namespace Discutea\MediaBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Discutea\MediaBundle\Services\Filter;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class DiscuteaMediaManyType extends AbstractType
{
    /**
     * @var Filter
     */
    private $filter;

    /**
     * DiscuteaMediaManyType constructor.
     * @param Filter $filter
     */
    public function __construct(Filter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * {@inheritDoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['filter'] = $this->filter->set($options['filter']);
    }

    /**
     * {@inheritDoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'entry_type' => DiscuteaMediaOneForCollectionType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'contexts' => false,
            'allowed_extensions' => array(),
            'filter' => null,
            'error_bubbling' => false,
        ));
    }

    /**
     * {@inheritDoc}
     */
    public function getParent()
    {
        return CollectionType::class;
    }

    /**
     * {@inheritDoc}
     */
    public function getExtendedType()
    {
        return CollectionType::class;
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'discutea_media_many';
    }
}
