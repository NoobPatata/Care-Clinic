<?php

class Validation {

    public function isEmpty($data , $fields) {
        $msg = null;
        foreach ($fields as $value) {
            if (empty($data[$value])) {
                $msg .= "$value field empty </br>";
            }
        }
        return $msg;
    }
    
    public function isValidEmail($email) {
        if(filter_var($email , FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    public function isValidContact($contactNumber) {
        if(preg_match("/^(01)[0-46-9]*[0-9]{7,8}$/" ,$contactNumber)) {
            return true;
        }
        return false;
    }

    public function isValidDate($date) {
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/",$date)) {
            return true;
        } else {
            return false;
        }
    }

    public function isValidPrice($price) {
        if (preg_match("/^\d{0,8}(\.\d{0,2})?$/",$price)) {
            return true;
        } else {
            return false;
        }
        
    } 
}
?>

