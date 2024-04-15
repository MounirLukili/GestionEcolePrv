<?php
  session_start();
  require_once "connectConfig.php";
  $userLogin = $userPassword = "";
  $login_err = "";

  //Vérification si la session est ouvert
  if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    if($_SESSION["userType"]=='Adminstrateur')  header("location: ../pages/LoggedIn/adminHome.php");
    else if($_SESSION["userType"]=='Professeur')  header("location: ../pages/LoggedIn/teacherHome.php");    
    else header("location: ../pages/LoggedIn/studentHome.php");
    exit;
  }

  if(isset($_POST['SeConnecter'])){
      /* Vérification de l'existtence du login et Mot de passe */
      if(empty($_POST["userLogin"]) || empty($_POST["userPassword"])){
          $login_err = "Entrez votre Login et mot de passe ";
          /* header("location: ../pages/requestLogin.php"); */
          echo "<script>
                  alert('$login_err'); 
                  location='../pages/requestLogin.php'; 
                </script>";
      } else{
          $userLogin = $_POST["userLogin"];
          $userPassword = $_POST["userPassword"];
      }

      /* Validation des données */
      if(empty($login_err)){
          $sql = "SELECT userId, nom, prenom, email, userImage, userLogin, userPassword, userType, WebSite, PhoneNbr
          FROM utilisateurs WHERE userLogin = ?";
          
          if($stmt = mysqli_prepare($link, $sql)){
              mysqli_stmt_bind_param($stmt, "s", $param_username); //Binding
              $param_username = $userLogin; //parameters
              if(mysqli_stmt_execute($stmt)){
                  mysqli_stmt_store_result($stmt);
                  if(mysqli_stmt_num_rows($stmt) == 1){                    
                      mysqli_stmt_bind_result($stmt, $userId, $nom, $prenom, $email, $userImage, $userLogin, $hashed_password, $userType, $WebSite, $PhoneNbr);
                      if(mysqli_stmt_fetch($stmt)){
                        if($userPassword==$hashed_password){
                          session_start(); //userPassword true
                          $_SESSION["loggedin"] = true;
                          $_SESSION["userId"] = $userId;
                          $_SESSION["userLogin"] = $userLogin;
                          if ($userType=="admin") {
                            $_SESSION["userType"]="Adminstrateur";
                          }else if($userType=="student"){
                            $_SESSION["userType"]="Etudiant";
                          }else{
                            $_SESSION["userType"]="Professeur";
                          }
                          $_SESSION["nom"]=$nom;
                          $_SESSION["prenom"]= $prenom;
                          $_SESSION["email"]= $email;
                          $_SESSION["userImage"]= $userImage;
                          $_SESSION["WebSite"]= $WebSite;
                          $_SESSION["PhoneNbr"]= $PhoneNbr;
                          if($userType=='admin')  header("location: ../pages/LoggedIn/adminHome.php");   //redirection
                          else if($userType=='teacher')  header("location: ../pages/LoggedIn/teacherHome.php");    
                          else header("location: ../pages/LoggedIn/studentHome.php");
                        } else{
                          $login_err = "Login ou mot de passe Incorrect.";
                          echo "<script>
                                  alert('$login_err'); 
                                  location='../pages/requestLogin.php';
                                </script>";
                        }
                      }
                  } else{
                    $login_err = "Login Introuvable";
                    echo "<script>
                            alert('$login_err'); 
                            location='../pages/requestLogin.php';
                          </script>";
                  }
              } else{
                $login_err = "Erreur de connexion, Veuillez résseyez plus tard.";
                echo "<script>
                        alert('$login_err'); 
                        location='../pages/requestLogin.php';
                      </script>";
              }
              mysqli_stmt_close($stmt);
          }
      }
      mysqli_close($link);
  }
?>