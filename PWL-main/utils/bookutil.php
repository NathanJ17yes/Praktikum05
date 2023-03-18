<?php
function fetchOneBookFromDb($Book_Id){
    $link = createMySQLConnection();
    $query = "SELECT Book_Id,title, Author, Cover, Publisher, Publish_year FROM book WHERE Book_Id = ?";
    $stmt = $link->prepare($query);
    $stmt -> bindparam(1, $Book_Id);
    $stmt->execute();
    $result = $stmt->fetch();
    $link =null; 
    return $result;
}
function updateBookToDb($Book_Id, $title, $Author, $Publisher, $Publish_year, $newBi){
    $result = 0;
    $link = createMySQLConnection();
    $link -> beginTransaction();
    $query = 'UPDATE book SET title = ?, Book_Id = ?, Author =?, Publisher=?, Publish_year = ? WHERE Book_Id = ?';
    $stmt = $link -> prepare($query);
    $stmt->bindparam(1, $title);
    $stmt->bindparam(2, $newBi);
    $stmt->bindparam(3, $Author);
    $stmt->bindparam(4, $Publisher);
    $stmt->bindparam(5, $Publish_year);
    $stmt->bindparam(6, $Book_Id);
    if($stmt -> execute()){
        $link -> commit();
        $result = 1;

    }else{
        $link -> rollback();

    }
    $link = null;
    return $result;
}
function deleteBook($Book_Id){
    $result = 0;
    $link = createMySQLConnection();
    $link -> beginTransaction();
    $query = 'DELETE FROM book WHERE Book_Id = ?';
    $stmt = $link -> prepare($query);
    $stmt -> bindparam(1, $Book_Id);
    if ($stmt -> execute()) {
        $link -> commit();
        $result = 1;
    } else {
        $link -> rollBack();
    }
      $link = null;
      return $result;
    }
    function updateCoverToDb($isbn, $cover){
        $result = 0;
        $link = createMySQLConnection();
        $link -> beginTransaction();
        $query = 'UPDATE book SET Cover = ? WHERE Book_Id = ?';
        $stmt = $link->prepare($query);
        $stmt->bindParam(1,$cover,PDO::PARAM_STR);
        $stmt->bindParam(2,$isbn,PDO::PARAM_STR);
        if($stmt->execute()){
            $link -> commit();
            $result = 1;
        }else{
            $link -> rollBack();
        }
        $link =null;
        return $result;
    }
?>