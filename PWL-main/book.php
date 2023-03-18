<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Book</title>
</head>
<body>
    <?php
    $link = new PDO('mysql:host=localhost;dbname=pwldb', 'root', '');
    $link -> setAttribute(PDO::ATTR_AUTOCOMMIT, false);
    $link -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = 'SELECT Book_Id, title, Author, Publisher, Short_desc, Genre_Id FROM book';
    $stmt = $link -> prepare($query);
    $stmt ->execute();
    $result = $stmt->fetchALL();
    $link = null;
    ?>

    <table class="table table-hover">
        <thread>
            <tr>
                <th>Book Id</th>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Short desc</th>
                <th>Genre Id</th>
            </tr>
        </thread>
        <tbody>
        <?php
        foreach ($result as $book){
            echo '<tr>';
            echo '<td>'. $book['Book_Id']. '</td>';
            echo '<td>'. $book['title'].'</td>';
            echo '<td>'. $book['Author'].'</td>';
            echo '<td>'. $book['Publisher'].'</td>';
            echo '<td>'. $book['Short_desc'].'</td>';
            echo '<td>'. $book['Genre_Id'].'</td>';
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
</body>
</html>
