<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="icon" href="data:,">
    <title>Add Products</title>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="title-add-product">
            <h2 class="h2"> Add Products</h2>
        </div>
    </div>
    <div class="container">
        <form action="add_products_sql.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Name :</label>
                <input type="text" class="form-control" id="name" placeholder="Product Name" name="name">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">description :</label>
                <input type="text" class="form-control" id="description" placeholder="Description" name="description">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price :</label>
                <input type="text" class="form-control" id="price" placeholder="500 DA" name="price">
            </div>
            <div class="mb-3">
                <label for="stock_quantity" class="form-label">Quantity in the stock :</label>
                <input type="number" class="form-control" id="stock_quantity" placeholder="Quantity in the stock" name="stock_quantity">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image of the Product:</label>
                <input type="file" class="form-control" id="image" name="image">
            </div>
                <button type="submit" class="btn btn-primary">Add Product</button>
        
        </form> 
    </div>



    
    
        
</body>
</html>

