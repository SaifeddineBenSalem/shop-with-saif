<?php
session_start();
if (!(isset($_SESSION["login"])))
    header("Location: ../login.php");
if (!isset($_GET["id"]) || trim($_GET["id"]) === '') 
     header("Location: index.php");
$id = $_GET["id"];
require_once '../../controlers/logged/ProductsControler.php';
require_once '../../controlers/logged/OrdersControler.php';
require_once '../../controlers/logged/UserControler.php';
$userControler = new UserControler();
$user=$userControler->getCurrentUser($_SESSION["login"]);
$role = $user["role"];
if ($role != "admin")
    header("Location: ../index.php");
$ordersControler = new OrdersControler();
$category = $ordersControler->getOrderById($id);
$productsControler = new ProductsControler();
$selectedProduct= $productsControler->getProductById($category["product"]);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'accept' &&  $category["status"] === "confirmed") {
    $id = intval($_POST['id']);
    $ordersControler->acceptOrder($id);
    $currentUrl = $_SERVER['PHP_SELF'];
    $currentUrl .=  "?action=vieworder";
    $currentUrl .= "&id=" . $_GET['id'];
   header("Location: " . $currentUrl);


}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'refuse' && ( ($category["status"] === "confirmed") 
    || ($category["status"] === "pending") ) ) {
    $id = intval($_POST['id']);
    $ordersControler->refuseOrder($id);
    $currentUrl = $_SERVER['PHP_SELF'];
    $currentUrl .=  "?action=vieworder";
    $currentUrl .= "&id=" . $_GET['id'];
    header("Location: " . $currentUrl);
}
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>DASHMIN - Bootstrap Admin Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="../../inc/logged/admin/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../../inc/logged/admin/lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../../inc/logged/admin/css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../../inc/logged/admin/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <?php include 'sidebar.php'?>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <?php include 'navbar.php'?>   

            <!-- Navbar End -->


            <!-- Blank Start -->
           <div class="container-fluid py-5 px-4">
    <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0 shadow-lg">
        <div class="col-md-6 text-center p-4 bg-white rounded shadow">
            <div class="mb-4">
                <h1 class="display-5 fw-bold text-primary">Order details</h1>
                <p class="text-muted">Here are the details of the selected order:</p>
            </div>
            <div class="text-start">
                <h4 class="mb-3">
                    <span class="text-secondary fw-bold">ID:</span>
                    <span class="text-dark"><?php echo $category["id"]; ?></span>
                </h4>
                <h4 class="mb-3">
                    <span class="text-secondary fw-bold">Selected product:</span>
                    <span class="text-dark"><a href="../index.php?action=productview&id=<?php echo $selectedProduct["id"]; ?>" target="_blank"><?php echo $selectedProduct["name"]; ?></a></span>
                </h4>
                <h4 class="mb-3">
                    <span class="text-secondary fw-bold">Size :</span>
                    <span class="text-dark"><?php echo $category["size"]; ?></span>
                </h4>
                <h4 class="mb-3">
                    <span class="text-secondary fw-bold">Color :</span>
                    <span class="text-dark"><?php echo $category["color"]; ?></span>
                </h4>
                <h4 class="mb-3">
                    <span class="text-secondary fw-bold">Quantity :</span>
                    <span class="text-dark"><?php echo $category["quantity"]; ?></span>
                </h4>
                <h4 class="mb-3">
                    <span class="text-secondary fw-bold">Poster:</span>
                    <span class="text-dark"><?php echo $category["poster"]; ?></span>
                </h4>
                <h4 class="mb-3">
                    <span class="text-secondary fw-bold">Posting Date:</span>
                    <span class="text-dark"><?php echo $category["posting_date"]; ?></span>
                </h4>
                
                <h4 class="mb-3">
                    <span class="text-secondary fw-bold">Status:</span>
                    <span class="text-dark"><?php echo $category["status"]; ?></span>
                </h4>
            </div>
            <?php if ($category["status"] === "confirmed") { ?>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
        <input type="hidden" name="action" value="accept">
        <button type="submit" class="btn btn-primary mt-4 px-4 py-2 rounded-pill shadow-sm">Accept</button>
    </form>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
        <input type="hidden" name="action" value="refuse">
        <button type="submit" class="btn btn-primary mt-4 px-4 py-2 rounded-pill shadow-sm">Refuse</button>
    </form>
<?php } if ($category["status"] === "pending") { ?>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
        <input type="hidden" name="action" value="refuse">
        <button type="submit" class="btn btn-primary mt-4 px-4 py-2 rounded-pill shadow-sm">Refuse</button>
    </form>
<?php } ?>

            <a href="index.php?action=orders" class="btn btn-primary mt-4 px-4 py-2 rounded-pill shadow-sm">Back to orders</a>

        </div>
    </div>
</div>

            <!-- Blank End -->


            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">Your Site Name</a>, All Right Reserved. 
                        </div>
                        <div class="col-12 col-sm-6 text-center text-sm-end">
                            <!--/*** This template is free as long as you keep the footer author’s credit link/attribution link/backlink. If you'd like to use the template without the footer author’s credit link/attribution link/backlink, you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". Thank you for your support. ***/-->
                            Designed By <a href="https://htmlcodex.com">HTML Codex</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../inc/logged/admin/lib/chart/chart.min.js"></script>
    <script src="../../inc/logged/admin/lib/easing/easing.min.js"></script>
    <script src="../../inc/logged/admin/lib/waypoints/waypoints.min.js"></script>
    <script src="../../inc/logged/admin/lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="../../inc/logged/admin/lib/tempusdominus/js/moment.min.js"></script>
    <script src="../../inc/logged/admin/lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="../../inc/logged/admin/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="../../inc/logged/admin/js/main.js"></script>
</body>

</html>