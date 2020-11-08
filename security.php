<?php

include_once('database/dbconfig.php');
include('code.php');
if ($connection) {
    // echo "Database Connected";
} else {
    header("Location: database/dbconfig.php");
}


if ($usertype['usertype']=="admin") {
    header("location: index.php");
}else{
    header("location: login.php");
}
?>



