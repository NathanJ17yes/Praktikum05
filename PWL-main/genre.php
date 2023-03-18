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
</head>
<body>
   <?php
        $link = new PDO('mysql:host=localhost;dbname=pwldb', 'root', '');
        $link -> setAttribute(PDO::ATTR_AUTOCOMMIT, false);
        $link -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
                    echo '</tr>';
                } 
            ?>
            </tbody>
        </table> 
    </main>
</body>
</html>
