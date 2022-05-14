<?php
$input = json_decode(file_get_contents('php://input'),true);

require_once '../../config/database.php';
spl_autoload_register(function ($class_name)
{
    require '../models/' . $class_name . '.php';
});

// Tạo đối tượng sản phẩm
if(isset($input['productName']))
{
    $name = $input['productName'];
    $productModel = new ProductModel();
    $item = $productModel->searchProducts($name);
    echo json_encode($item);
}



?>