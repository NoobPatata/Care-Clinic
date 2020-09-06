<?php 

session_start();

if(isset($_SESSION['role'])) {

    if($_SESSION['role'] === 'Doctor') {
        session_abort(); ?>
        <?php $page = 'home'; require("Head(Doctor).php"); ?>

        <body>
<!-- main page that show the upcoming appointment  -->
<div class="container-fluid">
        <h1>Today's Appoitment</h1>
            <hr class="hr-green mt-0">

</div>
 

        
        <?php 
        
        include_once('includes/autoLoad.php');
        $firstName = $_SESSION['First_Name'];
        $lastName = $_SESSION['Last_Name'];
        $fullName = $firstName . " " . $lastName;
        
        $appointment = new ViewAppoint;
        $printAppoint = $appointment->showDoctorAppointment($fullName);

                    if(!empty($printAppoint)) {
                        echo'
                        <table id="doctor" class="table table-striped table-bordered"  style="width:100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Medical Concern</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>';

                        foreach ($printAppoint as $appointList) { 
                            echo "<tr>";
                            echo "<td>" . $appointList['Date'] . "</td>";
                            echo "<td>" . $appointList['Time_Slot'] . "</td>";
                            echo "<td>" . $appointList['Medical_Concern'] . "</td>"; ?>
                            <td><a class="btn-sm button-l" href="\wdt\PrescriptionPage.php?id=<?php echo $appointList["LoginID"]; ?>&appointment=<?php echo $appointList["AppointmentID"]; ?>">Give Prescription</a></td>
                  <?php }
                    } else {
                        echo ' <br>                   
                        <div class="col-12">
                            <div class="row justify-content-md-center">
                                <div class="container-xl">
                                    <div class="card">
                                        <div class="card-header text-center bg-green">Today Appointment</div>
                                        <div class="card-body bg-custom">
                                            <br><br><br>
                                            <h1 class="text-center">You do not have any appointment today.</h1>
                                            <br><br><br>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>';                    
                    }
                    ?>

        </tbody>

    </table>
</body>

<script>
    $(document).ready(function() {
        $('#doctor').DataTable();
    } );

    $('#doctor').dataTable( {
        "scrollX": true
    } );
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


