<?php
    function show_users() {
        require("connectConfig.php");
		$sql = "SELECT nom, prenom, userImage FROM utilisateurs;";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <th scope='row'>".'<img class="userImageInList rounded" src="data:image/jpeg;base64,'.
                        base64_encode($row['userImage']).'"/>'."</th>
                        <td>".$row["nom"]." ".$row["prenom"]."</td>
                      </tr>";
            }
        }
        $link->close();
	}

    function show_users_with_type($Type){
        require("connectConfig.php");
		$sql = "SELECT nom, prenom, userLogin, email, PhoneNbr, userImage, Email, WebSite, PhoneNbr FROM utilisateurs where userType='$Type';";
        $result = $link->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($Type=='student') {
                    echo  "
                    <div class='modal fade' id='deleteUserModal".$row['userLogin']."' tabindex='-1' role='dialog' aria-labelledby='deleteUserModal".$row['userLogin']."Label' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header m-0 p-3    '>
                                    <h3 class='modal-title' id='deleteUserModal".$row['userLogin']."Label'>Supprimer un utilisateur</h3>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>   
                                </div>
                                <div class='modal-body m-0'>
                                    <form action='../../configFiles/moddifyObject.php' method='post'>
                                        <input class='form-control m-2' name='userLogin' value=".$row['userLogin']." />
                                        <div class='form-row m-2'>
                                            <input type='button' class='btn btn-secondary mr-2 btn-sm' data-dismiss='modal' value='Annuler' />
                                            <input type='submit' class='btn btn-primary btn-sm' name='deleteTeacherModal' value='Supprimer l utilsateur' />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='modal fade' id='configUserModal".$row['userLogin']."' tabindex='-1' role='dialog' aria-labelledby='configUserModal".$row['userLogin']."Label' aria-hidden='true'>
                        <div class='modal-dialog modal-lg' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header m-0 p-3'>
                                    <h3 class='modal-title' id='configUserModal".$row['userLogin']."Label'>Modifier les données d'un utilisateur</h3>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>   
                                </div>

                                <div class='modal-body m-0'>
                                    <form action='../../configFiles/moddifyObject.php' method='post' enctype='multipart/form-data'>
                                        <div class='form-row align-items-end'>
                                            <div class='col-md-4 mb-2'>
                                                <label class='ml-2' for='nom'>Nom</label>
                                                <input class='form-control ml-2 mt-0' name='nom' value=".$row['nom']." />
                                            </div>
                                            <div class='col-md-4 mb-2'>
                                                <label class='ml-2' for='prenom'>Prenom</label>
                                                <input class='form-control ml-2 mt-0' name='prenom' value=".$row['prenom']." />
                                            </div>
                                            <div class='col-md-4 mb-2' style='display:none;'>
                                                <label class='ml-2' for='userLogin'>Nom d'utilisateur</label>
                                                <input class='form-control ml-2 mt-0' name='userLogin' value=".$row['userLogin'].">
                                            </div>
                                        </div>

                                        <div class='form-row align-items-end'>
                                            <div class='col-md-4 mb-1'>
                                                <label class='ml-2' for='email'>E-mail</label>
                                                <input class='form-control ml-2 mt-0' name='email' value=".$row['email']." />
                                            </div>
                                            <div class='col-md-4 mb-1'>
                                                <label class='ml-2' for='WebSite'>Site Web</label>
                                                <input class='form-control ml-2 mt-0' name='WebSite' value=".$row['WebSite']." >
                                            </div>
                                            <div class='col-md-4 mb-1'>
                                                <label class='ml-2' for='userImg'>Télécharger l'image</label>
                                                <input type='file' class='form-control ml-2 mt-0' name='userImg' />
                                            </div>
                                        </div>
                                        
                                        <div class='form-row m-2'>
                                            <input type='button' class='m-2 btn btn-secondary btn-sm' data-dismiss='modal' value='Annuler' />
                                            <input type='submit' class='m-2 btn btn-primary btn-sm' name='configStudentModal' value='Modifier les données' />    
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <tr>
                        <th class='align-middle' scope='row'>".
                        '<img class="userImageInList rounded" src="data:image/jpeg;base64,'.
                        base64_encode($row['userImage']).'"/>'."</th>
                        <td class='align-middle'>".$row["nom"]."</td>
                        <td class='align-middle'>".$row["prenom"]."</td>
                        <td class='align-middle'>".$row["userLogin"]."</td>
                        <td class='align-middle'>".$row["Email"]."</td>
                        <td class='align-middle'>".$row["WebSite"]."</td>
                        <td class='align-middle'>
                            <button
                                class='btn btn-light text-danger font-weight-bold'
                                data-toggle='modal' data-target='#deleteUserModal".$row['userLogin']."'
                            >
                                <i class='fa fa-ban'></i>
                            </button>
                            <button
                                class='btn btn-light text-warning font-weight-bold'
                                data-toggle='modal' data-target='#configUserModal".$row['userLogin']."'
                            >
                                <i class='fa fa-cog'></i>
                            </button>
                        </td>
                    </tr>";
                } else {
                    echo "<div class='modal fade' id='deleteUserModal".$row['userLogin']."' tabindex='-1' role='dialog' aria-labelledby='deleteUserModal".$row['userLogin']."Label' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header m-0 p-3    '>
                                        <h3 class='modal-title' id='deleteUserModal".$row['userLogin']."Label'>Supprimer un utilisateur</h3>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>   
                                    </div>
                                    <div class='modal-body m-0'>
                                        <form action='../../configFiles/moddifyObject.php' method='post'>
                                            <input class='form-control m-2' name='userLogin' value=".$row['userLogin']." />
                                            <div class='form-row m-2'>
                                                <input type='button' class='btn btn-secondary mr-2 btn-sm' data-dismiss='modal' value='Annuler' />
                                                <input type='submit' class='btn btn-primary btn-sm' name='deleteTeacherModal' value='Supprimer l utilsateur' />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class='modal fade' id='configUserModal".$row['userLogin']."' tabindex='-1' role='dialog' aria-labelledby='configUserModal".$row['userLogin']."Label' aria-hidden='true'>
                            <div class='modal-dialog modal-lg' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header m-0 p-3'>
                                        <h3 class='modal-title' id='configUserModal".$row['userLogin']."Label'>Modifier les données d'un utilisateur</h3>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>   
                                    </div>

                                    <div class='modal-body m-0'>
                                        <form action='../../configFiles/moddifyObject.php' method='post' enctype='multipart/form-data'>
                                            <div class='form-row align-items-end'>
                                                <div class='col-md-4 mb-2'>
                                                    <label class='ml-2' for='nom'>Nom</label>
                                                    <input class='form-control ml-2 mt-0' name='nom' value=".$row['nom']." />
                                                </div>
                                                <div class='col-md-4 mb-2'>
                                                    <label class='ml-2' for='prenom'>Prenom</label>
                                                    <input class='form-control ml-2 mt-0' name='prenom' value=".$row['prenom']." />
                                                </div>
                                                <div class='col-md-4 mb-2' style='display:none;'>
                                                    <label class='ml-2' for='userLogin'>Nom d'utilisateur</label>
                                                    <input class='form-control ml-2 mt-0' name='userLogin' value=".$row['userLogin'].">
                                                </div>
                                            </div>

                                            <div class='form-row align-items-end'>
                                                <div class='col-md-4 mb-1'>
                                                    <label class='ml-2' for='email'>E-mail</label>
                                                    <input class='form-control ml-2 mt-0' name='email' value=".$row['email']." />
                                                </div>
                                                <div class='col-md-4 mb-1'>
                                                    <label class='ml-2' for='PhoneNbr'>N Téléphone</label>
                                                    <input class='form-control ml-2 mt-0' name='PhoneNbr' value=".$row['PhoneNbr']." />
                                                </div>
                                                <div class='col-md-4 mb-1'>
                                                    <label class='ml-2' for='userImg'>Télécharger l'image</label>
                                                    <input type='file' class='form-control ml-2 mt-0' name='userImg' />
                                                </div>
                                            </div>
                                            
                                            <div class='form-row m-2'>
                                                <input type='button' class='m-2 btn btn-secondary btn-sm' data-dismiss='modal' value='Annuler' />
                                                <input type='submit' class='m-2 btn btn-primary btn-sm' name='configTeacherModal' value='Modifier les données' />    
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <tr>
                            <th class='align-middle' scope='row'>".
                            '<img class="userImageInList rounded" src="data:image/jpeg;base64,'.
                            base64_encode($row['userImage']).'"/>'."</th>
                            <td class='align-middle'>".$row["nom"]."</td>
                            <td class='align-middle'>".$row["prenom"]."</td>
                            <td class='align-middle'>".$row["userLogin"]."</td>
                            <td class='align-middle'>".$row["Email"]."</td>
                            <td class='align-middle'>".$row["PhoneNbr"]."</td>
                            <td class='align-middle'>
                                <button
                                    class='btn btn-light text-danger font-weight-bold'
                                    data-toggle='modal' data-target='#deleteUserModal".$row['userLogin']."'
                                >
                                    <i class='fa fa-ban'></i>
                                </button>
                                <button
                                    class='btn btn-light text-warning font-weight-bold'
                                    data-toggle='modal' data-target='#configUserModal".$row['userLogin']."'
                                >
                                    <i class='fa fa-cog'></i>
                                </button>
                            </td>
                        </tr>";
                }
                
            }
        }
        $link->close();
    }

    function show_users_with_type_student($Type){
        require("connectConfig.php");
		$sql = "SELECT nom, prenom, userLogin, email, PhoneNbr, userImage, Email, WebSite, PhoneNbr FROM utilisateurs where userType='$Type';";
        $result = $link->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($Type=='student') {
                    echo  "
                    <div class='modal fade' id='deleteUserModal".$row['userLogin']."' tabindex='-1' role='dialog' aria-labelledby='deleteUserModal".$row['userLogin']."Label' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header m-0 p-3    '>
                                    <h3 class='modal-title' id='deleteUserModal".$row['userLogin']."Label'>Supprimer un utilisateur</h3>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>   
                                </div>
                                <div class='modal-body m-0'>
                                    <form action='../../configFiles/moddifyObject.php' method='post'>
                                        <input class='form-control m-2' name='userLogin' value=".$row['userLogin']." />
                                        <div class='form-row m-2'>
                                            <input type='button' class='btn btn-secondary mr-2 btn-sm' data-dismiss='modal' value='Annuler' />
                                            <input type='submit' class='btn btn-primary btn-sm' name='deleteTeacherModal' value='Supprimer l utilsateur' />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='modal fade' id='configUserModal".$row['userLogin']."' tabindex='-1' role='dialog' aria-labelledby='configUserModal".$row['userLogin']."Label' aria-hidden='true'>
                        <div class='modal-dialog modal-lg' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header m-0 p-3'>
                                    <h3 class='modal-title' id='configUserModal".$row['userLogin']."Label'>Modifier les données d'un utilisateur</h3>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>   
                                </div>

                                <div class='modal-body m-0'>
                                    <form action='../../configFiles/moddifyObject.php' method='post' enctype='multipart/form-data'>
                                        <div class='form-row align-items-end'>
                                            <div class='col-md-4 mb-2'>
                                                <label class='ml-2' for='nom'>Nom</label>
                                                <input class='form-control ml-2 mt-0' name='nom' value=".$row['nom']." />
                                            </div>
                                            <div class='col-md-4 mb-2'>
                                                <label class='ml-2' for='prenom'>Prenom</label>
                                                <input class='form-control ml-2 mt-0' name='prenom' value=".$row['prenom']." />
                                            </div>
                                            <div class='col-md-4 mb-2' style='display:none;'>
                                                <label class='ml-2' for='userLogin'>Nom d'utilisateur</label>
                                                <input class='form-control ml-2 mt-0' name='userLogin' value=".$row['userLogin'].">
                                            </div>
                                        </div>

                                        <div class='form-row align-items-end'>
                                            <div class='col-md-4 mb-1'>
                                                <label class='ml-2' for='email'>E-mail</label>
                                                <input class='form-control ml-2 mt-0' name='email' value=".$row['email']." />
                                            </div>
                                            <div class='col-md-4 mb-1'>
                                                <label class='ml-2' for='WebSite'>Site Web</label>
                                                <input class='form-control ml-2 mt-0' name='WebSite' value=".$row['WebSite']." >
                                            </div>
                                            <div class='col-md-4 mb-1'>
                                                <label class='ml-2' for='userImg'>Télécharger l'image</label>
                                                <input type='file' class='form-control ml-2 mt-0' name='userImg' />
                                            </div>
                                        </div>
                                        
                                        <div class='form-row m-2'>
                                            <input type='button' class='m-2 btn btn-secondary btn-sm' data-dismiss='modal' value='Annuler' />
                                            <input type='submit' class='m-2 btn btn-primary btn-sm' name='configStudentModal' value='Modifier les données' />    
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <tr>
                        <th class='align-middle' scope='row'>".
                        '<img class="userImageInList rounded" src="data:image/jpeg;base64,'.
                        base64_encode($row['userImage']).'"/>'."</th>
                        <td class='align-middle'>".$row["nom"]."</td>
                        <td class='align-middle'>".$row["prenom"]."</td>
                        <td class='align-middle'>".$row["userLogin"]."</td>
                        <td class='align-middle'>".$row["Email"]."</td>
                        <td class='align-middle'>".$row["WebSite"]."</td>
                        <td class='align-middle'>
                    </tr>";
                } else {
                    echo "<div class='modal fade' id='deleteUserModal".$row['userLogin']."' tabindex='-1' role='dialog' aria-labelledby='deleteUserModal".$row['userLogin']."Label' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header m-0 p-3    '>
                                        <h3 class='modal-title' id='deleteUserModal".$row['userLogin']."Label'>Supprimer un utilisateur</h3>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>   
                                    </div>
                                    <div class='modal-body m-0'>
                                        <form action='../../configFiles/moddifyObject.php' method='post'>
                                            <input class='form-control m-2' name='userLogin' value=".$row['userLogin']." />
                                            <div class='form-row m-2'>
                                                <input type='button' class='btn btn-secondary mr-2 btn-sm' data-dismiss='modal' value='Annuler' />
                                                <input type='submit' class='btn btn-primary btn-sm' name='deleteTeacherModal' value='Supprimer l utilsateur' />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class='modal fade' id='configUserModal".$row['userLogin']."' tabindex='-1' role='dialog' aria-labelledby='configUserModal".$row['userLogin']."Label' aria-hidden='true'>
                            <div class='modal-dialog modal-lg' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header m-0 p-3'>
                                        <h3 class='modal-title' id='configUserModal".$row['userLogin']."Label'>Modifier les données d'un utilisateur</h3>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>   
                                    </div>

                                    <div class='modal-body m-0'>
                                        <form action='../../configFiles/moddifyObject.php' method='post' enctype='multipart/form-data'>
                                            <div class='form-row align-items-end'>
                                                <div class='col-md-4 mb-2'>
                                                    <label class='ml-2' for='nom'>Nom</label>
                                                    <input class='form-control ml-2 mt-0' name='nom' value=".$row['nom']." />
                                                </div>
                                                <div class='col-md-4 mb-2'>
                                                    <label class='ml-2' for='prenom'>Prenom</label>
                                                    <input class='form-control ml-2 mt-0' name='prenom' value=".$row['prenom']." />
                                                </div>
                                                <div class='col-md-4 mb-2' style='display:none;'>
                                                    <label class='ml-2' for='userLogin'>Nom d'utilisateur</label>
                                                    <input class='form-control ml-2 mt-0' name='userLogin' value=".$row['userLogin'].">
                                                </div>
                                            </div>

                                            <div class='form-row align-items-end'>
                                                <div class='col-md-4 mb-1'>
                                                    <label class='ml-2' for='email'>E-mail</label>
                                                    <input class='form-control ml-2 mt-0' name='email' value=".$row['email']." />
                                                </div>
                                                <div class='col-md-4 mb-1'>
                                                    <label class='ml-2' for='PhoneNbr'>N Téléphone</label>
                                                    <input class='form-control ml-2 mt-0' name='PhoneNbr' value=".$row['PhoneNbr']." />
                                                </div>
                                                <div class='col-md-4 mb-1'>
                                                    <label class='ml-2' for='userImg'>Télécharger l'image</label>
                                                    <input type='file' class='form-control ml-2 mt-0' name='userImg' />
                                                </div>
                                            </div>
                                            
                                            <div class='form-row m-2'>
                                                <input type='button' class='m-2 btn btn-secondary btn-sm' data-dismiss='modal' value='Annuler' />
                                                <input type='submit' class='m-2 btn btn-primary btn-sm' name='configTeacherModal' value='Modifier les données' />    
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <tr>
                            <th class='align-middle' scope='row'>".
                            '<img class="userImageInList rounded" src="data:image/jpeg;base64,'.
                            base64_encode($row['userImage']).'"/>'."</th>
                            <td class='align-middle'>".$row["nom"]."</td>
                            <td class='align-middle'>".$row["prenom"]."</td>
                            <td class='align-middle'>".$row["userLogin"]."</td>
                            <td class='align-middle'>".$row["Email"]."</td>
                            <td class='align-middle'>".$row["WebSite"]."</td>
                        </tr>";
                }
                
            }
        }
        $link->close();
    }



    function show_users_with_type_prof($Type){
        require("connectConfig.php");
		$sql = "SELECT nom, prenom, userLogin, email, PhoneNbr, userImage, Email, WebSite, PhoneNbr FROM utilisateurs where userType='$Type';";
        $result = $link->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($Type=='student') {
                    echo  "
                    <div class='modal fade' id='deleteUserModal".$row['userLogin']."' tabindex='-1' role='dialog' aria-labelledby='deleteUserModal".$row['userLogin']."Label' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header m-0 p-3    '>
                                    <h3 class='modal-title' id='deleteUserModal".$row['userLogin']."Label'>Supprimer un utilisateur</h3>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>   
                                </div>
                                <div class='modal-body m-0'>
                                    <form action='../../configFiles/moddifyObject.php' method='post'>
                                        <input class='form-control m-2' name='userLogin' value=".$row['userLogin']." />
                                        <div class='form-row m-2'>
                                            <input type='button' class='btn btn-secondary mr-2 btn-sm' data-dismiss='modal' value='Annuler' />
                                            <input type='submit' class='btn btn-primary btn-sm' name='deleteTeacherModal' value='Supprimer l utilsateur' />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='modal fade' id='configUserModal".$row['userLogin']."' tabindex='-1' role='dialog' aria-labelledby='configUserModal".$row['userLogin']."Label' aria-hidden='true'>
                        <div class='modal-dialog modal-lg' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header m-0 p-3'>
                                    <h3 class='modal-title' id='configUserModal".$row['userLogin']."Label'>Modifier les données d'un utilisateur</h3>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>   
                                </div>

                                <div class='modal-body m-0'>
                                    <form action='../../configFiles/moddifyObject.php' method='post' enctype='multipart/form-data'>
                                        <div class='form-row align-items-end'>
                                            <div class='col-md-4 mb-2'>
                                                <label class='ml-2' for='nom'>Nom</label>
                                                <input class='form-control ml-2 mt-0' name='nom' value=".$row['nom']." />
                                            </div>
                                            <div class='col-md-4 mb-2'>
                                                <label class='ml-2' for='prenom'>Prenom</label>
                                                <input class='form-control ml-2 mt-0' name='prenom' value=".$row['prenom']." />
                                            </div>
                                            <div class='col-md-4 mb-2' style='display:none;'>
                                                <label class='ml-2' for='userLogin'>Nom d'utilisateur</label>
                                                <input class='form-control ml-2 mt-0' name='userLogin' value=".$row['userLogin'].">
                                            </div>
                                        </div>

                                        <div class='form-row align-items-end'>
                                            <div class='col-md-4 mb-1'>
                                                <label class='ml-2' for='email'>E-mail</label>
                                                <input class='form-control ml-2 mt-0' name='email' value=".$row['email']." />
                                            </div>
                                            <div class='col-md-4 mb-1'>
                                                <label class='ml-2' for='WebSite'>Site Web</label>
                                                <input class='form-control ml-2 mt-0' name='WebSite' value=".$row['WebSite']." >
                                            </div>
                                            <div class='col-md-4 mb-1'>
                                                <label class='ml-2' for='userImg'>Télécharger l'image</label>
                                                <input type='file' class='form-control ml-2 mt-0' name='userImg' />
                                            </div>
                                        </div>
                                        
                                        <div class='form-row m-2'>
                                            <input type='button' class='m-2 btn btn-secondary btn-sm' data-dismiss='modal' value='Annuler' />
                                            <input type='submit' class='m-2 btn btn-primary btn-sm' name='configStudentModal' value='Modifier les données' />    
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <tr>
                        <th class='align-middle' scope='row'>".
                        '<img class="userImageInList rounded" src="data:image/jpeg;base64,'.
                        base64_encode($row['userImage']).'"/>'."</th>
                        <td class='align-middle'>".$row["nom"]."</td>
                        <td class='align-middle'>".$row["prenom"]."</td>
                        <td class='align-middle'>".$row["userLogin"]."</td>
                        <td class='align-middle'>".$row["Email"]."</td>
                        <td class='align-middle'>".$row["WebSite"]."</td>
                        <td class='align-middle'>
                    </tr>";
                } else {
                    echo "<div class='modal fade' id='deleteUserModal".$row['userLogin']."' tabindex='-1' role='dialog' aria-labelledby='deleteUserModal".$row['userLogin']."Label' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header m-0 p-3    '>
                                        <h3 class='modal-title' id='deleteUserModal".$row['userLogin']."Label'>Supprimer un utilisateur</h3>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>   
                                    </div>
                                    <div class='modal-body m-0'>
                                        <form action='../../configFiles/moddifyObject.php' method='post'>
                                            <input class='form-control m-2' name='userLogin' value=".$row['userLogin']." />
                                            <div class='form-row m-2'>
                                                <input type='button' class='btn btn-secondary mr-2 btn-sm' data-dismiss='modal' value='Annuler' />
                                                <input type='submit' class='btn btn-primary btn-sm' name='deleteTeacherModal' value='Supprimer l utilsateur' />
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class='modal fade' id='configUserModal".$row['userLogin']."' tabindex='-1' role='dialog' aria-labelledby='configUserModal".$row['userLogin']."Label' aria-hidden='true'>
                            <div class='modal-dialog modal-lg' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header m-0 p-3'>
                                        <h3 class='modal-title' id='configUserModal".$row['userLogin']."Label'>Modifier les données d'un utilisateur</h3>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>   
                                    </div>

                                    <div class='modal-body m-0'>
                                        <form action='../../configFiles/moddifyObject.php' method='post' enctype='multipart/form-data'>
                                            <div class='form-row align-items-end'>
                                                <div class='col-md-4 mb-2'>
                                                    <label class='ml-2' for='nom'>Nom</label>
                                                    <input class='form-control ml-2 mt-0' name='nom' value=".$row['nom']." />
                                                </div>
                                                <div class='col-md-4 mb-2'>
                                                    <label class='ml-2' for='prenom'>Prenom</label>
                                                    <input class='form-control ml-2 mt-0' name='prenom' value=".$row['prenom']." />
                                                </div>
                                                <div class='col-md-4 mb-2' style='display:none;'>
                                                    <label class='ml-2' for='userLogin'>Nom d'utilisateur</label>
                                                    <input class='form-control ml-2 mt-0' name='userLogin' value=".$row['userLogin'].">
                                                </div>
                                            </div>

                                            <div class='form-row align-items-end'>
                                                <div class='col-md-4 mb-1'>
                                                    <label class='ml-2' for='email'>E-mail</label>
                                                    <input class='form-control ml-2 mt-0' name='email' value=".$row['email']." />
                                                </div>
                                                <div class='col-md-4 mb-1'>
                                                    <label class='ml-2' for='PhoneNbr'>N Téléphone</label>
                                                    <input class='form-control ml-2 mt-0' name='PhoneNbr' value=".$row['PhoneNbr']." />
                                                </div>
                                                <div class='col-md-4 mb-1'>
                                                    <label class='ml-2' for='userImg'>Télécharger l'image</label>
                                                    <input type='file' class='form-control ml-2 mt-0' name='userImg' />
                                                </div>
                                            </div>
                                            
                                            <div class='form-row m-2'>
                                                <input type='button' class='m-2 btn btn-secondary btn-sm' data-dismiss='modal' value='Annuler' />
                                                <input type='submit' class='m-2 btn btn-primary btn-sm' name='configTeacherModal' value='Modifier les données' />    
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <tr>
                            <th class='align-middle' scope='row'>".
                            '<img class="userImageInList rounded" src="data:image/jpeg;base64,'.
                            base64_encode($row['userImage']).'"/>'."</th>
                            <td class='align-middle'>".$row["nom"]."</td>
                            <td class='align-middle'>".$row["prenom"]."</td>
                            <td class='align-middle'>".$row["userLogin"]."</td>
                            <td class='align-middle'>".$row["Email"]."</td>
                            <td class='align-middle'>".$row["WebSite"]."</td>
                        </tr>";
                }
                
            }
        }
        $link->close();
    }

























    function show_user_options($Type){
        require("connectConfig.php");
		$sql = "SELECT userId, nom, prenom FROM utilisateurs where userType='$Type';";
        $result = $link->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo  "<option value=".$row["userId"]."> ".$row["nom"]." ".$row["prenom"]."</option>";
            }
        }
        $link->close();
    }

    function show_modules_options(){
        require("connectConfig.php");
		$sql = "SELECT moduleId, nomModule FROM modules";
        $result = $link->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo  "<option value=".$row["moduleId"]."> ".$row["nomModule"]."</option>";
            }
        }
        $link->close();
    }

    function show_modules_Table(){
        require("connectConfig.php");
		$sql = "SELECT moduleId,nomModule, nom, prenom, semestre, moduleDescription, teacherId FROM modules,utilisateurs WHERE modules.teacherId=utilisateurs.userId;";
        $result = $link->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row["semestre"]==1) $semestre="Semestre 1";
                elseif($row["semestre"]==2) $semestre="Semestre 2";
                else $semestre="Semestre 3";

                echo  "
                    <div class='modal fade' id='deletemoduleModal".$row['moduleId']."' tabindex='-1' role='dialog' aria-labelledby='deletemoduleModal".$row['moduleId']."Label' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header m-0 p-3    '>
                                    <h3 class='modal-title' id='deletemoduleModal".$row['moduleId']."Label'>Supprimer</h3>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>   
                                </div>
                                <div class='modal-body m-0'>
                                    <form action='../../configFiles/moddifyObject.php' method='post'>
                                        <input class='form-control m-2' name='moduleId' value=".$row['moduleId']." />
                                        <div class='form-row m-2'>
                                            <input type='button' class='btn btn-secondary mr-2 btn-sm' data-dismiss='modal' value='Annuler' />
                                            <input type='submit' class='btn btn-primary btn-sm' name='deleteModuleModal' value='Supprimer le module' />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class='modal fade' id='modifymoduleModal".$row['moduleId']."' tabindex='-1' role='dialog' aria-labelledby='modifymoduleModal".$row['moduleId']."Label' aria-hidden='true'>
                        <div class='modal-dialog modal-lg' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header m-0 p-3'>
                                    <h3 class='modal-title' id='modifymoduleModal".$row['moduleId']."Label'>Modifier les données d'un utilisateur</h3>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>   
                                </div>

                                <div class='modal-body m-0'>
                                    <form action='../../configFiles/moddifyObject.php' method='post' enctype='multipart/form-data'>
                                        <div class='form-row align-items-end'>
                                            <div class='col-md-4 mb-2'>
                                                <label class='ml-2' for='moduleName'>Nom du module</label>
                                                <input class='form-control ml-2 mt-0' name='moduleName' value=".$row['nomModule']." />
                                            </div>
                                            <div class='col-md-4 mb-2'>
                                                <input class='form-control ml-2 mt-0' name='teacherIdfirst' value=".$row['teacherId']." style='display:none;'/>
                                                <input class='form-control ml-2 mt-0' name='moduleId' value=".$row['moduleId']." style='display:none;'/>
                                                <label class='ml-2' for='teacherIdsecond'>Prenom du professeur</label>
                                                <select class='form-control custom-select' name='teacherIdsecond'>
                                                    <option selected value='0'>Choisir</option>";
                echo show_user_options('teacher');
                echo "
                                                </select>
                                            </div>
                                        </div>

                                        <div class='form-row align-items-end'>
                                            <div class='col-md-4 mb-1'>
                                                <label class='ml-2' for='semestre'>Semestre</label>
                                                <input class='form-control ml-2 mt-0' name='semestre' value=".$row['semestre']." />
                                            </div>
                                        </div>
                                        
                                        <div class='form-row m-2'>
                                            <input type='button' class='m-2 btn btn-secondary btn-sm' data-dismiss='modal' value='Annuler' />
                                            <input type='submit' class='m-2 btn btn-primary btn-sm' name='configModuleModal' value='Modifier les données' />    
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <tr>
                        <th class='align-middle' scope='row'>".$row["nomModule"]."</th>
                        <td class='align-middle'>".$row["nom"]." ".$row["prenom"]."</td>
                        <td class='align-middle'>".$semestre."</td>
                        <td class='align-middle'>
                            <button
                                class='btn btn-light text-danger font-weight-bold'
                                data-toggle='modal' data-target='#deletemoduleModal".$row['moduleId']."'
                            >
                                <i class='fa fa-ban'></i>
                            </button>
                            <button
                                class='btn btn-light text-warning font-weight-bold'
                                data-toggle='modal' data-target='#modifymoduleModal".$row['moduleId']."'
                            >
                                <i class='fa fa-cog'></i>
                            </button>
                        </td>
                    </tr>";
            }
        }
        $link->close();
    }





    function show_modules_Table_student(){
        require("connectConfig.php");
		$sql = "SELECT moduleId,nomModule, nom, prenom, semestre, moduleDescription, teacherId FROM modules,utilisateurs WHERE modules.teacherId=utilisateurs.userId;";
        $result = $link->query($sql);
        
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row["semestre"]==1) $semestre="Semestre 1";
                elseif($row["semestre"]==2) $semestre="Semestre 2";
                else $semestre="Semestre 3";

                echo  "
                    <div class='modal fade' id='deletemoduleModal".$row['moduleId']."' tabindex='-1' role='dialog' aria-labelledby='deletemoduleModal".$row['moduleId']."Label' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header m-0 p-3    '>
                                    <h3 class='modal-title' id='deletemoduleModal".$row['moduleId']."Label'>Supprimer</h3>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>   
                                </div>
                                <div class='modal-body m-0'>
                                    <form action='../../configFiles/moddifyObject.php' method='post'>
                                        <input class='form-control m-2' name='moduleId' value=".$row['moduleId']." />
                                        <div class='form-row m-2'>
                                            <input type='button' class='btn btn-secondary mr-2 btn-sm' data-dismiss='modal' value='Annuler' />
                                            <input type='submit' class='btn btn-primary btn-sm' name='deleteModuleModal' value='Supprimer le module' />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class='modal fade' id='modifymoduleModal".$row['moduleId']."' tabindex='-1' role='dialog' aria-labelledby='modifymoduleModal".$row['moduleId']."Label' aria-hidden='true'>
                        <div class='modal-dialog modal-lg' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header m-0 p-3'>
                                    <h3 class='modal-title' id='modifymoduleModal".$row['moduleId']."Label'>Modifier les données d'un utilisateur</h3>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>   
                                </div>

                                <div class='modal-body m-0'>
                                    <form action='../../configFiles/moddifyObject.php' method='post' enctype='multipart/form-data'>
                                        <div class='form-row align-items-end'>
                                            <div class='col-md-4 mb-2'>
                                                <label class='ml-2' for='moduleName'>Nom du module</label>
                                                <input class='form-control ml-2 mt-0' name='moduleName' value=".$row['nomModule']." />
                                            </div>
                                            <div class='col-md-4 mb-2'>
                                                <input class='form-control ml-2 mt-0' name='teacherIdfirst' value=".$row['teacherId']." style='display:none;'/>
                                                <input class='form-control ml-2 mt-0' name='moduleId' value=".$row['moduleId']." style='display:none;'/>
                                                <label class='ml-2' for='teacherIdsecond'>Prenom du professeur</label>
                                                <select class='form-control custom-select' name='teacherIdsecond'>
                                                    <option selected value='0'>Choisir</option>";
                echo show_user_options('teacher');
                echo "
                                                </select>
                                            </div>
                                        </div>

                                        <div class='form-row align-items-end'>
                                            <div class='col-md-4 mb-1'>
                                                <label class='ml-2' for='semestre'>Semestre</label>
                                                <input class='form-control ml-2 mt-0' name='semestre' value=".$row['semestre']." />
                                            </div>
                                        </div>
                                        
                                        <div class='form-row m-2'>
                                            <input type='button' class='m-2 btn btn-secondary btn-sm' data-dismiss='modal' value='Annuler' />
                                            <input type='submit' class='m-2 btn btn-primary btn-sm' name='configModuleModal' value='Modifier les données' />    
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <tr>
                        <th class='align-middle' scope='row'>".$row["nomModule"]."</th>
                        <td class='align-middle'>".$row["nom"]." ".$row["prenom"]."</td>
                        <td class='align-middle'>".$semestre."</td>
                    </tr>";
            }
        }
        $link->close();
    }


    function show_notes_per_module(){
        require("connectConfig.php");
        $sql = "SELECT noteId,nom,prenom,CC1,CC2,exam, nomModule FROM utilisateurs, notes, modules 
        WHERE studentId=userId and notes.moduleId=modules.moduleId ORDER BY nomModule;";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo  "
                    <div class='modal fade' id='deletenotes".$row['noteId']."' tabindex='-1' role='dialog' aria-labelledby='deletenotes".$row['noteId']."Label' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header m-0 p-3    '>
                                    <h3 class='modal-title' id='deletenotes".$row['noteId']."Label'>Supprimer la note d'un étudiant</h3>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>   
                                </div>
                                <div class='modal-body m-0'>
                                    <form action='../../configFiles/moddifyObject.php' method='post'>
                                        <p>Vous voulez vraiment supprimer la note du : <br/>".$row["nom"]." ".$row["prenom"]."</p>
                                        <input name='noteId' value='".$row['noteId']."' style='display:none;'/>
                                        <div class='form-row m-2'>
                                            <input type='button' class='btn btn-secondary mr-2 btn-sm' data-dismiss='modal' value='Annuler' />
                                            <input type='submit' class='btn btn-primary btn-sm' name='deleteStudentNotes' value='Supprimer la note' />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class='modal fade' id='configNotes".$row['noteId']."' tabindex='-1' role='dialog' aria-labelledby='configNotes".$row['noteId']."Label' aria-hidden='true'>
                            <div class='modal-dialog modal-lg' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header m-0 p-3'>
                                        <h3 class='modal-title' id='configNotes".$row['noteId']."Label'>Modifier les notes</h3>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>   
                                    </div>

                                    <div class='modal-body m-0'>
                                        <form action='../../configFiles/moddifyObject.php' method='post' enctype='multipart/form-data'>
                                            <div class='form-row align-items-end'>
                                                <input name='noteId' value='".$row['noteId']."' style='display:none;'/>
                                                <div class='col-md-4 mb-2'>
                                                    <label class='ml-2' for='CC1'>CC1</label>
                                                    <input class='form-control ml-2 mt-0' name='CC1' value=".$row['CC1']." />
                                                </div>
                                                <div class='col-md-4 mb-2'>
                                                    <label class='ml-2' for='CC2'>CC2</label>
                                                    <input class='form-control ml-2 mt-0' name='CC2' value=".$row['CC2']." />
                                                </div>
                                                <div class='col-md-4 mb-2'>
                                                    <label class='ml-2' for='exam'>Examen final</label>
                                                    <input class='form-control ml-2 mt-0' name='exam' value=".$row['exam'].">
                                                </div>
                                            </div>
                                            
                                            <div class='form-row m-2'>
                                                <input type='button' class='m-2 btn btn-secondary btn-sm' data-dismiss='modal' value='Annuler' />
                                                <input type='submit' class='m-2 btn btn-primary btn-sm' name='configStudentsNotes' value='Modifier les données' />    
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <tr>
                        <td class='align-middle'>".$row["nomModule"]."</td>
                        <th class='align-middle'>".$row["nom"]." ".$row["prenom"]."</th>
                        <td class='align-middle'>".$row["CC1"]."</td>
                        <td class='align-middle'>".$row["CC2"]."</td>
                        <td class='align-middle'>".$row["exam"]."</td>
                        <td class='align-middle'>   
                            <button
                                class='btn btn-light text-danger font-weight-bold'
                                data-toggle='modal' data-target='#deletenotes".$row['noteId']."'
                            >
                                <i class='fa fa-ban'></i>
                            </button>
                            <button
                                class='btn btn-light text-warning font-weight-bold'
                                data-toggle='modal' data-target='#configNotes".$row['noteId']."'
                            >
                                <i class='fa fa-cog'></i>
                            </button>
                        </td>
                    </tr>";
            }
        }
        $link->close();
    }


    function show_notes_per_module_teacher(){
        require("connectConfig.php");
        $sql = "SELECT noteId,nom,prenom,CC1,CC2,exam, nomModule FROM utilisateurs, notes, modules 
        WHERE studentId=userId and notes.moduleId=modules.moduleId ORDER BY nomModule;";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo  "
                    <div class='modal fade' id='deletenotes".$row['noteId']."' tabindex='-1' role='dialog' aria-labelledby='deletenotes".$row['noteId']."Label' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header m-0 p-3    '>
                                    <h3 class='modal-title' id='deletenotes".$row['noteId']."Label'>Supprimer la note d'un étudiant</h3>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>   
                                </div>
                                <div class='modal-body m-0'>
                                    <form action='../../configFiles/moddifyObject.php' method='post'>
                                        <p>Vous voulez vraiment supprimer la note du : <br/>".$row["nom"]." ".$row["prenom"]."</p>
                                        <input name='noteId' value='".$row['noteId']."' style='display:none;'/>
                                        <div class='form-row m-2'>
                                            <input type='button' class='btn btn-secondary mr-2 btn-sm' data-dismiss='modal' value='Annuler' />
                                            <input type='submit' class='btn btn-primary btn-sm' name='deleteStudentNotes' value='Supprimer la note' />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class='modal fade' id='configNotes".$row['noteId']."' tabindex='-1' role='dialog' aria-labelledby='configNotes".$row['noteId']."Label' aria-hidden='true'>
                            <div class='modal-dialog modal-lg' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header m-0 p-3'>
                                        <h3 class='modal-title' id='configNotes".$row['noteId']."Label'>Modifier les notes</h3>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>   
                                    </div>

                                    <div class='modal-body m-0'>
                                        <form action='../../configFiles/moddifyObject.php' method='post' enctype='multipart/form-data'>
                                            <div class='form-row align-items-end'>
                                                <input name='noteId' value='".$row['noteId']."' style='display:none;'/>
                                                <div class='col-md-4 mb-2'>
                                                    <label class='ml-2' for='CC1'>CC1</label>
                                                    <input class='form-control ml-2 mt-0' name='CC1' value=".$row['CC1']." />
                                                </div>
                                                <div class='col-md-4 mb-2'>
                                                    <label class='ml-2' for='CC2'>CC2</label>
                                                    <input class='form-control ml-2 mt-0' name='CC2' value=".$row['CC2']." />
                                                </div>
                                                <div class='col-md-4 mb-2'>
                                                    <label class='ml-2' for='exam'>Examen final</label>
                                                    <input class='form-control ml-2 mt-0' name='exam' value=".$row['exam'].">
                                                </div>
                                            </div>
                                            
                                            <div class='form-row m-2'>
                                                <input type='button' class='m-2 btn btn-secondary btn-sm' data-dismiss='modal' value='Annuler' />
                                                <input type='submit' class='m-2 btn btn-primary btn-sm' name='configStudentsNotes' value='Modifier les données' />    
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <tr>
                        <td class='align-middle'>".$row["nomModule"]."</td>
                        <th class='align-middle'>".$row["nom"]." ".$row["prenom"]."</th>
                        <td class='align-middle'>".$row["CC1"]."</td>
                        <td class='align-middle'>".$row["CC2"]."</td>
                        <td class='align-middle'>".$row["exam"]."</td>
                        <td class='align-middle'>   
                            <button
                                class='btn btn-light text-danger font-weight-bold'
                                data-toggle='modal' data-target='#deletenotes".$row['noteId']."'
                            >
                                <i class='fa fa-ban'></i>
                            </button>
                            <button
                                class='btn btn-light text-warning font-weight-bold'
                                data-toggle='modal' data-target='#configNotes".$row['noteId']."'
                            >
                                <i class='fa fa-cog'></i>
                            </button>
                        </td>
                    </tr>";
            }
        }
        $link->close();
    }











    function show_notes_per_student(){
        require("connectConfig.php");       
        $sql = "SELECT noteId,userId,nomModule, semestre, CC1, CC2, exam, nom, prenom FROM modules, notes, utilisateurs
        WHERE notes.studentId=utilisateurs.userId and modules.moduleId=notes.moduleId ORDER BY userId;";

        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                if ($row["semestre"]==1) $semestre="Semestre 1";
                elseif($row["semestre"]==2) $semestre="Semestre 2";
                else $semestre="Semestre 3";

                echo  "
                    <div class='modal fade' id='deletenotesperstudent".$row['noteId']."' tabindex='-1' role='dialog' aria-labelledby='deletenotesperstudent".$row['noteId']."Label' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <div class='modal-header m-0 p-3    '>
                                    <h3 class='modal-title' id='deletenotesperstudent".$row['noteId']."Label'>Supprimer la note d'un étudiant</h3>
                                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                        <span aria-hidden='true'>&times;</span>
                                    </button>   
                                </div>
                                <div class='modal-body m-0'>
                                    <form action='../../configFiles/moddifyObject.php' method='post'>
                                        <p>Vous voulez vraiment supprimer la note du : <br/>".$row["nom"]." ".$row["prenom"]."</p>
                                        <input name='noteId' value='".$row['noteId']."' style='display:none;'/>
                                        <div class='form-row m-2'>
                                            <input type='button' class='btn btn-secondary mr-2 btn-sm' data-dismiss='modal' value='Annuler' />
                                            <input type='submit' class='btn btn-primary btn-sm' name='deleteStudentNotes' value='Supprimer la note' />
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class='modal fade' id='configNotesperstudent".$row['noteId']."' tabindex='-1' role='dialog' aria-labelledby='configNotesperstudent".$row['noteId']."Label' aria-hidden='true'>
                            <div class='modal-dialog modal-lg' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header m-0 p-3'>
                                        <h3 class='modal-title' id='configNotesperstudent".$row['noteId']."Label'>Modifier les notes</h3>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>   
                                    </div>

                                    <div class='modal-body m-0'>
                                        <form action='../../configFiles/moddifyObject.php' method='post' enctype='multipart/form-data'>
                                            <div class='form-row align-items-end'>
                                                <input name='noteId' value='".$row['noteId']."' style='display:none;'/>
                                                <div class='col-md-4 mb-2'>
                                                    <label class='ml-2' for='CC1'>CC1</label>
                                                    <input class='form-control ml-2 mt-0' name='CC1' value=".$row['CC1']." />
                                                </div>
                                                <div class='col-md-4 mb-2'>
                                                    <label class='ml-2' for='CC2'>CC2</label>
                                                    <input class='form-control ml-2 mt-0' name='CC2' value=".$row['CC2']." />
                                                </div>
                                                <div class='col-md-4 mb-2'>
                                                    <label class='ml-2' for='exam'>Examen final</label>
                                                    <input class='form-control ml-2 mt-0' name='exam' value=".$row['exam'].">
                                                </div>
                                            </div>
                                            
                                            <div class='form-row m-2'>
                                                <input type='button' class='m-2 btn btn-secondary btn-sm' data-dismiss='modal' value='Annuler' />
                                                <input type='submit' class='m-2 btn btn-primary btn-sm' name='configStudentsNotes' value='Modifier les données' />    
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                    </div>

                    <tr>
                        <td class='align-middle'>".$row["nom"]." ".$row["prenom"]."</td>
                        <th class='align-middle'>".$row["nomModule"]."</th>
                        <td class='align-middle'>".$semestre."</td>
                        <td class='align-middle'>".$row["CC1"]."</td>
                        <td class='align-middle'>".$row["CC2"]."</td>
                        <td class='align-middle'>".$row["exam"]."</td>
                        <td class='align-middle'>
                            <button
                                class='btn btn-light text-danger font-weight-bold'
                                data-toggle='modal' data-target='#deletenotesperstudent".$row['noteId']."'
                            >
                                <i class='fa fa-ban'></i>
                            </button>
                            <button
                                class='btn btn-light text-warning font-weight-bold'
                                data-toggle='modal' data-target='#configNotesperstudent".$row['noteId']."'
                            >
                                <i class='fa fa-cog'></i>
                            </button>
                        </td>
                    </tr>";
            }
        }
        $link->close();
    }

    function show_modules_notes_student_home($studentId){
        require("connectConfig.php");
        $sql = "SELECT nomModule, CC1, CC2, exam FROM modules, notes
            WHERE notes.studentId='$studentId' and modules.moduleId=notes.moduleId;";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {

                echo  "<div class='p-2 m-2 moduleBox border shadowBoxStyle rounded bg-white' style='width: 30%;'>
                        <h4><b>".$row["nomModule"]."</b></h4>
                        <div class='d-flex justify-content-center align-items-center'>
                            <i class='fa fa-book mr-2'></i>
                            <div class='modulesNotes ml-2'>
                                <p class=' mt-1 mb-1'>CC1: <span>".$row["CC1"]."</span></p>
                                <p class='mt-1 mb-1'>CC2: <span>".$row["CC2"]."</span></p>
                                <p class='mt-1 mb-1'>Note finale: <b>".$row["exam"]."</b></p>
                            </div>
                        </div>
                    </div>";
            }
        }
        $link->close();
    }

    function show_modules_notes_for_rapport_student_home($studentId,$semestre){
        require("connectConfig.php");
        $sql = "SELECT nomModule, CC1, CC2, exam FROM modules, notes
            WHERE notes.studentId='$studentId' and modules.moduleId=notes.moduleId and modules.semestre='$semestre';";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $CC1=$row["CC1"];
                $CC2=$row["CC2"];
                $exam=$row["exam"];

                $noteFM=$CC1*25/100+$CC2*25/100+$exam*50/100;
                echo  "<tr>
                        <th class='p-1'>".$row["nomModule"]."</th>
                        <td class='p-1'>".$CC1."</td>
                        <td class='p-1'>".$CC2."</td>
                        <td class='p-1'>".$exam."</td>
                        <td class='p-1'>".$noteFM."</td>
                    </tr>";
            }
        }
        $link->close();
    }

    function calcul_note($studentId,$semestre){
        require("connectConfig.php");
        $sql = "SELECT nomModule, CC1, CC2, exam FROM modules, notes
            WHERE notes.studentId='$studentId' and modules.moduleId=notes.moduleId and modules.semestre='$semestre';";
        $result = $link->query($sql);
        $notes=array();
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $CC1=$row["CC1"];
                $CC2=$row["CC2"];
                $exam=$row["exam"];
                $noteFM=$CC1*25/100+$CC2*25/100+$exam*50/100;
                array_push($notes,$noteFM);
            }
        }
        $notefinal=0;
        for($i = 0; $i < count($notes); $i++) {
            $notefinal+=$notes[$i];
        }
        if (count($notes)==0) echo 0;
        else echo $notefinal/count($notes);
        
        $link->close();
    }

?>