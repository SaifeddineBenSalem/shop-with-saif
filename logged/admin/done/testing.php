<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkbox Example</title>
</head>
<body>
    <?php
    $selectedInterests = [];
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Check if checkboxes are selected
        if (isset($_POST['interests'])) {
            $selectedInterests = $_POST['interests']; // Retrieve selected values as an array
        }
    }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
        <label>
            <input type="checkbox" name="interests[]" value="Sports" 
            <?php echo in_array("Sports", $selectedInterests) ? "checked" : ""; ?>> Sports
        </label><br>
        <label>
            <input type="checkbox" name="interests[]" value="Music" 
            <?php echo in_array("Music", $selectedInterests) ? "checked" : ""; ?>> Music
        </label><br>
        <label>
            <input type="checkbox" name="interests[]" value="Travel" 
            <?php echo in_array("Travel", $selectedInterests) ? "checked" : ""; ?>> Travel
        </label><br>
        <label>
            <input type="checkbox" name="interests[]" value="Art" 
            <?php echo in_array("Art", $selectedInterests) ? "checked" : ""; ?>> Art
        </label><br>
        <button type="submit">Submit</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        if (!empty($selectedInterests)) {
            echo "<h3>You selected:</h3>";
            echo "<ul>";
            foreach ($selectedInterests as $interest) {
                echo "<li>" . htmlspecialchars($interest) . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<h3>No interests selected.</h3>";
        }
    }
    ?>
</body>
</html>
