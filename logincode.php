<?php
include('security.php');


$connection = mysqli_connect("localhost","root","","adminpanel");



    //CODICE PER LOGIN TRA ADMIN E USER

    if (isset($_POST['login_btn']))
    {
       
        $email_login = $_POST['email'];
        $password_login = $_POST['password'];
       
        
        $query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login' ";
        $query_run = mysqli_query($connection, $query);
        $usertypes = mysqli_fetch_array($query_run);
        
        //QUI L' UTENTE ADMIN VIENE REINDIRIZZATO ALLA DASHBOARD
        if($usertypes['usertype'] == "admin")
       
        {
            $_SESSION['username'] = $email_login;
            header('Location: index.php');//REINDIRIZZAMENTO ALLA DASHBOARD
        }
             //QUI L' UTENTE USER VIENE REINDIRIZZATO ALLA INDEX PAGE DEL SITO
        else if($usertypes['usertype'] == "user")
        {
            $_SESSION['username'] = $email_login;
            header('Location: index.php');//REINDIRIZZAMENTO ALLA INDEX PAGE DEL SITO   
        }
        else
        {
            $_SESSION['status'] = "<h3 class='alert alert-danger'>Email e/o Password non validi!</h3>";
            header('Location: login.php');
        }    

     }

?>