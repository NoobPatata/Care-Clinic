<?php 

session_start();

if(isset($_SESSION['role'])) {

    if($_SESSION['role'] === 'Nurse') {
        session_abort(); ?>
        <?php $page = 'medicalinventory'; require("Head(Nurse).php"); ?>
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
    <div class="container-fluid">
        <!-- alert -->
        <?php
            if (isset($_GET['success'])){
                echo'
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Medicine or Services successfully updated.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }elseif (isset($_GET['deletesuccess'])){
                echo'
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Medicine or Services successfuly removed.</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>';

            }


            elseif (isset($_GET['error'])) {
                if ($_GET ['error'] == "EmptyFiels"){
                    echo'
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Medicine or services not update due to empty fields.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                }else if ($_GET ['error'] == "wrongPriceFormat") {
                    echo'
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Medicine or services not update due to invaalid price format.</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>';
                }
                
            }
        ?>
            <div class="row justify-content-md-end">
        <div class="col-md-auto">
            <button name="addinventory" class="btn-lg button-l mb-3 btn-block" onclick="window.location.href='AddMedicineAndServicesPage.php'">Add Medicine and Services</button>
        </div>
    </div>

 
    <table id="inventory" class="table table-striped table-bordered"  style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Type</th>
                <th style='display :none;'>MS_ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        include_once('includes/autoLoad.php'); 
        
        $inv = new InvView();
        $med = $inv->showInv();
        foreach ($med as $details) {

            echo "<tr>";
            echo "<td id='name'>". $details['Name'] ."</td>";
            echo "<td>". $details['Price'] ."</td>";
            echo "<td>". $details['Type'] ."</td>";
            echo "<td id='MS_ID' style='display :none;'>" . $details['MS_ID'] . "</td>";?>
            <td>
                <a class="btn-sm button-l" href="\wdt\EditMedicineAndServicesPage.php?id=<?php  echo $details["MS_ID"]; ?>" >Edit</a>
                <a data-toggle="modal" data-target="#delete" class="btn-sm button-l deletebtn" >Delete</a>
            </td>
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
                            <form action="deleteMed.php" method="POST">
                                <div class="modal-body">
                                    <input type="hidden" id="MS_ID" name="MS_ID"></input>
                                    Are you sure you want to remove <a id="name"></a> ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn button-l" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn button-l">Delete</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>
    </div>
    
</body>

<script>
    $(".deletebtn").click(function() {
        var $row = $(this).closest("tr");    // Find the row
        var $name = $row.find("#name").text(); // Find the text
        var $MS_ID = $row.find("#MS_ID").text();
        document.getElementById('name').innerHTML = $name ;
        document.getElementById('MS_ID').value = $MS_ID ;
    });


    $(document).ready(function() {
        $('#inventory').DataTable({
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