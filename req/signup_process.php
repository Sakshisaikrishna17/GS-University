<?php
// Include the existing database connection file
include "../DB_connection.php";

// Handle form submission for signup
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $email_address = $_POST['email_address'];
    $date_of_birth = $_POST['date_of_birth'];
    $date_of_joined = $_POST['date_of_joined'];
    $section = $_POST['section'];
    $parent_fname = $_POST['parent_fname'];
    $parent_lname = $_POST['parent_lname'];
    $parent_phone_number = $_POST['parent_phone_number'];
    $role = $_POST['role']; // Capture the role from the form

    // Check if passwords match
    if ($password !== $confirm_password) {
        header("Location: ../signup.php?error=Passwords do not match");
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Set up queries based on the role
        if ($role == '1') { // Admin
            $check_query = "SELECT * FROM admin WHERE username = :username LIMIT 1";
            $insert_query = "INSERT INTO admin (username, password) VALUES (:username, :password)";
        } elseif ($role == '2') { // Teacher
            $check_query = "SELECT * FROM teachers WHERE username = :username LIMIT 1";
            $insert_query = "INSERT INTO teachers (username, password) VALUES (:username, :password)";
        } elseif ($role == '3') { // Student
            $check_query = "SELECT * FROM students WHERE username = :username LIMIT 1";
            $insert_query = "INSERT INTO students (username, password, fname, lname, address, gender, email_address, date_of_birth, date_of_joined, section, parent_fname, parent_lname, parent_phone_number) 
                             VALUES (:username, :password, :fname, :lname, :address, :gender, :email_address, :date_of_birth, :date_of_joined, :section, :parent_fname, :parent_lname, :parent_phone_number)";
        } elseif ($role == '4') { // Registrar Office
            $check_query = "SELECT * FROM registrar_office WHERE username = :username LIMIT 1";
            $insert_query = "INSERT INTO registrar_office (username, password) VALUES (:username, :password)";
        } else {
            header("Location: ../signup.php?error=Invalid role selected");
            exit();
        }

        // Check if the username exists
        $stmt = $conn->prepare($check_query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            header("Location: ../signup.php?error=Username already registered");
            exit();
        }

        // Insert the new user into the appropriate table
        $stmt = $conn->prepare($insert_query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);

        // Additional fields for the `students` table
        if ($role == '3') {
            $stmt->bindParam(':fname', $fname);
            $stmt->bindParam(':lname', $lname);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':gender', $gender);
            $stmt->bindParam(':email_address', $email_address);
            $stmt->bindParam(':date_of_birth', $date_of_birth);
            $stmt->bindParam(':date_of_joined', $date_of_joined);
            $stmt->bindParam(':section', $section);
            $stmt->bindParam(':parent_fname', $parent_fname);
            $stmt->bindParam(':parent_lname', $parent_lname);
            $stmt->bindParam(':parent_phone_number', $parent_phone_number);
        }

        if ($stmt->execute()) {
            header("Location: ../signup.php?success=Signup successful! You can now log in.");
        } else {
            header("Location: ../signup.php?error=Something went wrong. Please try again.");
        }
    } catch (PDOException $e) {
        header("Location: ../signup.php?error=Database error: " . $e->getMessage());
        exit();
    }
}

// Close the database connection
$conn = null;
?>
