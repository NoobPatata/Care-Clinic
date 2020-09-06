<?php 

session_start();

if(isset($_SESSION['role'])) {

    if($_SESSION['role'] === 'Patient') {
        session_abort(); ?>
        <?php $page = ''; require("Head(patient).php"); ?>



<style>
    .close {
            float: right;
            font-size: 21px;
            font-weight: 700;
            line-height: 1;
            color: white;
            text-shadow: 0 1px 0 #fff;
            filter: alpha(opacity=20);
            opacity: .5;
            
    }
    .close:hover {
        color: white; 
        opacity: .8;
        text-decoration: none;
        outline:none;

        
    }   
</style>
<body>

           
<script src="JS/tableToCards.js"></script>
   
    <div class="container-fluid">
    <?php    
        if (isset($_GET['success'])){
            if ($_GET['success'] == 'deletedone'){
                echo'
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Appointment successfully removed.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';

            }else if ($_GET['success'] == 'updatedone'){
                echo'
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Appointment succcessfully updated.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }

        }                        
    ?>
    <div class="col-md-12 bg-custom">
        <h2>Upcoming Appointment</h2>
        <hr class="hr-green mt-0">
    </div>

            
            <?php 

                if (isset($_SESSION['loginID'])) {
                    
                    include_once('includes/autoLoad.php');
                    $loginID = $_SESSION['loginID'];
                    $appointment = new ViewAppoint;
                    $printAppoint = $appointment->showMyAppointment($loginID);

                    if(!empty($printAppoint)) {
                        echo'
                        <table class="table" id="UpcomingAppointment" data-card-width="768">
                        <thead>
                            <tr>
                                <th data-card-title>Date</th>
                                <th>Time</th>
                                <th>Doctor</th>
                                <th>Medical Concern</th>
                                <th style="display :none;">Appointment ID</th>
                                <th data-card-footer>Action</th>
                            </tr>
                        </thead>
                        <tbody>';
                        foreach ($printAppoint as $appointList) { 
                            echo "<tr>";
                            echo "<td id='date'>" . $appointList['Date'] . "</td>";
                            echo "<td>" . $appointList['Time_Slot'] . "</td>";
                            echo "<td> Dr. " . $appointList['Doctor_Name'] . "</td>";
                            echo "<td>" . $appointList['Medical_Concern'] . "</td>";
                            echo "<td id='appointmentid' style='display :none;'>" . $appointList['AppointmentID'] . "</td>"; ?>
                            <td><a class="btn-sm button-l" href="\wdt\EditAppointmentPage.php?id=<?php echo $appointList["AppointmentID"]; ?>">Edit</a>
                            <a data-toggle="modal" data-target="#delete" class="btn-sm button-l deletebtn">Delete</a></td>

                            <!-- Modal -->
                            <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deletemodal" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-green">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Confirmation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="cancelAppointment.php" method="POST">
                                            <div class="modal-body">
                                                <input type="hidden" id="appointmentid" name="appointmentid"></input>
                                                Are you sure you want to remove appointment on <a id="date"></a> ?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn button-l" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn button-l">Delete</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                  <?php      }
                        
                    } else {
                        echo '                   
                        <div class="col-12">
                            
                            <div class="row justify-content-md-center">
                                <div class="container-xl">
                                    <div class="card">
                                        <div class="card-header text-center bg-green">My appointment</div>
                                        <div class="card-body bg-custom">
                                            <br><br><br>
                                            <h1 class="text-center">You do not have any upcoming appointment.</h1>
                                            <br><br><br>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>';
                    }

                } 

                else {
                    header("Location: index.php");
                }



            ?>
            


            </tbody>
        </table>
    </div>


</body>

<script>
    $(".deletebtn").click(function() {
        var $row = $(this).closest("tr");    // Find the row
        var $date = $row.find("#date").text(); // Find the text
        var $appointmentid = $row.find("#appointmentid").text();
        document.getElementById('date').innerHTML = $date ;
        document.getElementById('appointmentid').value = $appointmentid ;



    });

    $(document).ready(function() {
        $('#Admin').DataTable({
            "scrollX": true
        });
    } );




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