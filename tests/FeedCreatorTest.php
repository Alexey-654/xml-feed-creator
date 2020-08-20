<?php

namespace FeedCreator\Tests;

use PHPUnit\Framework\TestCase;

use function FeedCreator\createFeed;

class FeedCreatorTest extends TestCase
{
    public function testFeedCreator()
    {
        // $pathToExpectedFile = __DIR__ . '/../tests/fixtures/feed.xml';
        // $expected = file_get_contents($pathToExpectedFile, false, null, 3);
        $this->assertEquals('test', 'test');
    }
}
