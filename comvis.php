<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hasil Analisisi Kegiatan KKN</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
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
            width: 100%;
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

        content .item{
        	width: 48%;
        	display: inline-block;
        	vertical-align: top;
        }

        content .item img{
        	width: 400px;
        }
    </style>
</head>
<body>
	<?php
		if (isset($_GET['url'])) {
				$url = $_GET['url'];
			} else {
				header("Location: pelaporan-kkn.php");
			} 	
	?>

	<header>
        <a href="https://kkn-unim.azurewebsites.net/index.php"><nav>Pendaftaran KKN</nav></a>
        <a href="https://kkn-unim.azurewebsites.net/pelaporan-kkn.php"><nav class="active">Pelaporan Kegiatan KKN</nav></a>
    </header>
	<script type="text/javascript">
	    function processImage() {
	        // **********************************************
	        // *** Update or verify the following values. ***
	        // **********************************************
	 
	        // Replace <Subscription Key> with your valid subscription key.
	        var subscriptionKey = "19f42a8a8ad643a8824ffc00feee9abf";
	 
	        // You must use the same Azure region in your REST API method as you used to
	        // get your subscription keys. For example, if you got your subscription keys
	        // from the West US region, replace "westcentralus" in the URL
	        // below with "westus".
	        //
	        // Free trial subscription keys are generated in the "westus" region.
	        // If you use a free trial subscription key, you shouldn't need to change
	        // this region.
	        var uriBase =
	            "https://southeastasia.api.cognitive.microsoft.com/vision/v2.0/analyze";
	 
	        // Request parameters.
	        var params = {
	            "visualFeatures": "Categories,Description,Color",
	            "details": "",
	            "language": "en",
	        };
	 
	        // Display the image.
	        var sourceImageUrl = "<?php echo $url ?>";
	        document.querySelector("#sourceImage").src = sourceImageUrl;
	 
	        // Make the REST API call.
	        $.ajax({
	            url: uriBase + "?" + $.param(params),
	 
	            // Request headers.
	            beforeSend: function(xhrObj){
	                xhrObj.setRequestHeader("Content-Type","application/json");
	                xhrObj.setRequestHeader(
	                    "Ocp-Apim-Subscription-Key", subscriptionKey);
	            },
	 
	            type: "POST",
	 
	            // Request body.
	            data: '{"url": ' + '"' + sourceImageUrl + '"}',
	        })
	 
	        .done(function(data) {
	            // Show formatted JSON on webpage.
	            $("#responseTextArea").val(JSON.stringify(data, null, 2));
	            $("#deskripsi").text(data.description.captions[0].text);
	        })
	 
	        .fail(function(jqXHR, textStatus, errorThrown) {
	            // Display error message.
	            var errorString = (errorThrown === "") ? "Error. " :
	                errorThrown + " (" + jqXHR.status + "): ";
	            errorString += (jqXHR.responseText === "") ? "" :
	                jQuery.parseJSON(jqXHR.responseText).message;
	            alert(errorString);
	        });
	    };
	</script>

    <content>
    	<h1>Hasil Analisis Foto Kegiatan KKN</h1>
    	<p>Hasil dari analisis Kegiatan Anda sebagai berikut:</p>
    	<div class="item">
    		<strong>Response:</strong><br><br>
    		<textarea id="responseTextArea" class="UIInput"
                  style="width:400px; height:400px;"></textarea>
    	</div>
    	<div class="item">
    		<strong>Source Image: </strong><br><br>
    		<img id="sourceImage">
    		<strong id="deskripsi"></strong>
    	</div>
    </content>
	
</body>
</html>