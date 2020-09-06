<?php

class Users extends Dbh {

    protected function submit($email ) {
        $sql = "SELECT * FROM users WHERE email = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('s' , $email );
        $stmt->execute();
        return $stmt;
    }

    protected function register($firstName ,  $lastName ,  $gender , $dob , $address ,  $contactNumber , $email , $password , $remarks, $user) {

        $hashPwd = password_hash($password , PASSWORD_DEFAULT);
        $sql = "INSERT INTO `users`(`First_Name`, `Last_Name`, `Gender`, `Date_of_Birth`, `Address`, `Contact_Number`, `Email`, `Passwd`, `Remark`, `User` , `Status`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $status = 0;
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('ssssssssssi' , $firstName ,  $lastName ,  $gender , $dob , $address ,  $contactNumber ,$email , $hashPwd , $remarks, $user , $status);
        $stmt->execute();
        return $stmt;

    }

    protected function getUserData($loginID) {
        $sql = "SELECT * FROM Users WHERE LoginID = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('s' , $loginID);
        $stmt->execute();
        $arr = $stmt->get_result()->fetch_assoc();
        return $arr;
    }

    protected function getAllPatient() {
        $sql = "SELECT * FROM Users WHERE User = ? ";
        $user = 'Patient';
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('s' , $user );
        $stmt->execute();
        $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $arr;
    }

    protected function updatProfileInfo($address , $contact , $email , $remark , $status , $loginID) {
        $sql = "UPDATE `users` SET `Address`= ? ,`Contact_Number`= ? ,`Email`= ? ,`Remark`= ? ,`Status`= ? WHERE LoginID = ?";
        // $status = 1;
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('ssssii' ,  $address , $contact , $email , $remark , $status , $loginID);
        $stmt->execute();
        return $stmt;
    }

    protected function getAllStaff() {
        $sql = "SELECT * FROM Users WHERE User = ? OR User = ? OR User = ? ";
        $nurse = "Nurse";
        $doctor = "Doctor";
        $admin = "Admin";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('sss' , $nurse , $doctor , $admin);
        $stmt->execute();
        $arr = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        return $arr;
    }

    protected function deleteStaff($LoginID) {
        $sql = "DELETE FROM `Users` WHERE LoginID =?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('s' , $LoginID);
        $stmt->execute();
        return $stmt;
    }

    protected function changePwd($password ,$LoginID) {
        $sql = "UPDATE Users SET Passwd = ? WHERE LoginID =?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('ss' , $password , $LoginID);
        $stmt->execute();
        return $stmt;
    }

    public function isEmailExist($email) {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('s' , $email);
        $stmt->execute();
		$result = $stmt->get_result();
		if($result->num_rows > 0){
			return true;
		} else {
			return false;
		}
    }

}
?>