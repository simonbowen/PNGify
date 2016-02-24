<?php

namespace Thummer\Exporter;

class Imagick implements ExporterInterface {

    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    public function export($pageNumber = 0)
    {
        $image = new \Imagick($this->filePath . "[{$pageNumber}]");
        $image->setImageFormat("png");

        return $image->getImageBlob();
    }

}