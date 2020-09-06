<?php
if(isset($_POST['add'])) {
    session_start();
    $patientID = $_POST['patientID'];
    $doctorID = $_SESSION['loginID'];
    $remarks = $_POST['doctornotes'];
    $AppointmentID = $_POST['appointmentID'];
    $medService = $_POST['med'];
    include_once('includes/autoLoad.php');
    $validation = new Validation();
    $msg = $validation->isEmpty($_POST, array('doctornotes' , 'med' ));
    if($msg !== null) {
        Header("Location: PrescriptionPage.php?error=emptyFields&id=".$patientID."&appointment=".$patientID);
        exit();
    }
    else{
        $function = new PrescripContr();
        $prescription = $function->savePrescription($patientID, $doctorID , $AppointmentID , $remarks);
        foreach ($medService as $details) {
            $details = $function->saveDetails($prescription , $details);
        }
        $bill = $function->createBill($prescription , $patientID);
        $appointment = new AppointContr();
        $status = $appointment->updateStatus($AppointmentID);
        header("Location: DoctorPage(Doctor).php?success");
        exit();
    }
} 
else {
    header("Location: index.php");
}
?>

