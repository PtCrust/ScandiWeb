<?php
ob_start();
include "basic.php";
function products_list() {
    global $conn;
    $sql = "SELECT * FROM products";
    $data = mysqli_query($conn, $sql);
    return $data;

}
$dataa = products_list();

function massDelete($val){
            global $conn;
            foreach($val as $id){
            $sql = "DELETE FROM products WHERE id = '$id'";
            mysqli_query($conn, $sql);
            }
        header("Location:index.php");
}
if(isset($_POST['check'])){
massDelete($_POST['check']);}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Products List</title>
</head>
<body>
    <div class="container">
        <form action="index.php" method="post">    
        <h1 class="display-1">Products List</h1>
        <button type="submit" id="delete-product-btn" class="btn btn-danger" >MASS DELETE</button>
        <a href="add.php" class="btn btn-success">ADD</a>
        <hr>
        <div class="row">
        <section class="cards">
            <div class="content">
                 <?php while($product = mysqli_fetch_assoc($dataa)){  ?>
                <div class="card">
                  <div class="info">
                    <input type="checkbox" class="delete-checkbox" name="check[]" id="check" value="<?php echo $product['id']?>" style="margin-right: 90%;">
                   
                    <h3>SKU : <?php echo $product["SKU"]; ?> </h3>
                    <p>Name : <?php echo $product["name"]; ?> </p>
                    <p>Price : <?php echo ($product["price"]." $"); ?> </p>
                    
                    <?php if (isset($product["size"])) {?>
                    <p>Size : <?php echo $product["size"]; ?> </p> <?php }?>
                    
                    <?php if (isset($product["height"])) {?>
                    <p>Dimensions : <?php echo ($product["height"]."x".$product["width"]."x".$product["length"]); ?> </p>
                    </p> <?php }?>
                    
                    <?php if (isset($product["weight"])) {?>
                    <p>Weight : <?php echo ($product["weight"]." K.g"); ?> </p><?php }?>  
                </div>
                </div>

                    <?php }?>
            </div>            
        </section>
        </div>
        <hr>
        <h5 align="center">ScandiWeb Test Assignment </h5>
        </form>
    </div>
</body>
</html>
