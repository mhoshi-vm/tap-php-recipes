<!DOCTYPE html>
<html>
<head>
    <title>PHP Simple</title>
</head>
<body>
<?php
require 'vendor/autoload.php';

$HelloWorld = new tappoc\HelloWorld();

$input="";
if (isset($_GET['input'])) {
    $input = $_GET['input'];
}

echo $HelloWorld->respond($input);

?>
</body>
</html>