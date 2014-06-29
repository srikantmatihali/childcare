<?php include('phpqrcode.php');
$errorCorrectionLevel = 'L';
$matrixPointSize = 5;
$filename =  'images/dummyqr.png';
$data = 'code this bossasdfasdfasfasf';
//QRcode::png('code data text', 'images/dummyqr.png');
QRcode::png($data, $filename, $errorCorrectionLevel, $matrixPointSize, 2);

?>