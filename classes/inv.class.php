<?php

class Inv extends Dbh {

    protected function getInv() {
        $sql = "SELECT * FROM medicineandservices";
        $stmt = $this->connect()->query($sql);
        $rows = $stmt->fetch_all(MYSQLI_ASSOC);
        return $rows;
    }

    protected function addInv($name , $price , $type) {
        $sql = "INSERT INTO `medicineandservices`(`Name`, `Price` , `Type`) VALUES (?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('sds' , $name , $price , $type);
        $stmt->execute();
        return $stmt;
    }

    protected function deleteInv($medID) {
        $sql = "DELETE FROM medicineandservices WHERE MS_ID = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('i' , $medID);
        $stmt->execute();
        return $stmt;
    }

    protected function editInv($name , $price  , $medID) {
        $sql = "UPDATE medicineandservices SET Name = ?, Price = ?  WHERE MS_ID = ? ";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('sdi' , $name , $price , $medID);
        $stmt->execute();
        return $stmt;
    }

    protected function getMedDetails($medID) {
        $sql = "SELECT * FROM medicineandservices WHERE MS_ID = ?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('i' , $medID);
        $stmt->execute();
        $results = $stmt->get_result();
        $row = $results->fetch_assoc(); 
        return $row;
    }

}
?>