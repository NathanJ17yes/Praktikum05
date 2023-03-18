<?php
function login($email, $pass){
    $link = createMySQLConnection();
    $query = 'SELECT id, Name, email from user where email = ? AND password = ?';
    $stmt = $link->prepare($query);
    $stmt -> bindparam(1,$email);
    $stmt -> bindparam(2,$pass);
    $stmt->execute();
    $user = $stmt->fetch();
    $link = null;
    return $user;
}
?>