<?php
$genreid = filter_input(INPUT_GET, 'gid');
if(isset($genreid)){
    $genre = fetchOneGenreFromDb($genreid);

}

$updatePressed = filter_input(INPUT_POST, 'btnSave');
if(isset($updatePressed)){
    $name = filter_input(INPUT_POST, 'txtName');
    $newId = filter_input(INPUT_POST, 'txtId');
    if(trim($name)== ' '){
        echo 'please fill a valid genre name';
    }elseif(trim($id)== ' '){
        echo 'please fill a valid id';
    }
    else{
        $result = updateGenreToDb($genre['Id'], $name, $newId);
        if($result){
            header('location:index.php?menu=genre');
        } else{
            echo '<div>Failed</div>';
        }
    }

}

?>
<form method="post">
        <label for ="txtName">Name</label>
        <input type= "text" maxlength="100" id="txtName" name="txtName" placeholder="New Genre Name"
         value = "<?php echo $genre['Nama_genre']; ?>">
        <input type = "text" maxlength = "100" id="txtId" name = "txtId" placeholder ="New Genre Id" value = "<?php echo $genre['Id']; ?>">
        <input type="submit" name="btnSave" value="Update Genre">
</form>