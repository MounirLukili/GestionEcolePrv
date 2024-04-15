<?php
  require_once "../configFiles/loginConfig.php";
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../CSS/loginVerification.css " />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <title>ITSN - Connexion</title>
  </head>
 
  <body>
    <div>
      <div class="header">
        <a href="../index.php" class="logo" title="Acceuil">
          <img src="../Media/Logo.png"     
           width="150" 
           height="100"  />

        </a>
      </div>
      <div class="login-container">
        <div class="login-form">
        <i class="fa fa-user"></i>
            <p>Connexion</p>
            <form action="../configFiles/loginConfig.php" method="POST">
              <p class="verificationErreur">
                <?php echo $login_err ?>
              </p>
              <input type="text" name="userLogin" placeholder="Login" /> <br />
              <input
                type="password"
                name="userPassword"
                placeholder="Mot de passe"
              />
              <input type="button" value="Oublié?" />
              <br />
              <input type="submit" value="Se connecter" name="SeConnecter"/>
            </form>
          <a href="../index.php">&#10094; Retour à la page d'acceuil</a>
        </div>
      </div>

      <div class="footer">
        <p>ITSN - Institut Technique des sciences nouvelles © 2022</p>
      </div>
    </div>
  </body>
</html>
