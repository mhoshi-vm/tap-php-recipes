<!DOCTYPE html>
<html>
<head>
    <title>PHP w Custom Bindings</title>
</head>
<body>
<?php
$db_host="";
$db_port="";
$db_username="";
$db_password="";
$db_database="";
if(getenv('SERVICE_BINDING_ROOT') != ""){
    $sbRoot = getenv('SERVICE_BINDING_ROOT');
    $sbDirs = scandir($sbRoot);
    foreach ($sbDirs as $sbDir) {
        $sbName = $sbRoot . '/' . $sbDir;
        if (is_dir($sbName)) {
            $sbContents = scandir($sbName);
            foreach ($sbContents as $content) {
                echo $content;
                if ($content == "type" &&
                    is_file($sbName . '/' . $content) &&
                    file_get_contents($sbName . '/' . $content) == "postgresql"
                ){
                    $db_host = file_get_contents($sbName . '/host');
                    $db_port = file_get_contents($sbName . '/port');
                    $db_username = file_get_contents($sbName . '/username');
                    $db_password = file_get_contents($sbName . '/password');
                    $db_database = file_get_contents($sbName . '/database');
                }

            }

        }
    }
}
$connectionString = "host=$db_host dbname=$db_database user=$db_username password=$db_password port=$db_port";
echo $connectionString . "<br>";
$con = pg_connect($connectionString);
$sql = "SELECT version();";
$result = pg_send_query($con, $sql);
echo $result . "<br>";
pg_close($con)
?>
</body>
</html>