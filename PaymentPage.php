<?php 

session_start();

if(isset($_SESSION['role'])) {

    if($_SESSION['role'] === 'Nurse') {
        session_abort(); ?>

<?php $page = 'billing'; require("Head(Nurse).php"); ?>


<div class="container-fluid">
    <h2>Billing</h2>
    <hr class="hr-green mt-0">
    <!-- alert -->
    <?php
    if (isset($_GET['error'])) {
        if ($_GET ['error'] == "EmptyFiels"){
            echo'
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please enter amount paid.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }elseif ($_GET ['error'] == "wrongPriceFormat"){
            echo'
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please enter valid amount.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }elseif ($_GET ['error'] == "amountinvalid"){
            echo'
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Please enter valid amount.</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>';
        }
    }?>
    <table id="billing" class="table table-striped table-bordered" data-card-ignore>
        <thead>
            <tr>
                <th>Medicine / Services</th>
                <th>Price</th>

            </tr>
        </thead>
        <tbody>
            <?php 
            
            include_once('includes/autoLoad.php');

            $billID = $_GET['id'];
            $total = $_GET['price'];

            $bill = new BillingView();
            $details = $bill->showBillDetails($billID);

            foreach($details as $value) {
                echo "<tr>";
                echo "<td>". $value['Name']."</td>";
                echo "<td>RM ". $value['Price']."</td>";
                echo "</tr>";
            }
            
            ?>

           
        </tbody>
    </table>

</div>





<form id="billing-form" method="POST" action="makePayment.php ?>">
    <div class="form-group row justify-content-end">
        <label for="total" class="col-sm-1 col-form-label">Total:</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="total" name="total" readonly value='RM <?php echo $total; ?>'>
        </div>
    </div>
    <div class="form-group row justify-content-end">
        <label for="amountpaid" class="col-sm-1 col-form-label">Amount Paid:</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="amountpaid" name="amountpaid" onkeyup="calculatebalance(this.value)">
        </div>
    </div>
    <div class="form-group row justify-content-end">
        <label for="balance" class="col-sm-1 col-form-label" readonly>Balance:</label>
        <div class="col-sm-3">
            <input type="text" class="form-control" id="balance" name="balance">
        </div>
    </div>
    <br>
    <div class="row justify-content-md-end">
        <div class="col-md-auto">
            <button type="submit" id="pay" name="pay" class="btn-sm button-l mb-3 btn-block" >Pay</button>

        </div>
    </div>
    <input type = 'hidden' name = 'billID' value="<?php echo $billID;?>">
</form>
<script>
    bootstrapValidate('#amountpaid', 'numeric:Amount Paid contains numbers only!')

    function calculatebalance(amountpaid) {
        var value = document.getElementById('total').value;
        var total = value.replace('RM' , "");
        var balance = amountpaid - total;
        var display = document.getElementById('balance');
        display.value = balance;

       

    }
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