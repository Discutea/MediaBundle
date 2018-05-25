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
    private $config;

    public function __construct(array $config)
    {
        $this->config = $config;
    }

    public function has($key)
    {
        return array_key_exists($key, $this->config);
    }

    public function get($key)
    {
        if (false === $this->has($key)) {
            throw new \LogicException(sprintf('The config %s does not exist!', $key));
        }

        return $this->config[$key];
    }
}
