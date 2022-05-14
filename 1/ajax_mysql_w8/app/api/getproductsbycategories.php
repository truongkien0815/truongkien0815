<?php
$input = json_decode(file_get_contents('php://input'), true);


require_once '../../config/database.php';
spl_autoload_register(function ($class_name)
{
    require '../models/' . $class_name . '.php';
});

// Tạo đối tượng sản phẩm
if(isset($input['checkedCategoriesId']))
{
    $id = $input['checkedCategoriesId'];
    $productModel = new ProductModel();
    if(empty($id)) {
        $item = $productModel->getProducts();
    }
    else {
        $item = $productModel->getProductsByCategory($id);
    }
    echo json_encode($item);
}
