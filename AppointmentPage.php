<?php 

session_start();

if(isset($_SESSION['role'])) {

    if($_SESSION['role'] === 'Nurse') {
        session_abort(); ?>

<?php $page = 'appointments'; require("Head(Nurse).php"); ?>

<body>
    <div class="container-fluid">
        <h1>Today's Appointment</h1>
        <hr class="hr-green mt-0">
    </div>

    <div class="row justify-content-md-end">
        <div class="col-md-auto">
            <button name="makeappointment" class="btn-lg button-l mb-3 btn-block" onclick="window.location.href='MakeAppointmentPage(Nurse).php'">Make Appointment</button>
        </div>
    </div>

    <?php
        include_once('includes/autoLoad.php');
        $view = new ViewAppoint();
        $appointments = $view->showAllAppointment();
        if(!empty($appointments)) {
            echo'    
            <table id="Appointments" class="table table-striped table-bordered"  style="width:100%">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Doctor</th>
                    <th>Patient Name</th>
                    <th>Medical Concern</th>
                </tr>
            </thead>
            <tbody>';
            foreach ($appointments as $appointment) {

                echo "<tr>";
                echo "<td>" . $appointment['Date'] . "</td>";
                echo "<td>" . $appointment['Time_Slot'] . "</td>";
                echo "<td>" . $appointment['Doctor_Name'] . "</td>";
                echo "<td>" . $appointment['First_Name'] . " " .$appointment['Last_Name'] . "</td>";
                echo "<td>" . $appointment['Medical_Concern'] . "</td>";
                echo "</tr>";
    
    
            }
            echo'</tbody>

            </table>';
        } else {
            echo'                        
            <div class="col-12">
                <div class="row justify-content-md-center">
                    <div class="container-fluid">
                        <div class="card">
                            <div class="card-header text-center bg-green">Today appointment</div>
                            <div class="card-body bg-custom">
                                <br><br><br>
                                <h1 class="text-center">There are no appointment today.</h1>
                                <br><br><br>
                            </div>
                        </div>
                    </div>
                </div>
            </div><br>';
        }
    ?>
</body>


<script>
    $(document).ready(function() {
        $('#Appointments').DataTable();
    } );

    $('#Appointments').dataTable( {
        "scrollX": true
    } );

</script>

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
