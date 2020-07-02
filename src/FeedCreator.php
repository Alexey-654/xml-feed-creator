<?php

namespace Feed\Creator;

use Carbon\Carbon;
use SimpleXLSX;

const XML_INFO = <<<XMLINFO
<?xml version="1.0" encoding="utf-8"?>
<realty-feed xmlns="http://webmaster.yandex.ru/schemas/feed/realty/2010-06">
XMLINFO;

const FOOTER = '</realty-feed>';
const CREATION_DATE = '2020-06-21T00:00:00+03:00';
const PATH_TO_OUTPUT_FILE = __DIR__ . '/../output-files/feed.xml';


function createFeed(string $inputFile, string $pathToOutputFile = PATH_TO_OUTPUT_FILE): void
{
    $rows = parsExcel($inputFile);
    $now = Carbon::now()->toW3cString();
    $genDate = "\n<generation-date>{$now}</generation-date>" . "\n";
    $header = XML_INFO . $genDate;

    $offer = makeOffer($rows, CREATION_DATE);
    $resultFeed = $header . $offer . FOOTER;
    $outputFile = file_put_contents($pathToOutputFile, $resultFeed);

    if ($outputFile !== false) {
        echo "Your XML file have been successfully generated. \nLook up here - " . realpath($pathToOutputFile) . "\n\n";
    }
}


function parsExcel(string $inputFile): array
{
    $headerValues = [];
    $rows = [];
    $xlsx = SimpleXLSX::parse($inputFile);
    foreach ($xlsx->rows() as $key => $row) {
        if ($key === 0) {
            $headerValues = $row;
            continue;
        }
        $rows[] = array_combine($headerValues, $row);
    }
    
    return $rows;
}


function makeOffer(array $rows, string $creationDate, string $offer = ''): string
{
    foreach ($rows as $row) {
        if ($row['status'] === 'В продаже') {
            $offer .= '<offer internal-id="' . $row['offer id'] . '">' . "\n";
            $offer .= '<type>' . $row['type'] . '</type>' . "\n";
            $offer .= '<property-type>' . $row['property-type'] . '</property-type>' . "\n";
            $offer .= '<category>' . $row['category flat'] . '</category>' . "\n";
            $offer .= '<creation-date>' . $creationDate . '</creation-date>' . "\n";
        
            // inner elements location start
            $offer .= '<location>' . "\n";
            $offer .= '<country>' . $row['country'] . '</country>' . "\n";
            $offer .= '<locality-name>' . $row['locality-name'] . '</locality-name>' . "\n";
            $offer .= '<address>' . $row['address'] . '</address>' . "\n";
            $offer .= '</location>' . "\n";
            // inner elements location end
        
            $offer .= '<deal-status>' . $row['deal-status'] . '</deal-status>' . "\n";
        
            // inner elements price start
            $offer .= '<price>' . "\n";
            $offer .= '<value>' . $row['value'] . '</value>' . "\n";
            $offer .= '<currency>' . $row['currency'] . '</currency>' . "\n";
            $offer .= '</price>' . "\n";
            // inner elements price end
        
            // inner elements sales-agent start
            $offer .= '<sales-agent>' . "\n";
            $offer .= '<phone>' . $row['phone'] . '</phone>' . "\n";
            $offer .= '<organization>' . $row['organization'] . '</organization>' . "\n";
            $offer .= '<url>' . $row['url'] . '</url>' . "\n";
            $offer .= '<category>' . $row['category'] . '</category>' . "\n";
            $offer .= '<photo>' . $row['photo'] . '</photo>' . "\n";
            $offer .= '</sales-agent>' . "\n";
            // inner elements sales-agent end

            $offer .= (empty($row['rooms']))
                    ? '<studio>' . $row['studio'] . '</studio>' . "\n"
                    : '<rooms>' . $row['rooms'] . '</rooms>' . "\n";

            $offer .= '<new-flat>' . $row['new-flat'] . '</new-flat>' . "\n";
            $offer .= '<bathroom-unit>' . $row['bathroom-unit'] . '</bathroom-unit>' . "\n";
            $offer .= '<balcony>' . $row['balcony'] . '</balcony>' . "\n";
            $offer .= '<floor>' . $row['floor'] . '</floor>' . "\n";
            $offer .= '<floors-total>' . $row['floors-total'] . '</floors-total>' . "\n";
            $offer .= '<building-name>' . $row['building-name'] . '</building-name>' . "\n";
            $offer .= '<yandex-building-id>' . $row['yandex-building-id'] . '</yandex-building-id>' . "\n";
            $offer .= '<yandex-house-id>' . $row['yandex-house-id'] . '</yandex-house-id>' . "\n";
            $offer .= '<building-state>' . $row['building-state'] . '</building-state>' . "\n";
            $offer .= '<ready-quarter>' . $row['ready-quarter'] . '</ready-quarter>' . "\n";
            $offer .= '<built-year>' . $row['built-year'] . '</built-year>' . "\n";
            
            // images start
            $offer .= '<image>' . $row['image1'] . '</image>' . "\n";
            $offer .= '<image>' . $row['image2'] . '</image>' . "\n";
            $offer .= '<image>' . $row['image3'] . '</image>' . "\n";
            $offer .= '<image>' . $row['image4'] . '</image>' . "\n";
            $offer .= '<image>' . $row['image5'] . '</image>' . "\n";
            $offer .= '<image>' . $row['image6'] . '</image>' . "\n";
            $offer .= '<image>' . $row['image7'] . '</image>' . "\n";
            $offer .= '<image>' . $row['image8'] . '</image>' . "\n";
            // images end
            
            // inner elements area start
            $offer .= '<area>' . "\n";
            $offer .= '<value>' . $row['value_area'] . '</value>' . "\n";
            $offer .= '<unit>' . $row['unit_area'] . '</unit>' . "\n";
            $offer .= '</area>' . "\n";
            // inner elements area end
        
            // inner elements living-space start
            $offer .= '<living-space>' . "\n";
            $offer .= '<value>' . $row['value-living-space'] . '</value>' . "\n";
            $offer .= '<unit>' . $row['unit-living-space'] . '</unit>' . "\n";
            $offer .= '</living-space>' . "\n";
            // inner elements living-space end
        
            $offer .= '</offer>' . "\n";
        }
    }

    return  $offer;
}
