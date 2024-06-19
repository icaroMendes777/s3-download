<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/facades/s3.php';


// $dotenv = new Dotenv();
// $dotenv->loadEnv(__DIR__ . '/.env');

// define('AWS_KEY', $_ENV['AWS_KEY']);
// define('AWS_SECRET_KEY', $_ENV['AWS_SECRET_KEY']);
// define('DESKTOP_ROOT_FILE', $_ENV['DESKTOP_ROOT_FILE']);


// // require the amazon sdk from your composer vendor dir

// // Instantiate the S3 class and point it at the desired host
// $client = new S3Client([
//     'region' => '',
//     'version' => '2006-03-01',
//     'region' => 'us-east-1',
//     //'endpoint' => $ENDPOINT,
//     'credentials' => [
//         'key' => AWS_KEY,
//         'secret' => AWS_SECRET_KEY
//     ],
//     // Set the S3 class to use objects.dreamhost.com/bucket
//     // instead of bucket.objects.dreamhost.com
//     //'use_path_style_endpoint' => true
// ]);

// function downloadFileFromS3(S3Client $s3, $bucketName, $fileName, $localFilePath)
// {
//     try {
//         $result = $s3->getObject([
//             'Bucket' => $bucketName,
//             'Key'    => $fileName,
//             'SaveAs' => $localFilePath,
//         ]);

//         return true;
//     } catch (S3Exception $e) {
//         return "Error downloading file: " . $e->getMessage();
//     }
// }

// function listBuckets(S3Client $client)
// {
//     $listResponse = $client->listBuckets();
//     $buckets = $listResponse['Buckets'];
//     foreach ($buckets as $bucket) {
//         echo $bucket['Name'] . "\t" . $bucket['CreationDate'] . "\n";
//     }
// }

// function createDirectoryIfNotExists($dirPath)
// {
//     // Check if the directory exists
//     if (!file_exists($dirPath)) {
//         // Directory does not exist, create it
//         if (!mkdir($dirPath, 0777, true)) {
//             // Failed to create directory
//             return "Failed to create directory: $dirPath";
//         }
//         return "Directory created: $dirPath";
//     } else {
//         // Directory already exists
//         return "Directory already exists: $dirPath";
//     }
// }


// function downloadAllFilesInBucket($client, $bucket)
// {

//     try {
//         // List objects in the bucket
//         $objects = $client->listObjects([
//             'Bucket' => $bucket,
//         ]);

//         // Display the list of objects
//         echo "Files in bucket '$bucket':\n";
//         foreach ($objects['Contents'] as $object) {
//             $fileName = $object['Key'];
//             echo $fileName . "\n";

//             $date = date("Y-m-d");

//             $downloadsDir = DESKTOP_ROOT_FILE . "/downloads/$date";

//             createDirectoryIfNotExists($downloadsDir);

//             $localFilePath = "$downloadsDir/$fileName";

//             echo "local: $localFilePath";

//             downloadFileFromS3($client, $bucket, $fileName, $localFilePath);
//         }
//     } catch (AwsException $e) {
//         // Display error message if an error occurs
//         echo $e->getMessage();
//     }
// }


//listBuckets($client);



$s3 = new s3BucketFacade;

$s3->downloadAllFilesInBucket();
