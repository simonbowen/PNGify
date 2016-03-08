<?php

namespace PNGify;

use PNGify\Exporter\Factory;

class FileConverter {

    protected $path;
    protected $extension;
    protected $config;

    public function __construct($path, $extension = null)
    {
        $this->path = $path;
        $this->extension = $extension;
    }

    public function setConfig($config)
    {
        $this->config = $config;
        return $this;
    }

    public function getConfig()
    {
        return $this->config;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getExporter($extension)
    {
        $factory = new Factory($this->config);
        return $factory($this->getPath(), $extension);
    }

    private function getExtension()
    {
        if ($this->extension) {
            return $this->extension;
        } else {
            return pathinfo($this->getPath())['extension'];
        }
    }

    public function toImage()
    {
        $exporter = $this->getExporter($this->getExtension());
        return $exporter->export();
    }

}