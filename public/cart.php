<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/style/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <link rel="icon" href="data:,">
    <link rel="stylesheet" href="/assets/style/header.css">
    <link rel="stylesheet" href="/assets/style/style.css">
    <title>Boutique Shop</title>
</head>

<?php
    session_start();

    try {
        $host = "localhost";
        $dbname = "shop_app";
        $username = "root";
        $password = "root";
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        $customer_id = $_SESSION['id'];

        // Fetch the order items for the customer from the order_items table
        $query = "SELECT oi.*, p.name AS product_name 
                FROM order_items oi 
                INNER JOIN products p ON oi.product_id = p.id 
                WHERE oi.customer_id = :customer_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(":customer_id", $customer_id);
        $stmt->execute();
        $order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <table class="table container mt-5" >
        <thead>
            <tr>
            
            <th scope="col">Product</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $cart_total = 0;
        // Display the order items
        foreach ($order_items as $order_item) {
        ?>    
            <tr>
                <td><?php echo $order_item['product_name']; ?></td>
                <td> <?php echo $order_item['quantity']; ?></td>
                <td><?php echo $order_item['price'] . 'DA'; ?> </td>
            </tr>
          
           
            </tbody>
       
        <?php
        
        }
        ?></table>
        <?php
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

?>