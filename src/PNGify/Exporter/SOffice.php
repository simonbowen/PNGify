<?php

namespace PNGify\Exporter;

class SOffice implements ExporterInterface {

    protected $binary;
    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
        $this->setUp();
    }

    public function setBinary($binary)
    {
        $this->binary = $binary;
    }

    public function getBinary()
    {
        return $this->binary;
    }

    public function setUp()
    {
        $config = require './config.php';
        $this->setBinary($config['soffice_path']);
    }

    protected function createCommand($file)
    {
        $tmpDir = md5_file($file);
        $command = $this->getBinary() . " --headless --convert-to png {$file} --outdir /tmp/{$tmpDir}";
        return $command;
    }

    public function export($pageNumber = 0)
    {
        // Get the path for soffice
        $pathInfo = pathinfo($this->filePath);

        $tmpDir = md5_file($this->filePath);
        $command = $this->createCommand($this->filePath);

        exec($command);

        $convertedFilePath = implode(DIRECTORY_SEPARATOR, [
            "/tmp",
            $tmpDir,
            $pathInfo['filename'] . ".png"
        ]);

        return file_get_contents($convertedFilePath);
    }

}