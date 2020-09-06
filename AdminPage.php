<?php 

session_start();

if(isset($_SESSION['role'])) {

    if($_SESSION['role'] === 'Admin') {
        session_abort(); ?>
        <?php $page = 'home'; require("Head(Admin).php"); ?>

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
        <h1 class="">Users</h1>
        <hr class="hr-green mt-0">
        <?php
            if (isset($_GET['success'])){
                echo'
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>User Successfully Removed</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>';
            }
        ?>

        <table id="Admin" class="table table-striped table-bordered"  style="width:100%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th style="display :none;">ID</th>
                    <th>Action</th>
                </tr>
            </thead>
            
            <tbody> 

                <?php 
                include_once("includes/autoLoad.php");
                $data = new UserView();
                $users = $data->showAllStaff();
                foreach($users as $user) {
                    echo "<tr>";
                    echo "<td id='name'>" . $user["First_Name"] . " " . $user['Last_Name'] .  "</td>";
                    echo "<td>" . $user['Email'] . "</td>";
                    echo "<td>" . $user['User'] . "</td>";
                    echo "<td id='userid' style='display :none;'>" . $user['LoginID'] . "</td>"; ?>

                    <td>
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
                                <form action="deleteStaff.php?" method="POST">
                                    <div class="modal-body">
                                        <input type="hidden" id="userid" name="userid"></input>
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


            <?php }
                
                ?>
            </tbody>

        </table>
    </div>
</body>

<script>
    $(".deletebtn").click(function() {
        var $row = $(this).closest("tr");    // Find the row
        var $name = $row.find("#name").text(); // Find the text
        var $userid = $row.find("#userid").text();
        document.getElementById('name').innerHTML = $name ;
        document.getElementById('userid').value = $userid ;
    });

    $(document).ready(function() {
        $('#Admin').DataTable({
            "scrollX": true
        });
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