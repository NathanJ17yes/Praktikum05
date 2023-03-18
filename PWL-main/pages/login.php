<style>
    #container {
        width: 350px;
        height : 400px;
        border : 2px solid grey;
        border-radius: 35px;
        padding : auto;
        margin-top : 10%;
        margin-left : 40%;
    }
    form{
        margin-top : 100px;
        margin-left : 20px;
    }
    input[type=text], input[type=password] {
        width: 90%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
}
</style>

    <?php
    $loginPressed = filter_input(INPUT_POST, 'btnSave');
    if(isset($loginPressed)){
        $email = filter_input(INPUT_POST, 'txtEmail');
        $pass = filter_input(INPUT_POST, 'txtPass');
        if(trim($email)=='' || trim($pass)== ''){
            echo 'please fill email and password';

        }else{
            $user = login($email, $pass);
            if($user['email'] == $email){
                $_SESSION['is_user_logged']= true;
                $_SESSION['user_name'] = $user['Name'];
                header('location:index.php');
            }else{
                echo 'invalid email or password';
            }
        }
    }
    ?>
<div id = "container">
    <form method = "post"> 
        <label for = "txtEmail">Email</label>
        <br>
        <input type = "text" maxlength = 100 id = "txtEmail" name="txtEmail" placeholder = "Email">
        <br>
        <label for = "txtPass">Password</label>
        <br>
        <input type = "text" maxlength = 100 id = "txtPass" name="txtPass" placeholder = "Password">
        <br>
        <input type="submit" name="btnSave" value="Done">

    </form>
</div>
</body>
</html>