<?php

namespace PNGify;

use PNGify\Exporter\Factory;

class FileConverter {

    protected $path;
    protected $extension;
    protected $mappings;

    public function __construct($path, $extension = null)
    {
        $this->path = $path;
        $this->extension = $extension;
    }

    public function setMappings($mappings)
    {
        $this->mappings = $mappings;
    }

    public function getMappings()
    {
        return $this->mappings;
    }

    private function getPath()
    {
        return $this->path;
    }

    private function getExporter($extension)
    {
        $factory = new Factory($this->mappings);
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