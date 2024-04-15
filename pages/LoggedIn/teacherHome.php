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
    <title>ITSN - Professeur</title>
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
              <i class="fa fa-users"></i> <span>Affichage des données</span>
            </a>
          </p>

          <div
            class="collapse p-1 mb-2"
            id="gestionUtilisateur"
            data-parent="#navigationCollapse"
          >
            <div class="navigation_sec card card-body mb-0 pb-2">
              <p
                class="mb-1 btn_navigation_sec btn btn-light btn-block"
                role="button"
                id="daschboardNav2"
                onclick="manageDashboardNav(2);"
              >
                Liste des étudiants
              </p>
              <p
                class="mb-1 btn_navigation_sec btn btn-light btn-block"
                role="button"
                id="daschboardNav3"
                onclick="manageDashboardNav(3);"
              >
                Liste des modules
              </p>
              
              <p id="daschboardNav4" disabled> </p>
              <p id="daschboardNav5" disabled> </p>
            </div>
          </div>

          <p>
            <a
              class="mb-1 btn_navigation btn btn-primary btn-block"
              data-toggle="collapse"
              href="#gestionModule"
              role="button"
              aria-expanded="false"
              id="daschboardNavType2"
            >
              <i class="fa fa-book"></i> <span>Gestion de notes</span>
            </a>
          </p>

          <div
            class="collapse mb-2"
            id="gestionModule"
            data-parent="#navigationCollapse"
          >
            <div class="navigation_sec card card-body">
              <p
                class="mb-1 btn_navigation_sec btn btn-light btn-block"
                role="button"
                id="daschboardNav6"
                onclick="manageDashboardNav(6);"
              >
                Ajouter les notes
              </p>
              <hr />
              <p
                class="mb-1 btn_navigation_sec btn btn-light btn-block"
                role="button"
                id="daschboardNav7"
                onclick="manageDashboardNav(7);"
              >
                Importer et Exporter les notes
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
                      <p class="m-1">
                        N° Téléphone:
                        <span
                          ><?php echo htmlspecialchars($_SESSION["PhoneNbr"]); ?></span
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
                                <i class="fa fa-graduation-cap m-3"></i>
                                <p class="align-self-end mr-3">
                                  <?php count_users("student");?>
                                </p>
                              </div>
                              <div class="content-details fadeIn-bottom">
                                <h3
                                  class="content-title"
                                  onclick="manageDashboardNav(2);"
                                >
                                  Liste des étudiants
                                </h3>
                              </div>
                            </div>
                            <div class="col content m-1">
                              <div
                                class="content-image carouselDashboardTool bg-info d-flex flex-column justify-content-between"
                                onclick="manageDashboardNav(3);"
                              >
                                <i class="fa fa-book m-3"></i>
                                <p class="align-self-end mr-4">
                                  <?php count_modules(); ?>
                                </p>
                              </div>
                              <div class="content-details fadeIn-bottom">
                                <h3
                                  class="content-title"
                                  onclick="manageDashboardNav(3);"
                                >
                                  Liste des modules
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
                                class="content-image carouselDashboardTool bg-success d-flex flex-column justify-content-between"
                                onclick="manageDashboardNav(6);"
                              >
                                <i class="fa fa fa-list-alt m-3"></i>
                                <p class="align-self-end mr-3">
                                  <?php count_notes(); ?>
                                </p>
                              </div>
                              <div class="content-details fadeIn-bottom">
                                <h3
                                  class="content-title"
                                  onclick="manageDashboardNav(6);"
                                >
                                  Saisie des notes
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

          <!--------------------------- Affichage des étudiants -------------------------->
          <div class="usersList" id="dashboardTool2">
            <div class="m-2">
              <button
                class="manageComponentBtn btn"
                onclick="manageDashboardNav(3);"
              >
                <i class="fa fa-angle-double-left"></i>
                Afficher la liste des modules
              </button>
            </div>

            <div class="usersListTable m-2 rounded p-3 bg-white">
              <h3><b>Liste des étudiant</b></h3>
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
                    </tr>
                  </thead>
                  <tbody>
                    <?php show_users_with_type_prof('student');?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <!--------------------------- Affichage des modules -------------------------->
          <div class="usersList" id="dashboardTool3">
            <div class="m-2">
              <button
                class="manageComponentBtn btn"
                onclick="manageDashboardNav(2);"
              >
                <i class="fa fa-angle-double-left"></i>
                Afficher la liste des étudiants
              </button>
            </div>

            <div class="usersListTable m-2 rounded p-3 bg-white">
              <h3><b>Liste des modules</b></h3>
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
                    </tr>
                  </thead>
                  <tbody>
                    <?php show_modules_Table_student();?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

          <div class="manageUsers" id="dashboardTool4"></div>
          <div class="usersList" id="dashboardTool5"></div>

          <!--------------------------------- Ajouter les notes -------------------------->
          <div class="usersList" id="dashboardTool6">
            <div class="m-2">
              <button
                class="manageComponentBtn btn"
                onclick="manageDashboardNav(7);"
              >
                <i class="fa fa-angle-double-left"></i>
                Importer Exporter les notes sous forme .csv
              </button>
            </div>
            <!-- Ajouter des notes -->
            <div class="m-2 p-3 bg-white rounded border">
              <h3><b>Insérer les notes d'un étudiant</b></h3>
              <form
                class="addDelComponentForm shadowBoxStyle p-3 mb-0 pb-0 card"
                action="../../configFiles/addObject.php"
                method="post"
              >
                <div class="form-row align-items-end">
                  <div class="col-md-3 mb-2 mr-2">
                    <label for="moduleId">Nom du module</label>
                    <select class="form-control p-1 custom-select" name="moduleId">
                      <option selected>Choisir le module</option>
                      <?php show_modules_options();?>
                    </select>
                  </div>

                  <div class="col-md-3 mb-2 mr-2">
                    <label for="studentId">Nom de l'étudiant</label>
                    <select class="form-control p-1 custom-select" name="studentId">
                      <option selected>Choisir l'étudiant</option>
                      <?php show_user_options("student");?>
                    </select>
                  </div>

                  <div class="col-md-5 mb-2 mr-2">
                    <button
                      class="addDelComponentBtn btn btn-primary"
                      type="submit"
                      name="addNotes"
                    >
                      Ajouter les notes
                    </button>
                  </div>
                </div>
                
                <div class="form-row">
                  <div class="col-md-3 mb-2 mr-2">
                    <label for="CC1">1er Contrôle Continu</label>
                    <input
                      type="text"
                      class="p-1 form-control"
                      name="CC1"
                      placeholder="CC1"
                      required
                    />
                  </div>
                </div>
                
                <div class="form-row">
                  <div class="col-md-3 mb-2 mr-2">
                    <label for="CC2">2éme Contrôle Continu</label>
                    <input
                      type="text"
                      class="p-1 form-control"
                      name="CC2"
                      placeholder="CC2"
                      required
                    />
                  </div>
                </div>
                
                <div class="form-row">
                  <div class="col-md-3 mb-2 mr-2">
                    <label for="exam">Examen Final</label>
                    <input
                      type="text"
                      class="p-1 form-control"
                      name="exam"
                      placeholder="Examen final"
                      required
                    />
                  </div>
                </div>
                
              </form>
            </div>
            
          </div>

          <!--------------------------------- Importer Exporter ------------------------------->
          <div class="usersList" id="dashboardTool7">
            <div class="m-2">
              <button
                class="manageComponentBtn btn"
                onclick="manageDashboardNav(6);"
              >
                <i class="fa fa-angle-double-left"></i>
                Importer Exporter les notes individuelement
              </button>
            </div>

            <div class="importExportExport m-2 card p-1">
              <div class="container">
                <div class="row">
                  <div class="col-7 importerlesnotes bg-white rounded m-1">
                    <p class="importExportTitle m-2 mb-1">
                      Ajouter les notes d'un modules
                    </p>
                    <form
                      class="addDelComponentForm mt-1 ml-2"
                      action="../../configFiles/importcsvData.php"
                      method="post"
                      enctype="multipart/form-data"
                    >
                      <div class="form-row align-content-center">
                        <div class="col-md-5 mb-1 mt-1">
                          <label for="moduleNotesId">Choisir le module </label>
                          <select
                            class="form-control custom-select"
                            name="moduleNotesId"
                          >
                            <option selected>Choisir le module</option>
                            <?php show_modules_options();?>
                          </select>
                        </div>

                        <div class="col-md-6 mb-1 mt-1">
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
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="col-md-3 mb-1">
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
                  </div>

                  <div class="col exporterlesnotes bg-white rounded m-1">
                    <p class="importExportTitle m-2 mb-1">
                      Exporter les notes d'un module
                    </p>

                    <form
                      class="addDelComponentForm mt-1 ml-2"
                      action="../../configFiles/exportCsvData.php"
                      method="post"
                      enctype="multipart/form-data"
                    >
                      <div class="form-row align-content-center">
                        <div class="col-md-8 mb-1">
                          <label for="moduleNotesId"> Choisir le module </label>
                          <select
                            class="form-control custom-select"
                            name="moduleNotesId"
                          >
                            <?php show_modules_options();?>
                          </select>
                        </div>
                      </div>

                      <div class="form-row">
                        <div class="col-md-4 mb-1">
                          <button
                            class="addDelComponentBtn btn btn-primary"
                            type="submit"
                            name="ExportNotesCsv"
                          >
                            Exporter les notes
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              
              <div
                class="table-wrapper-scroll-y users-scrollbar border rounded p-1 bg-white m-1"
                style="height: 200px"
              >
                <table class="table table-sm table-light">
                  <thead>
                    <tr>
                      <th scope="col align-middle">
                        Module
                      </th>
                      <th scope="col align-middle">Nom d'utilisateur de l'étudiant</th>
                      <th scope="col align-middle">CC1</th>
                      <th scope="col align-middle">CC2</th>
                      <th scope="col align-middle">Examen</th>
                      <th scope="col align-middle">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php show_notes_per_module_teacher('%');?>
                  </tbody>
                </table>
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
