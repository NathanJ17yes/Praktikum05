<?php 
$bookid = filter_input(INPUT_GET, 'gid');
if(isset($bookid)){
    $book = fetchOneBookFromDb($bookid);
}

$updatePressed = filter_input(INPUT_POST, 'btnSave');
if(isset($updatePressed)){
    $title = filter_input(INPUT_POST, 'txtTitle');
    $bookid = filter_input(INPUT_POST, 'txtBook_Id');
    $Author = filter_input(INPUT_POST, 'txtAuthor');
    $Publisher = filter_input(INPUT_POST, 'txtPublisher');
    $Publish_Year = filter_input(INPUT_POST, 'txtPy');
    $genre_name = filter_input(INPUT_POST, 'selectGN');
    if(trim($title)== ' '){
        echo 'please fill a valid title';
    }
    elseif(trim($bookid)== ' '){
        echo 'please fill a valid Id';
    }
    elseif(trim($Author)== ' '){
        echo 'please fill a valid Author';
    }
    elseif(trim($Publisher)== ' '){
        echo 'please fill a valid Publisher';
    }
    elseif(trim($Publish_Year)== ' '){
        echo 'please fill a valid Year';
    }
    else{
        $result = updateBookToDb($book['Book_Id'], $title, $Author, $Publisher, $Publish_Year, $bookid);
        if($result){
            header('location:index.php?menu=book');

        }else{
            echo 'Failed';
        }
    }
   
}
?>
<form method="post">
    <label for = "txtTitle">Title</lable>
    <input type = "text" maxlength="100" id="txtTitle" name = "txtTitle" placeholder ="New Title"
    value = "<?php echo $book['title'];?>">
    <br>
    <label for = "txtBook_Id">Book Id</lable>
    <input type = "text" maxlength="100" id="txtBook_Id" name = "txtBook_Id" placeholder ="New Title"
    value = "<?php echo $book['Book_Id'];?>">
    <br>
    <label for = "txtAuthor">Author</lable>
    <input type = "text" maxlength="100" id="txtAuthor" name = "txtAuthor" placeholder ="New Title"
    value = "<?php echo $book['Author'];?>">
    <br>
    <label for = "txtPublisher">Publisher</lable>
    <input type = "text" maxlength="100" id="txtPublisher" name = "txtPublisher" placeholder ="New Title"
    value = "<?php echo $book['Publisher'];?>">
    <br>
    <label for = "txtPy">Publish Year</lable>
    <input type = "text" maxlength="100" id="txtPy" name = "txtPy" placeholder ="New Year"
    value = "<?php echo $book['Publish_year'];?>">
    <br>
    <label for = "selectGN">Genre Name</lable>
    <select name = "selectGN" id = "selectGN">
        <?php
                $link = createMySQLConnection();
                $query = 'SELECT Id, Nama_genre FROM genre';
                $stmt = $link -> prepare($query);
                $stmt->execute();
                $results = $stmt->fetchAll();
                $link = null;
                foreach ($results as $genre) {
                    echo '<option value="' . $genre['Id'] . '">' . $genre['Nama_genre'] . '</option>';
                }
            ?>
    </select>
    <input type="submit" name="btnSave" value="Update Book">
</form>