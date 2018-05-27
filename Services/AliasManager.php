<?php

namespace Discutea\MediaBundle\Services;

use Discutea\MediaBundle\Manager\MediaManagerInterface;

class AliasManager
{
    /**
     * @var Config
     */
    private $config;

    /**
     * @var null
     */
    private $alias = null;

    /**
     * @var string
     */
    private $name = MediaManagerInterface::ORIGINAL_DIR;

    /**
     * AliasManager constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @param array|null $alias
     * @return AliasManager
     */
    public function buildAlias(array $alias = null): AliasManager
    {
        if (is_array($alias) && $alias) {
            $this->alias = array_replace(array('width' => null, 'height' => null), $alias);
            $this->validateAlias();
            $this->name = $this->aliasToName();

            $this->checkDirectory($this->name);
        }

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array|null
     */
    public function getAlias(): ?array
    {
        return $this->alias;
    }

    /**
     * @param string $name
     * @return bool
     */
    private function checkDirectory(string $name)
    {
        $directory = $this->config->get('path') . $name;

        if (false === is_dir($directory)) {
            return mkdir($directory, 0755, true);
        }

        return true;
    }

    /**
     * @return string
     */
    private function aliasToName()
    {
        if ($this->alias['width'] && $this->alias['height']) {
            return $this->alias['width'].'x'.$this->alias['height'];
        }

        if ($this->alias['width']) {
            return $this->alias['width'];
        }

        return $this->alias['height'];
    }

    private function validateAlias()
    {
        foreach ($this->alias as $name => $value) {
            if (!in_array($name, array('width', 'height'))) {
                throw new \LogicException($name.' is not a good key');
            }

            if (in_array($name, array('width', 'height')) && (!preg_match('#^\d+$#', $value) && $value !== null)) {
                throw new \LogicException($value.' must be a integer or null');
            }
        }
    }
}
