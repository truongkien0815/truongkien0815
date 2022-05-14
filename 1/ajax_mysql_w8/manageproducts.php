<?php
require_once './authvalidate.php';
require_once './config/database.php';
spl_autoload_register(function ($class_name)
{
    require './app/models/' . $class_name . '.php';
});

// Products
$productModel = new ProductModel();
$productList = $productModel->getProducts();
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
        <h1>Products</h1>
        <a href="createproduct.php" class="btn btn-primary">+ Add product</a>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Product Price</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($productList as $item) {
            ?>
                <tr>
                    <th scope="row"><?php echo $item['id'] ?></th>
                    <td><?php echo $item['product_name']; ?></td>
                    <td><?php echo $item['product_price']; ?></td>
                    <td><img src="./public/images/<?php echo $item['product_image']; ?>" alt="" height="80"></td>
                    <td>
                        <a href="#" class="btn btn-primary">Edit</a>

                        <form action="manageproducts.php" method="post" onsubmit="return deleteProduct('<?php echo $item['product_name']; ?>'">
                            <input type="hidden" name="id" value="<?php echo $item['id'] ?>);">
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                        
                    </td>
                </tr>
            <?php
            }
            ?>
            </tbody>
            </table>
    </div>
    <script>
        function deleteProduct(pName, pId) {
            if(confirm('Xóa ' + pName + ' không?')) {
                //xóa
            }
            else {
                return false;
            }
        }
    </script>
</body>
</html>