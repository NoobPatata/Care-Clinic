<?php 

session_start();

if(isset($_SESSION['role'])) {

    if($_SESSION['role'] === 'Patient') {
        session_abort(); ?>
<?php $page = ''; require("Head(patient).php"); ?>

<body>
    <script src="JS/tableToCards.js"></script>
    <div class="col-md-12 bg-custom">
        <h2>Past Appointment</h2>
        <hr class="hr-green mt-0">
    </div>

            
            <?php 

                if (isset($_SESSION['loginID'])) {

                    
                    include_once('includes/autoLoad.php');

                    $view = new PrescripView();
                    $patientID = $_SESSION['loginID'];

                    $history = $view->showPastPrescription($patientID);

                    if(!empty($history)) {
                        echo'    <div class="container-fluid">
                        <table class="table" id="pastappointment" data-card-width="768">
                            <thead>
                                <tr>
                                    <th data-card-title>Date</th>
                                    <th>Time</th>
                                    <th>Doctor</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>';
    
                        foreach ($history as $Details) {
                            echo "<tr>";
                            echo "<td>". $Details['Date'] ."</td>";
                            echo "<td>". $Details['Time_Slot'] ."</td>";
                            echo "<td>". $Details['Doctor_Name'] ."</td>";
                            echo "<td>". $Details['Remarks'] ."</td>"; 
                            echo "</tr>"; 
                        }

                    }else
                    echo'                        
                    <div class="col-12">
                    <div class="row justify-content-md-center">
                        <div class="container-xl">
                            <div class="card">
                                <div class="card-header text-center bg-green">Past appointment</div>
                                <div class="card-body bg-custom">
                                    <br><br><br>
                                    <h1 class="text-center">You do not have any past appointment.</h1>
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
    </div>



</body>


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
