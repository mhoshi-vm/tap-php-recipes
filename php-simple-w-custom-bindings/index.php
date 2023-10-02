<!DOCTYPE html>
<html>
<head>
    <title>PHP w Custom Bindings</title>
</head>
<body>
<?php
$db_host = getenv('PG_HOST');
$db_port = getenv('PG_PORT');
$db_database = getenv('PG_NAME');
$db_username = getenv('PG_USERNAME');
$db_password = getenv('PG_PASSWORD');

$sb_root = getenv('SERVICE_BINDING_ROOT');
if($sb_root !== null && $sb_root !== "" ){
    $sb_root = getenv('SERVICE_BINDING_ROOT');
    $sb_dirs = scandir($sb_root);
    foreach ($sb_dirs as $sb_dir) {
        $sb_name = $sb_root . '/' . $sb_dir;
        if (is_dir($sb_name)) {
            $sb_contents = scandir($sb_name);
            foreach ($sb_contents as $content) {
                if ($content == "type" &&
                    is_file($sb_name . '/' . $content) &&
                    file_get_contents($sb_name . '/' . $content) === "postgresql"
                ){
                    $db_host = file_get_contents($sb_name . '/host');
                    $db_port = file_get_contents($sb_name . '/port');
                    $db_username = file_get_contents($sb_name . '/username');
                    $db_password = file_get_contents($sb_name . '/password');
                    $db_database = file_get_contents($sb_name . '/database');
                }
            }
        }
    }
}

$dsn = "pgsql:dbname=$db_database host=$db_host port=$db_port";

try{
    $dbh = new PDO($dsn, $db_username, $db_password);

    $sql = "SELECT version();";
    foreach ($dbh->query($sql) as $row) {
        print($row['version']);
    }
}catch (PDOException $e){
    print('Error:'.$e->getMessage());
    die();
}
$dbh = null;
?>
</body>
</html>