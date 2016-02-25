# Thummer

A tool to convert most file formats to a PNG. This tool was written as I had a requirement
to allow users to upload a multitude of file types and for this process to generate a thumbail
from the user uploaded file where possible.

## Usage

This can be used on the command line with 

> php console.php pngify:convert \<file\> \[\<output\>\]

> php console.php pngify:convert ~/Desktop/awesome_design.psd ~/Desktop/awesome_design.png

## Set up

Ensure you have LibreOffice installed.

Copy ./config.php.example to ./config.php. Update the binary path to SOffice.

On OSX the binary path is

> /Applications/LibreOffice.app/Contents/MacOS/soffice

You can fire up a HTTP server for demonstration

> php -S \<host\>:\<port\> 

> php -S localhost:8000

and go to [http://localhost:8000]()


## TODO

Finish It.

- Validation on the HTTP request to ensure that we can handle the POST'd file
- Write some more tests
- Allow user to specify a file already on the server via HTTP, maybe with a $_GET var
- Rudimentary thumbnailing of the generated files 