<?php
    require_once "../../configFiles/countConfig.php";
    require_once "../../configFiles/usersListConfig.php";
    $moduleId=0;
    $studentId=0;
    session_start(); //Initialisation de la session
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){ //Vérification de l'authentification de l'utilisateur
        header("location: login.php");
        exit;
    }
    if(isset($_POST['choosemodulesToshowNote'])){
      $moduleId=$_POST['notesOf'];
    }
    if(isset($_POST['choosestudentToshowNote'])){
      $studentId=$_POST['notesOf'];
    }
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
      integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
      crossorigin="anonymous"
    />
    <link
      href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link rel="stylesheet" href="../../CSS/loggedInHome.css" />
    <title>ITSN - Adminstrateur</title>
  </head>
  <body>
    <div class="main_container">
      <!---------------------------- Navigation ------------------------------------>
      <div class="side_navigation shadow p-3 mb-5 bg-white rounded">
        <a
          class="logo_Home d-flex align-items-center align-content-center"
          href="../../index.php"
          target="blank"
        >
          <img src="../../Media/Logo.png"            width="150" 
           height="100"/>
          <p>Institut Technique des Sciences Nouvelles</p>
        </a>

        <hr />

        <p
          class="btn_navigation btn btn-primary btn-block activeDaschboardTool"
          role="button"
          aria-expanded="false"
          onclick="manageDashboardNav(1);"
          id="daschboardNav1"
        >
          <i class="fa fa-dashboard"></i> <span>Tableau de bord</span>
        </p>

        <div class="accordion" id="navigationCollapse">
          <p>
            <a
              class="btn_navigation btn btn-primary btn-block"
              data-toggle="collapse"
              href="#gestionUtilisateur"
              role="button"
              aria-expanded="false"
              id="daschboardNavType1"
            >
              <i class="fa fa-users"></i> <span>Gestion des utilisateurs</span>
            </a>
          </p>

          <div
            class="collapse"
            id="gestionUtilisateur"
            data-parent="#navigationCollapse"
          >
            <div class="navigation_sec card card-body">
              <p
                class="btn_navigation_sec btn btn-light btn-block"
                role="button"
                id="daschboardNav2"
                onclick="manageDashboardNav(2);"
              >
                Gestion des enseignants
              </p>
              <p
                class="btn_navigation_sec btn btn-light btn-block"
                role="button"
                id="daschboardNav3"
                onclick="manageDashboardNav(3);"
              >
                Liste des enseignants
              </p>
              <hr />
              <p
                class="btn_navigation_sec btn btn-light btn-block"
                role="button"
                id="daschboardNav4"
                onclick="manageDashboardNav(4);"
              >
                Gestion des étudiants
              </p>
              <p
                class="btn_navigation_sec btn btn-light btn-block"
                role="button"
                id="daschboardNav5"
                onclick="manageDashboardNav(5);"
              >
                Liste des étudiants
              </p>
            </div>
          </div>

          <p>
            <a
              class="btn_navigation btn btn-primary btn-block"
              data-toggle="collapse"
              href="#gestionModule"
              role="button"
              aria-expanded="false"
              id="daschboardNavType2"
            >
              <i class="fa fa-book"></i> <span>Gestion des modules</span>
            </a>
          </p>

          <div
            class="collapse"
            id="gestionModule"
            data-parent="#navigationCollapse"
          >
            <div class="navigation_sec card card-body">
              <p
                class="btn_navigation_sec btn btn-light btn-block"
                role="button"
                id="daschboardNav6"
                onclick="manageDashboardNav(6);"
              >
                Les modules de la formation
              </p>
              <hr />
              <p
                class="btn_navigation_sec btn btn-light btn-block"
                role="button"
                id="daschboardNav7"
                onclick="manageDashboardNav(7);"
              >
                Les notes des étudiants
              </p>
            </div>
          </div>
        </div>
      </div>

      <div class="main_navigation shadow p-3 pb-1 mb-3 bg-white rounded">
        <!--------------------------- Informations du profil connecté ----------------------->
        <div class="user_login_information p-1 mb-2">
          <div class="user_profile">
            <?php echo '<img class="user_picture border" src="data:image/jpeg;base64,'.base64_encode($_SESSION['userImage']).'"/>';
            ?>
            <div class="user_information">
              <p class="user_name">
                <?php echo htmlspecialchars($_SESSION["nom"]); ?>
                <?php echo htmlspecialchars($_SESSION["prenom"]); ?>
              </p>
              <p class="user_type">
                <?php echo htmlspecialchars($_SESSION["email"]); ?>
              </p>
            </div>
            <div class="dropdownleft">
              <button
                class="user_configuration btn btn-secondary"
                type="button"
                id="dropdownMenuButtonUserProfil"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="fa fa-bars"></i>
              </button>

              <div
                class="dropdown-menu"
                aria-labelledby="dropdownMenuButtonUserProfil"
              >
                <a class="dropdown-item" href="userProfil.php">Paramétres</a>
                <a class="dropdown-item" href="passwordReset.php">
                  Réintialiser Mot de passe
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="../../configFiles/disconnect.php"
                  >Se deconnecter</a
                >
              </div>
            </div>
          </div>
        </div>

        <div class="user_navigation p-1 mb-0">
          <!--------------------------- Tableau de bord: Dashboard ------------------------>
          <div class="dashboard p-1" id="dashboardTool1">
            <div class="user_navigation_title ml-2 p-0 mb-1">
              <b>Bienvenue</b>
              <span> <?php echo htmlspecialchars($_SESSION["prenom"]); ?> </span
              >!
            </div>

            <!-- Message du serveur -->
            <?php 
                if(isset($_SESSION['status'])){
                    ?>
            <div class="warningServeur p-2 m-2 text-dark rounded bg-warning">
              <?= $_SESSION['status']; ?>
            </div>
            <?php 
                    unset($_SESSION['status']);
                }
            ?>
            <!-- contenu du tableau de bord -->
            <div class="dashboardTools bg-white p-1 container border rounded">
              <div class="row align-items-center">
                <div class="carouselDashboard col-8">
                  <!-- card des information du profil connecté -->
                  <div
                    class="userInformations d-flex flex-row border rounded align-items-center p-1 m-1 ml-5 mr-5"
                    id="userInformations"
                  >
                    <?php echo '<img class="rounded-circle m-1 border" src="data:image/jpeg;base64,'.base64_encode($_SESSION['userImage']).'"/>';
                    ?>
                    <div class="m-2">
                      <p class="m-1">
                        Nom:
                        <span
                          ><?php echo htmlspecialchars($_SESSION["nom"]); ?></span
                        >
                      </p>
                      <p class="m-1">
                        prenom:
                        <span
                          ><?php echo htmlspecialchars($_SESSION["prenom"]); ?></span
                        >
                      </p>
                      <p class="m-1">
                        Role:
                        <span
                          ><?php echo htmlspecialchars($_SESSION["userType"]); ?></span
                        >
                      </p>
                      <p class="m-1">
                        Nom d'utilisateur:
                        <span
                          ><?php echo htmlspecialchars($_SESSION["userLogin"]); ?></span
                        >
                      </p>
                      <p class="m-1">
                        E-mail:
                        <span
                          ><?php echo htmlspecialchars($_SESSION["email"]); ?></span
                        >
                      </p>
                    </div>
                  </div>
                  <!-- carousel des outils -->
                  <div
                    id="carouselDashboardIndicator"
                    class="carousel slide"
                    data-ride="carousel"
                    data-interval="3000"
                  >
                    <ol class="carousel-indicators">
                      <li
                        data-target="#carouselDashboardIndicator"
                        data-slide-to="0"
                        class="active"
                      ></li>
                      <li
                        data-target="#carouselDashboardIndicator"
                        data-slide-to="1"
                      ></li>
                    </ol>
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <div class="container m-2 p-2">
                          <div class="carouselDashboardToolsContainer row">
                            <div class="col content m-1">
                              <div
                                class="content-image carouselDashboardTool bg-warning d-flex flex-column justify-content-between"
                                onclick="manageDashboardNav(2);"
                              >
                                <i class="fa fa-users m-3"></i>
                                <p class="align-self-end mr-3">
                                  <?php count_users("teacher");?>
                                </p>
                              </div>
                              <div class="content-details fadeIn-bottom">
                                <h3
                                  class="content-title"
                                  onclick="manageDashboardNav(2);"
                                >
                                  Gestion des Professeurs
                                </h3>
                              </div>
                            </div>
                            <div class="col content m-1">
                              <div
                                class="content-image carouselDashboardTool bg-info d-flex flex-column justify-content-between"
                                onclick="manageDashboardNav(4);"
                              >
                                <i class="fa fa-graduation-cap m-3"></i>
                                <p class="align-self-end mr-4">
                                  <?php count_users("student"); ?>
                                </p>
                              </div>
                              <div class="content-details fadeIn-bottom">
                                <h3
                                  class="content-title"
                                  onclick="manageDashboardNav(4);"
                                >
                                  Gestion des étudiants
                                </h3>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="carousel-item">
                        <div class="container m-2 p-2">
                          <div class="carouselDashboardToolsContainer row">
                            <div class="col content m-1">
                              <div
                                class="content-image carouselDashboardTool bg-secondary d-flex flex-column justify-content-between"
                                onclick="manageDashboardNav(6);"
                              >
                                <i class="fa fa-book m-3"></i>
                                <p class="align-self-end mr-3">
                                  <?php count_modules(); ?>
                                </p>
                              </div>
                              <div class="content-details fadeIn-bottom">
                                <h3
                                  class="content-title"
                                  onclick="manageDashboardNav(6);"
                                >
                                  Gestion des modules
                                </h3>
                              </div>
                            </div>
                            <div class="col content m-1">
                              <div
                                class="content-image carouselDashboardTool bg-success d-flex flex-column justify-content-between"
                                onclick="manageDashboardNav(7);"
                              >
                                <i class="fa fa-check-square-o m-3"></i>
                                <p class="align-self-end mr-4">
                                  <?php count_notes(); ?>
                                </p>
                              </div>
                              <div class="content-details fadeIn-bottom">
                                <h3
                                  class="content-title"
                                  onclick="manageDashboardNav(7);"
                                >
                                  Gestion des notes
                                </h3>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Liste de tous les utilsateurs -->
                <div class="col pr-5">
                  <div class="table-wrapper-scroll-y users-scrollbar">
                    <table class="table table-light">
                      <?php show_users(); ?>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--------------------------- Gestion des utilisateurs -------------------------->
          <!-- Ajout Suppression des enseignant -->
          <div class="manageUsers" id="dashboardTool2">
            <div class="mb-2">
              <button
                class="manageComponentBtn btn"
                onclick="manageDashboardNav(3);"
              >
                <i class="fa fa-angle-double-left"></i>
                Afficher la liste des professeurs
              </button>
            </div>

            <div id="accordionTeacher">
              <!-- Ajouter Un professeur -->
              <div class="card">
                <div class="addDelUserCard card-header" id="heading1">
                  <button
                    class="manageComponentBtn btn btn-link"
                    data-toggle="collapse"
                    data-target="#collapse1"
                    aria-expanded="true"
                    aria-controls="collapse1"
                  >
                    Ajouter un professeur
                  </button>
                </div>

                <div
                  id="collapse1"
                  class="addDelUserCard collapse show"
                  aria-labelledby="heading1"
                  data-parent="#accordionTeacher"
                >
                  <div class="card-body">
                    <form
                      class="addDelComponentForm"
                      action="../../configFiles/addObject.php"
                      method="POST"
                      enctype="multipart/form-data"
                    >
                      <div class="form-row align-items-center">
                        <div class="col-md-4 mb-3">
                          <label for="teacherName">Nom du professeur</label>
                          <input
                            type="text"
                            class="form-control"
                            name="teacherName"
                            placeholder="Nom du professeur"
                            required
                          />
                        </div>

                        <div class="col-md-3 mb-3">
                          <label for="teacherLastName">prenom</label>
                          <input
                            type="text"
                            class="form-control"
                            name="teacherLastName"
                            placeholder="prenom"
                            required
                          />
                        </div>

                        <div class="col-md-5 mb-3">
                          <label for="teacherEmail">Email</label>
                          <input
                            type="email"
                            class="form-control"
                            name="teacherEmail"
                            placeholder="Email"
                            required
                          />
                        </div>

                        <div class="col-md-4 mb-3">
                          <label for="teacherPhoneNbr">Numéro de Téléphone</label>
                          <input
                            type="text"
                            class="form-control"
                            name="teacherPhoneNbr"
                            placeholder="N° Téléphone"
                            required
                          />
                        </div>
                        
                        <div class="form-group col-md-4 mb-3">
                          <label for="teacherImg">
                            Télécharger l'image du professeur
                          </label>
                          <div class="custom-file">
                            <input
                              type="file"
                              class="custom-file-input form-control-file"
                              name="teacherImg"
                              lang="fr"
                              onchange="detectFileName(this,'teacherImgFileName');"
                            />
                            <label
                              class="custom-file-label"
                              for="teacherImg"
                              id="teacherImgFileName"
                            >
                              Sélectionner le fichier
                            </label>
                          </div>
                        </div>
                        
                      </div>

                      <div class="form-row align-items-end">
                        <div class="col-md-4 mb-0">
                          <label for="teacherLogin">Login</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span
                                class="input-group-text"
                                id="validationTeacherLogin"
                                >@</span
                              >
                            </div>
                            <input
                              type="text"
                              class="form-control"
                              name="teacherLogin"
                              placeholder="Login"
                              aria-describedby="validationTeacherLogin"
                              required
                            />
                            <div class="invalid-tooltip">
                              Entrer un login valid.
                            </div>
                          </div>
                        </div>

                        <div class="col-md-4 mb-0">
                          <label for="teacherPassword">Mot de passe</label>
                          <input
                            type="password"
                            class="form-control"
                            name="teacherPassword"
                            placeholder="itsn@2022"
                            required
                          />
                        </div>

                        <div class="col-auto mb-0">
                          <label></label>
                          <button
                            class="addDelComponentBtn btn btn-primary"
                            type="submit"
                            name="addTeacher"
                          >
                            Ajouter un professeur
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              
              <!-- Supprimer Un professeur -->
              <div class="card">
                <div class="addDelUserCard card-header" id="heading2">
                  <button
                    class="manageComponentBtn btn btn-link collapsed"
                    data-toggle="collapse"
                    data-target="#collapse2"
                    aria-expanded="false"
                    aria-controls="collapse2"
                  >
                    Supprimer un professeur de la liste
                  </button>
                </div>

                <div
                  id="collapse2"
                  class="addDelUserCard collapse"
                  aria-labelledby="heading2"
                  data-parent="#accordionTeacher"
                >
                  <div class="card-body">
                    <form
                      class="addDelComponentForm"
                      action="../../configFiles/delObject.php"
                      method="POST"
                    >
                      <div class="form-row align-items-end">
                        <div class="col-md-4 mb-3">
                          <label for="teacherLogin">
                            Login du professeur à supprimer
                          </label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span
                                class="input-group-text"
                                id="validationTeacherLoginToDelete"
                                >@</span
                              >
                            </div>
                            <input
                              type="text"
                              class="form-control"
                              name="teacherLogin"
                              placeholder="Login"
                              aria-describedby="validationTeacherLoginToDelete"
                              required
                            />
                            <div class="invalid-tooltip">
                              Entrer un login valid.
                            </div>
                          </div>
                        </div>
                        <div class="col-md-4 mb-3">
                          <button
                            class="addDelComponentBtn btn btn-primary"
                            type="submit"
                            name="deleteTeacher"
                          >
                            Supprimer le compte d'utilisateur
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Afficher la liste des enseignants -->
          <div class="usersList" id="dashboardTool3">
            <div class="m-2">
              <button
                class="manageComponentBtn btn"
                onclick="manageDashboardNav(2);"
              >
                <i class="fa fa-angle-double-left"></i>
                Ajouter ou Supprimer un compte Professeur
              </button>
            </div>

            <div class="usersListTable m-2 rounded p-3 bg-white">
              <!-- barre de recherche -->
              <div class="d-flex flex-row justify-content-end rounded mb-2">
                <input
                  type="search"
                  class="form-control rounded mr-1"
                  placeholder="Chercher"
                  aria-label="Search"
                  aria-describedby="search-addon"
                />
                <button
                  class="input-group-text border-0 bg-light rounded"
                  id="search-addon"
                >
                  <i class="fa fa-search"></i>
                </button>
              </div>


              <!-- table des enseignants -->
              <div
                class="table-wrapper-scroll-y users-scrollbar border rounded p-2"
              >
                <table class="table table-sm table-light">
                  <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col">Nom</th>
                      <th scope="col">Prenom</th>
                      <th scope="col">Nom d'utilisateur</th>
                      <th scope="col">Email</th>
                      <th scope="col">N Téléphone</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                      <?php show_users_with_type('teacher');?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!-- Ajout Suppression des étudiants -->
          <div class="manageUsers" id="dashboardTool4">
            <div class="mb-2">
              <button
                class="manageComponentBtn btn"
                onclick="manageDashboardNav(5);"
              >
                <i class="fa fa-angle-double-left"></i>
                Afficher la liste des étudiants
              </button>
            </div>

            <div id="accordionStudent">
              <!-- Ajouter un étudiant -->
              <div class="card">
                <div class="addDelUserCard card-header" id="heading2">
                  <button
                    class="manageComponentBtn btn btn-link"
                    data-toggle="collapse"
                    data-target="#collapse3"
                    aria-expanded="true"
                    aria-controls="collapse3"
                  >
                    Ajouter un étudiant
                  </button>
                </div>

                <div
                  id="collapse3"
                  class="addDelUserCard collapse show"
                  aria-labelledby="heading2"
                  data-parent="#accordionStudent"
                >
                  <div class="card-body">
                    <form
                      class="addDelComponentForm"
                      action="../../configFiles/addObject.php"
                      method="post"
                      enctype="multipart/form-data"
                    >
                      <div class="form-row align-items-center">
                        <div class="col-md-4 mb-3">
                          <label for="studentName">Nom de l'étudiant</label>
                          <input
                            type="text"
                            class="form-control"
                            name="studentName"
                            placeholder="Nom de l'étudiant"
                            required
                          />
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="studentLastName">prenom</label>
                          <input
                            type="text"
                            class="form-control"
                            name="studentLastName"
                            placeholder="prenom"
                            required
                          />
                        </div>
                        <div class="col-md-5 mb-3">
                          <label for="studentEmail">Email</label>
                          <input
                            type="email"
                            class="form-control"
                            name="studentEmail"
                            placeholder="Email"
                            required
                          />
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="studentWebSite">Site Web: </label>
                          <input
                            type="text"
                            class="form-control"
                            name="studentWebSite"
                            placeholder="example@itsn.ma"
                            required
                          />
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="studentImg">
                            Télécharger l'image de l'étudiant
                          </label>
                          <div class="custom-file">
                            <input
                              type="file"
                              class="custom-file-input"
                              name="studentImg"
                              lang="fr"
                              onchange="detectFileName(this,'studentImgFileName');"
                            />
                            <label
                              class="custom-file-label"
                              for="studentImg"
                              id="studentImgFileName"
                            >
                              Sélectionner le fichier
                            </label>
                          </div>
                        </div>
                      </div>
                      <div class="form-row align-items-end">
                        <div class="col-md-4 mb-3">
                          <label for="studentLogin">Login</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span
                                class="input-group-text"
                                id="validationStudentLogin"
                                >@</span
                              >
                            </div>
                            <input
                              type="text"
                              class="form-control"
                              name="studentLogin"
                              placeholder="Login"
                              aria-describedby="validationStudentLogin"
                              required
                            />
                            <div class="invalid-tooltip">
                              Entrer un login valid.
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="studentPassword">Mot de passe</label>
                          <input
                            type="password"
                            class="form-control"
                            name="studentPassword"
                            placeholder="itsn@2022"
                            required
                          />
                        </div>
                        <div class="col-md-3 mb-3">
                          <button
                            class="addDelComponentBtn btn btn-primary"
                            type="submit"
                            name="addStudent"
                          >
                            Ajouter un étudiant
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>

              <!-- supprimer un étudiant -->
              <div class="card">
                <div class="addDelUserCard card-header" id="heading4">
                  <button
                    class="manageComponentBtn btn btn-link collapsed"
                    data-toggle="collapse"
                    data-target="#collapse4"
                    aria-expanded="false"
                    aria-controls="collapse4"
                  >
                    Supprimer un étudiant de la liste
                  </button>
                </div>

                <div
                  id="collapse4"
                  class="addDelUserCard collapse"
                  aria-labelledby="heading4"
                  data-parent="#accordionStudent"
                >
                  <div class="card-body">
                    <form
                      class="addDelComponentForm"
                      action="../../configFiles/delObject.php"
                      method="post"
                    >
                      <div class="form-row align-items-end">
                        <div class="col-md-4 mb-3">
                          <label for="studentLogin">
                            Login de l'étudiant à supprimer
                          </label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span
                                class="input-group-text"
                                id="validationStudentLoginToDelete"
                                >@</span
                              >
                            </div>
                            <input
                              type="text"
                              class="form-control"
                              name="studentLogin"
                              placeholder="Login"
                              aria-describedby="validationStudentLoginToDelete"
                              required
                            />
                            <div class="invalid-tooltip">
                              Entrer un login valid.
                            </div>
                          </div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <button
                            class="addDelComponentBtn btn btn-primary"
                            type="submit"
                            name="deleteStudent"
                          >
                            Supprimer le compte d'utilisateur
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Afficher la liste des étudiants -->
          <div class="usersList" id="dashboardTool5">
            <div class="m-2">
              <button
                class="manageComponentBtn btn"
                onclick="manageDashboardNav(4);"
              >
                <i class="fa fa-angle-double-left"></i>
                Ajouter ou Supprimer un Etudiant
              </button>
            </div>

            <div class="usersListTable m-2 rounded p-3 bg-white">
              <!-- barre de recherche -->
              <div class="d-flex flex-row justify-content-end rounded mb-2">
                <input
                  type="search"
                  class="form-control rounded mr-1"
                  placeholder="Chercher"
                  aria-label="Search"
                  aria-describedby="search-addon"
                />
                <button
                  class="input-group-text border-0 bg-light rounded"
                  id="search-addon"
                >
                  <i class="fa fa-search"></i>
                </button>
              </div>

              <!-- table des étudiants -->
              <div
                class="table-wrapper-scroll-y users-scrollbar border rounded p-2"
              >
                <table class="table table-sm table-light">
                  <thead>
                    <tr>
                      <th scope="col"></th>
                      <th scope="col">Nom</th>
                      <th scope="col">Prenom</th>
                      <th scope="col">Nom d'utilisateur</th>
                      <th scope="col">Email</th>
                      <th scope="col">Site Web</th>
                      <th scope="col">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php show_users_with_type('student');?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!--------------------------------- Gestion des modules -------------------------->
          <div class="usersList" id="dashboardTool6">
            <div id="modulesConf">
              <div class="mb-2">
                <button
                  class="manageComponentBtn btn"
                  onclick="showListsConfig('modulesList','modulesConf');"
                >
                  <i class="fa fa-angle-double-left"></i>
                  Afficher la liste des modules de la formation
                </button>
              </div>

              <!-- Ajouter un module form -->
              <div id="accordionModules">
                <div class="card">
                  <div class="addDelUserCard card-header" id="heading5">
                    <button
                      class="manageComponentBtn btn btn-link"
                      data-toggle="collapse"
                      data-target="#collapse5"
                      aria-expanded="true"
                      aria-controls="collapse5"
                    >
                      Ajouter un module
                    </button>
                  </div>

                  <div
                    id="collapse5"
                    class="addDelUserCard collapse show"
                    aria-labelledby="5"
                    data-parent="#accordionModules"
                  >
                    <div class="card-body p-3">
                      <form
                        class="addDelComponentForm"
                        action="../../configFiles/addObject.php"
                        method="post"
                        enctype="multipart/form-data"
                      >
                        <div class="form-row align-items-center">
                          <div class="col-md-4 mb-3">
                            <label for="moduleName">Nom du module</label>
                            <input
                              type="text"
                              class="form-control"
                              name="moduleName"
                              placeholder="Nom du module"
                              required
                            />
                          </div>

                          <div class="col-md-7 mb-3">
                            <label for="moduleProfId">
                              Choisir le professeur
                            </label>
                            <select
                              class="form-control custom-select"
                              name="moduleProfId"
                            >
                              <option selected>Choose...</option>
                              <?php show_user_options("teacher");?>
                            </select>
                          </div>
                        </div>

                        <div class="form-row align-items-end">
                          <div class="col-md-4 mb-3">
                            <label for="moduleSemestre"> Semestre </label>
                            <select
                              class="form-control custom-select"
                              name="moduleSemestre"
                            >
                              <option selected>Choose...</option>
                              <option value="1">Premier Semestre</option>
                              <option value="2">Deuxième Semestre</option>
                              <option value="3">Troisième Semestre</option>
                            </select>
                          </div>

                          <div class="col-md-4 mb-3">
                            <label for="moduleDescription">
                              Description du module
                            </label>
                            <div class="custom-file">
                              <input
                                type="file"
                                class="custom-file-input"
                                name="moduleDescription"
                                lang="fr"
                                onchange="detectFileName(this,'moduleDescriptionFile')"
                              />
                              <label
                                class="custom-file-label"
                                for="studentImg"
                                id="moduleDescriptionFile"
                              >
                                Sélectionner le fichier
                              </label>
                            </div>
                          </div>

                          <div class="col-md-4 mb-3">
                            <button
                              class="addDelComponentBtn btn btn-primary"
                              type="submit"
                              name="addModule"
                            >
                              Ajouter le module
                            </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="card">
                  <div class="addDelUserCard card-header" id="heading6">
                    <button
                      class="manageComponentBtn btn btn-link collapsed"
                      data-toggle="collapse"
                      data-target="#collapse6"
                      aria-expanded="false"
                      aria-controls="collapse6"
                    >
                      Supprimer un modules de la liste
                    </button>
                  </div>
                  <!-- supprimer un module form -->
                  <div
                    id="collapse6"
                    class="addDelUserCard collapse"
                    aria-labelledby="heading6"
                    data-parent="#accordionModules"
                  >
                    <div class="card-body">
                      <form
                        class="addDelComponentForm"
                        action="../../configFiles/delObject.php"
                        method="post"
                      >
                        <div class="form-row align-items-end">
                          <div class="col-md-7 mb-3">
                            <label for="modelToDel">
                              Choisir le module à supprimer
                            </label>
                            <select
                              class="form-control custom-select"
                              name="modelToDel"
                            >
                              <option selected>Choisir le module...</option>
                              <?php show_modules_options();?>
                            </select>
                          </div>

                          <div class="col-md-3 mb-3">
                            <button
                              class="addDelComponentBtn btn btn-primary"
                              type="submit"
                              name="deleteModule"
                            >
                              Supprimer le module
                            </button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Afficher la liste des modules -->
            <div id="modulesList">
              <div class="mb-2">
                <button
                  class="manageComponentBtn btn"
                  onclick="showListsConfig('modulesConf','modulesList');"
                >
                  <i class="fa fa-angle-double-left"></i>
                  Ajouter supprimer un module formation
                </button>
              </div>

              <div class="contentList">
                <div class="usersListTable m-2 rounded p-3 bg-white">
                  <!-- barre de recherche -->
                  <div class="d-flex flex-row justify-content-end rounded mb-2">
                    <input
                      type="search"
                      class="form-control rounded mr-1"
                      placeholder="Chercher"
                      aria-label="Search"
                      aria-describedby="search-addon"
                    />
                    <button
                      class="input-group-text border-0 bg-light rounded"
                      id="search-addon"
                    >
                      <i class="fa fa-search"></i>
                    </button>
                  </div>

                  <!-- table des modules -->
                  <div
                    class="table-wrapper-scroll-y users-scrollbar border rounded p-2"
                  >
                    <table class="table table-sm table-light">
                      <thead>
                        <tr>
                          <th scope="col align-middle">Nom du module</th>
                          <th scope="col align-middle">Nom du professeur</th>
                          <th scope="col align-middle">Semestre</th>
                          <th scope="col align-middle">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php show_modules_Table();?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!--------------------------------- Gestion des notes ------------------------------->
          <div class="usersList" id="dashboardTool7">
            <!-- Affichage des notes -->
            <div id="notesLists">
              <div class="mb-1">
                <button
                  class="manageComponentBtn btn"
                  onclick="showListsConfig('notesConf','notesLists');"
                >
                  <i class="fa fa-angle-double-left"></i>
                  Ajouter les notes d'un module
                </button>
              </div>

              <div class="p-2 bg-white">
                <div class="chooseNotesPer">
                  <form class="form-inline" method="POST">
                    <div
                      class="form-group mr-2"
                      id="choosemodulesToshowNoteDiv"
                    >
                      <select
                        class="form-control custom-select mr-2"
                        name="notesOf"
                      >
                        <?php show_modules_options();?>
                      </select>
                    </div>

                    <div
                      class="form-group mr-2"
                      id="chooseStudentToshowNoteDiv"
                    >
                      <select
                        class="form-control custom-select mr-2"
                        name="notesOf"
                      >
                        <?php show_user_options('student');?>
                      </select>
                    </div>

                    <div class="form-group ml-2 justify-content-center">
                      <p
                        class="inactiveNotesPerChoice d-inline ml-2 mr-1 mt-3"
                        id="choiceNotesPer1"
                      >
                        Notes par étudiant
                      </p>
                      <input
                        type="checkbox"
                        checked
                        data-toggle="toggle"
                        data-on=" "
                        data-off=" "
                        data-onstyle="outline-secondary"
                        data-offstyle="outline-secondary"
                        data-size="xs"
                        onchange="chooseNotesPer(this)"
                        data-style="ios"
                        name="NotesPerChoice"
                      />
                      <p
                        class="activeNotesPerChoice d-inline ml-1 mt-3"
                        id="choiceNotesPer2"
                      >
                        Notes par modules
                      </p>
                    </div>
                  </form>
                </div>

                <!-- Liste des Notes par étudiants -->
                <div class="notesPerStudents" id="notesPerStudents">
                  <div
                    class="table-wrapper-scroll-y users-scrollbar border rounded p-2"
                  >
                    <table class="table table-sm table-light">
                      <thead>
                        <tr>
                          <th scope="col align-middle">Nom d'étudiant</th>
                          <th scope="col align-middle">Nom de module</th>
                          <th scope="col align-middle">Semestre</th>
                          <th scope="col align-middle">Note CC1</th>
                          <th scope="col align-middle">Note CC2</th>
                          <th scope="col align-middle">Note Examen</th>
                          <th scope="col align-middle">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php show_notes_per_student()?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <!-- Liste des Notes par modules -->
                <div class="notesPerModules" id="notesPerModules">
                  <div
                    class="table-wrapper-scroll-y users-scrollbar border rounded p-2"
                  >
                    <table class="table table-sm table-light">
                      <thead>
                        <tr>
                          <th scope="col align-middle">Nom du module</th>
                          <th scope="col align-middle">Nom de l'étudiant</th>
                          <th scope="col align-middle">Note CC1</th>
                          <th scope="col align-middle">Note CC2</th>
                          <th scope="col align-middle">Note Examen</th>
                          <th scope="col align-middle">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php show_notes_per_module();?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <!-- Ajout des notes -->
            <div id="notesConf">
              <div class="mb-2">
                <button
                  class="manageComponentBtn btn"
                  onclick="showListsConfig('notesLists','notesConf');"
                >
                  <i class="fa fa-angle-double-left"></i>
                  Afficher la liste des notes
                </button>
              </div>

              <div class="p-1 bg-white rounded">
                <p class="ml-3 mb-3">Ajouter les notes d'un module</p>
                <form
                  class="addDelComponentForm mt-1 ml-2"
                  action="../../configFiles/importcsvData.php"
                  method="post"
                  enctype="multipart/form-data"
                >
                  <div
                    class="form-row align-content-center justify-content-center"
                  >
                    <div class="col-md-3 mb-1">
                      <label for="moduleNotesId"> Choisir le module </label>
                      <select
                        class="form-control custom-select"
                        name="moduleNotesId"
                      >
                        <option selected>choisir le module...</option>
                        <?php show_modules_options();?>
                      </select>
                    </div>

                    <div class="col-md-2 mb-1">
                      <label for="moduleDate">Promotion</label>
                      <input
                        type="text"
                        class="form-control"
                        name="moduleDate"
                        placeholder="Nom du module"
                        disabled
                      />
                    </div>

                    <div class="col-md-3 mb-1">
                      <label for="notesFile">
                        Le fichier des notes ".csv"
                      </label>
                      <div class="custom-file">
                        <input
                          type="file"
                          class="custom-file-input"
                          name="notesFile"
                          lang="fr"
                          onchange="detectFileName(this,'notesFileName');"
                        />
                        <label
                          class="custom-file-label"
                          for="notesFile"
                          id="notesFileName"
                        >
                          Sélectionner le fichier
                        </label>
                      </div>
                      <small class="text-muted"
                        >Le fichier doit étre de la forme: Nom de l'étudiant,
                        note CC1, note CC2, Note d'exam
                      </small>
                    </div>

                    <div class="col-md-3 mb-2 align-self-center">
                      <button
                        class="addDelComponentBtn btn btn-primary"
                        type="submit"
                        name="importNotesCsv"
                      >
                        Importer les notes
                      </button>
                    </div>
                  </div>
                </form>
                <!-- Tables des notes ajouter -->
                <div
                  class="table-wrapper-scroll-y users-scrollbar border rounded p-2"
                >
                  <table class="table table-sm table-light">
                    <thead>
                      <tr>
                        <th scope="col align-middle">Nom du module</th>
                        <th scope="col align-middle">
                          Nom d'utilisateur de l'étudiant
                        </th>
                        <th scope="col align-middle">CC1</th>
                        <th scope="col align-middle">CC2</th>
                        <th scope="col align-middle">Examen</th>
                        <th scope="col align-middle">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php show_notes_per_module();?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer p-0 m-0">
      <p>ITSN - Institut Technique des Sciences Nouvelles © 2022</p>
    </div>

    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
      integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
      integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
      crossorigin="anonymous"
    ></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script src="../../JS/home.js"></script>
  </body>
</html>
