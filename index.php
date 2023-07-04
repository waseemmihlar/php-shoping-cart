<!DOCTYPE html>
<?php include "config.php"?>
<html lang="en">
<head>
   <?php include "head.php";?>
</head>
<body>
   <div class="container">
    <div class="row">
        <h1 class="text-center">Add to Cart</h1><hr>
        <?php 
        $qry="select * from products";
        $res=$con->query($qry);

        if($res->num_rows>0){
            while($row=$res->fetch_assoc()){
               ?>
               <div class="col-md-4 col-sm-6 col-lg-3 col-xs-12 text-center">
               <img src=<?php echo "$row[pic]";?>>
               <p><strong><a href="#"><?php echo "$row[product_name]";?></a></strong></p>
               <h5 class="text-danger"><?php echo "$row[price]";?></h5>
               <p><a href="view.php?id=<?php echo "$row[sno]";?>" class="btn btn-success">view details</a></p>
               </div>
               <?php

            }
        }
        ?>

    </div>
   </div>
</body>
</html>