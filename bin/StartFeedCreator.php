<?php

use function FeedCreator\createFeed;

const CREATION_DATE = '2020-06-21T00:00:00+03:00';

$autoloadPath1 = __DIR__ . '/../../../autoload.php';
$autoloadPath2 = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath1)) {
    require_once $autoloadPath1;
} else {
    require_once $autoloadPath2;
}

$pathToInputFile = __DIR__ . '/../tests/fixtures/InputData.xlsx';
$pathToOutputFile = __DIR__ . '/../tests/fixtures/feed.xml';

$createFeedResult = createFeed($pathToInputFile, $pathToOutputFile, CREATION_DATE);

echo $createFeedResult === false
        ? "Error happens. Relax, take a deep breath and try again."
        : "Your XML file have been successfully generated. \nLook up here - " . realpath($pathToOutputFile) . "\n\n";
