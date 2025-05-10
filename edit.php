<?php include "db.php"; ?>
<?php
$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM products WHERE id=$id");
$product = mysqli_fetch_assoc($result);
?>



<h2>Edit Product</h2>
<form method="post">

  Name: <input type="text" name="name" value="<?= $product['name'] ?>"><br><br>
  Price: <input type="text" name="price" value="<?= $product['price'] ?>"><br><br>
  <input type="submit" value="Update">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $price = $_POST['price'];
  mysqli_query($conn, "UPDATE products SET name='$name', price='$price' WHERE id=$id");
  echo "Product updated! <a href='index.php'>Go back</a>";
}
?>
