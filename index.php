<?php include "db.php"; ?>

<h2>All Products</h2>
<a href="add.php">Add New Product</a>
<table border="1" cellpadding="10">
  <tr>
    <th>Name</th>
    <th>Price</th>
    <th>description</th>
    <th>Actions</th>
  </tr>
  <?php

    $result = mysqli_query($conn, "SELECT * FROM products");
    while ($row = mysqli_fetch_assoc($result)) {

      echo "<tr>
              <td>{$row['name']}</td>
              
              <td>{$row['description']}</td>
              <td>
                <a href='edit.php?id={$row['id']}'>Edit</a> | 
                <a href='delete.php?id={$row['id']}'>Delete</a>
              </td>
            </tr>";
    }
  ?>
</table>