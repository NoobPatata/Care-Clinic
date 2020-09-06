<?php

if(isset($_POST['update-profile'])) {

    session_start();
    include_once('includes/autoLoad.php');
    $id = $_SESSION['loginID'];
    $address = $_POST['address'];
    $contact = $_POST['contactnumber'];
    $email = $_POST['email'];
    $remark = $_POST['remark'];

    $validation = new Validation();
    $msg = $validation->isEmpty($_POST, array('address' , 'contactnumber' , 'email' , 'remark'));
    $checkContact = $validation->isValidContact($_POST['contactnumber']);
    $checkEmail = $validation->isValidEmail($_POST['email']);

    if($msg !== null) {
        header("Location: ProfilePage(Patient).php?error=emptyfields");
        exit();
    }

    elseif (!$checkEmail) {
        header("Location: ProfilePage(Patient).php?error=wrongEmail");
        exit();
    }

    elseif (!$checkContact) {
        header("Location: ProfilePage(Patient).php?error=wrongcontact");
        exit();
    }

    else {

        $file = $_FILES['profilePic'];

        $fileName = $file['name'];
        $FileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        if(empty($_FILES['profilePic']['name'])) {
            $control = new UsersContr();
            $status = 0;
            $update = $control->updateProfile($address , $contact , $email , $remark , $status , $id);
            header('Location: ProfilePage(Patient).php?success');
            exit();
        }
        else {

        $fileExt = explode('.' , $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array('jpg' , 'jpeg' , 'png');

        if (in_array($fileActualExt , $allowed)) {

            if($fileError === 0) {

                if($fileSize < 30000) {

                    $fileName = "uploads/profile".$id."*";
                    $fileInfo = glob($fileName);
                    $fileExt = explode("." ,$fileInfo[0]);
                    $fileactualext = $fileExt[1];

                    $files = "uploads/profile".$id.".".$fileactualext;
                
                    if(file_exists($files)) {
                        unlink($files);
                        $fileNameNew = "profile".$id.".".$fileActualExt;
                        $fileDestination = 'uploads/'.$fileNameNew;
                        move_uploaded_file($FileTmpName ,  $fileDestination);
                        $control = new UsersContr();
                        $status = 1;
                        $update = $control->updateProfile($address , $contact , $email , $remark , $status , $id);
                        header('Location: ProfilePage(Patient).php?success');
                        exit();
                        
                    } else {

                        $fileNameNew = "profile".$id.".".$fileActualExt;
                        $fileDestination = 'uploads/'.$fileNameNew;
                        move_uploaded_file($FileTmpName ,  $fileDestination);
                        $control = new UsersContr();
                        $status = 1;
                        $update = $control->updateProfile($address , $contact , $email , $remark , $status , $id);
                        header('Location: ProfilePage(Patient).php?success');
                        exit();

                    }
                    
                } else {
                    header('Location: ProfilePage(Patient).php?error=filesizetoobig');
                }

            }  else {
                header('Location: ProfilePage(Patient).php?error=failupload');
            }

        } 
        
        else {
            header('Location: ProfilePage(Patient).php?error=invalidfiletype');
        }

    } 

        }

       

}

else {
    Header("Location: index.php");
    exit();
}