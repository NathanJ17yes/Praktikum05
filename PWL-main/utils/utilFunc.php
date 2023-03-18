<?php 
function createMySQLConnection(): PDO{
    $link = new PDO('mysql:host=localhost;dbname=pwldb', 'root', '');
    $link -> setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $link;
}

?>
