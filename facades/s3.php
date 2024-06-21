<?php


require_once __DIR__ . '/../util/files.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;
use Symfony\Component\Dotenv\Dotenv;
use Aws\Exception\AwsException;

$dotenv = new Dotenv();
$dotenv->loadEnv(__DIR__ . '/../.env');

define('AWS_KEY', $_ENV['AWS_KEY']);
define('AWS_SECRET_KEY', $_ENV['AWS_SECRET_KEY']);
define('DESKTOP_ROOT_FILE', $_ENV['DESKTOP_ROOT_FILE']);
define('BUCKET_NAME', $_ENV['BUCKET_NAME']);
define('BACKUP_DIR', $_ENV['BACKUP_DIR']);

// Instantiate the S3 class and point it at the desired host

class s3BucketFacade
{
    private $client;

    public function __construct()
    {
        $this->client = new S3Client([
            'region' => '',
            'version' => '2006-03-01',
            'region' => 'us-east-1',
            'credentials' => [
                'key' => AWS_KEY,
                'secret' => AWS_SECRET_KEY
            ],
        ]);
    }

    public function downloadFileFromS3($fileName, $localFilePath)
    {
        try {
            $result = $this->client->getObject([
                'Bucket' => BUCKET_NAME,
                'Key' => $fileName,
                'SaveAs' => $localFilePath,
            ]);

            return true;
        } catch (S3Exception $e) {
            return "Error downloading file: " . $e->getMessage();
        }
    }

    public function listBuckets()
    {
        $listResponse = $this->client->listBuckets();
        $buckets = $listResponse['Buckets'];
        foreach ($buckets as $bucket) {
            echo $bucket['Name'] . "\t" . $bucket['CreationDate'] . "\n";
        }
    }

    function downloadAllFilesInBucket()
    {

        try {
            // List objects in the bucket
            $objects = $this->client->listObjects([
                'Bucket' => BUCKET_NAME,
            ]);

            // Display the list of objects
            echo "Files in bucket " . BUCKET_NAME . ":\n";
            foreach ($objects['Contents'] as $object) {

                $fileName = $object['Key'];
                echo $fileName . " downloading to:\n";
                $date = date("Y-m-d");

                createDirectoryIfNotExists(BACKUP_DIR);

                $downloadsDir = BACKUP_DIR . "/$date";
                createDirectoryIfNotExists($downloadsDir);

                $localFilePath = $downloadsDir . "/" . $fileName;
                echo "local: $localFilePath \n";

                $this->downloadFileFromS3($fileName, $localFilePath);
            }
        } catch (AwsException $e) {

            echo $e->getMessage();
        }
    }
}
