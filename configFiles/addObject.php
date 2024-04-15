<?php
    require("delAddConfigObject.php");
    if(isset($_POST['addTeacher'])){
        $teacherName = $_POST['teacherName'];
        $teacherLastName= $_POST['teacherLastName'];
        $teacherEmail = $_POST['teacherEmail'];
        $teacherLogin = $_POST['teacherLogin'];
        $teacherPassword = $_POST['teacherPassword'];
        $userType='teacher';
        $phoneNbr=$_POST['teacherPhoneNbr'];
        $userImg=$_FILES['teacherImg'];
        $result=add_user($teacherName,$teacherLastName, $teacherEmail, $teacherLogin,$teacherPassword,$userType,$userImg,$phoneNbr," ");
    }

    if(isset($_POST['addStudent'])){
        $StudentName = $_POST['studentName'];
        $StudentLastName= $_POST['studentLastName'];
        $StudentEmail = $_POST['studentEmail'];
        $StudentLogin = $_POST['studentLogin'];
        $StudentPassword = $_POST['studentPassword'];
        $userType='student';
        $webSite=$_POST['studentWebSite'];
        $userImg=$_FILES['studentImg'];
        add_user($StudentName,$StudentLastName, $StudentEmail, $StudentLogin,$StudentPassword,$userType,$userImg," ",$webSite);
    }

    if (isset($_POST['addModule'])) {
        $moduleName=$_POST['moduleName'];
        $moduleProfId=$_POST['moduleProfId'];
        $moduleSemestre=$_POST['moduleSemestre'];
        $moduleDescription=$_FILES['moduleDescription'];
        addModules($moduleProfId,$moduleName,$moduleSemestre,$moduleDescription);
    }

    if (isset($_POST['addNotes'])) {
        $moduleId=$_POST['moduleId'];
        $studentId=$_POST['studentId'];
        $CC1=$_POST['CC1'];
        $CC2=$_POST['CC2'];
        $exam=$_POST['exam'];
        addNotes($moduleId,$studentId,$CC1,$CC2,$exam);
    }
?>