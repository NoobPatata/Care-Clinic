<?php

class ViewAppoint extends Appoint {

    public function showDoctor() {
        $result = $this->getDoctor();
        return $result;
    }

    public function showAvailableSlot($date , $doctorName) {
        $all = $this->getAllSlot();
        $booked = $this->getBookedSlot($date , $doctorName);
        foreach($all as $key) {
            $allSlot[] = $key['TimeSlot']; 
        }
        if(empty($booked)) {
            return $allSlot;
        } else {
            foreach ($booked as $key) {
                $taken[] = $key['Time_Slot'];
            }
            $diff = array_diff($allSlot , $taken);
            return $diff;
        }          
    }

    public function showMyAppointment($loginID) {
        $result = $this->getMyAppointment($loginID);
        return $result;
    }
 
    public function cancelAppointment($loginID) {
        $result = $this->cancelAppoint($loginID);
        return $result;
    }
 
    public function editAppoint($time , $date , $loginID) {
        $result = $this->editAppoint($time , $date , $loginID);
        return $result;
    }    

    public function showDoctorAppointment($doctorName) {
        $result = $this->getDoctorAppointment($doctorName);
        return $result;
    }

    public function showAllAppointment() {
        $result = $this->getAllAppointment();
        return $result;
    }
}
?>