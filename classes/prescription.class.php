<?php 


class Prescription extends Dbh {

    protected function insertPrescription($patientID , $doctorID , $appointmentID ,$remarks) {            
        $sql = "INSERT INTO `prescription`(`PatientID`, `DoctorID`, `AppointmentID` ,`Remarks`) VALUES (?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param("iiis" , $patientID , $doctorID , $appointmentID , $remarks);
        $stmt->execute();
        $result = $stmt->insert_id;
        return $result; 
    }

    protected function insertDetails($prescriptionID , $name) {
        $sql = "INSERT INTO `prescription_details`(`PrescriptionID`, `MS_ID`, `Price`) VALUES (? , (SELECT MS_ID FROM medicineandservices WHERE name = ?) , (SELECT Price FROM medicineandservices WHERE name = ?))";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('iss' , $prescriptionID , $name , $name);
        $stmt->execute();
    }

    protected function insertBilling($prescriptionID , $patientID) {
        $sql = "INSERT INTO billing(PrescriptionID , PatientID ,  GrandTotal ,status) VALUES (? , ? ,(SELECT SUM(Price) FROM prescription_details WHERE PrescriptionID = ?) , ?)";
        $status = 0;
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('iiii' , $prescriptionID , $patientID , $prescriptionID , $status);
        $stmt->execute();
       
    }

    protected function getPastPrescription($patientID) {
        $sql = "SELECT appointment.Date , appointment.Time_Slot , appointment.Doctor_Name , prescription.Remarks , prescription.PrescriptionID FROM `appointment` INNER JOIN prescription ON appointment.AppointmentID = prescription.AppointmentID WHERE prescription.PatientID = ? AND appointment.Status = ?";
        $status = 1;
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('ii' , $patientID  , $status);
        $stmt->execute();
        $results = $stmt->get_result();
        $row = $results->fetch_all(MYSQLI_ASSOC);
        return $row;
       
    }
   
} 
?>