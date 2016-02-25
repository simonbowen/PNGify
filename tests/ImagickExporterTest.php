<?php

class ImagickExporterTest extends PHPUnit_Framework_TestCase {

    protected $assetPath = './tests/assets/test.pdf';

    public function testConvertsPdfToPng()
    {
        $pdfExporter = new \PNGify\Exporter\Imagick(__DIR__ . '/assets/test.pdf');
        $image = $pdfExporter->export();

        $tmpPath = './tests/tmp/pdf.png';
        file_put_contents($tmpPath, $image);

        $control = new Imagick('./tests/results/pdf.png');
        $sample = new Imagick($tmpPath);

        $diff = $control->compareImages($sample, Imagick::METRIC_MEANSQUAREERROR);
        $this->assertEquals(0, $diff[1]);

    }


}