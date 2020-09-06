<?php 

class BillingContr extends Billing {

    public function updateBill($paid , $balance  , $billID) {
        $result = $this->editBilling($paid , $balance  , $billID);
        return $result;
    }
}
?>