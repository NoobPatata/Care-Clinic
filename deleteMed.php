<?php 
if(isset($_POST['MS_ID'])) {
    $medID = $_POST["MS_ID"];    include_once('includes/autoLoad.php');
    $inv = new InvContr();    
    $med = $inv->removeMed($medID);
    if ($med) {
        header("location: MedicinAndServicesPage.php?deletesuccess");
    } else {        
        header("location: MedicinAndServicesPage.php?error");
    }
} 
else {
    header("location: index.php");
}
?>

