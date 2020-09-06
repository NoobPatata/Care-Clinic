<?php if(isset($_GET['id'])) { ?>

<?php $page = 'medicalinventory'; require("Head(Nurse).php"); ?>

<?php 

    include_once("includes/autoLoad.php");
    $medID = $_GET['id'];
    $selected = new InvView();
    $med = $selected->showMedDetails($medID);
    $name = $med['Name'];
    $price = $med['Price'] ;
    

?>
    <body>
        <br>
        <div class="col-12">
            <div class="row justify-content-md-center">
                <div class="container-xl">                   
                    <div class="card">
                        <div class="card-header text-center bg-green">Update Medicine and Services</div>
                        <div class="card-body bg-custom">
                            <form id="editmedicalinventory-form" method="POST" action="updateMed.php">
                                <div class="col-lg-12 bg-custom">
                                    <div class="row justify-content-md-center">
                                        <!-- left -->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Name"  value="<?php echo $name; ?>"/>
                                            </div>
                                        </div>                                          
                                        <!-- right -->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="price">Price</label>
                                                <input type="text" class="form-control" id="price" name="price" placeholder="Price"  value="<?php echo $price; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="medID" value = "<?php echo $medID; ?>">

                                    <div class="row justify-content-md-end">
                                        <div class="col-md-auto">
                                            <button type="submit" name="update-med" class="btn-lg button-l mb-3 btn-block">Save</button>
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
    bootstrapValidate('#price', 'numeric:Price contains numbers only!')
</script>

<?php } else {
header("Location: index.php");
}
?>