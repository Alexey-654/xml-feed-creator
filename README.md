# <img src="https://img.shields.io/badge/php-%23777BB4.svg?&style=for-the-badge&logo=php&logoColor=white"/> xml-feed-creator
This project helps generate xml file for classified advertisements websites (realty.yandex.ru, cian.ru).  
It parse data from excel file and ouput valid xml file.

![CI](https://github.com/Alexey-654/xml-feed-creator/workflows/CI/badge.svg)
[![Maintainability](https://api.codeclimate.com/v1/badges/f0a93a4dd66185e09eaf/maintainability)](https://codeclimate.com/github/Alexey-654/xml-feed-creator/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/f0a93a4dd66185e09eaf/test_coverage)](https://codeclimate.com/github/Alexey-654/xml-feed-creator/test_coverage)


## Installation
```bash
$ git clone https://github.com/Alexey-654/xml-feed-creator.git
$ cd xml-feed-creator
$ make install
```

## Usage
One simple function
```bash
createFeed($pathToInputFile, $pathToOutputFile, $creationDate);
```