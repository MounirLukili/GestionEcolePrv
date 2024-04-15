<?php
    session_start();
    include_once "connectConfig.php";
    if(isset($_POST["ExportNotesCsv"])){
        header('Content-Type: text/csv; charset=utf-8'); //Encodage
        header('Content-Disposition: attachment; filename=notes_module_n_'.$_POST['moduleNotesId'].'.csv');  
        $output = fopen("php://output", "w");  
        fputcsv($output, array("Nom de l'étudiant", "CC1", "CC2", "Exam"));  
        $query = "SELECT userLogin, CC1, CC2, exam from utilisateurs, notes WHERE userId=studentId AND moduleId=".$_POST["moduleNotesId"]."";  
        $result = mysqli_query($link, $query);  
        while($row = mysqli_fetch_assoc($result)){  
            fputcsv($output, $row);  
        }
        fclose($output);
    } 
    $link->close(); 
?>