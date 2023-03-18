<?php
function fetchGenreFromDb()
{
    $link = createMySQLConnection();
    $query = 'SELECT Id, Nama_genre From genre';
    $stmt = $link -> prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll();
    $link = null;
    return $results;
}
function addGenretodb($newName){
    $result = 0;
    $link = createMySQLConnection();
    $link -> beginTransaction();
    $query = 'INSERT INTO genre(Nama_genre) VALUES(?)'; 
    $stmt = $link -> prepare($query);
    $stmt->bindparam(1, $newName);
    if($stmt->execute()){
        $link->commit();
        $result = 1;
    }else{
        $link -> rollBack();
    }
        $link = null;
        return $result;
}

function fetchOneGenreFromDb($Id){
    $link = createMySQLConnection();
    $query = 'SELECT Id, Nama_genre FROM genre WHERE Id = ?';
    $stmt = $link -> prepare($query);
    $stmt -> bindParam(1, $Id);
    $stmt ->execute();
    $result = $stmt->fetch();
    $link = null;
    return $result;
}

function updateGenreToDb($Id, $name, $newId){
    $result = 0;
    $link = createMySQLConnection();
    $link -> beginTransaction();
    $query = 'UPDATE genre SET Nama_genre = ?, Id= ? WHERE Id = ?'; 
    $stmt = $link -> prepare($query);
    $stmt->bindparam(1, $name);
    $stmt->bindparam(2, $newId);
    $stmt->bindparam(3, $Id);
    if($stmt -> execute()){
        $link->commit();
        $result = 1;
    }else{
        $link -> rollBack();
    }
    $link = null;
    return $result;
}

function deleteGenre($Id)
{
    $result = 0;
    $link = createMySQLConnection();
    $link -> beginTransaction();
    $query = 'DELETE FROM genre WHERE Id = ?';
    $stmt = $link -> prepare($query);
    $stmt -> bindParam(1, $Id);
    if ($stmt -> execute()) {
        $link -> commit();
        $result = 1;
    } else {
        $link -> rollBack();
    }
      $link = null;
      return $result;
    }
?>