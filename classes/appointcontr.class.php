<?php 

class AppointContr extends Appoint {

    public function makeAppointment($LoginID, $Date , $Time_Slot , $Doctor_Name , $Medical_Concern) {
        $make = $this->createAppointment($LoginID, $Date , $Time_Slot , $Doctor_Name , $Medical_Concern);
        return $make;
    }

    public function deleteAppointment($AppointmentID) {
        $result = $this->cancelAppoint($AppointmentID);
        return $result;
    }

    public function showSelectedAppointment($AppointmentID) {
        $result = $this->getSelectedAppointment($AppointmentID);
        return $result;
    }

    public function updateAppointment($time , $date , $AppointmentID) {
        $result = $this->editAppoint($time , $date , $AppointmentID);
        return $result;
    }

    public function updateStatus($AppointmentID) {
        $result = $this->changeStatus($AppointmentID);
        return $result;
    }

    public function makeAppointmentNurse($firstName , $lastName , $Date , $Time_Slot , $Doctor_Name , $Medical_Concern) {
        $result = $this->createAppointmentNurse($firstName , $lastName , $Date , $Time_Slot , $Doctor_Name , $Medical_Concern);
        return $result;
    }

}