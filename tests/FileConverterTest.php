<?php

class FileConverterTest extends PHPUnit_Framework_TestCase {

    protected $assetPath = './assets/test.docx';

    protected function getInstance()
    {
        return new \Thummer\FileConverter($this->assetPath);
    }

    public function testGetPath()
    {
        $this->assertEquals($this->assetPath, $this->getInstance()->getPath());
    }

    public function testGetExporter()
    {
        $exporter = $this->getInstance()->getExporter('pdf');
        $this->assertInstanceOf('Thummer\\Exporter\\Pdf', $exporter);
    }

}