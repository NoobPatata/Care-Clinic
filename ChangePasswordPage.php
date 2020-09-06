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
    
<body>
    <br>
    <div class="col-12">
        <div class="row justify-content-md-center">
            <div class="container-xl">
                <!-- alert -->
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET ['error'] == "EmptyFiels"){
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Please fill up all the fields.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }else if ($_GET ['error'] == "pwdnosame") {
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>New password cannot be same as the current password.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }else if ($_GET ['error'] == "passwordIncorrect") {
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Current password entered is incorrect.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }else if ($_GET ['error'] == "pwdnotmatch") {
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>New password and confirm new password entered did not match.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }                
                }else if (isset($_GET['success'])){
                    echo'
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Password successfully changed.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                }              
                ?>
                <div class="card">
                    <div class="card-header text-center bg-green">Change Password</div>
                    <div class="card-body bg-custom">
                        <form id="profile-form" method="POST" action="changePassword.php" enctype="multipart/form-data">
                            <div class="col-lg-12 bg-custom">
                                <div class="row justify-content-md-center">
                                    <!-- middle -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="currentpassword">Current Password</label>
                                            <input type="password" class="form-control" id="currentpassword" name="currentpassword"/>
                                        </div>
                                    </div>  
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="newpassword">New Password</label>
                                            <input type="password" class="form-control" id="newpassword" name="newpassword"/>
                                        </div>
                                    </div>   
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="col-form-label" for="confirmnewpassword">Confirm New Password</label>
                                            <input type="password" class="form-control" id="confirmnewpassword" name="confirmnewpassword"/>
                                        </div>
                                    </div>
                                    <button type="submit" name="change-password" class="btn-lg button-l mb-3 btn-block">Change Password</button>
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
    bootstrapValidate('#confirmnewpassword', 'matches:#newpassword:Your passwords should match')
</script>

<?php
if($_SESSION['role'] == 'Patient') {
    session_abort();
    require("Footer(Patient).php");  
}
?>
<?php
    } else {
    Header("location: index.php");
    exit();
}
?>