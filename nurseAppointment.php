<?php       
    if(isset($_POST['makeappointment'])) {      

        include_once('includes/autoLoad.php');

        $create = new AppointContr();
        $Date = $_POST['date'];
        $Time_Slot = $_POST['timeslot'];
        $Doctor_Name = $_POST['prefereddoctor'];
        $Medical_Concern = $_POST['medicalconcern'];
        $firstName = $_POST['patientfirstname'];
        $lastName = $_POST['patientlastname'];

        $validation = new Validation();
        $msg = $validation->isEmpty($_POST, array('timeslot' , 'prefereddoctor' , 'medicalconcern' , 'patientfirstname' , 'patientlastname'));
        $checkDate = $validation->isValidDate($_POST['date']);
        

        if($msg !== null) {
            Header("Location: MakeAppointmentPage(Nurse).php?error=EmptyFiels");
            exit();
        }
        elseif((!$checkDate)) {
            header("location: MakeAppointmentPage(Nurse).php?error=wrongDateFormat");
            exit();
        } 
        else {
            $result = $create->makeAppointmentNurse($firstName , $lastName , $Date , $Time_Slot , $Doctor_Name , $Medical_Concern);     
            header("location: MakeAppointmentPage(Nurse).php?success");
            exit();
        }

    }       

    else {
        header("location: index.php");
    }
?>