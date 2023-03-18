<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Genre</title>
    <link rel="stylesheet" href = "genre.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/genre_index.js"></script>
</head>
    <?php
        $saveButtonPressed = filter_input(INPUT_POST, 'btnSave');
        if(isset($saveButtonPressed)){
            $name = filter_input(INPUT_POST, 'txtName');
            if(trim($name)==''){
                echo 'please fill a valid genre name';

            }else{
                $result = addGenretodb($name);
                if ($result) {
                    echo 'Data Succesfully Loaded';
                  }else {
                    echo 'Failed to add data';
                  }
            }
            
        }
        $deleteCommand = filter_input(INPUT_GET, 'cmd');
        if(isset($deleteCommand)){
            $genreid = filter_input(INPUT_GET, 'gid');
            $result = deleteGenre($genreid);
            if($result){
                echo 'Data Succesfully deleted';
            }else{
                echo 'Data Failed to Remove';
            }
        }
    ?>
<body>
    <form method="post">
        <label for ="txtId">Id</label>
        <label for ="txtName">Name</label>
        <input type= "text" maxlength="100" id="txtName" name="txtName" placeholder="New Genre Name">
        <input type="submit" name="btnSave" value="Save Genre">
    </form>
   <?php
        $link = createMySQLConnection();
        $query = 'SELECT id, Nama_genre FROM genre';
        $stmt = $link -> prepare($query);
        $stmt ->execute();
        $result = $stmt->fetchALL();
        $link = null;
    ?>
    <main>
        <table class="table table-hover">
            <tr>
                <th>ID</th>
                <th>Name</th>
            </tr>
            <tbody>
            <?php
                foreach ($result as $genre){
                    echo '<tr>';
                    echo '<td>' . $genre['id']. '</td>';
                    echo '<td>'. $genre['Nama_genre'].'</td>';
                    echo '<td>
                    <button onclick = "editGenre('. $genre['id'].')" class = "btn"> Edit Data </button> 
                    <button onclick = "deleteGenre('. $genre['id'].')" class = "btn"> Delete Data </button> </td>';
                    echo '</tr>';
                } 
            ?>
            </tbody>
        </table> 
    </main>
</body>
</html>
