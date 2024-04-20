<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>MayTinhBiHu.com</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="../Imgs/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="../Content/styles.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<style>
    .ms-n5 {
        margin-left: -40px;
    }
</style>
<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: rgba(0, 0, 0, 0.2)">

    <div class="container px-4 px-lg-5">
        <a class="navbar-brand" href="../User/index.php">MayTinhBiHu.com</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
            <li class="nav-item"><a class="nav-link" href="../User/About.php">About</a></li>
                <li class="nav-item">
                    <a class="nav-link" href="../User/Products.php">Products</a>
                </li>
            </ul>
            <!-- Form tìm kiếm -->
            <form class="d-flex" action="" method="GET">
    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
    <button class="btn btn-outline-dark" type="submit">Search</button>
</form>
            <!-- Kết thúc Form tìm kiếm -->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Cart</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="../Account/Login">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Header-->
    <header class="bg-dark py-5">
        <div class="container px-4 px-lg-5 my-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">MayTinhBiHu.com</h1>
                <p class="lead fw-normal text-white-50 mb-0">Shop máy tính bất ổn </p>
            </div>
        </div>

    </header>
    <?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "computer_shop";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$products_per_page = 8;

// Check if search action is performed
if (isset($_GET['search'])) {
    $keyword = $_GET['search'];

    $sql_count = "SELECT COUNT(*) AS total FROM products WHERE name LIKE '%$keyword%'";
    $sql = "SELECT product_id, name, description, price, image_url FROM products WHERE name LIKE '%$keyword%'";

} else {
    // If no search action, retrieve all products
    $sql_count = "SELECT COUNT(*) AS total FROM products";
    $sql = "SELECT product_id, name, description, price, image_url FROM products";
}

$result_count = $conn->query($sql_count);
$row_count = $result_count->fetch_assoc();
$total_products = $row_count['total'];

$total_pages = ceil($total_products / $products_per_page);

$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

$offset = ($current_page - 1) * $products_per_page;

$sql .= " LIMIT $offset, $products_per_page";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<div class="product-container">';
    while($row = $result->fetch_assoc()) {
        echo '<div class="product">';
        echo '<img src="../Imgs/' . $row["image_url"] . '" alt="' . $row["name"] . '" class="product-image">';
        echo '<div class="product-info">';
        echo '<h2 class="product-name">' . $row["name"] . '</h2>';
        echo '<p class="product-description">' . $row["description"] . '</p>';
        echo '<p class="product-price">$' . $row["price"] . '</p>';
        echo '<a href="../User/add_to_cart.php?id=' . $row["product_id"] . '" class="btn btn-primary">Add to Cart</a>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';  

    echo '</br>';
    echo '</div>';
    echo '</div>';
} else {
    echo "0 results";
}

$conn->close();

?>





<style>
    .pagination {
        margin-top: 20px;
        display: flex;
        justify-content: center;
    }

    .pagination .page-link {
        color: #007bff;
        border: 1px solid #007bff;
        border-radius: 5px;
        padding: 8px 12px;
        margin-left: 5px;
        transition: background-color 0.3s;
    }

    .pagination .page-link:hover {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }
</style>

<style>
   .product-container {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); /* Tạo lưới với các cột có độ rộng tối thiểu là 300px */
  gap: 90px; /* Khoảng cách giữa các sản phẩm */
}

.product {
  width: 300px; /* Đặt kích thước cố định cho ô chứa sản phẩm */
  height: 400px; /* Đặt kích thước cố định cho ô chứa sản phẩm */
  margin-bottom: 20px;
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 10px;
}

.product-image {
  width: 100%; /* Kích thước hình ảnh là 100% của ô chứa */
  height: 70%; /* Đặt chiều cao tùy ý */
  object-fit: cover; /* Đảm bảo hình ảnh bên trong không bị vặn hoặc kéo dài */
  border-radius: 5px;
}

.product-info {
  margin-top: 10px;
}

.product-name {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 5px;
}

.product-description {
  margin-bottom: 10px;
}

.product-price {
  font-size: 16px;
  font-weight: bold;
  color: #007bff;
}
</style>
    <footer class="text-center text-lg-start text-dark"
            style="background-color: #ECEFF1">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-between p-4 text-white"
                 style="background-color: #212529 ">
        </section>
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold">MayTinhBiHu.com</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            MayTinhBiHu là thương hiệu được sinh ra từ giấc mơ của một game thủ, phát triển bởi tập thể các game thủ để phục vụ cho cộng đồng game thủ Việt.
                        </p>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold">Products</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            <a href="#!" class="text-dark">Laptop only</a>
                        </p>

                    </div>
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold">Useful links</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            <a href="#!" class="text-dark">Your Account</a>
                        </p>
                        <p>
                            <a href="#!" class="text-dark">Become an Affiliate</a>
                        </p>
                        <p>
                            <a href="#!" class="text-dark">Shipping Rates</a>
                        </p>
                        <p>
                            <a href="#!" class="text-dark">Help</a>
                        </p>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold">Contact</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p><a class="text-dark" href="https://www.facebook.com/KroPeiid">Diệp Bùi: </a>01652995196</p>
                        <p><a class="text-dark" href="https://www.facebook.com/KroPeiid">Nguỷn Duy: </a> 0326204040</p>
                        <p><a class="text-dark" href="https://www.facebook.com/KroPeiid">TamTran: </a>08247948998</p>
                        <p><a class="text-dark" href="https://www.facebook.com/KroPeiid">Thựn Tòn: </a> 01482355335</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="text-center p-3"
             style="background-color: rgba(0, 0, 0, 0.2)">
            <a class="text-dark" href="https://youtu.be/dQw4w9WgXcQ?si=KXrQQ18r4fZ_EXJx">MayTinhBiHu.com<a>
        </div>
    </footer>
    <!-- Footer -->
    <!-- End of .container -->
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="../Scripts/scripts.js"></script>
</body>
</html>
