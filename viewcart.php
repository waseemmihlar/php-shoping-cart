
<?php 
include "config.php";
session_start();
// echo "<pre>";
// print_r($_SESSION["cart"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php include "head.php"?>
</head>
<body>
    <div class="container">
        <div class="row">
            <h1 class="text-center">All Selected Items</h1><hr>
            <strong><a href="index.php">Home</a></strong>

            <table class="table table-hover">
                <thead>
            <tr>
            <th>No</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th>Action</th>
            </tr> 
            </thead>   
            <tbody>
                <?php 

                if(isset($_GET["delitem"])){
                    foreach($_SESSION["cart"] as $key=>$value){
                        if($value["pid"]==$_GET["delitem"]){
                            unset($_SESSION["cart"][$key]);
                        }
                    }
                }
                    if(!empty( $_SESSION["cart"])){
                        $total=0;
                        foreach($_SESSION["cart"] as $key => $value){
                            $subTotal=$value["price"]*$value["qty"];
                            $total+=$subTotal;
                            $itemNo=$key+1;
                            echo"<tr>
                            <td>{$itemNo}</td>
                            <td>{$value["pName"]}</td>
                            <td>{$value["qty"]}</td>
                            <td>{$value["price"]}</td>
                            <td>{$subTotal}</td>
                            <td><a href='viewcart.php?delitem={$value["pid"]}'>Remove</a></td>
                            </tr>";
                        }

                        echo"<tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><strong>Total</strong></td>
                        <td><strong>{$total}</strong></td>
                        </tr>";
                        
                    }
                    else{
                        header("location:index.php");
                    }
                ?>

            </tbody>
            <table>
        </div>
    </div>
</body>
</html>
