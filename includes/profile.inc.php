<?php
   require_once "./includes/config_session.inc.php";
   require_once "./includes/db.inc.php"; // Database connection
    
   // Assuming the user_id is stored in session
   $user_id = $_SESSION['current_user_id'];

   $query = "SELECT Users.fname, Users.midname, Users.lname, UserLogins.email, Users.profile_pic, Users.faculty_id   
              FROM Users
              INNER JOIN UserLogins ON Users.user_id = UserLogins.user_id
              WHERE Users.user_id = :user_id";

   // Prepare and execute the query
   $stmt = $pdo->prepare($query);
   $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
   $stmt->execute();

   // Fetch and display the result for the current user
   $user_data = $stmt->fetch(PDO::FETCH_ASSOC);

   // Check if data exist
   // $faculty_id = $user_data['faculty_id'];
   $full_name = $user_data['fname'] . ' ' . $user_data['midname'] . ' ' . $user_data['lname'] ?? 'No Name Found';
   $email = $user_data['email'] ?? 'No Email Found';
   $profile_pic = $user_data['profile_pic'] ?? './assets/image.webp'; // Default image if not set
