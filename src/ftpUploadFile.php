<?php

const HOST = 'vh252.timeweb.ru';
const FTP_USER_NAME = 'skfamilyug_feed';
$ftp_user_pass = '***';

$conn_id = ftp_connect(HOST);
$login_result = ftp_login($conn_id, FTP_USER_NAME, $ftp_user_pass);

// check connection
if ((!$conn_id) || (!$login_result)) {
    echo "FTP connection has failed!";
    echo "Attempted to connect to " . HOST .  "for user " . FTP_USER_NAME;
    exit;
} else {
    echo "Connected to " . HOST . ", for user " . FTP_USER_NAME . "\n";
}

// upload the file
$source_file = __DIR__ . '/../outputFiles/feed.xml';
$destination_file = 'feed.xml';
$upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY);

// check upload status
if (!$upload) {
    echo "FTP upload has failed!";
} else {
    echo "Uploaded $source_file to " . HOST . " as $destination_file";
}

// close the FTP stream
ftp_close($conn_id);
