<?php
session_start();
if (!(isset($_SESSION["login"])))
        header("Location: ../../login.php");
require_once '../../controlers/logged/UserControler.php';
$userControler = new UserControler();
$user=$userControler->getCurrentUser($_SESSION["login"]);
$role = $user["role"];
if ($role != "admin")
    header("Location: ../index.php");
require_once '../../controlers/logged/CategoriesControler.php';
$categoriesControler = new CategoriesControler();
$categories_names = $categoriesControler->getAllCategories();
require_once '../../controlers/logged/ProductsControler.php';
$productsControler = new ProductsControler();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $categoryName = $_POST["categoryName"];
    $categoryTemp = $categoriesControler->getCategoryByName($categoryName);
    $allsizes= "";
    $allcolors="";
    if (isset($_POST["shoesSizes"])) {
        foreach ($_POST["shoesSizes"] as $size) {
            if ($allsizes === "")
                $allsizes =  $size;
            else
                $allsizes =  $allsizes.",".$size;
        }
    }
    if (isset($_POST["colors"])) {
        foreach ($_POST["colors"] as $size) {
            if ($allcolors === "")
                $allcolors =  $size;
            else
                $allcolors =  $allcolors.",".$size;
        }
    }
    $targetDir = "../../inc/logged/img/products/";
    $fileName = basename($_FILES["productPhoto"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($fileType, $allowedTypes) && $_FILES["productPhoto"]["size"] <= 5000000) {
        if (move_uploaded_file($_FILES["productPhoto"]["tmp_name"], $targetFilePath)) {
            $photoPath = $fileName;
        } else {
            echo "Error uploading the file.";
            exit;
        }
    } else {
        echo "Invalid file type or size.";
        exit;
    }
    $h = $productsControler->addProduct($_POST["productName"],$categoryTemp["id"],$_POST["productPrice"],$_SESSION["login"],$_POST["productDescription"],$_POST["productPromo"],$allsizes,$allcolors,$fileName);
    header ("Location: index.php?action=addproduct");
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
            <div class="container-fluid pt-4 px-4">
                <div class="row vh-100 bg-light rounded align-items-center justify-content-center mx-0">
                    <div class="col-md-6 text-center">
                         <h2 class="form-header">Add a New product</h2>
                         <br>
                <form  method="POST" enctype="multipart/form-data">
                     <div class="form-group">
                        <select name="categoryName" required class="form-select" id="floatingSelect">
                            <option value=""> Select a category </option>
                            <?php foreach($categories_names as $category_name) {?>
                                <option value="<?php echo $category_name["name"]; ?>"><?php echo $category_name["name"]; ?></option>
                            <?php }?>
                        </select>
                        <br>
                     </div>
                    <div class="form-group">
                        <input type="text" id="productName" name="productName" class="form-control" placeholder="Enter product name" required>
                    </div><br>
                    <div class="form-group">
                        <textarea id="productDescription" name="productDescription" class="form-control" placeholder="Enter product description" required></textarea>

                    </div><br>
                     <div class="form-group">
                        <input type="number" min="1" id="productPrice" name="productPrice" class="form-control" placeholder="Enter product price" required>
                    </div><br>
                     <div class="form-group">
                        <input type="number" min="1" id="productPromo" name="productPromo" class="form-control" placeholder="Enter product promo">
                    </div><br>
                    <div class="form-group" id="shoesinput">
                        Sizes :<br>
                       <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="36"/> 36
                       <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="37"/> 37
                        <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="38"/> 38
                       <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="39"/> 39
                        <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="40"/> 40
                       <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="41"/> 41
                        <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="42"/> 42
                       <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="43"/> 43
                        <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="44"/> 44
                       <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="45"/> 45
                       <input type="checkbox" class="form-check-input" name="shoesSizes[]" value="45"/> XL
                    </div><br>
                    <div class="form-group" id="shoesinput">
                        Colors :<br>
                       <input type="checkbox" class="form-check-input" name="colors[]" value="Black"/> Black
                       <input type="checkbox" class="form-check-input" name="colors[]" value="White"/> White
                        <input type="checkbox" class="form-check-input" name="colors[]" value="Grey"/> Grey
                       <input type="checkbox" class="form-check-input" name="colors[]" value="Red"/> Red
                        <input type="checkbox" class="form-check-input" name="colors[]" value="Purple"/> Purple
                       <input type="checkbox" class="form-check-input" name="colors[]" value="Green"/> Green
                        <input type="checkbox" class="form-check-input" name="colors[]" value="Blue"/> Blue<br>
                       <input type="checkbox" class="form-check-input" name="colors[]" value="Yellow"/> Yellow
                        <input type="checkbox" class="form-check-input" name="colors[]" value="Brown"/> Brown
                       <input type="checkbox" class="form-check-input" name="colors[]" value="Orange"/> Orange
                    </div><br>
                    <div class="form-group">
                                <label for="productPhoto">Product Photo:</label>
                                <input type="file" name="productPhoto" class="form-control" accept="image/*" required>
                            </div><br>
                    <button type="submit" class="btn btn-primary w-100">Add Category</button>
                </form>
                    </div>
                </div>
            </div>
            <!-- Blank End -->


            <!-- Footer Start -->
            
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