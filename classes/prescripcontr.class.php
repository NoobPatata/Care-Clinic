<?php

class PrescripContr extends Prescription {

    public function savePrescription($patientID , $doctorID , $appointmentID , $remarks) {
        $result = $this->insertPrescription($patientID , $doctorID , $appointmentID ,$remarks);
        return $result;
    }

    public function saveDetails($prescriptionID , $name) {
        $result = $this->insertDetails($prescriptionID , $name);
        return $result;
    }

    public function createBill($prescriptionID , $patientID) {
        $result = $this->insertBilling($prescriptionID , $patientID);
        return $result;
    }

}
?>