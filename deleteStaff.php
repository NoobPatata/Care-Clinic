<?php 
    if(isset($_POST['userid'])) {
    include_once('includes/autoLoad.php');
    $delete = new UsersContr();
    $id = $_POST['userid'];
    $result = $delete->removeStaff($id);
    if ($result) {
        header("Location: AdminPage.php?success=deletedone");
    }   
    else {
        echo "delete fail";
    }
    } 
    else {
        header("Location: index.php");
    }

?>

