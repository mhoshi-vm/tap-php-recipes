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

$dsn = "pgsql:dbname=$db_database host=$db_host port=$db_port";

try{
    $dbh = new PDO($dsn, $db_username, $db_password);

    $sql = "SELECT version();";
    echo $dbh->exec($sql);
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}
$dbh = null;
?>
</body>
</html>