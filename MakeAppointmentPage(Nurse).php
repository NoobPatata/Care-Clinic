<?php 

session_start();

if(isset($_SESSION['role'])) {

    if($_SESSION['role'] === 'Nurse') {
        session_abort(); ?>
        <?php $page = 'makeappointment'; require("Head(Nurse).php"); ?>
    <body>
    <script type="text/javascript">
           function loadData() {
               var date = $("#date").val();
               var doctor = $("#prefereddoctor").val();
               $.ajax({
                   type: "POST",
                   url: "appointmentSlot.php",
                   data: {val: date , doctor: doctor},
                   success: function (response) {
                       $("#timeSlot").html(response);
                   }
               });
           }
        </script>
        <br>
        <?php
            if (isset($_SESSION['role'])) {


                echo'
                <div class="col-12">
                

                    <div class="row justify-content-md-center">
                        <div class="container-xl">';
                        if (isset($_GET['success'])){
                            echo'
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Appointment Added.</strong>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
                        } else if (isset($_GET['error'])){
                            if ($_GET['error'] == "EmptyFiels"){
                                echo'
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Please fill up all the fields.</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                            }else if ($_GET ['error'] == "wrongDateFormat") {
                                echo'
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>Please enter date following the format (YYYY-MM-DD).</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>';
                            }
                        }


                        echo'                     
                            <div class="card">
                                <div class="card-header text-center bg-green">Make Appointment
                                </div>
                                <div class="card-body bg-custom">
                                    <form id="makeappointment-form" method="POST" action="nurseAppointment.php">
                                        <div class="col-lg-12 bg-custom">
                                            <div class="row justify-content-md-center">
                                                <!-- left -->
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="patientfirstname">Patient First Name</label>
                                                        <input type="text" class="form-control" id="patientfirstname" name="patientfirstname" placeholder="Patient First Name"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="patientlastname">Patient Last Name</label>
                                                        <input type="text" class="form-control" id="patientlastname" name="patientlastname" placeholder="Patient Last Name"/>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="prefereddoctor">Prefered Doctor</label>
                                                        <select id="prefereddoctor" name="prefereddoctor" class="form-control" onchange="loadData()">
                                                            <option selected>Choose...</option>';
                                                            ?>
                                                            <?php 
                                                                include_once("includes/autoLoad.php");
                                                                $view = new ViewAppoint();
                                                                $doctor = $view->showDoctor();
                                                                foreach($doctor as $chosen){
                                                                    echo "<option value='". $chosen['First_Name'] . " " . $chosen['Last_Name'] ."'> Dr. ". $chosen['First_Name'] . " " . $chosen['Last_Name'] . "</option>";
                                                                }
                                                            ?>  
                                                            <?php
                                                        echo'
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dob">Date</label>
                                                        <input type="text" class="form-control" id="date" name="date" placeholder="YYYY-MM-DD" onkeyup="loadData()"/>
                                                    </div>

                                                </div>
                                                <!-- right -->
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="timeslot">Time Slot</label>
                                                        <select id="timeSlot" name="timeslot" class="form-control">
                                                            
                                                        <option selected>Choose a Time Slot</option>'
                                                        ?> <?php 
                                                        include_once('appointmentSlot.php');
                                                        
                                                        echo '
                                                        </select>
                                                    </div>

                                                        <div class="form-group">
                                                            <label class="col-form-label" for="remark">Medical Concern</label>
                                                            <textarea class="form-control" rows="1" id="medicalconcern" name="medicalconcern" placeholder="Medical Concern"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="row justify-content-md-end">
                                                <div class="col-md-auto">
                                                    <button type="submit" name="makeappointment" class="btn-lg button-l mb-3 btn-block">Make Appointment</button>
                                                </div>
                                                <div class="col-md-auto">
                                                    <button type="reset" class="btn-lg button-l mb-3 btn-block"> Clear</button>
                                                </div>
                                            </div>

                                        </div>      
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }

        ?>          
        <br>
    </body>

    <script>
        bootstrapValidate('#patientfirstname', 'required:Please fill out this field!')
        bootstrapValidate('#patientlastname', 'required:Please fill out this field!')
        bootstrapValidate('#date', 'ISO8601:Date did not match the format YYYY-MM-DD')
        bootstrapValidate('#medicalconcern', 'required:Please fill out this field!')
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

