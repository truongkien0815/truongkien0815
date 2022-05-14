<?php
require_once './config/database.php';
spl_autoload_register(function ($class_name)
{
    require './app/models/' . $class_name . '.php';
});

// Tạo đối tượng sản phẩm
if(isset($_GET['id']))
{
    $id = $_GET['id'];
    $productModel = new ProductModel();
    $item = $productModel->getProductById($id);
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
        <div class="row">
            <!-- 1 item -->
            
            <div class="col-md-4">
                <img src="./public/images/<?php echo $item['product_photo']; ?>" alt="" class="img-fluid">
            </div>
            <div class="col-md-8">
                <h1><?php echo $item['product_name']; ?></h1>
                <p class="product-price">
                    <?php echo $item['product_price']; ?>
                </p>
                <p class="product-description">
                    <?php echo $item['product_description']; ?>
                </p>
            </div>
            
        </div>
    </div>
</body>
</html>