<?php

namespace FeedCreator;

use Carbon\Carbon;

use function FeedCreator\ParseExcelFile\parseExcelFile;
use function FeedCreator\MakeFeedOffers\makeFeedOffers;

const XML_INFO = <<<XMLINFO
<?xml version="1.0" encoding="utf-8"?>
<realty-feed xmlns="http://webmaster.yandex.ru/schemas/feed/realty/2010-06">
XMLINFO;
const FEED_PART_FOOTER = "\n</realty-feed>";

function createFeed($pathToInputFile, $pathToOutputFile, $creationDate)
{
    $rows = parseExcelFile($pathToInputFile);
    $timeNow = Carbon::now()->toW3cString();
    $tagGenDate = "\n<generation-date>{$timeNow}</generation-date>\n";
    $feedPartHeader = XML_INFO . $tagGenDate;
    $feedPartOffer = makeFeedOffers($rows, $creationDate);
    $resultFeed = $feedPartHeader . $feedPartOffer . FEED_PART_FOOTER;
    
    return file_put_contents($pathToOutputFile, $resultFeed);
}
