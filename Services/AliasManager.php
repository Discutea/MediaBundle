<?php

namespace Discutea\MediaBundle\Services;

use Discutea\MediaBundle\Manager\MediaManagerInterface;

class AliasManager
{
    private $config;

    private $alias = null;

    private $name = MediaManagerInterface::ORIGINAL_DIR;

    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    public function buildAlias(array $alias = null): AliasManager
    {
        if (is_array($alias) && $alias) {
            $this->alias = array_replace(array('width' => null, 'height' => null), $alias);
            $this->valideAlias();
            $this->name = $this->aliasToName();

            $this->checkDirectory($this->name);
        }

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAlias(): ?array
    {
        return $this->alias;
    }

    private function checkDirectory(string $name)
    {
        $directory = $this->config->get('path') . $name;

        if (false === is_dir($directory)) {
            return mkdir($directory, 0755, true);
        }

        return true;
    }

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


    private function valideAlias()
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
