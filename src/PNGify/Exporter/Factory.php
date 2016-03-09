<?php

namespace PNGify\Exporter;

use PNGify\Exceptions\InvalidFileExtension;

class Factory {

    protected $config = [];

    public function __construct($config)
    {
        $this->config = $config;
    }

    protected function getExporter($extension)
    {
        foreach ($this->config['extensions'] as $class => $extensions) {
           if (in_array($extension, $extensions)) {
               return $class;
           }
        }

        throw new InvalidFileExtension();
    }

    public function __invoke($path, $extension)
    {
        $fqn = $this->getExporter($extension);

        // Wrong
        if($fqn == '\PNGify\Exporter\SOffice') {
            return new $fqn(
                $path, $this->config['soffice_path'], $this->config['soffice_outputDir']
            );
        }

        return new $fqn($path);
    }

}