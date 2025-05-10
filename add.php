<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Product</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a56d4;
            --secondary: #3f37c9;
            --accent: #4895ef;
            --light: #f8f9fa;
            --dark: #212529;
            --success: #4cc9f0;
            --warning: #f8961e;
            --danger: #f72585;
            --gray: #adb5bd;
            --light-gray: #e9ecef;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        
        body {
            background-color: #f8fafc;
            color: var(--dark);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }
        
        .container {
            max-width: 600px;
            width: 100%;
        }
        
        .card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid var(--light-gray);
            padding: 2.5rem;
        }
        
        .page-title {
            color: var(--primary-dark);
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 2rem;
            position: relative;
            display: inline-block;
        }
        
        .page-title::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 50px;
            height: 4px;
            background: var(--accent);
            border-radius: 2px;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }
        
        .form-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--gray);
            border-radius: 0.5rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }
        
        .form-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        .submit-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
            width: 100%;
            margin-top: 1rem;
        }
        
        .submit-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
        }
        
        .message {
            padding: 1rem;
            border-radius: 0.5rem;
            margin-top: 1.5rem;
            background-color: rgba(76, 201, 240, 0.1);
            border: 1px solid rgba(76, 201, 240, 0.2);
            color: var(--dark);
        }
        
        .message a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
        }
        
        .message a:hover {
            text-decoration: underline;
        }
        
        @media (max-width: 768px) {
            body {
                padding: 1.25rem;
                align-items: flex-start;
            }
            
            .card {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2 class="page-title">Add Product</h2>
            
            

            <form method="post">
                <div class="form-group">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" name="name" id="name" class="form-input" required>
                </div>
                
                <div class="form-group">
                    <label for="price" class="form-label">Price:</label>
                    <input type="text" name="price" id="price" class="form-input" required>
                </div>
        
                <div class="form-group">
                    <label for="des" class="form-label">description product </label>
                    <input type="text" name="des" id="des" class="form-input" required>
                </div>
                
                <button type="submit" class="submit-btn">Add Product</button>
            </form>
            
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['name'];
                $price = $_POST['price'];
                $des = $_POST['des'];
                mysqli_query($conn, "INSERT INTO products (name, price , description ) VALUES ('$name', '$price' , '$des')");
                echo 'Product added! <a href="index.php">Go back</a>';
            }
            ?>
        </div>
    </div>
</body>
</html>