<?php
session_start();
if (!(isset($_SESSION["login"])))
    header("Location: ../login.php");

    require_once '../controlers/logged/UserControler.php';
    $userControler = new UserControler();
    $currentUser = $userControler->getCurrentUser($_SESSION["login"]);
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['update_profile'])) {
                $id = $currentUser["id"];
                $email = $_POST['email'];
                $birthday = $_POST['birthday'];
                $gender = $_POST['gender'];
                $security_question = $_POST['security_question'];
                $security_answer = $_POST['security_answer'];
        
                $isUpdated = $userControler->updateUser($id, $email, $birthday, $gender, $security_question, $security_answer);
        
                if ($isUpdated) {
                    echo "Profile updated successfully!";
                    if ($_SESSION["login"] != $email)
                         $_SESSION["login"] = $email;
                    header("Location: index.php?action=profile");
                } else {
                    echo "Failed to update profile. Please try again.";
                }
            }
        
            if (isset($_POST['update_photo'])) {
                $id = $currentUser["id"];
                $photo = $_FILES['photo'];
        
                $isPhotoUpdated = $userControler->updateProfilePhoto($id, $photo);
        
                if ($isPhotoUpdated) {
                    echo "Profile photo updated successfully!";
                    header("Location: index.php?action=profile");
                } else {
                    echo "Failed to update profile photo. Please try again.";
                }
            }
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Enhanced Profile Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="../inc/logged/css/style.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .profile-card {
            max-width: 900px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            animation: fadeIn 1s;
        }
        .profile-header {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 2rem;
        }
        .profile-header img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s;
        }
        .profile-header img:hover {
            transform: scale(1.1);
        }
        .profile-header h2 {
            margin-left: 1.5rem;
            font-weight: 600;
        }
        .profile-details {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        .profile-details div {
            background: #f1f1f1;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .profile-details div:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .profile-details label {
            font-weight: 500;
            color: #555;
        }
        .profile-details span {
            display: block;
            font-weight: 600;
            color: #333;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media (max-width: 768px) {
            .profile-details {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>

    <!-- Enhanced Profile Section Start -->
    <div class="profile-card">
        <div class="profile-header text-center">
        <img src="../inc/logged/img/profilephotos/<?php echo $currentUser["photo"]?>" alt="Profile Picture">
            <h2><?php echo $currentUser["first_name"] . " " . $currentUser["last_name"]; ?></h2>
        </div>
        <form method="POST" enctype="multipart/form-data">
    <div class="profile-photo-upload">
        <label for="photo">Upload Profile Photo:</label>
        <input type="file" name="photo" id="photo" accept="image/*">
        <button type="submit" name="update_photo" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
            Upload Photo
        </button>
    </div>
</form>

        <form method="POST">
        <div class="profile-details">
            <div>
                <label>ID:</label>
                <span> <?php echo $currentUser["id"]; ?> </span>
            </div>
            
            <div>
                <label>Email:</label>
                <span><input type="text" name="email" value="<?php echo $currentUser["email"]; ?>"> </span>
            </div>
            <div>
                <label>Birthday:</label>
                <span><input type="date" name="birthday" value="<?php echo $currentUser["birthday"]; ?>"> </span>
            </div>
            <div>
                <label>Gender:</label>
                <span>
                    

                     <select name="gender" id="gender">
            <option value="Male" <?php echo ($currentUser["gender"] === "Male") ? 'selected' : ''; ?>>Male</option>
            <option value="Female" <?php echo ($currentUser["gender"] === "Female") ? 'selected' : ''; ?>>Female</option>
        </select>

                </span>
            </div>
            <div>
                <label>Role:</label>
                <span><?php echo $currentUser["role"]; ?></span>
            </div>
            <div>
                <label>Security Question:</label>
                <span><input name="security_question" type="text" value="<?php echo $currentUser["security_question"]; ?>"> </span>
            </div>
            <div>
                <label>Security Answer:</label>
                <span><input name="security_answer" type="text" value="<?php echo $currentUser["security_answer"]; ?>"> </span>
            </div>
            <button name="update_profile" style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; font-size: 16px; cursor: pointer;">
    Edit profile
</button>

        </div>
    </form>
    </div>
    <!-- Enhanced Profile Section End -->

    <?php include 'footer.php'; ?>

    <script>
        // Add animations for the profile picture hover
        const profilePicture = document.querySelector(".profile-header img");
        profilePicture.addEventListener("mouseover", () => {
            profilePicture.style.filter = "brightness(1.2)";
        });
        profilePicture.addEventListener("mouseout", () => {
            profilePicture.style.filter = "brightness(1)";
        });
    </script>
</body>

</html>
