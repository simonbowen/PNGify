<?php

namespace PNGify\Exporter;

class SOffice implements ExporterInterface {

    protected $binary;
    protected $filePath;
    protected $outputDir;

    public function __construct($filePath, $binary, $outputDir)
    {
        $this->filePath = $filePath;
        $this->binary = $binary;
        $this->outputDir = $outputDir;
    }

    public function setBinary($binary)
    {
        $this->binary = $binary;
    }

    public function getBinary()
    {
        return $this->binary;
    }


    protected function createCommand($file)
    {
        $tmpDir = md5_file($file);
        $command = $this->getBinary() . " --headless --convert-to png {$file} --outdir /tmp/{$this->outputDir}";
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