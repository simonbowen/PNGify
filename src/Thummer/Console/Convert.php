<?php

namespace Thummer\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Thummer\Exporter\Factory;

class Convert extends Command {

    public function configure()
    {
        $this
            ->setName('thummer:convert')
            ->setDescription('Convert a document to a PNG')
            ->addArgument('file', InputArgument::REQUIRED, 'The file you wish to convert')
            ->addArgument('output', InputArgument::OPTIONAL, 'Location to save the file to');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');

        $pathInfo = pathinfo($file);
        $outputPath = $input->getArgument('output') ?: $pathInfo['filename'] . ".png";

        $factory = new Factory();
        $exporter = $factory($pathInfo['extension'], $file);

        $image = $exporter->export();

        file_put_contents($outputPath, $image);

        $output->writeln("<info>Converting file: {$file} to png</info>");
        $output->writeln("<info>File written to: {$outputPath}</info>");
    }

}