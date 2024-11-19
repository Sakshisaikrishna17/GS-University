<?php 
session_start();

if (isset($_POST['uname']) && isset($_POST['pass']) && isset($_POST['role'])) {
    include "../DB_connection.php";
    
    $uname = $_POST['uname'];
    $pass = $_POST['pass'];
    $role = $_POST['role'];

    if (empty($uname)) {
        $em = "Username is required";
        header("Location: ../login.php?error=$em");
        exit;
    } else if (empty($pass)) {
        $em = "Password is required";
        header("Location: ../login.php?error=$em");
        exit;
    } else {
        // Determine which table and columns to use based on the role
        if ($role == '1') { // Admin
            $sql = "SELECT * FROM admin WHERE username = ?";
            $roleLabel = "Admin";
        } else if ($role == '2') { // Teacher
            $sql = "SELECT * FROM teachers WHERE username = ?";
            $roleLabel = "Teacher";
        } else if ($role == '3') { // Student
            $sql = "SELECT * FROM students WHERE username = ?";
            $roleLabel = "Student";
        } else if ($role == '4') { // Registrar Office
            $sql = "SELECT * FROM registrar_office WHERE username = ?";
            $roleLabel = "Registrar Office";
        } else {
            $em = "Invalid role selected";
            header("Location: ../login.php?error=$em");
            exit;
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute([$uname]);

        if ($stmt->rowCount() == 1) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            $username = $user['username'];
            $password = $user['password'];
            $idColumn = $role == '1' ? 'admin_id' : ($role == '2' ? 'teacher_id' : ($role == '3' ? 'student_id' : 'registrar_id'));

            if ($username === $uname) {
                if (password_verify($pass, $password)) {
                    $_SESSION['role'] = $roleLabel;
                    $_SESSION[$idColumn] = $user[$idColumn]; // Set session based on the ID

                    // Redirect to the appropriate role-specific page
                    if ($role == '1') {
                        header("Location: ../admin/index.php");
                    } else if ($role == '2') {
                        header("Location: ../Teacher/index.php");
                    } else if ($role == '3') {
                        header("Location: ../Student/index.php");
                    } else if ($role == '4') {
                        header("Location: ../RegistrarOffice/index.php");
                    }
                    exit;
                } else {
                    $em = "Incorrect Username or Password";
                    header("Location: ../login.php?error=$em");
                    exit;
                }
            } else {
                $em = "Incorrect Username or Password";
                header("Location: ../login.php?error=$em");
                exit;
            }
        } else {
            $em = "Incorrect Username or Password";
            header("Location: ../login.php?error=$em");
            exit;
        }
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>
