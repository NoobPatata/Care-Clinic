<?php

if (isset($_POST['save'])) {

    include_once("includes/autoLoad.php");
    $AppointmentID = $_POST["AppointmentID"];
    $time = $_POST['timeslot'];
    $date = $_POST['date'];

    $validation = new Validation();
    $msg = $validation->isEmpty($_POST, array('timeslot' , 'date'));
    $checkDate = $validation->isValidDate($_POST['date']);

    if($msg !== null) {
        Header("Location: EditAppointmentPage.php?error=EmptyFiels&id=".$AppointmentID);
        exit();
    }
    elseif((!$checkDate)) {
        Header("Location: EditAppointmentPage.php?error=wrongDateFormat&id=".$AppointmentID);
        exit();
    }

    else {
        $funtion = new AppointContr();
        $update = $funtion->updateAppointment($time , $date , $AppointmentID);
    
        if(!$update) {
            header("Location: EditAppointmentPage.php?error=updatefailed");
        } else {
            header("location: MyAppointmentPage.php?success=updatedone");
        }
    }
} 

else {
    header("Location: index.php");
}
?>