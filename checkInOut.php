<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>QR Code Scanner</title>
    <style>
        #video-preview {
            width: 100%;
            max-width: 500px;
            margin: auto;
        }
    </style>
</head>
<body>
    <h1>QR Code Scanner</h1>
    <div class="col-lg-9">
    <video id="video-preview"></video>
    <canvas style="width:100%;" id="qr-canvas"></canvas>
    </div>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            let scanner = new Instascan.Scanner({ video: document.getElementById('video-preview') });
            
            scanner.addListener('scan', function(content) {
                // Handle the scanned QR code content
                handleQRCode(content);
            });

            Instascan.Camera.getCameras().then(function(cameras) {
                if (cameras.length > 1) {
                    scanner.start(cameras[1]);
                } 
                else if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    console.error('No cameras found.');
                }
            }).catch(function(e) {
                console.error(e);
            });
        });

        function handleQRCode(content) {
            // Send the scanned QR code content to the server for processing
            $.post("process_qr.php", { qrContent: content })
                .done(function(response) {
                    console.log(response);
                    // Display the server response on the web page
                    alert(response);
                })
                .fail(function() {
                    alert("Error occurred while processing the QR code.");
                });
        }
    </script>
</body>
</html>
