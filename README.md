# Thummer

A tool to convert most file formats to a PNG. This tool was written as I had a requirement
to allow users to upload a multitude of file types and for this process to generate a thumbail
from the user uploaded file where possible.

## Setup 

This can be used on the command line with 

> php console.php thummer:convert \<file\> \[\<output\>\]

## TODO

Finish It.

- Validation on the HTTP request to ensure that we can handle the POST'd file
- Write some more tests
- Allow user to specify a file already on the server via HTTP, maybe with a $_GET var
- Rudimentary thumbnailing of the generated files 
- Don't hardcode the binary path of soffice