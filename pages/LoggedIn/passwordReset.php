<?php
    require_once "../../configFiles/countConfig.php";
    require_once "../../configFiles/usersListConfig.php";
    session_start(); //Initialisation de la session
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ //Vérification de l'authentification de l'utilisateur
        header("location: ../requestLogin.php");
        exit;
    }
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../CSS/resetPw.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <title> ITSN - Connexion</title>
  </head>

  <body>
    <div>
      <div class="header">
        <a href="../../index.php" class="logo" title="Acceuil">
          <img src="../../Media/Logo.png"            width="150" 
           height="100"/>
        </a>
      </div>

      <div class="login-container">
        <div class="login-form">
          <?php echo '<img class="user_picture" src="data:image/jpeg;base64,'.base64_encode($_SESSION['userImage']).'"/>';
            ?>
          <p>Réinitialisation du mot de passe</p>
          <!-- Message du serveur -->
          <?php 
                if(isset($_SESSION['status'])){
                ?>
                <div class="warningServeur">
                  <?= $_SESSION['status']; ?>
                </div>
                <?php 
                    unset($_SESSION['status']);
                }
          ?>
          <form action="../../configFiles/pwdResetConfig.php" method="POST">
            <input
              type="password"
              name="new_password"
              placeholder="Nouveau Mot de passe"
            />
            <br />
            <input
              type="password"
              name="confirm_password"
              placeholder="Confirmer le mot de passe"
            />
            <br />
            <input
              type="submit"
              value="Changer le mot de passe"
              name="changePW"
            />
          </form>
          <a href="../requestLogin.php">&#10094; Retour au tableau de bord</a>
        </div>
      </div>

      <div class="footer">
        <p>ITSN - Institut Technique des Sciences Nouvelles © 2022</p>
      </div>
    </div>
  </body>
</html>
