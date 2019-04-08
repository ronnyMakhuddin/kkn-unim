<?php
// require_once 'vendor/autoload.php';
// require_once "./random_string.php";

// use MicrosoftAzure\Storage\Blob\BlobRestProxy;
// use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
// use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
// use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
// use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;

// $connectionString = "DefaultEndpointsProtocol=https;AccountName=".getenv('ACCOUNT_NAME').";AccountKey=".getenv('ACCOUNT_KEY');

// // Create blob client.
// $blobClient = BlobRestProxy::createBlobService($connectionString);

// $fileToUpload = "HelloWorld.txt";

// if (!isset($_GET["Cleanup"])) {
//     // Create container options object.
//     $createContainerOptions = new CreateContainerOptions();

//     // Set public access policy. Possible values are
//     // PublicAccessType::CONTAINER_AND_BLOBS and PublicAccessType::BLOBS_ONLY.
//     // CONTAINER_AND_BLOBS:
//     // Specifies full public read access for container and blob data.
//     // proxys can enumerate blobs within the container via anonymous
//     // request, but cannot enumerate containers within the storage account.
//     //
//     // BLOBS_ONLY:
//     // Specifies public read access for blobs. Blob data within this
//     // container can be read via anonymous request, but container data is not
//     // available. proxys cannot enumerate blobs within the container via
//     // anonymous request.
//     // If this value is not specified in the request, container data is
//     // private to the account owner.
//     $createContainerOptions->setPublicAccess(PublicAccessType::CONTAINER_AND_BLOBS);

//     // Set container metadata.
//     $createContainerOptions->addMetaData("key1", "value1");
//     $createContainerOptions->addMetaData("key2", "value2");

//       $containerName = "blockblobs".generateRandomString();

//     try {
//         // Create container.
//         $blobClient->createContainer($containerName, $createContainerOptions);

//         // Getting local file so that we can upload it to Azure
//         $myfile = fopen($fileToUpload, "w") or die("Unable to open file!");
//         fclose($myfile);
        
//         # Upload file as a block blob
//         echo "Uploading BlockBlob: ".PHP_EOL;
//         echo $fileToUpload;
//         echo "<br />";
        
//         $content = fopen($fileToUpload, "r");

//         //Upload blob
//         $blobClient->createBlockBlob($containerName, $fileToUpload, $content);

//         // List blobs.
//         $listBlobsOptions = new ListBlobsOptions();
//         $listBlobsOptions->setPrefix("HelloWorld");

//         echo "These are the blobs present in the container: ";

//         do{
//             $result = $blobClient->listBlobs($containerName, $listBlobsOptions);
//             foreach ($result->getBlobs() as $blob)
//             {
//                 echo $blob->getName().": ".$blob->getUrl()."<br />";
//             }
        
//             $listBlobsOptions->setContinuationToken($result->getContinuationToken());
//         } while($result->getContinuationToken());
//         echo "<br />";

//         // Get blob.
//         echo "This is the content of the blob uploaded: ";
//         $blob = $blobClient->getBlob($containerName, $fileToUpload);
//         fpassthru($blob->getContentStream());
//         echo "<br />";
//     }
//     catch(ServiceException $e){
//         // Handle exception based on error codes and messages.
//         // Error codes and messages are here:
//         // http://msdn.microsoft.com/library/azure/dd179439.aspx
//         $code = $e->getCode();
//         $error_message = $e->getMessage();
//         echo $code.": ".$error_message."<br />";
//     }
//     catch(InvalidArgumentTypeException $e){
//         // Handle exception based on error codes and messages.
//         // Error codes and messages are here:
//         // http://msdn.microsoft.com/library/azure/dd179439.aspx
//         $code = $e->getCode();
//         $error_message = $e->getMessage();
//         echo $code.": ".$error_message."<br />";
//     }
// } 
// else 
// {

//     try{
//         // Delete container.
//         echo "Deleting Container".PHP_EOL;
//         echo $_GET["containerName"].PHP_EOL;
//         echo "<br />";
//         $blobClient->deleteContainer($_GET["containerName"]);
//     }
//     catch(ServiceException $e){
//         // Handle exception based on error codes and messages.
//         // Error codes and messages are here:
//         // http://msdn.microsoft.com/library/azure/dd179439.aspx
//         $code = $e->getCode();
//         $error_message = $e->getMessage();
//         echo $code.": ".$error_message."<br />";
//     }
// }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kegiatan KKN</title>
    <style>
        html body {
            margin: 0;
            padding: 0;
        }

        header {
            width: 100%;
            background: grey;
            font-size: 0;
        }

        header nav {
            font-size: 16px;
            height: 25px;
            display: inline-block;
            vertical-align: top;
            padding: 13px 10px;
            color: white;
        }

        header nav.active {
            background: white;
            color: #000;
            border: solid grey;
        }

        header nav:hover {
            background: white;
            color: #000;
            border: solid grey;
        }

        content {
            padding-left: 20px;
            display: inline-block;
        }
        table {
            width: 100%;
        }

        table tr th {
            text-align: left;
            padding: 3px; 
            background: #CCCCCC;
        }

        table tr td {
            padding: 3px;
        } 
    </style>
</head>
<body>
    <header>
        <!-- <a href="https://kkn-unim.azurewebsites.net/index.php"><nav class="active">Pendaftaran KKN</nav></a>
        <a href="https://kkn-unim.azurewebsites.net/pelaporan-kkn.php"><nav>Pelaporan Kegiatan KKN</nav></a> -->NO

        <a href="index.php"><nav>Pendaftaran KKN</nav></a>
        <a href="pelaporan-kkn.php"><nav class="active">Pelaporan Kegiatan KKN</nav></a>
    </header>
    <content>
        <h1>Pelaporan Kegiatan KKN</h1>
        
        <form method="post" action="pelaporan-kkn.php?Cleanup&containerName=<?php //echo $containerName; ?>">
            <p>
                Silahkan upload foto kegiatan KKN Anda dan klik tombol <strong>Upload</strong>. <br>
            </p>
            <input type="file" name="file_upload">
            <input type="submit" name="Submit" value="Upload">
        </form>
        <hr>
        <p>
            Klik tombol <strong>Analisa</strong> pada tabel untuk menganalisa foto kegiatan KKN.
        </p>

        <table>
            <tr>
                <th>No</th>
                <th>Nama File</th>
                <th>URL File</th>
                <th>Aksi</th>
            </tr>
            <!-- Foreach / loop -->
            <tr>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <td><input type="button" value="Analisa"></td>
            </tr>
        </table>
        
    </content>
</body>
</html>

