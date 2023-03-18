<?php
    session_start();
    if(!isset($_SESSION['is_user_logged'])) {
        $_SESSION['is_user_logged']= false;
    }
    include_once 'utils/genreutil.php';
    include_once 'utils/utilFunc.php';
    include_once 'utils/bookutil.php';
    include_once 'utils/userutil.php';
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
    <?php
        if($_SESSION['is_user_logged']){  
        ?> 
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
          
        <div class="container-fluid">
            <a class="navbar-brand" href="#">UltraBook</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="?menu=home">home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?menu=genre">genre</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?menu=book">book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?menu=logout">logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <main>
        <?php
        $navigation = filter_input(INPUT_GET, 'menu');
        switch($navigation){
            case 'home':
                include_once 'pages/home.php';
                break;
            case 'genre':
                include_once 'pages/genre.php';
                break;
            case 'book': 
                include_once 'pages/book.php';
                break; 
            case 'genre_edit':
                include_once 'pages/genre_edit.php';
                break;
            case 'book_edit':
                include_once 'pages/book_edit.php';
                break;
            case 'cover_update':
                include_once 'pages/cover_edit.php';
                break;
            case 'logout':
                session_unset();
                session_destroy();
                header("location:index.php");
                break;
            default :
                include_once 'pages/home.php';
        }
        ?>
    </main>
    <?php
}else{
include_once 'pages/login.php';
}
?>
</body>
