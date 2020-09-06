<?php 
    if(isset($_POST['appointmentid'])) {
        include_once('includes/autoLoad.php');
        $delete = new AppointContr();
        $id = $_POST['appointmentid'];
        $result = $delete->deleteAppointment($id);
        if ($result) {
            header("Location: MyAppointmentPage.php?success=deletedone");
        }   
        else {
            echo "delete fail";
        }
    } 
    else {
        header("Location: index.php");
    }

?>