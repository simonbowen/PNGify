<?php

class FileConverterTest extends PHPUnit_Framework_TestCase {

    protected $assetPath = './assets/test.docx';

    protected function getInstance()
    {
        return (new \PNGify\FileConverter($this->assetPath))->setMappings([
            '\\PNGify\\Exporter\\Imagick' => ['pdf'],
        ]);
    }

    public function testGetPath()
    {
        $this->assertEquals($this->assetPath, $this->getInstance()->getPath());
    }

    public function testGetExporter()
    {
        $exporter = $this->getInstance()->getExporter('pdf');
        $this->assertInstanceOf('PNGify\\Exporter\\Imagick', $exporter);
    }

}