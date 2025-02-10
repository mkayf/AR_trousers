<?php
    if(isset($_SESSION['message'])){
        echo "<p style='color: ". $_SESSION['message']["msgColor"] .";'>". $_SESSION['message']["msg"] ."</p>";
        unset($_SESSION['message']);
    }
?> 
