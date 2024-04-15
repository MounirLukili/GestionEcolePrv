<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="candidature.css">
    <script lang="JavaScript" src="firebase.js" type="module"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.3.1/jspdf.umd.min.js"></script>    <title>Pré-inscription</title>
</head>
<body>
    <!-- Your existing HTML for the pre-registration form goes here -->


    <div class="preinscription-container">
      <p class="preinscription-titre">Pré-inscription</p>
      <p>
        La formation ITSN est payante: Frais de formation: Pour les bacheliers 18 500 DH pour les 2
        années, 16 000 DH pour les licenciés(10 Mois), 6200 DH Pour le niveau 9ème année.
        <br />La formation est payable en 2 tranches. 
        Date limite de pré-inscription: 1er novembre. <br />Vous êtes invité à remplir le formulaire
        ci-dessous:
      </p>
      <div class="prinscription-form-container">
        <form>
          <p class="preinscription-form-titles">Données personnelles</p>
          <hr />
          <label for="fname">Nom</label>
          <input
            type="text"
            id="fname"
            name="firstname"
            placeholder="Votre Nom ..."
          />

          <label for="lname">Prénom</label>
          <input
            type="text"
            id="lname"
            name="lastname"
            placeholder="Votre prénom .."
          />

          <label for="phone">Télephone</label>
          <input
            type="tel"
            id="phone"
            name="lastname"
            placeholder="Numéro de télephone .."
          />

          <label for="email">Adresse électronique</label>
          <input
            type="email"
            id="email"
            name="lastname"
            placeholder="Votre Email .."
          />

          <p class="preinscription-form-titles">Niveau d'étude</p>
          <hr />

          <label for="level">Dernier diplôme obtenu</label>
          <select id="level" name="level">
            <option value="Autres">---</option>
            <option value="licence">Licence (d'un établissement public)</option>
            <option value="master">Master (d'un établissement public)</option>
            <option value="Ingenierie">
              Ingénierie (d'un établissement public)
            </option>
            <option value="prive3">Bac+3 (d'un établissement privé)</option>
            <option value="prive4">Bac+4 (d'un établissement privé)</option>
            <option value="prive5">Bac+5 (d'un établissement privé)</option>
          </select>
          <input
            type="text"
            id="level-autre"
            name="level"
            placeholder="Autre .."
          />
          <br />
          <label for="etablissement">Etablissement</label>
          <input
            type="text"
            id="etablissement"
            name="etablissement"
            placeholder="Etablissement"
          />
          <label for="ville">Ville</label>
          <input type="text" id="ville" name="ville" placeholder="Ville" />
          <label for="filiere">Filiere</label>
          <input
            type="text"
            id="filiere"
            name="filiere"
            placeholder="Filiere"
          />
          <label for="datediplome">Date d'obtention</label>
          <input type="Date" id="datediplome" name="datediplome" />
          <p class="preinscription-form-titles">Données Supplémentatire</p>
          <hr />
          <label for="cv">CV</label> <br />
          <input type="file" id="cv" name="cv" /> <br />
          <label for="note1">
            Relevés des notes de la dernière année d'études </label
          ><br />
          <input type="file" id="note1" name="note1" /> <br />
          
          

          <label for="motivation">
           Lettre de Motivation
          </label>
          <br />
          <input type="file" id="motiv" name="motiv" /> <br />



          <input type="submit" value="Confirmer et envoyer votre condidature" />
        </form>
      </div>
    </div>

    
</body>

<!-- Add Firebase Firestore SDK -->
<script src="https://www.gstatic.com/firebasejs/10.10.0/firebase-firestore.js" type="module"></script>



</html>


