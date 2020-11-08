<?php
session_start();
include('database/dbconfig.php');

    //CODICE PER L' INSERIMENTO DATI NEL FORM REGISTRAZIONE USER
    if(isset($_POST['registerbtn']))
        {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cpassword = $_POST['confirmpassword'];
            $usertype = $_POST['usertype'];

            $email_query = "SELECT * FROM register WHERE email='$email' ";
            $email_query_run = mysqli_query($connection, $email_query);
            if(mysqli_num_rows($email_query_run) > 0)
            {
                $_SESSION['status'] = "Email Already Taken. Please Try Another one.";
                $_SESSION['status_code'] = "error";
                header('Location: register.php');  
            }
            else
            {
                if($password === $cpassword)
                {
                    $query = "INSERT INTO register (username,email,password,usertype) VALUES ('$username','$email','$password','$usertype')";
                    $query_run = mysqli_query($connection, $query);

                    if($query_run)
                    {
                        // echo "Saved";
                        $_SESSION['status'] = "Admin Profile Added";
                        $_SESSION['status_code'] = "success";
                        header('Location: register.php');
                    }
                    else 
                    {
                        $_SESSION['status'] = "Admin Profile Not Added";
                        $_SESSION['status_code'] = "error";
                        header('Location: register.php');  
                    }
                }
                else 
                {
                    $_SESSION['status'] = "Password and Confirm Password Does Not Match";
                    $_SESSION['status_code'] = "warning";
                    header('Location: register.php');  
                }
            }

        }




    //CODICE PER L' EDIT-UPDATE DATI NEL FORM REGISTRAZIONE USER

    if (isset($_POST['updatebtn']))
    {
        $id = $_POST['edit_id'];
        $username = $_POST['edit_username'];
        $email = $_POST['edit_email'];
        $password = $_POST['edit_password'];
        $usertypeupdate = $_POST['update_usertype'];
        
        $query = "UPDATE register SET username='$username', email='$email', password='$password', usertype='$usertypeupdate' WHERE id='$id' ";
        $query_run = mysqli_query($connection, $query);
        
        
        if($query_run)
        
        {
            $_SESSION['success'] = "<h3 class='alert alert-success'>Dato aggiornato correttamente!</h3>";
            header('Location: register.php');
        }
        else
        {
            $_SESSION['status'] = "<h3 class='alert alert-warning'>Attenzione: dato non aggiornato!</h3>";
            header('Location: register.php');
        }    

     }

    
    
         //CODICE PER ELIMINARE DATI NELLA TABELLA USER

         if (isset($_POST['delete_btn']))
        {
            $id = $_POST['delete_id'];

            $query = "DELETE FROM register WHERE id='$id' ";
            $query_run = mysqli_query($connection, $query);

            if($query_run)

            {
                $_SESSION['success'] = "<h3 class='alert alert-success'>Il Dato selezionato è stato eliminato!</h3>";
                header('Location: register.php');
            }
            else
            {
                $_SESSION['status'] = "<h3 class='alert alert-warning'>Attenzione:il Dato selezionato non eliminato!</h3>";
                header('Location: register.php');
            }    

         }





        //CODICE PER IL LOGIN USER NELLA PAGINA LOGIN.PHP

        if(isset($_POST['login_btn']))
            {
                $email_login = $_POST['emaill']; 
                $password_login = $_POST['passwordd']; 

                $query = "SELECT * FROM register WHERE email='$email_login' AND password='$password_login' LIMIT 1";
                $query_run = mysqli_query($connection, $query);
                $usertype = mysqli_fetch_array($query_run);


                if($usertype['usertype'] == "admin")
                {
                    //$query2 = "SELECT usertype FROM register WHERE email='$email_login'";
                    //$query_run2 = mysqli_query($connection, $query2);
                    $_SESSION['username'] = $email_login;
                    $_SESSION['usertype'] = $usertype['usertype'];
                    header('Location: admin/dashboard.php');
                }
                else if($usertype['usertype'] == "user")
                {
                    $_SESSION['username'] = $email_login;
                      $_SESSION['usertype'] = $usertype['usertype'];
                    header('Location: index.php');
                }
                else
                {
                    $_SESSION['status'] = "Email / Password is Invalid";
                    header('Location: login.php');
                }

            }


//Funcao Logout
if (isset($_POST['logout_btn'])) {
    session_destroy();
    unset($_SESSION['usertype']);
    header("location: login.php");
}


/*
finestuff2@gmail.com
Bricco
111
admin

*/
?>
