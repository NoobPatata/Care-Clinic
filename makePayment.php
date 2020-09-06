<?php

if (isset($_POST['pay'])) {

    $billID = $_POST['billID'];
    $value = $_POST['total'];
    $balance = $_POST['balance'];
    $paid = $_POST['amountpaid'];
    $total = str_replace("RM" , "" , $value);

    include_once('includes/autoLoad.php');

    $validation = new Validation();
    $msg = $validation->isEmpty($_POST, array('amountpaid'));
    $checkPrice = $validation->isValidPrice($_POST['amountpaid']);

    if($msg !== null) {
        Header("Location: PaymentPage.php?error=EmptyFiels&id=".$billID."&price=".$total);
        exit();
    }
    elseif((!$checkPrice)) {
        header("location: PaymentPage.php?error=wrongPriceFormat&id=".$billID."&price=".$total);
        exit();
    } 
    else {
       
   
        if($total > $paid) {
            header('Location: PaymentPage.php?error=amountinvalid&id='.$billID.'&price='.$total);
        } else {
            include_once('includes/autoLoad.php');
            $bill = new BillingContr();
    
            $update = $bill->updateBill($paid , $balance , $billID);
            header('Location: BillingPage.php?success');
        }

    }
    

} else {
    header("Location: index.php");
    exit();
}