<?php

class PrescripView extends Prescription {

    public function showPastPrescription($patientID)
    {
       $result = $this->getPastPrescription($patientID);
       return $result;
    }


}
?>