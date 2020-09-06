<?php 

session_start();

if(isset($_SESSION['role'])) {

    if($_SESSION['role'] === 'Doctor') {
        session_abort(); ?>

<?php $page = ''; require("Head(Doctor).php"); ?>


<?php 

include_once("includes/autoLoad.php");

$patientID = $_GET['id'];
$appointmentID = $_GET['appointment'];
$user = new UserView();
$value = $user->showUserDate($patientID);
$firstName = $value['First_Name'];
$LastName = $value['Last_Name'] ;
$remark = $value['Remark'];
$fullName = $firstName . " " . $LastName;


    

?>


<body>
        <br>

        <div class="col-12">
            <div class="row justify-content-md-center">
                <div class="container-xl">
                <!-- alert -->
                <?php
                if (isset($_GET['error'])) {
                    if ($_GET ['error'] == "emptyFields"){
                        echo'
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>Please fill up all the fields.</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>';
                    }
                    
                }
               
                ?>
                    <div class="card">
                        <div class="card-header text-center bg-green">Patient Details</div>
                        <div class="card-body bg-custom">
                            <form id="viewpatienthistory-form" method="POST" action="">
                                <div class="col-lg-12 bg-custom">
                                    <div class="row justify-content-md-center">
                                        <!-- left -->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="name">Name</label>
                                                <input type="text" readonly  class=" form-control" id="name" name="name" placeholder="Name" value="<?php echo $fullName; ?>"/>
                                            </div>



                                        </div>                                          
                                        <!-- right -->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="remark">Remark</label>
                                                <textarea class="form-control" readonly rows="4" id="remark" name="remark"><?php echo $remark; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>      
                            </form>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header text-center bg-green">Prescription</div>
                        <div class="card-body bg-custom">
                            <form id="prescription-form" method="POST" action="givePrescription.php">
                                <div class="col-lg-12 bg-custom">
                                    <div class="row justify-content-md-center">
                                        <!-- left -->
                                        <div class="col-lg-6">
                                            <div class="row" >
                                                <div class="col-lg-3">
                                                    Services:
                                                </div>
                                                <div class="col-lg-9">
                                                <?php 
                                                    $inv = new InvView();
                                                    $med = $inv->showInv();                                                   
                                                    $new = array_filter($med, function ($var) {
                                                        return ($var['Type'] == 'Service');
                                                    });
                                                    foreach ($new as $details) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" name = "med[]" type="checkbox" id="<?php echo $details['Name']?>" value="<?php echo $details['Name']?>">
                                                        <label class="form-check-label" for="toothremoval"><?php echo $details['Name']?></label>
                                                    </div>
                                                <?php
                                                    }
                                                ?>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row" >
                                                <div class="col-lg-3">
                                                    Medicines:
                                                </div>
                                                <div class="col-lg-9">
                                                <?php 
                                                $medicine = array_filter($med, function ($var) {
                                                    return ($var['Type'] == 'Medicine');
                                                });
                                                foreach ($medicine as $value) { ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input"  name = "med[]" type="checkbox" id="<?php echo $value['Name']?>" value="<?php echo $value['Name']?>">
                                                        <label class="form-check-label" for="tylenol"><?php echo $value['Name']?></label>
                                                    </div>
                                                <?php }
                                                ?>
                                                </div>
                                            </div>
                                        </div>                                          
                                        <!-- right -->
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="col-form-label" for="remark">Doctor Notes</label>
                                                <textarea class="form-control" rows="4" id="doctornotes" name="doctornotes" placeholder="Enter doctor notes"></textarea>
                                            </div>
                                        </div>
                                        <input type="hidden" name = "patientID" value= "<?php echo $patientID;?>">
                                        <input type="hidden" name = "appointmentID" value= "<?php echo $appointmentID;?>">
                                    </div>
                                    <div class="row justify-content-md-end">
                                        <div class="col-md-auto">
                                            <button type="submit" name="add" class="btn-lg button-l mb-3 btn-block">Add</button>
                                        </div>
                                        <div class="col-md-auto">
                                            <button type="reset" class="btn-lg button-l mb-3 btn-block">Clear</button>
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
    bootstrapValidate('#doctornotes', 'required:Doctor note cannot be left empty!')
</script>


<?php    } else {
    Header("location: index.php");
    exit();
}

}

else {
    Header("location: index.php");
    exit();
}

?>