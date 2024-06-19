<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/facades/s3.php';

$s3 = new s3BucketFacade;

$s3->downloadAllFilesInBucket();
