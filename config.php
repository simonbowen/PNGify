<?php

return [
    'extensions' => [
        '\PNGify\Exporter\SOffice' => [
            'docx', 'pptx', 'xlsx', 'doc', 'ppt', 'xls'
        ],
        '\PNGify\Exporter\Imagick' => [
            'pdf', 'psd'
        ]
    ],
    'soffice_path' => '/Applications/LibreOffice.app/Contents/MacOS/soffice',
    'soffice_outputDir' => '/Users/simonbowen/Code/Criteo/files/tmp',
];