<?php 

session_start();

if(isset($_SESSION['role'])) {

    if($_SESSION['role'] === 'Nurse') {
        session_abort(); ?>

<?php $page = 'patient'; require("Head(Nurse).php"); ?>

<body>


 
    <table id="patient" class="table table-striped table-bordered"  style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Address</th>
                <th>Contact Number</th>
                <th>Email</th>
                <th>Remark</th>
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
                echo "<td>" . $value['Date_of_Birth']  ."</td>";
                echo "<td>" . $value['Address']  ."</td>";
                echo "<td>" . $value['Contact_Number']  ."</td>";
                echo "<td>" . $value['Email']  ."</td>";
                echo "<td>" . $value['Remark']  ."</td>";
                echo "</tr>";
            }


        ?>
           
        </tbody>

    </table>
</body>



<script>
    $(document).ready(function() {
        $('#patient').DataTable();
    } );

    $('#patient').dataTable( {
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