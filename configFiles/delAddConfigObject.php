<?php
    function del_user($LoginUser,$Type) {
        require("connectConfig.php");
        session_start();
        //vérifier si le role est un admin
        if ($_SESSION['userType']=="Adminstrateur") {
            $userType='';
            //Vérifier si l'utilisateur n'est pas un admin
            $sql = "SELECT userType FROM utilisateurs WHERE userLogin='$LoginUser'";
            $result = $link->query($sql);
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $userType=$row["userType"];
                }
            }
            $link->close();
            
            if ($userType!="admin") {
                require("connectConfig.php");
                $sql = "DELETE FROM utilisateurs WHERE userLogin='$LoginUser'";
                if (mysqli_query($link, $sql)) {
                    $msg_result="Le compte d'utilisateur à été bien supprimé";
                    $_SESSION['status']=$msg_result;
                    header('location: ../pages/LoggedIn/adminHome.php');
                } else {
                    $msg_result="Erreur de suppression du compte" . mysqli_error($link);
                    $_SESSION['status']=$msg_result;
                    header('location: ../pages/LoggedIn/adminHome.php');
                }
                mysqli_close($link);
            } else {
                $msg_result="Choisisser un autre type d'utilisateur";
                $_SESSION['status']=$msg_result;
                header('location: ../pages/LoggedIn/adminHome.php');
            }
        } else {
            $msg_result="Vous avez pas le droit de modifier ou supprimer un utilisateur, contacter votre admin";
            $_SESSION['status']=$msg_result;
            header('location: ../pages/requestLogin.php');
        }
        
	}
    
    function add_user($teacherName,$teacherLastName, $teacherEmail, $teacherLogin,$teacherPassword,$userType,$userImg,$PhoneNbr,$WebSite){
        require("connectConfig.php");
        session_start();
        if (is_uploaded_file($userImg['tmp_name'])) {
            $imgData = addslashes(file_get_contents($userImg['tmp_name']));
            
            $sql = "INSERT INTO utilisateurs (nom,prenom,userLogin,userPassword,email,userType,userImage,PhoneNbr,WebSite) VALUES
            ('$teacherName', '$teacherLastName','$teacherLogin','$teacherPassword','$teacherEmail','$userType','{$imgData}','$PhoneNbr','$WebSite');";
            if(mysqli_query($link, $sql)){
                $msg_result="le compte de l'utilisateur à été bien ajouté.";
                $_SESSION['status']=$msg_result;
                header('location: ../pages/LoggedIn/adminHome.php');
            } else{
                $msg_result="ERREUR: le compte n'a pas été ajouté" . mysqli_error($link);
                $_SESSION['status']=$msg_result;
                header('location: ../pages/LoggedIn/adminHome.php');
            }   
        }
        mysqli_close($link);
    }

    function addModules($moduleProfId,$moduleName,$moduleSemestre,$moduleDescription){
        require("connectConfig.php");
        session_start();
        if (is_uploaded_file($moduleDescription['tmp_name'])) {
            $FileData = addslashes(file_get_contents($moduleDescription['tmp_name']));
            $sql = "INSERT INTO modules (teacherId, nomModule, semestre, moduleDescription) VALUES 
            ('$moduleProfId', '$moduleName', '$moduleSemestre', '{$FileData}')";
            if(mysqli_query($link, $sql)){
                $msg_result="Le module à été bien ajouté.";
                $_SESSION['status']=$msg_result;
                header('location: ../pages/LoggedIn/adminHome.php');
            } else{
                $msg_result="ERREUR: le module n'a pas été ajouté, Vérifier les données du module" . mysqli_error($link);
                $_SESSION['status']=$msg_result;
                header('location: ../pages/LoggedIn/adminHome.php');
            }
        } else{
            $msg_result="ERREUR: le module n'a pas été ajouté" . mysqli_error($link);
            $_SESSION['status']=$msg_result;
            header('location: ../pages/LoggedIn/adminHome.php');
        }
        mysqli_close($link);   
    }

    function delModules($modelToDel){
        require("connectConfig.php");
        session_start();
        $sql = "DELETE FROM modules WHERE moduleId='$modelToDel'";
        if (mysqli_query($link, $sql)) {
            $msg_result="Le module à été bien supprimé";
            $_SESSION['status']=$msg_result;
            header('location: ../pages/LoggedIn/adminHome.php');
        } else {
            $msg_result="Erreur de suppression du module" . mysqli_error($link);
            $_SESSION['status']=$msg_result;
            header('location: ../pages/LoggedIn/adminHome.php');
        }
        mysqli_close($link);
    }

    function addNotes($moduleId,$studentId,$CC1,$CC2,$exam){
        require("connectConfig.php");
        session_start();
        $query= "INSERT INTO notes (CC1, CC2, exam, moduleId, studentId) 
        VALUES (".$CC1.", ".$CC2.", ".$exam.", ".$moduleId.", ".$studentId.");";
        if($link->query($query)){
            $msg_result="Les notes du module N ".$moduleId." ont été bien ajouté.";
            $_SESSION['status']=$msg_result;
            header('location: ../pages/LoggedIn/teacherHome.php');
        } else{
            $msg_result="Erreur d'ajout des données" . mysqli_error($link);
            $_SESSION['status']=$msg_result;
            header('location: ../pages/LoggedIn/teacherHome.php');
        }
        
        mysqli_close($link); 
    }

    function update_user($userId,$userImg,$nom,$prenom,$email,$userLogin,$phoneNbr,$webSite){
        require("connectConfig.php");
        if($userImg==NULL){
            $sql = "UPDATE utilisateurs SET nom= '$nom', prenom='$prenom', userLogin='$userLogin', PhoneNbr='$phoneNbr', WebSite='$webSite', email = '$email' WHERE userId = '$userId'; ";
            if(mysqli_query($link, $sql)){
                $_SESSION["userLogin"] = $userLogin;
                $_SESSION["nom"]=$nom;
                $_SESSION["prenom"]= $prenom;
                $_SESSION["email"]= $email;
                $_SESSION["WebSite"]= $webSite;
                $_SESSION["PhoneNbr"]= $phoneNbr;
                $msg_result="le compte de l'utilisateur à été bien mis à jour.";
                $_SESSION['status']=$msg_result;
                header("location: ../pages/requestLogin.php");
            } else {
                $msg_result="ERREUR: le compte n'a pas été mis à jour" . mysqli_error($link);
                $_SESSION['status']=$msg_result;
                header("location: ../pages/requestLogin.php");
            }
        } else if (is_uploaded_file($userImg['tmp_name'])) {
            $imgData = addslashes(file_get_contents($userImg['tmp_name']));
            $sql = "UPDATE utilisateurs SET nom= '$nom', prenom='$prenom',  userLogin='$userLogin', PhoneNbr='$phoneNbr', WebSite='$webSite', email = '$email', userImage='{$imgData}' WHERE userId = '$userId'; ";
            if(mysqli_query($link, $sql)){
                $_SESSION["userLogin"] = $userLogin;
                $_SESSION["nom"]=$nom;
                $_SESSION["prenom"]= $prenom;
                $_SESSION["email"]= $email;
                $_SESSION["WebSite"]= $webSite;
                $_SESSION["PhoneNbr"]= $phoneNbr;
                $msg_result="le compte de l'utilisateur à été bien mis à jour.";
                $_SESSION['status']=$msg_result;
                header("location: ../pages/requestLogin.php");
            }
            $getNewImg="SELECT userImage FROM utilisateurs WHERE userLogin = '$userLogin'";
            $_SESSION["userImage"]=$link->query($getNewImg)->fetch_assoc()['userImage']; //Ajouter la nouvelle image à la session
        } else {
            $msg_result="ERREUR: le compte n'a pas été mis à jour" . mysqli_error($link);
            $_SESSION['status']=$msg_result;
            header("location: ../pages/requestLogin.php");
        }
        mysqli_close($link);
    }

    function update_user_as_admin($userImg,$nom,$prenom,$email,$userLogin,$phoneNbr,$webSite){
        require("connectConfig.php");
        if($userImg==NULL){
            $sql = "UPDATE utilisateurs SET nom= '$nom', prenom='$prenom', PhoneNbr='$phoneNbr', 
            WebSite='$webSite', email = '$email' WHERE userLogin='$userLogin';";
            if(mysqli_query($link, $sql)){
                $msg_result="le compte de l'utilisateur à été bien mis à jour.";
                $_SESSION['status']=$msg_result;
                header("location: ../pages/requestLogin.php");
            } else {
                $msg_result="ERREUR: le compte n'a pas été mis à jour" . mysqli_error($link);
                $_SESSION['status']=$msg_result;
                header("location: ../pages/requestLogin.php");
            }
        } else if (is_uploaded_file($userImg['tmp_name'])) {
            $imgData = addslashes(file_get_contents($userImg['tmp_name']));
            $sql = "UPDATE utilisateurs SET nom= '$nom', prenom='$prenom', PhoneNbr='$phoneNbr', 
            WebSite='$webSite', email = '$email', userImage='{$imgData}' WHERE userLogin='$userLogin';";
            if(mysqli_query($link, $sql)){
                $msg_result="le compte de l'utilisateur à été bien mis à jour.";
                $_SESSION['status']=$msg_result;
                header("location: ../pages/requestLogin.php");
            } else {
                $msg_result="ERREUR: le compte n'a pas été mis à jour" . mysqli_error($link);
                $_SESSION['status']=$msg_result;
                header("location: ../pages/requestLogin.php");
            }
        } else {
            $msg_result="ERREUR: le compte n'a pas été mis à jour" . mysqli_error($link);
            $_SESSION['status']=$msg_result;
            header("location: ../pages/requestLogin.php");
        }
        mysqli_close($link);
    }

    function update_module_as_admin($moduleId,$name,$teacherId,$semestre){
        require("connectConfig.php");
        $sql="UPDATE modules SET semestre = '$semestre', teacherId='$teacherId', nomModule='$name' WHERE moduleId = '$moduleId'; ";
        if($link->query($sql)){
            $msg_result="le module à été bien mis à jour.";
            $_SESSION['status']=$msg_result;
            header("location: ../pages/requestLogin.php");
        } else {
            $msg_result="ERREUR: le module n'a pas été mis à jour" . mysqli_error($link);
            $_SESSION['status']=$msg_result;
            header("location: ../pages/requestLogin.php");
        }
    }

    function delNotes($noteId){
        require("connectConfig.php");
        session_start();
        $sql = "DELETE FROM notes WHERE noteId='$noteId'";
        if (mysqli_query($link, $sql)) {
            $msg_result="La note à été bien supprimé";
            $_SESSION['status']=$msg_result;
            header('location: ../pages/LoggedIn/adminHome.php');
        } else {
            $msg_result="Erreur de suppression de la note" . mysqli_error($link);
            $_SESSION['status']=$msg_result;
            header('location: ../pages/LoggedIn/adminHome.php');
        }
        mysqli_close($link);
    }


    function delNotes_asteacher($noteId){
        require("connectConfig.php");
        session_start();
        $sql = "DELETE FROM notes WHERE noteId='$noteId'";
        if (mysqli_query($link, $sql)) {
            $msg_result="La note à été bien supprimé";
            $_SESSION['status']=$msg_result;
            header('location: ../pages/LoggedIn/teacherHome.php');
        } else {
            $msg_result="Erreur de suppression de la note" . mysqli_error($link);
            $_SESSION['status']=$msg_result;
            header('location: ../pages/LoggedIn/teacherHome.php');
        }
        mysqli_close($link);
    }

    function update_notes_as_admin($noteId,$CC1,$CC2,$exam){
        require("connectConfig.php");
        $sql="UPDATE notes SET CC1 = '$CC1', CC2='$CC2', exam='$exam' WHERE noteId = '$noteId'; ";
        if($link->query($sql)){
            $msg_result="la note à été bien mis à jour.";
            $_SESSION['status']=$msg_result;
            header("location: ../pages/requestLogin.php");
        } else {
            $msg_result="ERREUR: la note n'a pas été mis à jour" . mysqli_error($link);
            $_SESSION['status']=$msg_result;
            header("location: ../pages/requestLogin.php");
        }
    }
?>