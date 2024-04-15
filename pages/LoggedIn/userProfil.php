<?php
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
    <link rel="stylesheet" href="../../CSS/infoProfil.css" />
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
          <img src="../../Media/Logo.png"     
           width="150" 
           height="100"  />

        </a>
      </div>
      <div class="login-container">
        <h2 class="loginTitle">Données de profil de l'utilisateur</h2>
        <div class="login-form">
          <form action="../../configFiles/moddifyObject.php" method="POST" enctype="multipart/form-data">
            <div class="formFlex">
              <input value=<?php echo $_SESSION["userId"]?> name="userId" style="display:none;">
              <div class="formImg">
                <?php echo '<img class="user_picture" src="data:image/jpeg;base64,'.base64_encode($_SESSION['userImage']).'"/>';?>
                <br/>
                <input type="file" name="profilImg" >
              </div>
              
              <div class="formOtherData">
                <label for="nom">Nom </label> <br/>
                <input type="text" value=<?php echo $_SESSION['nom']?> name="nom"/> <br/>

                <label for="prenom">Prenom </label> <br/>
                <input type="text" value=<?php echo $_SESSION['prenom']?> name="prenom"/> <br/>

                <label for="email">Email </label> <br/>
                <input type="text" value=<?php echo $_SESSION['email']?> name="email"/> <br/>

                <label for="userLogin">Nom d'utilisateur</label> <br/>
                <input type="text" value=<?php echo $_SESSION['userLogin']?> name="userLogin"/> <br/>

                <?php
                  if ($_SESSION['userType']=='Etudiant') {
                    ?>
                    <label for="WebSite">Site Web</label> <br/>
                    <input type="text" value=<?php echo $_SESSION['WebSite']?> name="WebSite"/> <br/>
                    <?php
                  }
                  if ($_SESSION['userType']=='Professeur') {
                    ?>
                    <label for="PhoneNbr">N Téléphone</label> <br/>
                    <input type="text" value=<?php echo $_SESSION['PhoneNbr']?> name="PhoneNbr"/> <br/>
                    <?php
                  }
                ?>

              </div>
            </div>
            <input
              type="submit"
              value="Changer vos données "
              name="changeProfil"
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
