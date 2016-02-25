<?php

namespace PNGify\Exporter;

use PNGify\Exceptions\InvalidFileExtension;

class Factory {

    protected $mappings = [];

    public function __construct($mappings)
    {
        $this->mappings = $mappings;
    }

    protected function getExporter($extension)
    {
        foreach ($this->mappings as $class => $extensions) {
           if (in_array($extension, $extensions)) {
               return $class;
           }
        }

        throw new InvalidFileExtension();
    }

    public function __invoke($path, $extension)
    {
        $fqn = $this->getExporter($extension);
        return new $fqn($path);
    }

}