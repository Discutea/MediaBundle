<?php
/**
 * Created by PhpStorm.
 * User: david
 * Date: 23/05/18
 * Time: 22:41
 */

namespace Discutea\MediaBundle\Services;


class Config
{
    /**
     * @var array
     */
    private $config;

    /**
     * Config constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->config);
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        if (false === $this->has($key)) {
            throw new \LogicException(sprintf('The config %s does not exist!', $key));
        }

        return $this->config[$key];
    }
}
