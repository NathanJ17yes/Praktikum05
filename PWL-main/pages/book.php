<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/book_index.js"></script>
    <title>Book</title>
</head>
<?php
        $saveButtonPressed = filter_input(INPUT_POST, 'btnSave');
        if(isset($saveButtonPressed)){
            $isbn = filter_input(INPUT_POST, 'txtISBN');
            $title = filter_input(INPUT_POST, 'txtTitle');
            $author = filter_input(INPUT_POST, 'txtAuthor');
            $pyear = filter_input(INPUT_POST, 'txtPYear');
            $publisher = filter_input(INPUT_POST, 'txtPublisher');
            $shortdesc = filter_input(INPUT_POST, 'txtShortDesc');
            $Genre_Id = filter_input(INPUT_POST, 'genre_id');
            $cover = filter_input(INPUT_POST, 'cover');
    
            if(trim($isbn)==' '){
                echo 'please fill a valid isbn';
            }
            elseif(trim($title)==' '){
                echo 'please fill a valid title';
            }
            elseif(trim($author)==' '){
                echo 'please fill a valid author';
            }
            elseif(trim($pyear)==' '){
                echo 'please fill a valid date';
            }
            elseif(trim($publisher)==' '){
                echo 'please fill a valid title';
            }
            elseif(trim($shortdesc)==' '){
                echo 'please fill a valid shortdesc';
            }
            else{
                $link = new PDO('mysql:host=localhost;dbname=pwldb', 'root', '');
                $link -> setAttribute(PDO::ATTR_AUTOCOMMIT, false);
                $link -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $link -> beginTransaction();
                $query = 'INSERT INTO book(Book_Id, title, Author, Publisher, Short_desc, Publish_Year, Genre_Id) VALUES(?,?,?,?,?,?,?)'; 
                $stmt = $link -> prepare($query);
                $stmt->bindparam(1, $isbn);
                $stmt->bindparam(2, $title);
                $stmt->bindparam(3, $author);
                $stmt->bindparam(4, $publisher);
                $stmt->bindparam(5, $shortdesc);
                $stmt->bindparam(6, $pyear);
                $stmt->bindparam(7, $Genre_Id);
                if($stmt->execute()){
                    $link->commit();
                }else{
                    $link -> rollBack();

                }
                $link = null;
            }
            
        }
        $deletecommand = filter_input(INPUT_GET,'cmd');
        if(isset($deletecommand)){
            $book_id = filter_input(INPUT_GET,'gid');
            $result = deleteBook($book_id);
            if($result){
                echo 'Book Succesfully Deleted';

            }
            else{
                echo 'Book Faild to Remove';
            }
        }
        
    ?>

<body>
    
    <?php
    $link = createMySQLConnection();
    $query = "SELECT Book_Id,title,Author,Publisher, Cover,Publish_year, genre.Nama_genre AS 'nama_genre' FROM book INNER JOIN genre WHERE book.Genre_Id = genre.Id;";
    $stmt = $link->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $link =null;
    ?>

    <table class="table table-hover">
        <thread>
            <tr>
                <th>Book Id</th>
                <th>Cover</th>
                <th>Title</th>
                <th>Author</th>
                <th>Publisher</th>
                <th>Publish Year</th>
                <th>Genre Name</th>
            </tr>
        </thread>
        <tbody>
        <?php
        foreach ($result as $book){
            echo '<tr>';
            echo '<td>'. $book['Book_Id']. '</td>';
            if($book['Cover']!=''){
                echo '<td>'. $book['Cover']. '</td>';
            }else{
                echo '<td><img src= "uploads/default.png" style = width:100px; height :auto;> </td>'; 
            }
           
            echo '<td>'. $book['title'].'</td>';
            echo '<td>'. $book['Author'].'</td>';
            echo '<td>'. $book['Publisher'].'</td>';
            echo '<td>'. $book['Publish_year'].'</td>';
            echo '<td>'. $book['nama_genre'].'</td>';
            echo 
            '<td><button onclick="editBook(\''.$book['Book_Id'].'\')" class = "btn">Edit Book</button>
             <button onclick="deleteBook(\''.$book['Book_Id'].'\')" class = "btn">Delete Book</button> 
             <button type="button" onclick="editCover(\''.$book['Book_Id'].'\')">Edit Cover</button></td>'
             ;
            echo '</tr>';
        }
        ?>
        </tbody>
    </table>
    <form method="post" enctype="multipart/form-data">
        <label for ="txtISBN">ISBN</label>
        <br>
        <input type= "text" maxlength="100" id="txtISBN" name="txtISBN" placeholder="Book ISBN">
        <br>
        <label for= "cover"> Cover </label>
        <br>
        <input type = "text" id="cover" name = "cover">
        <br>
        <label for ="txtTitle">Title</label>
        <br>
        <input type= "text" maxlength="100" id="txtTitle" name="txtTitle" placeholder="Book Title">
        <br>
        <label for ="txtAuthor">Author</label>
        <br>
        <input type= "text" maxlength="100" id="txtAuthor" name="txtAuthor" placeholder="Book Author">
        <br>
        <label for ="txtPublisher">Publisher</label>
        <br>
        <input type= "text" maxlength="100" id="txtPublisher" name="txtPublisher" placeholder="Book Publisher">
        <br>
        <label for ="txtPYear">Publish Year</label>
        <br>
        <input type= "text" maxlength="100" id="txtPYear" name="txtPYear" placeholder="Publish Year">
        <br>
        <label for ="txtShortDesc">Short Description</label>
        <br>
        <textarea type= "textarea" maxlength="1000" id="txtShortDesc" name="txtShortDesc" placeholder="Book Description"></textarea>
        <br>
        <label for="genre_id">Genre Id</label>
        <br>

        
        <select name="genre_id" id="genre_id">
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
        <input type="submit" name="btnSave" value="Input Book">
    
</body>
</html>
