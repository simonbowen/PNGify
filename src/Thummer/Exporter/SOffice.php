<?php

namespace Thummer\Exporter;

class SOffice implements ExporterInterface {

    protected $path = '/Applications/LibreOffice.app/Contents/MacOS';
    protected $filePath;

    public function __construct($filePath)
    {
        $this->filePath = $filePath;
    }

    protected function createCommand($file)
    {
        $tmpDir = md5_file($file);
        $command = $this->path . "/soffice --headless --convert-to png {$file} --outdir /tmp/{$tmpDir}";
        return $command;
    }

    public function export($pageNumber = 0)
    {
        // Get the path for soffice
        $pathInfo = pathinfo($this->filePath);

        $tmpDir = md5_file($this->filePath);
        $command = $this->createCommand($this->filePath);

        exec($command);

        $convertedFilePath = implode(DIRECTORY_SEPARATOR, ["/tmp", $tmpDir, $pathInfo['filename'] . ".png"]);
        return file_get_contents($convertedFilePath);
    }

}