<?php
session_start();
require_once 'controlers/LoginControler.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $loginControler = new LoginControler();
$loginControler->login($_POST["email"],$_POST["password"]);
}


if (isset($_SESSION["login"])) {
    error_log("Redirecting to logged/index.php because session login is set.");
    header("Location: logged/index.php");
    exit;
}
$message_error=null;
if (isset($_SESSION["error"]))
    $message_error= $_SESSION["error"];
unset($_SESSION["error"]);
$message_success=null;
if (isset($_SESSION["success"]))
    $message_success = $_SESSION["success"];
unset($_SESSION["success"]);
error_log("Session 'login' is not set, showing login page.");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="inc/vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="inc/vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="inc/vendor/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="inc/vendor/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="inc/css/main.css" rel="stylesheet" media="all">
    <style>
        div[role="alert"] {
  background-color: #f8d7da; /* Light red background */
  color: #721c24;           /* Dark red text */
  border: 1px solid #f5c6cb; /* Red border */
  padding: 10px 15px;       /* Add some spacing */
  border-radius: 4px;       /* Slightly rounded corners */
  font-family: Arial, sans-serif; /* Clean font */
  font-size: 14px;          /* Readable font size */
  margin: 10px 0;           /* Add spacing around the element */
}
div[role="alert1"] {   
  background-color: #d4edda; /* Light green background */   
  color: #155724;           /* Dark green text */   
  border: 1px solid #c3e6cb; /* Green border */   
  padding: 10px 15px;       /* Add some spacing */   
  border-radius: 4px;       /* Slightly rounded corners */   
  font-family: Arial, sans-serif; /* Clean font */   
  font-size: 14px;          /* Readable font size */   
  margin: 10px 0;           /* Add spacing around the element */ 
}


    </style>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Logging in form</h2>
                    <form method="POST" action="">
                        <?php if (isset($message_success) && $message_success != null ) {?>
                        <div  role="alert1">
  <?php echo $message_success;?>
</div>
<?php }?>
                        <?php if (isset($message_error) && $message_error != null ) {?>
                        <div role="alert">
  <?php echo $message_error;?>
</div>
<?php }?>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Email</label>
                                    <input class="input--style-4" type="email" name="email">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Password</label>
                                    <input class="input--style-4" type="password" name="password">
                                </div>
                            </div>
                            
                        </div>
                    <!-- <div class="input-group">
                            <label class="label">Subject</label>
                            <div class="rs-select2 js-select-simple select--no-search">
                                <select name="subject">
                                    <option disabled="disabled" selected="selected">Choose option</option>
                                    <option>Subject 1</option>
                                    <option>Subject 2</option>
                                    <option>Subject 3</option>
                                </select>
                                <div class="select-dropdown"></div>
                            </div>
                        </div> -->
                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit">Login</button>
                        </div>
                        <div class="p-t-15">
                            <a class="btn btn--radius-2 btn--blue" href="index.php?action=resetpassword">Reset your password</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php'?>
    <!-- Jquery JS-->
    <script src="inc/vendor/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="inc/vendor/select2/select2.min.js"></script>
    <script src="inc/vendor/datepicker/moment.min.js"></script>
    <script src="inc/vendor/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="inc/js/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->