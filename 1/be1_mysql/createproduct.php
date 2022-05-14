<?php
require_once './config/database.php';
spl_autoload_register(function ($class_name)
{
    require './app/models/' . $class_name . '.php';
});
if (isset($_POST['productSubmit'])) {
    $productModel = new ProductModel();
    
    $productName = $_POST['productName'];
    $productDescription = $_POST['productDescription'];
    $productPrice = $_POST['productPrice'];
    $productImage = $_POST['productImage'];
    
    $isAdded = $productModel->addProduct($productName, $productDescription, $productPrice, $productImage);
    if ($isAdded) {
        // Chuyển trang
        $uri = $_SERVER['SERVER_NAME'] . str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']) . 'manageproducts.php';
        header("Location: manageproducts.php");
    }
    else {
        echo "Thêm thất bại";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Thêm sản phẩm</h1>
        <form action="createproduct.php" method="post">
            <!-- Product Name -->
            <div class="mb-3">
                <label for="productName" class="form-label">Product name</label>
                <input type="text" name="productName" class="form-control" id="productName">
            </div>

            <!-- Product Description -->
            <div class="mb-3">
                <label for="productDescription" class="form-label">Product description</label>
                <input type="text" name="productDescription" class="form-control" id="productDescription">
            </div>

            <!-- Product Price -->
            <div class="mb-3">
                <label for="productPrice" class="form-label">Product price</label>
                <input type="text" name="productPrice" class="form-control" id="productPrice">
            </div>

            <!-- Product Image -->
            <div class="mb-3">
                <label for="productImage" class="form-label">Product image</label>
                <input type="text" name="productImage" class="form-control" id="productImage">
            </div>
            
            <button name="productSubmit" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>