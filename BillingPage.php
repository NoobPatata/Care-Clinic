<?php 

session_start();

if(isset($_SESSION['role'])) {

    if($_SESSION['role'] === 'Nurse') {
        session_abort(); ?>
        <?php $page = 'billing'; require("Head(Nurse).php"); ?>





<body>               
    <div class="container-fluid">
        <h2>Pending Payment</h2>
        <hr class="hr-green mt-0">
        <?php
            include_once('includes/autoLoad.php');
            $bills = new BillingView();
            $bill = $bills->showAllBill();
            if(!empty($bill)) {
                echo'
                <table class="table " id="pending-payment">
                <thead>
                    <tr>
                        <th >Invoice ID</th>
                        <th>Patient Name</th>
                        <th>Price</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tbody>';

                foreach ($bill as $value) {
                    echo "<tr>";
                    echo "<td>INV ".  $value['BillID'] . "</td>";
                    echo "<td>" . $value['First_Name'] . " " .$value["Last_Name"]."</td>";
                    echo "<td> RM ". $value['GrandTotal'] ."</td>"; ?>
                    <td><a class="btn-sm button-l" href="\wdt\PaymentPage.php?id=<?php echo $value["BillID"]; ?>&price=<?php echo $value['GrandTotal']?>">Pay Now</a>
                

                <?php echo "</tr>";   } 
                echo'
                </tbody>
                </table>
    </div>';
            } else {
                echo '                        
                <div class="row justify-content-md-center">
                    <div class="container-xl">
                        <div class="card">
                            <div class="card-header text-center bg-green">Pending Payment</div>
                            <div class="card-body bg-custom">
                                <br><br><br>
                                <h1 class="text-center">You do not have any pending payments.</h1>
                                <br><br><br>

                            </div>
                        </div>
                    </div>
                </div><br>';
        }
        ?>                    
</body>


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


