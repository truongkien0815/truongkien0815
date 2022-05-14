<?php
session_start();
require_once './config/database.php';
spl_autoload_register(function ($class_name)
{
    require './app/models/' . $class_name . '.php';
});

// Products
$productModel = new ProductModel();
$productList = $productModel->getProducts();

// Categories
$categoryModel = new CategoryModel();
$categoryList = $categoryModel->getCategories();
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
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAccount" aria-controls="navbarAccount" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarAccount">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <?php
        if(isset($_SESSION['username'])) {
        ?>
        <li class="nav-item" style="color: #fff">
          Xin chào, <a href="#"><?php echo $_SESSION['username']['user_username'] ?></a>
          <a href="logout.php">Logout</a>
        </li>
        <?php
        }
        else {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>
        <?php
        }
        ?>
      </ul>
    </div>
  </div>
</nav>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <?php
        foreach ($categoryList as $cate) {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="category.php?id=<?php echo $cate['id'] ?>"><?php echo $cate['category_name']; ?></a>
        </li>
        <?php
        }
        ?>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
    <div class="container">
      <div class="row">
        <div class="col-md-2">
          
          <?php
          foreach ($categoryList as $cate) {
          ?>
          
          <label>
            <input type="checkbox" name="categories-checkbox" id="categories-<?php echo $cate['id'] ?>" value="<?php echo $cate['id'] ?>" class="categories-checkbox">
            <?php echo $cate['category_name']; ?>
          </label>
          <br>
          <?php
          }
          ?>

        </div>
        <div class="col-md-6">
          <div class="row" id="product-list">
              <!-- 1 item -->
              <?php
              foreach ($productList as $item) {
              ?>
              <div class="col-md-4">
                  <a onclick="getProductDetail(<?php echo $item['id'] ?>)"><img src="./public/images/<?php echo $item['product_photo']; ?>" alt="" class="img-fluid"></a>
                  <h3><a href="product.php?id=<?php echo $item['id'] ?>"><?php echo $item['product_name']; ?></a></h3>
                  <p class="product-price">
                      <?php echo $item['product_price']; ?>
                  </p>
              </div>
              <?php
              }
              ?>
          </div>
        </div>
        <div class="col-md-4">
          <h2>Chi tiet san pham</h2>
          <div class="spinner-border d-none loader" role="status">
            <span class="visually-hidden">Loading...</span>
          </div>
          <div id="result"></div>
        </div>
      </div>
        
    </div>
    <script src="./public/js/ajax.js"></script>
</body>
</html>