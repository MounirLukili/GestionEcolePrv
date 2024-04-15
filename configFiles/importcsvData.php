<?php
    // Load the database configuration file
    session_start();
    include_once 'connectConfig.php';
    if(isset($_POST['importNotesCsv'])){
        $moduleId=$_POST['moduleNotesId'];
        $csvfiles = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');
        if(!empty($_FILES['notesFile']['name']) && in_array($_FILES['notesFile']['type'], $csvfiles)){// Validate whether selected file is a CSV file            
            if(is_uploaded_file($_FILES['notesFile']['tmp_name'])){// If the file is uploaded
                $csvFile = fopen($_FILES['notesFile']['tmp_name'], 'r');
                fgetcsv($csvFile);
                while(($line = fgetcsv($csvFile)) !== FALSE){
                    $studentLogin = $line[0];
                    $CC1  = $line[1];
                    $CC2  = $line[2];
                    $Exame = $line[3];
                    $prevQuery = "SELECT noteId FROM notes,utilisateurs WHERE studentId=userId AND moduleId='".$moduleId."'AND userLogin='".$studentLogin."'"; //vérifier si l'entrée existe déja
                    $prevResult = $link->query($prevQuery);
                    if($prevResult->num_rows > 0){
                        $update_query="UPDATE notes SET CC1= ".$CC1.",CC2=".$CC2.",exam=".$Exame." WHERE notes.studentId IN(SELECT userId from utilisateurs WHERE utilisateurs.userLogin='".$studentLogin."');";
                        $link->query($update_query);
                    } else{
                        $getstudentidquery="SELECT userId FROM utilisateurs WHERE userLogin='".$studentLogin."'";
                        $result=$link->query($getstudentidquery);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()){
                                $studentId=$row['userId'];
                            }
                        } else{
                            fclose($csvFile);// Close opened CSV file
                            $msg_result= "Un des étudiant ajouté n'existe pas";
                            $_SESSION['status']=$msg_result;
                            if($_SESSION["userType"]=='Adminstrateur')  header("location: ../pages/LoggedIn/adminHome.php");
                            else if($_SESSION["userType"]=='Professeur')  header("location: LoggedIn/teacherHome.php");    
                            else header("location: LoggedIn/studentHome.php");
                        }
                        $insertquery="INSERT INTO notes (CC1, CC2, exam, moduleId, studentId) VALUES (".$CC1.", ".$CC2.", ".$Exame.", ".$moduleId.", ".$studentId.");";
                        $link->query($insertquery);
                    }
                }
                fclose($csvFile);// Close opened CSV file
                $msg_result= "le fichier à été bien importer";
                $_SESSION['status']=$msg_result;
                if($_SESSION["userType"]=='Adminstrateur')  header("location: ../pages/LoggedIn/adminHome.php");
                else if($_SESSION["userType"]=='Professeur')  header("location: ../pages/LoggedIn/teacherHome.php");    
                else header("location: ../pages/LoggedIn/studentHome.php");
            } else {
                $msg_result= "Erreur d'importation";
                $_SESSION['status']=$msg_result;
                if($_SESSION["userType"]=='Adminstrateur')  header("location: ../pages/LoggedIn/adminHome.php");
                else if($_SESSION["userType"]=='Professeur')  header("location: ../pages/LoggedIn/teacherHome.php");    
                else header("location: ../pages/LoggedIn/studentHome.php");
            }
        } else {
            $msg_result=  "Fichier d'importation est invalide";
            $_SESSION['status']=$msg_result;
            if($_SESSION["userType"]=='Adminstrateur')  header("location: ../pages/LoggedIn/adminHome.php");
            else if($_SESSION["userType"]=='Professeur')  header("location: ../pages/LoggedIn/teacherHome.php");    
            else header("location: ../pages/LoggedIn/studentHome.php");
        }
    }
?>