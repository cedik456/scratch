<?php
require_once 'config_session.inc.php';

if (isset($_POST['submit']) && isset($_FILES['my_image'])) {

    require_once 'db.inc.php';  

    if (isset($pdo)) {
        echo "Database connection established successfully.<br>"; // Connection success message
    } else {
        echo "Database connection failed.<br>"; // Connection error message
    }
    
    echo "<pre>";
    print_r($_FILES['my_image']);
    echo "</pre>";

    $img_name = $_FILES['my_image']['name'];
    $img_size = $_FILES['my_image']['size'];
    $tmp_name = $_FILES['my_image']['tmp_name'];
    $error = $_FILES['my_image']['error'];

    if ($error === 0) {
        if ($img_size > 125000) {  // You may want to increase this size for larger image uploads.
            $em = "Your file is too large";
            header("Location: ../profile.php?error=$em");
            exit();  // Stop further script execution after redirection.
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . "." . $img_ex_lc;
                $img_upload_path = 'uploads/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                // Assuming $pdo is properly initialized in db.inc.php
                // Make sure to replace 'user_id' with the actual user's ID you want to update
                $user_id = $_SESSION['current_user_id']; // Retrieve user_id from session
                $query = "UPDATE Users SET profile_pic = :profile_pic WHERE user_id = :user_id";
                $stmt = $pdo->prepare($query);
                $stmt->bindParam(':profile_pic', $new_img_name, PDO::PARAM_STR);
                $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT); // Bind the user ID
                $stmt->execute();

                // Redirect or success message can go here
                header("Location: ../profile.php?success=Profile picture updated successfully");
                exit();  // Always exit after redirect
            } else {
                $em = "You can't upload files of this type";
                header("Location: ../profile.php?error=$em");
                exit();
            }
        }
    } else {
        $em = "Unknown Error occurred!";
        header("Location: ../profile.php?error=$em");
        exit();
    }

} else {
    header("Location: ../profile.php");
    exit();
}

// TIS GONNA WORK
