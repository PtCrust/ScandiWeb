<?php
include "basic.php";

function return_SKU_value() {
  global $conn;
  $sql = "SELECT SKU FROM products";
  $data = mysqli_query($conn, $sql);

  return $data;

}
$skuu = return_SKU_value();

function validate($SKU){
  $value="save";
    while($uniqueSKU = mysqli_fetch_assoc($SKU)){
      if($_POST['sku'] == $uniqueSKU['SKU']){        
        echo"<p><span style='color:red;'>SKU </span>: You have entered this value before !</p>";
        echo"<b>Please Enter a unique Value<b>";
        $value="error";
      }
    } 
    return $value;
 }
function new_DVD_product($sku, $name,$price,$size) {
    global $conn;
    $sql="INSERT INTO products(SKU, name, price, size )
                       VALUES ('$sku','$name','$price','$size')";
    mysqli_query($conn, $sql);
    header("Location: index.php");
  }
function new_Furniture_product($sku, $name,$price,$height,$width,$length) {
    global $conn;
    $sql="INSERT INTO products(SKU, name, price, height, width , length )
                       VALUES ('$sku','$name','$price','$height','$width','$length')";
    mysqli_query($conn, $sql);
    header("Location: index.php");
 }
function new_Book_product($sku, $name,$price,$weight) {
  global $conn;
  $sql="INSERT INTO products(SKU, name, price, weight )
                     VALUES ('$sku','$name','$price','$weight')";
  mysqli_query($conn, $sql);
  header("Location: index.php");
}
function Input($val){
  $arr = [
    "DVD" => function()
    {
      $sku = $_POST['sku'];
      $name = $_POST['name'];
      $price = $_POST['price'];
      $size = $_POST['size'];
      return new_DVD_product($sku,$name,$price,$size);
    },
    "Furniture" => function()
    {
      $sku = $_POST['sku'];
      $name = $_POST['name'];
      $price = $_POST['price'];
      $height = $_POST['height'];
      $width = $_POST['width'];
      $length = $_POST['length']; 
      return new_Furniture_product($sku, $name,$price,$height,$width,$length);

    },
    "Book" => function()
    {
      $sku = $_POST['sku'];
      $name = $_POST['name'];
      $price = $_POST['price'];
      $weight = $_POST['weight'];
      return new_Book_product($sku, $name,$price,$weight);
    
    }
  ];
return $arr[$val]();
}
if(isset($_POST['form_submit'])){
    $value = validate($skuu);
    if($value == "save"){
      Input($_POST['switcher']);
    }
  
  
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="script.js"></script>
    <title>addProduct</title>
</head>
<body>
    <div class="container">
    <form  action="add.php" method="POST" id="product_form">
        <h1 class="display-1">Product Add</h1>
        <a href="index.php" class="btn btn-danger">Cancel</a>
        <button type="submit" name="form_submit" class="btn btn-success">Save</button>   
        <hr>
        <div class="row">
                    <div class="inputData">
                        <label>SKU</label>
                        <input type="text" required name="sku" id="sku"><br>
                        <p id="unique"></p><br>
                        <label>Name</label>
                        <input type="text" required name="name" id="name"><br><br>

                        <label>Price ($)</label>
                        <input type="text" required name="price" id="price" ><br><br>

                        <label>Type Switcher</label>
                        <select name="switcher" id="selectOP" onchange="selector.getval(value)">
                             <option value="" disabled selected >Select Switcher</option>
                             <option value="DVD" >DVD</option>
                             <option value="Furniture">Furniture</option>
                             <option value="Book">Book</option>
                        </select><br><br>
                        <div id="size" style="display: none;">
                          <label>Size (MB)</label>
                          <input type="text" name="size" placeholder="Size"><br><br>
                          <label><b>Please enter the size of DVD in Megabytes</b></label>
                        </div>
                        <div id="dimensions" style="display: none;">
                          <label>Dimensions (CM)</label>
                          <input type="text" name="height" placeholder="Height"><br>
                          <input type="text" name="width" placeholder="Width" ><br>
                          <input type="text" name="length" placeholder="Length" ><br><br>
                          <label><b>Please enter the Dimensions in centimeters</b></label>
                        </div>
                        <div id="weight" style="display: none;">
                          <label>Weight (K.g)</label>
                          <input type="text" name="weight" placeholder="Weight"><br><br>
                          <label><b>Please enter the Weight of the Book in Kilograms</b></label>
                        </div>
                        
                </div>     
            </div>
            <hr style="margin: 80px;">
            <h5 align="center">ScandiWeb Test Assignment </h5>
            </form>
          </div>

</body>
</html>



