<?php 

session_start();

if(isset($_SESSION['role'])) {

    if($_SESSION['role'] === 'Doctor') {
        session_abort(); ?>

<?php $page = 'patienthistory'; require("Head(Doctor).php"); ?>
<body>


    <table id="patienthistory" class="table table-striped table-bordered"  style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>gender</th>
                <th>remark</th>
                <th>Action</th>
            </tr>
        </thead>
           
        <tbody>
            <?php 
            
            include_once('includes/autoLoad.php');

            $patients = new UserView();

            $patient = $patients->showAllPatient();

            foreach ($patient as $value) {
                echo "<tr>";
                echo "<td>" . $value['First_Name'] . " " . $value['Last_Name'] ."</td>";
                echo "<td>" . $value['Gender']  ."</td>";
                echo "<td>" . $value['Remark']  ."</td>"; ?>
                <td><a class="btn-sm button-l" href="\wdt\PatientHistoryDetailsPage.php?id=<?php echo $value['LoginID']; ?>">View History</a></td>
            <?php    echo "</tr>";
            }


            ?>
        </tbody>

    </table>
</body>



<script>
    $(document).ready(function() {
        $('#patienthistory').DataTable();
    } );

    $('#patienthistory').dataTable( {
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