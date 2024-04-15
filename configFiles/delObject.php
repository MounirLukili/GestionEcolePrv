<?php
    require("delAddConfigObject.php");
    if(isset($_POST['deleteTeacher'])){
        $teacherLogin = $_POST['teacherLogin'];
        del_user($teacherLogin,'teacher');
    }

    if(isset($_POST['deleteStudent'])){
        $studentLogin = $_POST['studentLogin'];
        del_user($studentLogin,'student');
    }
    
    if(isset($_POST['deleteModule'])){
        $moduleId = $_POST['modelToDel'];
        delModules($moduleId);
    }
?>