<?php
if(isset($_POST['update-med'])) {
    $medID = $_POST["medID"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    include_once('includes/autoLoad.php');
    $validation = new Validation();
    $msg = $validation->isEmpty($_POST, array('name' , 'price' ));
    $checkPrice = $validation->isValidPrice($_POST['price']);
    if($msg !== null) {
        Header("Location: MedicinAndServicesPage.php?error=EmptyFiels");
        exit();
    }
    elseif((!$checkPrice)) {
        header("location: MedicinAndServicesPage.php?error=wrongPriceFormat");
        exit();
    }
    else {
        $inv = new InvContr();
        $med = $inv->updateInv($name , $price , $medID);
        if ($med) {
            header("location: MedicinAndServicesPage.php?success");
        } else {
            echo"failed"; 
        }
    }

}else {
        header("location: Index.php");
}
?>

