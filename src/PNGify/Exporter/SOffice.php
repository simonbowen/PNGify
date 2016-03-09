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
        $pdf = $this->outputDir . '/' . pathinfo($file)['filename'] . '.pdf';
        $command = "export HOME=/tmp && " . $this->getBinary() . " --headless --convert-to pdf {$file} --outdir {$this->outputDir} && " . $this->getBinary() . " --headless --convert-to png {$pdf} --outdir {$this->outputDir}";
        return $command;
    }

    public function export($pageNumber = 0)
    {
        // Get the path for soffice
        $command = $this->createCommand($this->filePath);

        exec($command);

        $pathInfo = pathinfo($this->filePath);

        $convertedFilePath = implode(DIRECTORY_SEPARATOR, [
            $this->outputDir,
            $pathInfo['filename'] . ".png",
        ]);

        return file_get_contents($convertedFilePath);
    }

}