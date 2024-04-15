<?php
    session_start();
    
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../requestLogin.php");
        exit;
    }
    
    require_once "connectConfig.php";

    $new_password = $confirm_password = "";
    $password_err ="";
    
    if(isset($_POST['changePW'])){  
        if(empty($_POST["new_password"])){ //Vérification de nouveau mot passe
            $password_err = "SVP entrer votre nouveau mot de passe";
            $_SESSION['status']=$password_err;
            header("location: ../pages/LoggedIn/passwordReset.php");
        } elseif(strlen($_POST["new_password"]) < 6) {
            $password_err = "Le nouveau mot doit avoir au moin six caractéres";
            $_SESSION['status']=$password_err;
            header("location: ../pages/LoggedIn/passwordReset.php");
        } else {
            $new_password = $_POST["new_password"];
        }
        
        if(empty(($_POST["confirm_password"]))){// Vérifiaction de la confirmation de mot passe
            $password_err = "SVP entrer votre nouveau mot de passe.";
            $_SESSION['status']=$password_err;
            header("location: ../pages/LoggedIn/passwordReset.php");
        } else {
            $confirm_password = ($_POST["confirm_password"]);
            if(empty($password_err) && ($new_password != $confirm_password)){
                $password_err = "La confirmation du mot de passe entrer est inccorect";
                $_SESSION['status']=$password_err;
                header("location: ../pages/LoggedIn/passwordReset.php");
            }
        }
            
        if(empty($password_err) && empty($password_err)){
            $param_id = $_SESSION["userId"];
            $sql = "UPDATE utilisateurs SET userPassword = '$new_password' WHERE userId = '$param_id'";
            if($link->query($sql)){
                session_destroy();
                echo "<script> alert('Le mot de passe a été bien réinitialiser');
                        location='../pages/requestLogin.php';
                    </script>";
                
            } else {
                echo "Erreur de changement de mot de passe vérifier avec votre adminstrateur";
                $_SESSION['status']=$password_err;
                header("location: ../pages/LoggedIn/passwordReset.php");
            }
            $link->close();
        }
    }
?>