<?php 

session_start(); 

include "connection.php";

if ((isset($_POST['password']))) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }
    $pass = validate($_POST['password']);

    if (empty($pass)) {

        header("Location: home.php?error=User Name is required");

        exit();

    }else{

        $sql = "SELECT * FROM users WHERE password='$pass'";

        $result = mysqli_query($db, $sql);

        if (mysqli_num_rows($result) === 1) {

            $row = mysqli_fetch_assoc($result);

            if ($row['password'] === $pass) {

                echo "Logged in!";

                $_SESSION['first_name'] = $row['first_name'];
                
                $_SESSION['last_name'] = $row['last_name'];

                $_SESSION['id'] = $row['id'];

                $_SESSION['password'] = $row['password'];

                header("Location: report.php");

                exit();

            }else{

                header("Location: home.php?error=Pin Incorrecto");

                exit();

            }

        }else{

            header("Location: home.php?error=Pin Incorrecto");

            exit();

        }

    }

}else{

    header("Location: home.php");

    exit();

}