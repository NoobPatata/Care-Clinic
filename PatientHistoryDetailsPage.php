<?php 

session_start();

if(isset($_SESSION['role'])) {

    if($_SESSION['role'] === 'Doctor') {
        session_abort(); ?>

<?php $page = 'patienthistory'; require("Head(Doctor).php"); ?>

<body>
    <div class="container-fluid">




    </div>

            <?php            
            include_once('includes/autoLoad.php');
            $view = new PrescripView();
            $patientID = $_GET['id'];
            $history = $view->showPastPrescription($patientID);
            if(!empty($history)) {
                echo'
                <table id="patienthistorydetails" class="table table-striped table-bordered"  style="width:100%">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Doctor</th>
                        <th>Remark</th>
        
                    </tr>
                </thead>
                <tbody>';
                foreach ($history as $Details) {
                    echo "<tr>";
                    echo "<td>". $Details['Date'] ."</td>";
                    echo "<td>". $Details['Time_Slot'] ."</td>";
                    echo "<td>". $Details['Doctor_Name'] ."</td>";
                    echo "<td>". $Details['Remarks'] ."</td>";
                    echo "</tr>";
                }
                echo'
                </tbody>
                </table>';
                

            }else{
                echo '                    
                <div class="col-12">
                    <div class="row justify-content-md-center">
                        <div class="container-xl">
                            <div class="card">
                                <div class="card-header text-center bg-green">Patient history</div>
                                <div class="card-body bg-custom">
                                    <br><br><br>
                                    <h1 class="text-center">Patient do not have history.</h1>
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
        $('#patienthistorydetails').DataTable({
            "scrollX": true

        });
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