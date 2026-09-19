<?php
session_start();
if (!(isset($_SESSION["login"])))
    header("Location: ../../index.php?action=login");
if (!isset($_GET["id"]) || trim($_GET["id"]) === '') 
     header("Location: index.php");
$id = $_GET["id"];
require_once '../../controlers/logged/ProductsControler.php';
require_once '../../controlers/logged/UserControler.php';
$userControler = new UserControler();
$user=$userControler->getCurrentUser($_SESSION["login"]);
$role = $user["role"];
if ($role != "admin")
    header("Location: ../index.php");
$productsControler = new ProductsControler();
$category = $productsControler->getProductById($id);
echo $category;
if ($category === false)
    header("Location: index.php?action=products");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'archive' && $category["status"] === "Active") {
    $id = intval($_POST['id']);
    $productsControler->archiveProduct($id);
    $currentUrl = $_SERVER['PHP_SELF'];
    $currentUrl .=  "?action=viewproduct";
    $currentUrl .= "&id=" . $_GET['id'];
    header("Location: " . $currentUrl);

}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'restore' && $category["status"] === "Archived") {
    $id = intval($_POST['id']);
    $productsControler->restoreProduct($id);
    $currentUrl = $_SERVER['PHP_SELF'];
    $currentUrl .=  "?action=viewproduct";
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
    <div class="row min-vh-100 bg-light rounded align-items-center justify-content-center mx-0 shadow-lg">
    <div class="col-md-6 text-center p-4 bg-white rounded shadow">
        <div class="mb-4">
            <h1 class="display-5 fw-bold text-primary">Product Details</h1>
            <p class="text-muted">Here are the details of the selected product:</p>
        </div>
        <div class="text-start">
            <h4 class="mb-3">
                <span class="text-secondary fw-bold">Name:</span>
                <span class="text-dark"><?php echo $category["name"]; ?></span>
            </h4>
            <h4 class="mb-3">
                <span class="text-secondary fw-bold">Description:</span>
                <span class="text-dark"><?php echo $category["description"]; ?></span>
            </h4>
            <h4 class="mb-3">
                <span class="text-secondary fw-bold">Category:</span>
                <span class="text-dark"><?php echo $category["category"]; ?></span>
            </h4>
            <h4 class="mb-3">
                <span class="text-secondary fw-bold">Price:</span>
                <span class="text-dark"><?php echo $category["price"]; ?> DT</span>
            </h4>
            <?php if ($category["promo"]!= null) {?>
            <h4 class="mb-3">
                <span class="text-secondary fw-bold">Promo:</span>
                <span class="text-dark"><?php echo $category["promo"]; ?> DT</span>
            </h4>
            <?php }?>
            <h4 class="mb-3">
                <span class="text-secondary fw-bold">Sizes:</span>
                <?php $sizesArray = explode(",",$category["sizes"]); ?>
                <span class="text-dark"><?php foreach($sizesArray as $size) echo $size . " "; ?></span>
            </h4>
            <h4 class="mb-3">
                <span class="text-secondary fw-bold">Colors:</span>
                <?php $colorsArray = explode(",",$category["colors"]); ?>
                <span class="text-dark"><?php foreach($colorsArray as $size) echo $size . " "; ?></span>
            </h4>
            <h4 class="mb-3">
                <span class="text-secondary fw-bold">Poster:</span>
                <span class="text-dark"><?php echo $category["poster"]; ?></span>
            </h4>
            <h4 class="mb-3">
                <span class="text-secondary fw-bold">Posting Date:</span>
                <span class="text-dark"><?php echo $category["posting_date"]; ?></span>
            </h4>
           <?php if ($category["modified_by_name"] != null ){?>
            <h4 class="mb-3">
                <span class="text-secondary fw-bold">Last modified by:</span>
                <span class="text-dark"><?php echo $category["modified_by_name"]; ?></span>
            </h4>
            <h4 class="mb-3">

                <span class="text-secondary fw-bold">Posting Date:</span>
                <span class="text-dark"><?php echo $category["modified_by_time"]; ?></span>
            </h4>
        <?php }?>
            
            <h4 class="mb-3">
                <span class="text-secondary fw-bold">Status:</span>
                <span class="text-dark"><?php echo $category["status"]; ?></span>
            </h4>
        </div>
        <a href="index.php?action=modifyproduct&id=<?php echo $category["id"]; ?>" class="btn btn-primary mt-4 px-4 py-2 rounded-pill shadow-sm">Modify</a>
        <?php if ($category["status"] === "Active") { ?>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
        <input type="hidden" name="action" value="archive">
        <button type="submit" class="btn btn-primary mt-4 px-4 py-2 rounded-pill shadow-sm">Archive</button>
    </form>
<?php } else { ?>
    <form method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
        <input type="hidden" name="action" value="restore">
        <button type="submit" class="btn btn-primary mt-4 px-4 py-2 rounded-pill shadow-sm">Restore</button>
    </form>
<?php } ?>




        <a href="products.php" class="btn btn-primary mt-4 px-4 py-2 rounded-pill shadow-sm">Back to products</a>
    
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