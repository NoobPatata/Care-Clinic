<?php
if(isset($_POST['register'])) {
    include_once('includes/autoLoad.php');
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $contactNumber = $_POST['contactnumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passCheck = $_POST['confirmpassword'];
    $remark = $_POST['remark'];
    $user = 'Patient';
    $validation = new Validation();
    $msg = $validation->isEmpty($_POST, array('firstname' , 'lastname' , 'gender' , 'dob' , 'address' , 'contactnumber' , 'email' , 'password' , 'confirmpassword'  , 'remark' ));
    $checkEmail = $validation->isValidEmail($_POST['email']);
    $checkDate = $validation->isValidDate($_POST['dob']);
    $checkContact = $validation->isValidContact($_POST['contactnumber']);
    if($msg !== null) {
        Header("Location: RegisterPage.php?error=EmptyFiels&first=".$firstName."&last=".$lastName."&gender=".$gender."&dob=".$dob."&contact=".$contactNumber."&email=".$email);
        exit();
    }
    elseif(!$checkEmail) {
        Header("Location: RegisterPage.php?error=EmailError&first=".$firstName."&last=".$lastName."&gender=".$gender."&dob=".$dob."&contact=".$contactNumber);
        exit();
    }
    elseif(!$checkDate) {
        Header("Location: RegisterPage.php?error=DateError&first=".$firstName."&last=".$lastName."&gender=".$gender."&contact=".$contactNumber."&email=".$email);
        exit();
    }
    elseif(!$checkContact) {
        Header("Location: RegisterPage.php?error=ContactError&first=".$firstName."&last=".$lastName."&gender=".$gender."&dob=".$dob."&email=".$email);
        exit();
    }
    elseif ($password !== $passCheck) {
        Header("Location: RegisterPage.php?error=PasswordError&first=".$firstName."&last=".$lastName."&gender=".$gender."&dob=".$dob."&contact=".$contactNumber."&email=".$email);
        exit();
    }
    else {
        $enter = new UsersContr();
        $insert = $enter->registerUser($firstName ,  $lastName ,  $gender , $dob , $address ,  $contactNumber , $email , $password , $remark, $user);
        header("location: RegisterPage.php?success");
        exit();
    }
}
elseif (isset($_POST['register-staff'])) {
    include_once('includes/autoLoad.php');
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $gender = $_POST['gender'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $contactNumber = $_POST['contactnumber'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passCheck = $_POST['confirmpassword'];
    $remark = "";
    $user = $_POST['role'];
    $validation = new Validation();
    $msg = $validation->isEmpty($_POST, array('firstname' , 'lastname' , 'gender' , 'dob' , 'address' , 'contactnumber' , 'email' , 'password' , 'confirmpassword'  , 'role' ));
    $checkEmail = $validation->isValidEmail($_POST['email']);
    $checkDate = $validation->isValidDate($_POST['dob']);
    $checkContact = $validation->isValidContact($_POST['contactnumber']);


    if($msg !== null) {
        Header("Location: AddUserPage.php?error=EmptyFiels&first=".$firstName."&last=".$lastName."&gender=".$gender."&dob=".$dob."&contact=".$contactNumber."&email=".$email."&role=".$role);
        exit();
    }
    elseif(!$checkEmail) {
        Header("Location: AddUserPage.php?error=EmailError&first=".$firstName."&last=".$lastName."&gender=".$gender."&dob=".$dob."&contact=".$contactNumber."&role=".$role);
        exit();
    }
    elseif(!$checkDate) {
        Header("Location: AddUserPage.php?error=DateError&first=".$firstName."&last=".$lastName."&gender=".$gender."&contact=".$contactNumber."&email=".$email."&role=".$role);
        exit();
    }
    elseif(!$checkContact) {
        Header("Location: AddUserPage.php?error=ContactError&first=".$firstName."&last=".$lastName."&gender=".$gender."&dob=".$dob."&email=".$email."&role=".$role);
        exit();
    }
    elseif ($password !== $passCheck) {
        Header("Location: AddUserPage.php?error=PasswordError&first=".$firstName."&last=".$lastName."&gender=".$gender."&dob=".$dob."&contact=".$contactNumber."&email=".$email."&role=".$role);
        exit();
    }
    else {
        $enter = new UsersContr();
        $insert = $enter->registerUser($firstName ,  $lastName ,  $gender , $dob , $address ,  $contactNumber , $email , $password , $remark, $user);
        header("location: AddUserPage.php?success");
        exit();
    }
}
else {
    header("Location: index.php");
}
?>