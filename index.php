<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script lang="JavaScript" src="JS/main.js"></script>
    <title>ESIO - Ecole Supérieure d'Informatique d'Orléans</title>
</head>
<body onload="pageLoading();">
<header class="header">
    <div class="header-left">
        <img src="Media/logo.jpg" alt="ITSN Logo" style="height: 50px;"> <!-- Adjust size as needed -->
    </div>
    <div class="header-right">
        <div class="header-links">
            <a href="pages/candidate.php" id="navlinkCandidate">Candidate</a>
            <a href="pages/requestLogin.php" id="navlinkLogin">Login</a>
            <!-- Dropdown Menu Trigger -->
            <div class="dropdown">
                <button class="dropbtn" onclick="toggleDropdown()">Menu</button>
                <div class="dropdown-content" id="myDropdown">
                    <a href="#apropos">A propos</a>
                    <a href="#Contact">Contact</a>
                </div>
            </div>
        </div>
    </div>
</header>



<main>
  
     <div class="width-100">
      <img class="slider-width" src="Media/ext1.jpg">
     </div>

    <div class="content">
        <hr id="apropos" style="scroll-margin-top: 100px;">
        <div class="apropos-container" style="text-align: center;">
            <p class="apropos-titre">A propos de la formation:</p>
            <p>
            Créée en 1983, l’ESGI (École Supérieure de Génie Informatique) forme ses étudiants aux évolutions de l’informatique en s’adaptant aux besoins du secteur.

 

Accessible à partir du Bac, l’ESGI prépare à tous les métiers de l’informatique à travers 9 spécialisations dispensées sur 2 cycles : Cycle Bachelor (Bac à Bac+3) délivrant une Certification Professionnelle reconnu par l'Etat de niveau 6 et Cycle Mastère (Bac+3 à Bac+5) délivrant une Certification Professionnelle reconnu par l'Etat de niveau 7.

 

Afin de permettre aux étudiants de se professionnaliser, les formations sont accessibles en alternance dès la première année. Avec un réseau de plus de 1 100 entreprises partenaires, l'école entretient des relations étroites avec le monde de l'entreprise.

 

Dotée de nombreux laboratoires d'expérimentation, l'école a à cœur de développer une pédagogie par projets.

 

Présente sur 10 campus en France, l'ESGI est une école reconnue par l'Etat sur son campus parisien ce qui lui permet d'accueillir des étudiants boursiers.            </p>
        
<!--<div class="gallery">
      <a target="_blank" >
        <img src="Media/ext2.jpg" alt="Forest" width="600" height="400">
      </a>
      <div class="desc">Exterieur2</div>
    </div>


    <div class="gallery">
      <a target="_blank">
        <img src="Media/int.jpg" alt="Cinque Terre" width="600" height="400">
      </a>
      <div class="desc">Interieur</div>
    </div>   -->


   

    <div class="container">
      <div class="slider-wrapper">
        <button id="prev-slide" class="slide-button material-symbols-rounded">
          <
        </button>
        <ul class="image-list">
          <img class="image-item" src="Media/ext2.jpg" alt="img-1" />
          <img class="image-item" src="Media/int.jpg" alt="img-2" />
          <img class="image-item" src="Media/w.jpg" alt="img-3" />
          <img class="image-item" src="Media/2.jpg" alt="img-4" />
          <img class="image-item" src="Media/3.jpg" alt="img-5" />
          <img class="image-item" src="Media/plan.jpg" alt="img-6" />
          <img class="image-item" src="Media/logo.jpg" alt="img-7" />
          <img class="image-item" src="Media/ext1.jpg" alt="img-8" />
        
        </ul>
        <button id="next-slide" class="slide-button material-symbols-rounded">
          >
        </button>
      </div>
      <div class="slider-scrollbar">
        <div class="scrollbar-track">
          <div class="scrollbar-thumb"></div>
        </div>
      </div>
    </div>



    

</main>










<div class="contactUs">
<div class="contactUs">
      <div class="contactUs-Information">
        <p class="contactUs-titre">Information de Contact</p>
        <p class="contactUs-Informations">
          Mme. Souad El Kharraz <br />
          Directrice Générale <br />
          ITSN <br />
          <br />
          <i class="fa fa-envelope"></i> groupitsn@gmail.com <br />
          <i class="fa fa-phone"></i> 06 62 10 21 67 <br />
          <br />
          Prof. Azroumahli Chaimae <br />
          Enseignante <br />
          <i class="fa fa-phone"></i> 06 48 42 38 61
        </p>
      </div>
      <div class="contactUs-Formulaire">
        <p class="contactUs-titre">Contactez Nous</p>
        <form>
          <label for="contactNom">Nom</label>
          <input
            type="text"
            id="contactNom"
            name="contactNom"
            placeholder="Votre nom"
          />
          <label for="contactPrenom">Prenom</label>
          <input
            type="text"
            id="contactPrenom"
            name="contactPrenom"
            placeholder="Votre Prenom ..."
          />
          <label for="contactEmail">Email</label>
          <input
            type="email"
            id="contactEmail"
            name="contactEmail"
            placeholder="Votre Email ..."
          />
          <br />
          <p class="contactUs-textarea">
            <label for="contactMessage">Votre Message</label>
            <textarea id="contactMessage" name="contactMessage">...</textarea>
          </p>
          <br />
          <input type="submit" value="Envoyer" />
        </form>
      </div>
    </div>
</div>

<footer class="footer">
<footer class="footer">
      <div class="footer-container">
        <div class="footer-left">
          <p class="footer-links">
            <a href="index.php" onclick="navbarclick(1);">Acceuil -</a>
            <a href="#apropos" onclick="navbarclick(2);">A propos -</a>
            <a href="#preinscription" onclick="navbarclick(3);">
              Pré inscription -
            </a>
            <a href="pages/requestLogin.php" onclick="navbarclick(5);">Connexion</a>
          </p>
        </div>
        <div class="footer-right">
          <div class="footer-icons">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-github"></i></a>
          </div>
        </div>
      </div>
      <div class="footer-rights">
        <p>ESIO - Ecole Supérieure d'Informatique Orléans © 2024</p>
      </div>
    </footer>
</footer>



</body>
</html>
