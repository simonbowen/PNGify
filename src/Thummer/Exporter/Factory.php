<?php

namespace Thummer\Exporter;

class Factory {

    protected $map = [
        'SOffice' => ['docx', 'pptx', 'xlsx', 'doc', 'ppt', 'xls'],
        'Imagick' => ['pdf', 'psd'],
    ];

    protected function getExporter($extension)
    {
        foreach ($this->map as $class => $extensions) {
           if (in_array($extension, $extensions)) {
               return $class;
           }
        }
    }

    public function __invoke($path, $extension)
    {
        $fqn = 'Thummer\\Exporter\\' . $this->getExporter($extension);
        return new $fqn($path);
    }

}