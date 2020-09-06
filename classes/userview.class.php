<?php 

class UserView extends Users {
    public function showUserDate($loginID) {
        $result = $this->getUserData($loginID);
        return $result;
    }

    public function showAllStaff() {
        $result = $this->getAllStaff();
        return $result;
    }

    public function showAllPatient() {
        $result = $this->getAllPatient();
        return $result;
    }
}
?>