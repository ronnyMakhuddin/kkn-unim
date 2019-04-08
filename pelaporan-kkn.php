<?php
require_once 'vendor/autoload.php';
require_once "./random_string.php";

use MicrosoftAzure\Storage\Blob\BlobRestProxy;
use MicrosoftAzure\Storage\Common\Exceptions\ServiceException;
use MicrosoftAzure\Storage\Blob\Models\ListBlobsOptions;
use MicrosoftAzure\Storage\Blob\Models\CreateContainerOptions;
use MicrosoftAzure\Storage\Blob\Models\PublicAccessType;

$connectionString = "DefaultEndpointsProtocol=https;AccountName=kknunim;AccountKey=+kmiR7Moc3T7vbSR7Y6U93SfdeysdiKcIWBSQLQTDewpavvxStfRtd8j5tcNPvveYHyXyc9fZZZ+daIv8r/Mrg==;";

// Create blob client.
$containerName = "kkncontainer";
$blobClient = BlobRestProxy::createBlobService($connectionString);

if (isset($_POST["Submit"])) {
    # Upload file as a block blob
    $fileToUpload = strtolower($_FILES["fileToUpload"]["name"]);
    $content = fopen($_FILES["fileToUpload"]["tmp_name"], "r");

    //Upload blob
    $blobClient->createBlockBlob($containerName, $fileToUpload, $content);
    header("Location:pelaporan-kkn.php");    
}
// List blobs.
$listBlobsOptions = new ListBlobsOptions();
$listBlobsOptions->setPrefix("");
$result = $blobClient->listBlobs($containerName, $listBlobsOptions);
$no = 1;

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
        <a href="https://kkn-unim.azurewebsites.net/index.php"><nav class="active">Pendaftaran KKN</nav></a>
        <a href="https://kkn-unim.azurewebsites.net/pelaporan-kkn.php"><nav>Pelaporan Kegiatan KKN</nav></a>
    </header>
    <content>
        <h1>Pelaporan Kegiatan KKN</h1>
        
        <form method="post" action="pelaporan-kkn.php" enctype="multipart/form-data">
            <p>
                Silahkan upload foto kegiatan KKN Anda dan klik tombol <strong>Upload</strong>. <br>
            </p>
            <input type="file" name="fileToUpload" accept=".jpeg,.jpg,.png" required="">
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
            <?php
                do{
                    foreach ($result->getBlobs() as $blob)
                    {
                        echo "<tr>";
                        echo "<td>" . $no++ . "</td>"; 
                        echo "<td>" . $blob->getName() . "</td>";
                        echo "<td>" . $blob->getUrl() . "</td>"; 
                        echo "<td> <a href='comvis.php?url=" . $blob->getUrl() . "'> <input type='button' value='Analisa'> </td>";
                        echo "</tr>";
                    }
                    $listBlobsOptions->setContinuationToken($result->getContinuationToken());
                } while($result->getContinuationToken());
            ?>
        </table>
        
    </content>
</body>
</html>