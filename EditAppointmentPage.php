<?php 

session_start();
if(isset($_SESSION['role'])) {

    if($_SESSION['role'] === 'Patient') {
        session_abort(); ?>

        
    <?php 

include_once("includes/autoLoad.php");
$AppointmentID = $_GET['id'];
$selected = new AppointContr();
$data = $selected->showSelectedAppointment($AppointmentID);
$date = $data['Date'];
$time = $data["Time_Slot"]; 
$name = $data['Doctor_Name'];
$concern = $data['Medical_Concern'];?>

<?php $page = 'makeappointment'; require("Head(Patient).php"); ?>
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

                        if (isset($_GET['error'])){
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
                                    <form id="makeappointment-form" method="POST" action="updateAppointment.php">
                                        <div class="col-lg-12 bg-custom">
                                            <div class="row justify-content-md-center">
                                                <!-- left -->
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="prefereddoctor">Doctor Name</label>
                                                        <select id="prefereddoctor" name="prefereddoctor" readonly class="form-control"  onload="loadData()" onkeyup="loadData()">
                                                            <option value="'.$name.'" selected>Dr. '.$name.'</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dob">Date</label>
                                                        <input type="text" class="form-control" id="date" name="date" placeholder="YYYY-MM-DD"  onkeyup="loadData()"
                                                        value="'.$date.'"/>
                                                    </div>
                                                </div>
                                                <!-- right -->
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label class="col-form-label" for="timeslot">Time Slot</label>
                                                        <select id="timeSlot" name="timeslot" class="form-control">
                                                        <option selected>'.$time.'</option>'
                                                        ?> <?php 
                                                        include_once('appointmentSlot.php');
                                                        echo '
                                                        </select>
                                                    </div>
                                                        <div class="form-group">
                                                            <label class="col-form-label" for="remark">Medical Concern</label>
                                                            <textarea class="form-control" readonly rows="1" id="medicalconcern" name="medicalconcern" placeholder="Medical Concern">'.$concern.'</textarea>
                                                        </div>
                                                        <input type="hidden" name="AppointmentID" value="'.$AppointmentID.'" >
                                                    </div>
                                                </div>
                                            <div class="row justify-content-md-end">
                                                <div class="col-md-auto">
                                                    <button type="submit" name="save" class="btn-lg button-l mb-3 btn-block">Update Appointment</button>
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
        bootstrapValidate('#date', 'ISO8601:Date did not match the format YYYY-MM-DD')
        bootstrapValidate('#medicalconcern', 'required:Please fill out this field!')
    </script>




<?php require("Footer(Patient).php"); ?>








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

