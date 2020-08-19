<?php

namespace FeedCreator\ParseExcelFile;

use SimpleXLSX;

function parseExcelFile(string $pathToInputFile): array
{
    $xlsxFileRows = SimpleXLSX::parse($pathToInputFile)->rows();
    $headerValues = $xlsxFileRows[0];
    $rowsWithHeaderValuesAsKey = array_map(function ($value) use ($headerValues) {
        return array_combine($headerValues, $value);
    }, $xlsxFileRows);

    return $rowsWithHeaderValuesAsKey;
}
