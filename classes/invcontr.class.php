<?php 

class InvContr extends Inv {

    public function updateInv($name , $price , $medID) {
        $result = $this->editInv($name , $price , $medID);
        return $result;
    }

    public function removeMed($medID) {
        $result = $this->deleteInv($medID);
        return $result;
    }

    public function addMed($name , $price  , $type) {
        $result = $this->addInv($name , $price , $type);
        return $result;
    }

}
?>