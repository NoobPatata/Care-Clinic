<?php
if(isset($_POST['login'])) {
    include_once('includes/autoLoad.php');
    $email = $_POST['email'];
    $password = $_POST['password'];
    $result = new UsersContr();
    $roles =$result->submitLogin($email)->get_result()->fetch_assoc();
    if(!$roles) {
        header('Location: LoginPage.php?error=credentialsIncorrect');
        } else {
            $pwdCheck = password_verify($password , $roles['Passwd']);
            if($pwdCheck == false) {
                header("Location: LoginPage.php?error=wrongpwed");
            } elseif ($pwdCheck == true) {
                switch ($roles['User']) {
                    case 'Admin':
                        session_start();
                        $_SESSION['role'] = 'Admin';
                        $_SESSION['First_Name'] = $roles['First_Name'];
                        $_SESSION['Last_Name'] = $roles['Last_Name'];
                        $_SESSION['loginID'] = $roles['LoginID'];
                        $_SESSION['email'] = $roles['email'];
                        header('Location: index.php');
                        exit();
                        break;
                    case 'Doctor':
                        session_start();
                        $_SESSION['role'] = 'Doctor';
                        $_SESSION['First_Name'] = $roles['First_Name'];
                        $_SESSION['Last_Name'] = $roles['Last_Name'];
                        $_SESSION['loginID'] = $roles['LoginID'];
                        $_SESSION['email'] = $roles['email'];
                        header('Location: index.php');
                        exit();
                        break;
                    case 'Nurse':
                        session_start();
                        $_SESSION['role'] = 'Nurse';
                        $_SESSION['First_Name'] = $roles['First_Name'];
                        $_SESSION['Last_Name'] = $roles['Last_Name'];
                        $_SESSION['email'] = $roles['email'];
                        $_SESSION['loginID'] = $roles['LoginID'];
                        header('Location: index.php');
                        exit();
                        break;
                    case 'Patient':
                        session_start();
                        $_SESSION['role'] = 'Patient';
                        $_SESSION['email'] = $roles['email'];
                        $_SESSION['loginID'] = $roles['LoginID'];
                        header('Location: index.php?success');
                        exit();
                        break;
                }
        }
    }  
} else {
    header('Location: LoginPage.php');
}
?>

