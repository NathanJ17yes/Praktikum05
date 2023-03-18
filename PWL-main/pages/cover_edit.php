<?php
    $Book_IdEd = filter_input(INPUT_GET, 'isbn');
    if(isset($Book_IdEd)){
        $uploadRequest = filter_input(INPUT_POST, 'btnUpload');
        if(isset($uploadRequest)){
            $isbn = filter_input(INPUT_GET, 'isbn');
            $fileName = filter_input(INPUT_GET, 'isbn');
            $targetDirectory = 'uploads/';
            $fileExtension = pathinfo($_FILES['txtFile']['name'], PATHINFO_EXTENSION);
            $cover = $fileName.'.'.$fileExtension;
            $pathToUpload = $targetDirectory . $fileName . '.' . $fileExtension;
            if($_FILES['txtFile']['size']>1024*2048){
                echo 'File is to big than 2MB, please resize the file';
            }else{
                move_uploaded_file($_FILES['txtFile']['tmp_name'], $pathToUpload);
                $results = updateCoverToDb($isbn, $cover);
                if($results){
                    header('location:index.php?menu=book');
                }else{
                    echo '<div>Failed to add data</div>';
                }
            
            }
            
            
        }
    }
?>
<div class = "container">
    <div class = table>
         <?php
         $book = fetchOneBookFromDb($Book_IdEd);
         if($book['Cover']){
            echo '<img src="uploads/'. $book['Cover']. '" style="width:100px; height:auto;">';
         }else{
            echo '<img src="uploads/default.png" style="width:100px;height:auto;">';
         }
            
            
        ?> 
        <form method ="post" enctype="multipart/form-data">
            <label for ="covered">cover</label>
            <input type="file" name="txtFile" accept="image/*" class="form-control">
            <div>
                <input type="submit" name="btnUpload" value="upload Image" class = "btnUpload">
            </div>  
        </form>
</div>
</div>

