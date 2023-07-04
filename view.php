<?php
session_start();
include "config.php";
?>
<html lang="en">
  <head>
    <?php include "head.php"?>
  </head>
  <body>
    <div class="container">
        <div class="row">
      <h1 class="text-center">Add to Cart</h1>
      <hr>
      <strong><a href="index.php">Home</a></strong>
 
      <?php 

      if(isset($_POST["addCart"])){
        if(isset($_SESSION["cart"])){

          $pid_list=array_column($_SESSION["cart"],"pid");

          if(!in_array($_GET["id"],$pid_list)){
            $item=array(
              'pid'=>$_GET['id'],
              'pName'=>$_POST['pName'],
              'price'=>$_POST['price'],
              'qty'=>$_POST['qty']
            );
            $index=count($_SESSION["cart"]);
            $_SESSION["cart"][$index]=$item;
            header("location:viewcart.php");
          }else{
            
            header("location:index.php");
            echo "<script>alert('Item already added')</script>";
          }
    
        }else{
          $item=array(
            'pid'=>$_GET['id'],
            'pName'=>$_POST['pName'],
            'price'=>$_POST['price'],
            'qty'=>$_POST['qty']
          );

          $_SESSION["cart"][0]=$item;
          header("location:viewcart.php");
          }
      }

    if(isset($_GET["id"])){
        $qry="select * from products where sno = {$_GET["id"]}";
        $res=$con->query($qry); if($res->num_rows>0){ $row=$res->fetch_assoc();
      ?>
      <div class="col-md-4 col-sm-6 col-xs-12">
        <form action=<?php echo $_SERVER["REQUEST_URI"];?> method="post">
        <table class="table table-bordered">
          <tr>
            <td colspan=2><img src=<?php echo"$row[pic]"?>></td>
          </tr>
          <tr>
            <td>Product</td>
            <td>
                <p><strong><?php echo "$row[product_name]"?></strong></p>
            </td>
          </tr>
          <tr>
            <td>Brand Name</td>
            <td>
                <p><strong><?php echo "$row[brand_name]"?></strong></p>
            </td>
          </tr>
          <tr>
            <td>Price</td>
            <td>
                <p><strong><?php echo "$row[price]"?></strong></p>
            </td>
          </tr>
          <tr>
            <td>Ram</td>
            <td>
                <p><strong><?php echo "$row[ram]"?></strong></p>
            </td>
          </tr>
          <tr>
            <td>Storage</td>
            <td>
                <p><strong><?php echo "$row[storage]"?></strong></p>
            </td>
          </tr>
          <tr>
            <td>Display</td>
            <td>
                <p><strong><?php echo "$row[display]"?></strong></p>
            </td>
          </tr>
          <tr>
            <td>Battery</td>
            <td>
                <p><strong><?php echo "$row[battery]"?></strong></p>
            </td>
          </tr>
          <tr>
            <td>Enter Qty</td>
            <td>
            <input type="text" name="qty" required/>
            <input name="pName" value=<?php echo "$row[product_name]"?> type="hidden">
            <input name="price" value=<?php echo "$row[price]"?> type="hidden">
            </td>
          </tr>
          <tr>
            <td></td>
            <td><input type="submit" class="btn btn-success" value="Add cart" name="addCart"></td>
          </tr>
        </table>
        </form>
      </div>
      <?php

        }else{
            header("location:index.php");
        }

    }else{
        header("location:index.php");
    }
    ?>
    </div>
    </div>
  </body>
</html>
