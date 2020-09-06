<?php

    if(isset($_POST['val']) && isset($_POST['doctor'])) {
        if(!empty($_POST['doctor']) && !empty($_POST['val'])) {
            include_once("includes/autoLoad.php");
            $doctor = $_POST['doctor'];
            $date = $_POST['val'];
            $slot = new ViewAppoint();
            $timeslot = $slot->showAvailableSlot($date , $doctor);
            echo "<select name='timeslot'' class='form-control''>";
            echo "<option>Choose a Time Slot</option>";
            foreach($timeslot as $alltime){ 
                echo "<option value='". $alltime ."'>" . $alltime . "</option>";
            } 
        } else {
            echo "<option>Choose a Time Slot</option>";
        }
    }    
?>
