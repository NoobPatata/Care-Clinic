<?php

class UsersContr extends Users {

    public function submitLogin($email ) {
        $result = $this->submit($email );
        return $result;
    }

    public function registerUser($firstName ,  $lastName ,  $gender , $dob , $address ,  $contactNumber , $email , $password , $remarks, $user) {
        $result = $this->register($firstName ,  $lastName ,  $gender , $dob , $address ,  $contactNumber , $email , $password , $remarks, $user);
        return $result;
    }     
    
    public function removeStaff($loginID) {
        $result = $this->deleteStaff($loginID);
        return $result;
    }

    public function updateProfile($address , $contact , $email , $remark , $status , $loginID) {
        $result = $this->updatProfileInfo($address , $contact , $email , $remark , $status , $loginID);
        return $result;
    }

    public function updatePwd($password ,$LoginID) {
        $result = $this->changePwd($password ,$LoginID);
        return $result;
    }
}
?>