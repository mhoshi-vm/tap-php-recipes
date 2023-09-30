<!DOCTYPE html>
<html>
<head>
    <title>PHP w Supported Bindings</title>
</head>
<body>
<?php
//simple counter to test sessions. should increment on each page reload.
session_start();
$count = isset($_SESSION['count']) ? $_SESSION['count'] : 1;

echo '<h1> Page hit count:';
echo $count;
echo '</h1>';

$_SESSION['count'] = ++$count;
?>
</body>
</html>