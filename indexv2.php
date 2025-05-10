<?php include "db.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management System</title>
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
        }
        
        .container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
        }
        
        .page-title {
            color: var(--primary-dark);
            font-size: 2rem;
            font-weight: 600;
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
        
        .add-product-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background-color: var(--primary);
            color: white;
            padding: 0.75rem 1.5rem;
            text-decoration: none;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
            font-weight: 500;
            box-shadow: 0 4px 6px -1px rgba(67, 97, 238, 0.3);
        }
        
        .add-product-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(67, 97, 238, 0.3);
        }
        
        .card {
            background: white;
            border-radius: 0.75rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid var(--light-gray);
        }
        
        .products-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .products-table thead {
            background: linear-gradient(to right, var(--primary), var(--secondary));
            color: white;
        }
        
        .products-table th {
            padding: 1.25rem 1.5rem;
            text-align: left;
            font-weight: 500;
            font-size: 0.875rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .products-table td {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid var(--light-gray);
            font-size: 0.9375rem;
        }
        
        .products-table tr:last-child td {
            border-bottom: none;
        }
        
        .products-table tr:nth-child(even) {
            background-color: rgba(67, 97, 238, 0.02);
        }
        
        .products-table tr:hover {
            background-color: rgba(67, 97, 238, 0.05);
        }
        
        .price-cell {
            font-weight: 600;
            color: var(--primary-dark);
        }
        
        .actions-cell {
            width: 220px;
        }
        
        .action-buttons {
            display: flex;
            gap: 0.75rem;
        }
        
        .action-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.375rem;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
            font-size: 0.8125rem;
            border: 1px solid transparent;
        }
        
        .edit-btn {
            background-color: rgba(72, 149, 239, 0.1);
            color: var(--primary);
            border-color: rgba(72, 149, 239, 0.2);
        }
        
        .edit-btn:hover {
            background-color: rgba(72, 149, 239, 0.2);
        }
        
        .delete-btn {
            background-color: rgba(247, 37, 133, 0.1);
            color: var(--danger);
            border-color: rgba(247, 37, 133, 0.2);
        }
        
        .delete-btn:hover {
            background-color: rgba(247, 37, 133, 0.2);
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .products-table tbody tr {
            animation: fadeIn 0.3s ease forwards;
        }
        
        .products-table tbody tr:nth-child(1) { animation-delay: 0.05s; }
        .products-table tbody tr:nth-child(2) { animation-delay: 0.1s; }
        .products-table tbody tr:nth-child(3) { animation-delay: 0.15s; }
        .products-table tbody tr:nth-child(4) { animation-delay: 0.2s; }
        
        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 1.25rem;
            }
            
            .page-header {
                flex-direction: column;
                gap: 1rem;
                align-items: flex-start;
                margin-bottom: 1.5rem;
            }
            
            .products-table {
                display: block;
                overflow-x: auto;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .action-btn {
                justify-content: flex-start;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="page-header">
            <h1 class="page-title">Product Management</h1>
            <a href="add.php" class="add-product-btn">
                <i class="fas fa-plus-circle"></i>
                Add New Product
            </a>
        </div>
        
        <div class="card">
            <table class="products-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Product Name</th>
                        <th>Price</th>
                        <th class="actions-cell">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $result = mysqli_query($conn, "SELECT * FROM products");
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>{$row['id']}</td>
                                <td>{$row['name']}</td>
                                <td class='price-cell'><i class='fas fa-dollar-sign'></i> {$row['price']}</td>
                                <td>
                                    <div class='action-buttons'>
                                        <a href='edit.php?id={$row['id']}' class='action-btn edit-btn'>
                                            <i class='fas fa-edit'></i>
                                            Edit
                                        </a>
                                        <a href='delete.php?id={$row['id']}' class='action-btn delete-btn'>
                                            <i class='fas fa-trash-alt'></i>
                                            Delete
                                        </a>
                                    </div>
                                </td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>