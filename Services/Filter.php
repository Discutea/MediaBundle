<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 26/05/18
 * Time: 10:59
 */

namespace Discutea\MediaBundle\Services;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class Filter
{
    /**
     * @var SessionInterface
     */
    private $session;

    /**
     * Filter constructor.
     * @param SessionInterface $session
     */
    public function __construct(SessionInterface $session)
    {
        $this->session = $session;
    }

    /**
     * set filter.
     *
     * @param string $name
     *
     * @return string Key of new filter
     */
    public function set($name)
    {
        $filters = array_unique ($this->session->get('filters', array()));
        if (in_array ($name, $filters)) {
            return array_search ($name, $filters);
        }

        $filterKey = 'filter_'.sha1(microtime(true).mt_rand().$name);
        $filters[$filterKey] = $name;
        $this->session->set('filters', $filters);

        return $filterKey;
    }

    /**
     * Get filter.
     *
     * @param string $filterKey
     *
     * @return string Filter name
     */
    public function get($filterKey)
    {
        $filters = $this->session->get('filters', array());

        if (!array_key_exists ($filterKey, $filters)) {
            return null;
        }

        return $filters[$filterKey];
    }

    /**
     * has filter.
     *
     * @param string $filterKey
     *
     * @return bool
     */
    public function has($filterKey)
    {
        $filters = $this->session->get('filters', array());

        return array_key_exists ($filterKey, $filters);
    }
}
