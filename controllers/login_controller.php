<?php


/////////////////             Signup
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $logname = filter_input(INPUT_POST, 'logname', FILTER_SANITIZE_STRING);
    $logemail = filter_input(INPUT_POST, 'logemail', FILTER_SANITIZE_EMAIL);
    $logpass = filter_input(INPUT_POST, 'logpass', FILTER_SANITIZE_STRING);
    $password = password_hash($logpass, PASSWORD_DEFAULT);
    // Check if the profile picture is uploaded
    if (isset($_FILES['profile-picture'])) {
        $targetDir = "./assets/img/";
        $fileName = basename($_FILES["profile-picture"]["name"]);
        $targetFilePath = $targetDir . $fileName;

        // Move the uploaded file to the desired directory
        if (move_uploaded_file($_FILES["profile-picture"]["tmp_name"], $targetFilePath)) {
            // Check if the user already exists
            $userChecker = User::CheckUser($logemail, $db);

            if ($userChecker) {
                echo "User exist";
            } else {
                User::AddUser($logemail, $password, $logname, $fileName, $db);

                header("Location: index.php?page=login");
                exit();
            }
        } else {
            echo "File_upload_failed";
        }
    }
}



////////////////////////               sign in
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signin"])) {
    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    // Assuming CheckUser returns user data or false if the user doesn't exist
    $userChecker = User::CheckUser($email, $db);
    //var_dump($userChecker);

    if ($userChecker) {
        // User exists, now verify the password
        if (password_verify($password, $userChecker["password"])) {
            User::login($userChecker["user_id"]);
            header("Location: index.php?page=home");
            exit();

        } else {
            echo "Invalid email or password. Please try again.";
        }
    } else {
        echo "User not found. Please check your email and try again.";
    }
}


