<?php

namespace PNGify\Exporter;

class SOffice implements ExporterInterface {

    protected $binary;
    protected $filePath;
    protected $outputDir;
    protected $homeDir;

    public function __construct($filePath, $binary, $outputDir, $homeDir)
    {
        $this->filePath = $filePath;
        $this->binary = $binary;
        $this->outputDir = $outputDir;
        $this->homeDir = $homeDir;
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
        $pathinfo = pathinfo($file);
        $pdf = $this->outputDir . '/' . pathinfo($file)['filename'] . '.pdf';
        $command = $this->getBinary() . " --headless --convert-to pdf {$file} --outdir {$this->outputDir}; " . $this->getBinary() . " --headless --convert-to png {$pdf} --outdir {$this->outputDir}";

        // Straight to png
        if($pathinfo['extension'] == 'docx' or $pathinfo['extension'] == 'doc') {
            $command = $this->getBinary() . " --headless --convert-to png {$file} --outdir {$this->outputDir}";
        }

        if ($this->homeDir) {
            $command = "export HOME=" . $this->homeDir . " && " . $command;
        }

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