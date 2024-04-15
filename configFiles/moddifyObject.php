<?php
    require("delAddConfigObject.php");
    session_start();

    if(isset($_POST['changeProfil'])){
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['email'];
        $userLogin = $_POST['userLogin'];
        $userId=$_POST['userId'];
        if($_SESSION["userType"]=="Etudiant")  $webSite=$_POST['WebSite'];
        else $webSite=" ";
        if($_SESSION['userType']=="Professeur") $phoneNbr=$_POST['PhoneNbr'];
        else $phoneNbr=" ";

        if($_FILES['profilImg']['size'] == 0){
            update_user($userId,NULL,$nom,$prenom,$email,$userLogin,$phoneNbr,$webSite);  
        } else{
            $userImg=$_FILES['profilImg'];
            update_user($userId,$userImg,$nom,$prenom,$email,$userLogin,$phoneNbr,$webSite);  
        }
    }
    
    if (isset($_POST['deleteTeacherModal'])) {
        if ($_SESSION['userType']=='Adminstrateur') {
            $teacherLogin=$_POST['userLogin'];
            del_user($teacherLogin,'teacher');
        }
        else {
            $_SESSION['status']="Vous avez pas le droit de modifier les données d'un utilisateur. 
            Contactez votre adminstrateur";
            header('location: ../pages/requestLogin.php');
        }
        
    }

    if (isset($_POST['configTeacherModal'])) {
        if ($_SESSION['userType']=='Adminstrateur') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $userLogin = $_POST['userLogin'];
            $phoneNbr=$_POST['PhoneNbr'];

            if($_FILES['userImg']['size'] == 0){
                update_user_as_admin(NULL,$nom,$prenom,$email,$userLogin,$phoneNbr,'');  
            } else {
                $userImg=$_FILES['userImg'];
                update_user_as_admin($userImg,$nom,$prenom,$email,$userLogin,$phoneNbr,'');  
            }
        } else {
            $_SESSION['status']="Vous avez pas le droit de modifier les données d'un utilisateur. 
            Contactez votre adminstrateur";
            header('location: ../pages/requestLogin.php');
        }
    }

    if (isset($_POST['configStudentModal'])) {
        if ($_SESSION['userType']=='Adminstrateur') {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $userLogin = $_POST['userLogin'];
            $webSite=$_POST['WebSite'];

            if($_FILES['userImg']['size'] == 0){
                update_user_as_admin(NULL,$nom,$prenom,$email,$userLogin,'',$webSite);  
            } else {
                $userImg=$_FILES['userImg'];
                update_user_as_admin($userImg,$nom,$prenom,$email,$userLogin,'',$webSite);  
            }
        } else {
            $_SESSION['status']="Vous avez pas le droit de modifier les données d'un utilisateur. 
            Contactez votre adminstrateur";
            header('location: ../pages/requestLogin.php');
        } 
    }

    if (isset($_POST['deleteModuleModal'])){
        $modelToDel=$_POST['moduleId'];
        delModules($modelToDel);
    }

    if (isset($_POST['configModuleModal'])){
        $moduleId=$_POST['moduleId'];
        $name=$_POST['moduleName'];
        if($_POST['teacherIdsecond']==0) $teacherId=$_POST['teacherIdfirst'];
        else $teacherId=$_POST['teacherIdsecond'];
        $semestre=$_POST['semestre'];

        update_module_as_admin($moduleId,$name,$teacherId,$semestre);
    }

    if (isset($_POST['deleteStudentNotes'])) {
        $noteId=$_POST['noteId'];
        delNotes($noteId);
    }

    if (isset($_POST['deleteStudentNotes'])) {
        $noteId=$_POST['noteId'];
        delNotes_asteacher($noteId);
    }

    if (isset($_POST['configStudentsNotes'])) {
        $noteId=$_POST['noteId'];
        $CC1=$_POST['CC1'];
        $CC2=$_POST['CC2'];
        $exam=$_POST['exam'];
        update_notes_as_admin($noteId,$CC1,$CC2,$exam);
    }
?>