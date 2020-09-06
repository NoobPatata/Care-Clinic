<?php $page = ''; require("Head(patient).php"); ?>



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
                    }else if ($_GET ['error'] == "EmailError") {
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Please enter a valid email address.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }else if ($_GET ['error'] == "DateError") {
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Please enter date following the format (YYYY-MM-DD).</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }else if ($_GET ['error'] == "ContactError") {
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Please enter a valid contact number.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }else if ($_GET ['error'] == "PasswordError") {
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Password entered did not match.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }else if ($_GET ['error'] == "mailtaken") {
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>This email is already taken by another user.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }
                    
                }
                else if (isset($_GET['success'])){
                    echo'
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Account successfully added.</strong><a href="LoginPage.php" class="alert-link">Click here to login</a>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                }

               
                ?>
                    <div class="card">
                        <div class="card-header text-center bg-green">Register</div>
                        <div class="card-body bg-custom">
                            <form id="register-form" method="POST" action="register.php">
                                <div class="col-lg-12 bg-custom">
                                    <div class="row justify-content-md-center">
                                        <!-- left -->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="firstname">First Name</label>
                                                <input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" value="<?php echo htmlspecialchars($_GET['first'] ?? "")?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="fullname">Last Name</label>
                                                <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" value="<?php echo htmlspecialchars($_GET['last'] ?? "")?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="gender">Gender</label>
                                                <select id="gender" name="gender" class="form-control">
                                                    <option value="" disabled selected hidden>Choose...</option>
                                                    <option <?php echo (isset($_GET['gender']) && $_GET['gender'] === 'Male') ? 'selected' : ''; ?> value="Male">Male</option>
                                                    <option <?php echo (isset($_GET['gender']) && $_GET['gender'] === 'Female') ? 'selected' : ''; ?> value="Female">Female</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="dob">Date of Birth</label>s
                                                <input type="text" class="form-control" id="dob" name="dob" placeholder="YYYY-MM-DD" value="<?php echo htmlspecialchars($_GET['dob'] ?? "")?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control" rows="1" id="address" name="address" placeholder="Address"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="contactnumber">Contact Number</label>
                                                <input type="text" class="form-control" id="contactnumber" name="contactnumber" placeholder="0123456789" value="<?php echo htmlspecialchars($_GET['contact'] ?? "")?>"/>
                                            </div>
                                        </div>                                          
                                        <!-- right -->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="email">Email</label>
                                                <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($_GET['email'] ?? "")?>"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="password">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="password">Confirm Password</label>
                                                <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm Password"/>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label" for="remark">Remark</label>
                                                <textarea class="form-control" rows="4" id="remark" name="remark" placeholder="Please state your allergies and medical condition (If none put none)."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row justify-content-md-end">
                                        <div class="col-md-auto">
                                            <button type="submit" name="register" class="btn-lg button-l mb-3 btn-block"> Register</button>
                                        </div>
                                        <div class="col-md-auto">
                                            <button type="reset" class="btn-lg button-l mb-3 btn-block"> Cancel</button>
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
        bootstrapValidate('#firstname', 'required:Please fill out this field!')
        bootstrapValidate('#lastname', 'required:Please fill out this field!')
        bootstrapValidate('#dob', 'ISO8601:Date of birth did not match the format YYYY-MM-DD')
        bootstrapValidate('#address', 'required:Please fill out this field!')
        bootstrapValidate('#contactnumber', 'regex:^(01)[0-46-9]*[0-9]{7,8}$:Invalid contact number. Example 0132822133')
        bootstrapValidate('#email', 'email:Enter a valid email address')
        bootstrapValidate('#confirmpassword', 'matches:#password:Your passwords should match')
        bootstrapValidate('#remark', 'required:Please put none if you do not have any allergies or medical concern.')

    </script>

<?php require("Footer(Patient).php"); ?>
