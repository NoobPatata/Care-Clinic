<?php

class Appoint extends Dbh {
    //get all doctor 
    protected function getDoctor() {
        $sql = "SELECT * FROM Users WHERE User = 'Doctor' ";
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetch_all(MYSQLI_ASSOC);
        return $results;
    }

    //get all the slot available 
    protected function getAllSlot() {
        $sql = "SELECT * FROM timeslot";
        $stmt = $this->connect()->query($sql);
        $results = $stmt->fetch_all(MYSQLI_ASSOC);
        return $results;
    }

    //show slot that are booked an particular date
    protected function getBookedSlot($date , $doctorName) {
        $sql = "SELECT * FROM `appointment` WHERE Date =? AND Doctor_Name = ?";
        // $todayDate = date("Y-m-d");
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('ss' , $date , $doctorName);
        $stmt->execute();
        $results = $stmt->get_result();
        $row = $results->fetch_all(MYSQLI_ASSOC);
        return $row;
    }


    //make new appointment 
    protected function createAppointment($LoginID, $Date , $Time_Slot , $Doctor_Name , $Medical_Concern) {
        $sql = "INSERT INTO appointment (`LoginID`, `Date`, `Time_Slot`, `Doctor_Name`, `Medical_Concern` ,`Status`) VALUES (?,?,?,?,?,?)";
        $status = 0;
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param("sssssi" , $LoginID, $Date , $Time_Slot , $Doctor_Name , $Medical_Concern , $status);
        $stmt->execute();
        return $stmt;
    }

    //get the appointment of the patient
    protected function getMyAppointment($loginID) {
        $sql = "SELECT * FROM appointment WHERE LoginID = ? AND Date >= CURDATE() AND Status = ? ";
        $status = 0;
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('si' , $loginID , $status);
        $stmt->execute();
        $results = $stmt->get_result();
        $row = $results->fetch_all(MYSQLI_ASSOC); 
        return $row;
    }

    //to cancel an appointment made
    protected function cancelAppoint($AppointmentID) {
        $sql = "DELETE FROM `appointment` WHERE AppointmentID =?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('s' , $AppointmentID);
        $stmt->execute();
        return $stmt;
    }


    //for patient to update their appointment 
    protected function editAppoint($time , $date , $AppointmentID) {
        $sql = "UPDATE appointment SET Time_Slot = ?, Date = ? WHERE AppointmentID = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('sss' , $time , $date , $AppointmentID);
        $stmt->execute();
        return $stmt;
    }

    //get the details of the selected appointment
    protected function getSelectedAppointment($AppointmentID) {
        $sql = "SELECT * FROM `appointment` WHERE AppointmentID = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('s' , $AppointmentID);
        $stmt->execute();
        $arr = $stmt->get_result()->fetch_assoc();
        return $arr;
    }
    
    //show today appointment for the doctor 
    protected function getDoctorAppointment($doctorName) {
        $sql = "SELECT * FROM appointment WHERE Doctor_Name = ? AND Date = CURDATE() AND Status = ?";
        $status = 0;
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param("si" , $doctorName , $status);
        $stmt->execute();
        $results = $stmt->get_result();
        $row = $results->fetch_all(MYSQLI_ASSOC); 
        return $row;
    }


    //change status of appointment after meeting doctor
    protected function changeStatus($AppointmentID) {
        $sql = "UPDATE `appointment` SET `Status`= ? WHERE AppointmentID = ?";
        $status = 1;
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param("ii" , $status , $AppointmentID);
        $stmt->execute();
        return $stmt;
    }


    //show all the appointment today for nurse
    protected function getAllAppointment() {
        $sql = "SELECT * FROM appointment INNER JOIN users on appointment.LoginID = users.LoginID WHERE Date = CURDATE() AND appointment.Status = ?";
        $status = 0;
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param("i"  , $status);
        $stmt->execute();
        $results = $stmt->get_result();
        $row = $results->fetch_all(MYSQLI_ASSOC); 
        return $row;
    }


    protected function createAppointmentNurse($firstName , $lastName , $Date , $Time_Slot , $Doctor_Name , $Medical_Concern) {
        $sql = "INSERT INTO appointment (`LoginID`, `Date`, `Time_Slot`, `Doctor_Name`, `Medical_Concern` ,`Status`) VALUES ((SELECT LoginID FROM users WHERE First_Name = ? AND Last_Name = ?),?,?,?,?,?)";
        $status = 0;
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param("ssssssi" , $firstName , $lastName , $Date , $Time_Slot , $Doctor_Name , $Medical_Concern , $status);
        $stmt->execute();
        return $stmt;
    }
    
}
?>