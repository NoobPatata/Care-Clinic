<?php 
if(isset($_POST['addMed'])) {
        
    $name = $_POST["name"];    
    $price = $_POST["price"];    
    $type = $_POST['type'];
    include_once('includes/autoLoad.php');

    $validation = new Validation();
    $msg = $validation->isEmpty($_POST, array('name' , 'price' , 'type'));
    $checkPrice = $validation->isValidPrice($_POST['price']);

    if($msg !== null) {
        Header("Location: AddMedicineAndServicesPage.php?error=EmptyFiels");
        exit();
    }
    elseif((!$checkPrice)) {
        header("location: AddMedicineAndServicesPage.php?error=wrongPriceFormat");
        exit();
    }
    else {
        $inv = new InvContr();    
        $med = $inv->addMed($name , $price , $type );
        if ($med) {        
            header("location: AddMedicineAndServicesPage.php?success");
        } else {       
            header("location: AddMedicineAndServicesPage.php?error");
        }

    }

    
} 
else {   
    header("location: index.php");
}
?>