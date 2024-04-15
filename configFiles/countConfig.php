<?php
    function count_users($Type) {
        require("connectConfig.php");
		$sql = "SELECT count(userId)as nbr FROM utilisateurs WHERE userType ='$Type'";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["nbr"];
            }
        }
        $link->close();
	}
    
    function count_modules(){
        require("connectConfig.php");
		$sql = "SELECT count(moduleId) as nbr FROM modules;";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["nbr"];
            }
        }
        $link->close();
    }

    function count_notes(){
        require("connectConfig.php");
		$sql = "SELECT count(noteId) as nbr FROM notes;";
        $result = $link->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo $row["nbr"];
            }
        }
        $link->close();
    }
?>