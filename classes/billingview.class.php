<?php

class BillingView extends Billing {
    public function showAllBill() {
        $result = $this->getAllBill();
        return $result;
    }

    public function showBillDetails($billingID) {
        $result = $this->getBillDetails($billingID);
        return $result;
    }
}

?>