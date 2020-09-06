<?php 

    session_start();

    if(isset($_SESSION['role'])) { 


        if($_SESSION['role'] == 'Patient') {
            session_abort();
            $page = ''; require("Head(Patient).php"); 
        } elseif ($_SESSION['role'] == 'Nurse') {
            session_abort();
            $page = ''; require("Head(Nurse).php"); 
        } elseif ($_SESSION['role'] == 'Doctor') {
            session_abort();
            $page = ''; require("Head(Doctor).php"); 
        } elseif ($_SESSION['role'] == 'Admin') {
            session_abort();
            $page = ''; require("Head(Admin).php"); 
    }

?>

<?php

    include_once('includes/autoLoad.php');
    $id = $_SESSION['loginID'];

    $view = new UserView();
    $data = $view->showUserDate($id);
    $firstName = $data['First_Name'];
    $lastName = $data['Last_Name'];
    $gender = $data['Gender'];
    $DOB = $data['Date_of_Birth'];
    $address = $data['Address'];
    $contact = $data['Contact_Number'];
    $email = $data['Email'];
    $remark = $data['Remark'];
    $status = $data['Status'];
?>


<body>
    <br>

    <div class="col-12">
        <div class="row justify-content-md-center">
            <div class="container-fluid">
                <!-- alert -->
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET ['error'] == "emptyfields"){
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Please fill up all the fields.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }else if ($_GET ['error'] == "wrongEmail") {
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Please enter a valid email address.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }else if ($_GET ['error'] == "wrongcontact") {
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Please enter a valid contact number.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }else if ($_GET ['error'] == "filesizetoobig") {
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Profile picture size cannot be larger than 3mb.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }else if ($_GET ['error'] == "failupload") {
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Profile picture failed to upload please try again.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }else if ($_GET ['error'] == "invalidfiletype") {
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Only .jpg, .jpeg and .png file type is supported for profile picture.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }
                    
                }
                else if (isset($_GET['success'])){
                    echo'
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Profile updated.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                }

               
                ?>


                <div class="card">
                    <div class="card-header text-center bg-green">Profile</div>
                    <div class="card-body bg-custom">
                        <form id="profile-form" method="POST" action="upload.php" enctype="multipart/form-data">
                            <div class="col-lg-12 bg-custom">
                                <div class="row justify-content-md-center">
                                    <div class="col-lg-2">
                                        <div class="container">
                                            <?php 
                                            
                                            if($status == 0) {
                                                echo '<span class="material-icons d-inline-block align-top" style="font-size: 180px; user-select:none;">account_circle</span>';
                                            } else {
                                                $fileName = "uploads/profile".$id."*";
                                                $fileInfo = glob($fileName);
                                                $fileExt = explode("." , $fileInfo[0]);
                                                $fileactualext = $fileExt[1];
                                                echo "<img class='rounded-circle' Style='Height: 180px; width: 180px;' src='uploads/profile".$id.".".$fileactualext."?".mt_rand()."' alt='Profile Picture'>";
                                            }
                                            
                                            ?>
                                                                                  
                                            <input type="file" name="profilePic" class="">
                                        </div>
                                       

                                    </div>
                                    <!-- middle -->
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="col-form-label" for="firstname">First Name</label>
                                            <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" readonly value='<?php echo $firstName; ?>'/>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="fullname">Last Name</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" readonly value='<?php echo $lastName; ?>'/>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="gender">Gender</label>
                                            <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" readonly value='<?php echo $gender; ?>'/>
                                        </div>
                                        <div class="form-group">
                                            <label for="dob">Date of Birth</label>
                                            <input type="text" class="form-control" id="dob" name="dob" placeholder="YYYY-MM-DD" readonly value='<?php echo $DOB; ?>'/>
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control" rows="1" id="address" name="address" placeholder="Address" value='<?php echo $address; ?>'><?php echo $address; ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-form-label" for="contactnumber">Contact Number</label>
                                            <input type="text" class="form-control" id="contactnumber" name="contactnumber" placeholder="0123456789" value="<?php echo $contact;?>"/>
                                        </div>

                                    </div>                                          
                                    <!-- right -->
                                    <div class="col-lg-5">
                                        <div class="form-group">
                                            <label class="col-form-label" for="email">Email</label>
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $email; ?>"/>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-form-label" for="remark">Remark</label>
                                            <textarea class="form-control" rows="4" id="remark" name="remark" placeholder="Please state your allergies and medical condition (If none put none)."><?php echo $remark; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row justify-content-md-end">
                                    <div class="col-md-auto">
                                        <button type="submit" name="update-profile" class="btn-lg button-l mb-3 btn-block">Save</button>
                                    </div>

                                </div>

                            </div>      
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <br>
</body>
    <script>
        bootstrapValidate('#address', 'required:Please fill out this field!')
        bootstrapValidate('#contactnumber', 'regex:^(01)[0-46-9]*[0-9]{7,8}$:Invalid contact number. Example 0132822133')
        bootstrapValidate('#email', 'email:Enter a valid email address')
        bootstrapValidate('#remark', 'required:Please put none if you do not have any allergies or medical concern.')
    </script>



<?php

if($_SESSION['role'] == 'Patient') {
    session_abort();
    require("Footer(Patient).php");  
}


?>





<?php    } else {
    Header("location: index.php");
    exit();
}


?>
