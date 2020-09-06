<?php 

class Billing extends Dbh {

    protected function getAllBill() {
        $sql = "SELECT BillID , GrandTotal , PrescriptionID , billing.Status , First_Name , Last_Name FROM billing INNER JOIN users ON billing.PatientID = users.LoginID  WHERE billing.Status = ? ";
        $status = 0;
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param('i' , $status);
        $stmt->execute();
        $results = $stmt->get_result();
        $row = $results->fetch_all(MYSQLI_ASSOC);
        return $row;
    }

    protected function getBillDetails($billingID) {
        $sql = "SELECT medicineandservices.Name , prescription_details.Price  FROM prescription_details INNER JOIN medicineandservices ON prescription_details.MS_ID = medicineandservices.MS_ID WHERE PrescriptionID = (SELECT PrescriptionID FROM Billing WHERE BillID = ?)";
        $stmt = $this->connect()->prepare($sql);
        $stmt->bind_param("i" , $billingID);
        $stmt->execute();
        $results = $stmt->get_result();
        $row = $results->fetch_all(MYSQLI_ASSOC);
        return $row;
    }

    protected function editBilling($paid , $balance  , $billingID) {
        $sql = "UPDATE `billing` SET `AmountPaid` = ?,`Balance`= ?,`Status`= ? WHERE BillID = ?";
        $status = 1;
        $stmt =  $this->connect()->prepare($sql);
        $stmt->bind_param('iiii' , $paid , $balance , $status , $billingID);
        $stmt->execute();
        $result = $stmt->affected_rows;
        return $result;
    }


}
?>