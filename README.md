# CLI utility - xml-feed-creator

[![Maintainability](https://api.codeclimate.com/v1/badges/f0a93a4dd66185e09eaf/maintainability)](https://codeclimate.com/github/Alexey-654/xml-feed-creator/maintainability)

This project helps generate xml file from xlsx file type.
Then this xml-feed goes to web and parsed by realty.yandex.ru and other classified advertisements website.


## Installation
```bash
$ git clone https://github.com/Alexey-654/xml-feed-creator.git
$ cd xml-feed-creator
$ make install
```

## Usage
In your Unix terminal go to the directory with installed package, then type:
```bash
$ bin/xmlfeed <pathToInputFile> [<pathToOutputFile>]
```

On Windows in your shell type -
```bash
$ php .\bin\xmlfeed .\sample-data\InputData.xlsx
```
 