<?php

namespace FeedCreator\Tests;

use PHPUnit\Framework\TestCase;

use function FeedCreator\createFeed;

class FeedCreatorTest extends TestCase
{
    public function testFeedCreator()
    {
        $pathToExpectedFile = __DIR__ . '/../tests/fixtures/expectedfeed.xml';
        $expectedData = file_get_contents($pathToExpectedFile, false, null, 3);
        $creationDate = '2020-06-21T00:00:00+03:00';
        $pathToInputFile = __DIR__ . '/../tests/fixtures/InputData.xlsx';
        $pathToOutputFile = __DIR__ . '/../tests/fixtures/feed.xml';
        $createFeedResult = createFeed($pathToInputFile, $pathToOutputFile, $creationDate);
        $resultData = file_get_contents($pathToExpectedFile, false, null, 3);

        $this->assertEquals($expectedData, $resultData);
    }
}
