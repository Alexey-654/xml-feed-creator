<?php

namespace feedCreator;

use Carbon\Carbon;
use SimpleXLSX;

function createFeed($inputFileName, $outputFeedFile)
{
    $rows = parsExcel($inputFileName);

    $xmlInfo = <<<XMLINFO
    <?xml version="1.0" encoding="utf-8"?>
    <realty-feed xmlns="http://webmaster.yandex.ru/schemas/feed/realty/2010-06">
    XMLINFO;
    $now = Carbon::now()->toW3cString();
    $creationDate = Carbon::create(2020, 6, 21)->toW3cString();
    $genDate = "\n<generation-date>{$now}</generation-date>" . "\r\n";

    $header = $xmlInfo . $genDate;

    $offer = makeOffer($rows, '', $creationDate);
    $footer = "</realty-feed>";

    $resultFeed = $header . $offer . $footer;
    $outputFile = file_put_contents($outputFeedFile, $resultFeed);
    if ($outputFile !== false) {
        echo "Your XML file have been successfully generated. \nLook up here - " . $outputFeedFile . "\n\n";
    }
}

function parsExcel($inputFileName)
{
    if ($xlsx = SimpleXLSX::parse($inputFileName)) {
        $header_values = $rows = [];
        foreach ($xlsx->rows() as $k => $r) {
            if ($k === 0) {
                $header_values = $r;
                continue;
            }
            $rows[] = array_combine($header_values, $r);
        }
    }
    return $rows;
}

function makeOffer($rows, $offer, $creationDate)
{
    foreach ($rows as $row) {
        $offer .= '<offer internal-id="' . $row['offer id'] . '">' . "\r\n";
        $offer .= '<type>' . $row['type'] . '</type>' . "\r\n";
        $offer .= '<property-type>' . $row['property-type'] . '</property-type>' . "\r\n";
        $offer .= '<category>' . $row['category flat'] . '</category>' . "\r\n";
        $offer .= '<creation-date>' . $creationDate . '</creation-date>' . "\r\n";
    
        // inner elements location start
        $offer .= '<location>' . "\r\n";
        $offer .= '<country>' . $row['country'] . '</country>' . "\r\n";
        $offer .= '<locality-name>' . $row['locality-name'] . '</locality-name>' . "\r\n";
        $offer .= '<address>' . $row['address'] . '</address>' . "\r\n";
        $offer .= '</location>' . "\r\n";
        // inner elements location end
    
        $offer .= '<deal-status>' . $row['deal-status'] . '</deal-status>' . "\r\n";
    
        // inner elements price start
        $offer .= '<price>' . "\r\n";
        $offer .= '<value>' . $row['value'] . '</value>' . "\r\n";
        $offer .= '<currency>' . $row['currency'] . '</currency>' . "\r\n";
        $offer .= '</price>' . "\r\n";
        // inner elements price end
    
        // inner elements sales-agent start
        $offer .= '<sales-agent>' . "\r\n";
        $offer .= '<phone>' . $row['phone'] . '</phone>' . "\r\n";
        $offer .= '<organization>' . $row['organization'] . '</organization>' . "\r\n";
        $offer .= '<url>' . $row['url'] . '</url>' . "\r\n";
        $offer .= '<category>' . $row['category'] . '</category>' . "\r\n";
        $offer .= '<photo>' . $row['photo'] . '</photo>' . "\r\n";
        $offer .= '</sales-agent>' . "\r\n";
        // inner elements sales-agent end
    
        $offer .= '<rooms>' . $row['rooms'] . '</rooms>' . "\r\n";
        $offer .= '<new-flat>' . $row['new-flat'] . '</new-flat>' . "\r\n";
        $offer .= '<bathroom-unit>' . $row['bathroom-unit'] . '</bathroom-unit>' . "\r\n";
        $offer .= '<balcony>' . $row['balcony'] . '</balcony>' . "\r\n";
        $offer .= '<floor>' . $row['floor'] . '</floor>' . "\r\n";
        $offer .= '<floors-total>' . $row['floors-total'] . '</floors-total>' . "\r\n";
        $offer .= '<building-name>' . $row['building-name'] . '</building-name>' . "\r\n";
        $offer .= '<yandex-building-id>' . $row['yandex-building-id'] . '</yandex-building-id>' . "\r\n";
        $offer .= '<yandex-house-id>' . $row['yandex-house-id'] . '</yandex-house-id>' . "\r\n";
        $offer .= '<building-state>' . $row['building-state'] . '</building-state>' . "\r\n";
        $offer .= '<ready-quarter>' . $row['ready-quarter'] . '</ready-quarter>' . "\r\n";
        $offer .= '<image>' . $row['image1'] . '</image>' . "\r\n";
    
        // inner elements area start
        $offer .= '<area>' . "\r\n";
        $offer .= '<value>' . $row['value_area'] . '</value>' . "\r\n";
        $offer .= '<unit>' . $row['unit_area'] . '</unit>' . "\r\n";
        $offer .= '</area>' . "\r\n";
        // inner elements area end
    
        // inner elements living-space start
        $offer .= '<living-space>' . "\r\n";
        $offer .= '<value>' . $row['value-living-space'] . '</value>' . "\r\n";
        $offer .= '<unit>' . $row['unit-living-space'] . '</unit>' . "\r\n";
        $offer .= '</living-space>' . "\r\n";
        // inner elements living-space end
    
        // inner elements kitchen-space start
        $offer .= '<kitchen-space>' . "\r\n";
        $offer .= '<value>' . $row['value-kitchen-space'] . '</value>' . "\r\n";
        $offer .= '<unit>' . $row['unit-kitchen-space'] . '</unit>' . "\r\n";
        $offer .= '</kitchen-space>' . "\r\n";
        // inner elements kitchen-space end
    
        // inner elements room-space start
        $offer .= '<room-space>' . "\r\n";
        $offer .= '<value>' . $row['value-room-space'] . '</value>' . "\r\n";
        $offer .= '<unit>' . $row['unit-room-space'] . '</unit>' . "\r\n";
        $offer .= '</room-space>' . "\r\n";
        // inner elements room-space end
    
        $offer .= '</offer>' . "\r\n";
    }
    return  $offer;
}
