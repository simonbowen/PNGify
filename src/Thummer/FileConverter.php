<?php

namespace Thummer;

use Thummer\Exporter\Factory;

class FileConverter {

    protected $path;
    protected $extension;

    public function __construct($path, $extension = null)
    {
        $this->path = $path;
        $this->extension = $extension;
    }

    private function getPath()
    {
        return $this->path;
    }

    private function getExporter($extension)
    {
        $factory = new Factory;
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