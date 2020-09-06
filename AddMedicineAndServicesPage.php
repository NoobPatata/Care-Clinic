<?php 

session_start();

if(isset($_SESSION['role'])) {

    if($_SESSION['role'] === 'Nurse') {
        session_abort(); ?>
        <?php $page = 'medicalinventory'; require("Head(Nurse).php"); ?>
        <body>
            <br>
            <div class="col-12">
                <div class="row justify-content-md-center">
                    <div class="container-xl">
                        <!-- alert -->
                        <?php
                            if (isset($_GET['success'])){
                                echo'
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>Item Successfully Added</strong>  <a href="\wdt\MedicinAndServicesPage.php" class="alert-link">Click here to view inventory.</a>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                            }elseif (isset($_GET['error'])){
                                if($_GET['error'] == 'EmptyFiels'){
                                    echo'
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Please fill in all the fields.</strong> 
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                    
                                }elseif($_GET['error'] == 'wrongPriceFormat'){
                                    echo'
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>Please enter valid price.</strong> 
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>';
                                }
                            }
                        ?>
                        <div class="card">
                            <div class="card-header text-center bg-green">
                                Add Medicine and Services
                            </div>
                            <div class="card-body bg-custom">
                                <form id="addinventory-form" method="POST" action="addMed.php">
                                    <div class="col-lg-12 bg-custom">
                                        <div class="row justify-content-md-center">
                                            <!-- left -->
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="name">Name</label>
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name"/>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-form-label" for="type">Type</label>
                                                    <select id="type" name="type" class="form-control">
                                                        <option value="" disabled selected hidden>Choose...</option>
                                                        <option value="Medicine">Medicine</option>
                                                        <option value="Service">Service</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- right -->
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label class="col-form-label" for="price">Price</label>
                                                    <input type="text" class="form-control" id="price" name="price" placeholder="Price"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row justify-content-md-end">
                                            <div class="col-md-auto">
                                                <button type="submit" name="addMed" class="btn-lg button-l mb-3 btn-block">Add</button>
                                            </div>
                                            <div class="col-md-auto">
                                                <button type="reset" class="btn-lg button-l mb-3 btn-block">Cancel</button>
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
<?php
    } else {
        Header("location: index.php");
        exit();
    }
}
else {
    Header("location: index.php");
    exit();
}
?>

<script>
    bootstrapValidate('#price', 'numeric:Price contains numbers only!')
</script>