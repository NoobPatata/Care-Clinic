<?php $page = ''; require("Head(patient).php"); ?>



    <body>
        <br>
        <div class="container-xl">
                            <!-- alert -->
                            <?php
                if (isset($_GET['error'])) {
                    if ($_GET ['error'] == "credentialsIncorrect"){
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Invalid email and password.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }else if ($_GET ['error'] == "wrongpwed"){
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Password is incorrect.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    } 
                }            
                ?>


        
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="row justify-content-md-center">
                <div class="col-md-5">
                <div class="card">
                        <div class="card-header text-center bg-green">Login</div>
                        <div class="card-body bg-custom">

                            <form id="login-form" method="POST" action="login.php">
                                <div class="form-group">
                                    <label class="col-form-label" for="email">Email Address</label>
                                    <input type="text" class="form-control" id="email" name="email" placeholder="email address"/>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="password"/>
                                </div>
                                <div class="col-md-12">
                                    <div class="row justify-content-md-center">
                                        <button type="submit" class="btn-md button-l mb-3 btn-block" name="login"> Login</button>
                                        <button type="button" class="btn-md button-l mb-3 btn-block" onclick="window.location.href='RegisterPage.php'">Register</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                </div>
            </div>
        </div>
        
        <br>
    </body>




    <script>
        bootstrapValidate('#email', 'email:Enter a valid email address.')
        bootstrapValidate('#password', 'required:Please fill out this field!')
    </script>

    <?php require("Footer(Patient).php"); ?>


