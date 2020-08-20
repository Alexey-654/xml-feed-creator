<?php

namespace FeedCreator\MakeFeedOffers;

function makeFeedOffers(array $rows, string $creationDate)
{
    $offers = [];
    foreach ($rows as $row) {
        if ($row['status'] === 'В продаже') {
            $offers[] = '<offer internal-id="' . $row['offer id'] . '">';
            $offers[] = '<type>' . $row['type'] . '</type>';
            $offers[] = '<property-type>' . $row['property-type'] . '</property-type>';
            $offers[] = '<category>' . $row['category flat'] . '</category>';
            $offers[] = '<creation-date>' . $creationDate . '</creation-date>';
            $offers[] = '<location>'; // inner elements location start
            $offers[] = '<country>' . $row['country'] . '</country>';
            $offers[] = '<locality-name>' . $row['locality-name'] . '</locality-name>';
            $offers[] = '<address>' . $row['address'] . '</address>';
            $offers[] = '</location>'; // inner elements location end
            $offers[] = '<deal-status>' . $row['deal-status'] . '</deal-status>';
            $offers[] = '<price>'; // inner elements price start
            $offers[] = '<value>' . $row['value'] . '</value>';
            $offers[] = '<currency>' . $row['currency'] . '</currency>';
            $offers[] = '</price>'; // inner elements price end
            $offers[] = '<sales-agent>'; // inner elements sales-agent start
            $offers[] = '<phone>' . $row['phone'] . '</phone>';
            $offers[] = '<organization>' . $row['organization'] . '</organization>';
            $offers[] = '<url>' . $row['url'] . '</url>';
            $offers[] = '<category>' . $row['category'] . '</category>';
            $offers[] = '<photo>' . $row['photo'] . '</photo>';
            $offers[] = '</sales-agent>'; // inner elements sales-agent end
            $offers[] = (empty($row['rooms']))
                    ? '<studio>' . $row['studio'] . '</studio>'
                    : '<rooms>' . $row['rooms'] . '</rooms>';
            $offers[] = '<new-flat>' . $row['new-flat'] . '</new-flat>';
            $offers[] = '<bathroom-unit>' . $row['bathroom-unit'] . '</bathroom-unit>';
            $offers[] = '<balcony>' . $row['balcony'] . '</balcony>';
            $offers[] = '<floor>' . $row['floor'] . '</floor>';
            $offers[] = '<floors-total>' . $row['floors-total'] . '</floors-total>';
            $offers[] = '<building-name>' . $row['building-name'] . '</building-name>';
            $offers[] = '<yandex-building-id>' . $row['yandex-building-id'] . '</yandex-building-id>';
            $offers[] = '<yandex-house-id>' . $row['yandex-house-id'] . '</yandex-house-id>';
            $offers[] = '<building-section>' . $row['building-section'] . '</building-section>';
            $offers[] = '<building-state>' . $row['building-state'] . '</building-state>';
            $offers[] = '<ready-quarter>' . $row['ready-quarter'] . '</ready-quarter>';
            $offers[] = '<built-year>' . $row['built-year'] . '</built-year>';
            $offers[] = '<image>' . $row['image1'] . '</image>'; // images start
            $offers[] = '<image>' . $row['image2'] . '</image>';
            $offers[] = '<image>' . $row['image3'] . '</image>';
            $offers[] = '<image>' . $row['image4'] . '</image>';
            $offers[] = '<image>' . $row['image5'] . '</image>';
            $offers[] = '<image>' . $row['image6'] . '</image>';
            $offers[] = '<image>' . $row['image7'] . '</image>';
            $offers[] = '<image>' . $row['image8'] . '</image>'; // images end
            $offers[] = '<area>'; // inner elements area start
            $offers[] = '<value>' . $row['value_area'] . '</value>';
            $offers[] = '<unit>' . $row['unit_area'] . '</unit>';
            $offers[] = '</area>'; // inner elements area end
            $offers[] = '<living-space>'; // inner elements living-space start
            $offers[] = '<value>' . $row['value-living-space'] . '</value>';
            $offers[] = '<unit>' . $row['unit-living-space'] . '</unit>';
            $offers[] = '</living-space>'; // inner elements living-space end
            $offers[] = '</offer>';
        }
    }

    return  implode("\n", $offers);
}
