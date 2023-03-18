<?php
$uploadRequest = filter_input(INPUT_POST, 'btnUpload');
if(isset($uploadRequest)){
    $fileName = filter_input(INPUT_POST, 'txtName');
    $targetDirectory = 'uploads/';
    $fileExtension = pathinfo($_FILES['imageFile']['name'], PATHINFO_EXTENSION);
    $pathToUpload = $targetDirectory . $fileName . '.' . $fileExtension;
    if($_FILES['imageFile']['size']>1024*2048){
        echo 'File is to big than 2MB, please resize the file';
    }else{
        move_uploaded_file($_FILES['imageFile']['tmp_name'], $pathToUpload);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    
    <div class ="container">
        <form method ="post" enctype="multipart/form-data">
            <input type="text" name="txtName" placeholder="name">
            <input type="file" name="imageFile" accept="image/*" class="form-control">
            <div>
                <input type="submit" name="btnUpload" value="upload Image" class = "btnUpload">
            </div>  
        </form>
    </div>
    <main>
        
    </main>
</body>
