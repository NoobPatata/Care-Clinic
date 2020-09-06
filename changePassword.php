<?php
if(isset($_POST['change-password'])) {
    session_start();
    $currentPwd = $_POST['currentpassword'];
    $newPwd = $_POST['newpassword'];
    $confirm = $_POST['confirmnewpassword'];
    $loginID = $_SESSION['loginID'];
    include_once('includes/autoLoad.php');
    $function = new UserView();
    $data = $function->showUserDate($loginID);
    $pwd =  $data['Passwd'];
    $pwdCheck = password_verify($currentPwd , $pwd);
    $matching = password_verify($newPwd , $pwd);
    $validation = new Validation();
    $msg = $validation->isEmpty($_POST, array('currentpassword' , 'newpassword' , 'confirmnewpassword' ));
    if($msg !== null) {
        Header("Location: ChangePasswordPage.php?error=EmptyFiels");
        exit();
    }
    else {
        if($matching == TRUE) {
            header("Location: ChangePasswordPage.php?error=pwdnosame");
            exit();
        }       
        else {       
            if ($pwdCheck == FALSE ) {
                header("Location: ChangePasswordPage.php?error=passwordIncorrect");
                exit();
            }        
            else {
                if($newPwd !== $confirm) {
                    header('Location: ChangePasswordPage.php?error=pwdnotmatch');
                    exit();
                } else {
                    $system = new UsersContr();
                    $hashPwd = password_hash($newPwd , PASSWORD_DEFAULT);
                    $change = $system->updatePwd($hashPwd ,$loginID);
                    header("Location: ChangePasswordPage.php?success");
                    exit();
                }
            }
        }

    }
} 
else {
    header("location: index.php");
}
?>

