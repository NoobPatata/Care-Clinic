<?php

class InvView extends Inv {

    public function showInv() {
        $result = $this->getInv();
        return $result;  
    }

    public function showMedDetails($medID) {
        $result = $this->getMedDetails($medID);
        return $result;
    }

}
?>