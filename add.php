<?php
ob_start();
include "basic.php";

abstract class Switcher{
  var $sku;
  var $name;
  var $price;
  function __construct($sku,$name,$price)
  {
      $this->sku   = $sku;
      $this->name  = $name;
      $this->price = $price; 
  }    
    
  function validate()
  {
      $value="save";
      global $conn;
      $sql = "SELECT SKU FROM products";
      $data = mysqli_query($conn, $sql);

      while($uniqueSKU = mysqli_fetch_assoc($data))
      {
          if($_POST['sku'] == $uniqueSKU['SKU'])
          {        
            echo"<p><span style='color:red;'>SKU </span>: You have entered this value before !</p>";
            echo"<b>Please Enter a unique Value<b>";
            $value="error";
          }
      } 
      return $value;
  }
    abstract function save_new_product();
}
class DVD extends Switcher
{
  var $size;
  function __construct($sku,$name,$price,$size)
  {
      parent::__construct($sku,$name,$price);
      $this->size = $size;
  }
  function save_new_product()
  {
      global $conn;        
      $sql="INSERT INTO products(SKU, name, price, size )
                  VALUES ('$this->sku','$this->name','$this->price','$this->size')";
      mysqli_query($conn, $sql);
      header("Location:index.php");
  }
}
class Furniture extends Switcher
{
  var $height;
  var $width;
  var $length;
  function __construct($sku,$name,$price,$height,$width,$length)
  {
      parent::__construct($sku,$name,$price);
      $this->height  = $height;
      $this->width   = $width;
      $this->length  = $length;
  }
  function save_new_product()
  {
    global $conn;
    $sql="INSERT INTO products(SKU, name, price, height, width , length )
                 VALUES ('$this->sku','$this->name','$this->price','$this->height','$this->width','$this->length')";
    mysqli_query($conn, $sql);
     header("Location: index.php");
  }
}
class Book extends Switcher
{
  var $weight;
  function __construct($sku,$name,$price,$weight)
  {
      parent::__construct($sku,$name,$price);
      $this->weight  = $weight;
  }
  function save_new_product()
  {
    global $conn;
    $sql="INSERT INTO products(SKU, name, price, weight )
                 VALUES ('$this->sku','$this->name','$this->price','$this->weight')";
    mysqli_query($conn, $sql);
    header("Location: index.php");
  }
}

function Input($val)
{
  $arr = [
    "DVD" => function()
    {
      $sku   = $_POST['sku'];
      $name  = $_POST['name'];
      $price = $_POST['price'];
      $size  = $_POST['size'];
      $dvd   = new DVD($sku,$name,$price,$size);
      if($dvd->validate()=="save")
      {
        return $dvd->save_new_product();
      }
    },
    "Furniture" => function()
    {
      $sku       = $_POST['sku'];
      $name      = $_POST['name'];
      $price     = $_POST['price'];
      $height    = $_POST['height'];
      $width     = $_POST['width'];
      $length    = $_POST['length'];
      $furniture = new Furniture($sku, $name,$price,$height,$width,$length);
      if($furniture->validate()=="save")
      {
        return $furniture->save_new_product();
      } 
    },
    "Book" => function()
    {
      $sku    = $_POST['sku'];
      $name   = $_POST['name'];
      $price  = $_POST['price'];
      $weight = $_POST['weight'];
      $book   = new Book($sku, $name,$price,$weight); 
      if($book->validate()=="save")
      {
        return $book->save_new_product();
      }    
    }
  ];
return $arr[$val]();
}

if(isset($_POST['form_submit']))
{
  Input($_POST['switcher']);
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
                        <input type="text" pattern="[a-zA-Z0-9-_]+" required name="sku" id="sku"><br><br>
                        
                        <label>Name</label>
                        <input type="text" required name="name" id="name"><br><br>

                        <label>Price ($)</label>
                        <input type="number" required name="price" id="price" ><br><br>

                        <label>Type Switcher</label>
                        <select name="switcher" id="productType" onchange="selector.getval(value)">
                             <option value="" disabled selected >Select Switcher</option>
                             <option value="DVD" >DVD</option>
                             <option value="Furniture">Furniture</option>
                             <option value="Book">Book</option>
                        </select><br><br>
                        <div id="sizee" style="display: none;">
                          <label>Size (MB)</label>
                          <input type="number"id="size" name="size" placeholder="Size"><br><br>
                          <label><b>Please enter the size of DVD in Megabytes</b></label>
                        </div>
                        <div id="dimensions" style="display: none;">
                          <label>Dimensions (CM)</label>
                          <input type="number" id="height" name="height" placeholder="Height"><br>
                          <input type="number" id="width" name="width" placeholder="Width" ><br>
                          <input type="number" id="length" name="length" placeholder="Length" ><br><br>
                          <label><b>Please enter the Dimensions in centimeters</b></label>
                        </div>
                        <div id="weightt" style="display: none;">
                          <label>Weight (K.g)</label>
                          <input type="number" id="weight" name="weight" placeholder="Weight"><br><br>
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

