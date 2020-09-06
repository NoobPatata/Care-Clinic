<?php       
    if(isset($_POST['makeappointment'])) {      
        include_once('includes/autoLoad.php');
        session_start();
        $create = new AppointContr();
        $Date = $_POST['date'];
        $Time_Slot = $_POST['timeslot'];
        $Doctor_Name = $_POST['prefereddoctor'];
        $Medical_Concern = $_POST['medicalconcern'];
        $LoginID =  $_SESSION['loginID'];

        $validation = new Validation();
        $msg = $validation->isEmpty($_POST, array('timeslot' , 'prefereddoctor' , 'medicalconcern' ));
        $cehckDate = $validation->isValidDate($_POST['date']);

        if($msg !== null) {
            Header("Location: MakeAppointmentPage.php?error=EmptyFiels");
            exit();
        }
        elseif((!$cehckDate)) {
            header("location: MakeAppointmentPage.php?error=wrongDateFormat");
            exit();
        }
        else {
            $result = $create->makeAppointment($LoginID, $Date , $Time_Slot , $Doctor_Name , $Medical_Concern);     
            header("location: MakeAppointmentPage.php?success");
            exit();
        }
    }      
    else {
        header("location: index.php");
    }
?>
