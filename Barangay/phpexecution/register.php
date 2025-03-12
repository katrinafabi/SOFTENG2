<?php
include 'db_connection.php'; // Include the database connection file

function validate_password($password) {
    $errors = [];
    
    if (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long.";
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = "Password must include at least one uppercase letter.";
    }
    if (!preg_match('/[a-z]/', $password)) {
        $errors[] = "Password must include at least one lowercase letter.";
    }
    if (!preg_match('/[0-9]/', $password)) {
        $errors[] = "Password must include at least one number.";
    }
    if (!preg_match('/[\W_]/', $password)) {
        $errors[] = "Password must include at least one symbol.";
    }
    
    return $errors;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the data from the form
    $lname = $_POST['last_name'];
    $fname = $_POST['first_name'];
    $mi = $_POST['middle_name'];
    $suffix = $_POST['suffix'];
    $birthdate = $_POST['dob'];
    $age = $_POST['age'];
    $birthplace = $_POST['birthplace'];
    $sex = $_POST['gender'];
    $cstatus = $_POST['civil'];
    $religion = $_POST['religion'];
    $address = $_POST['address1'];
    $city = $_POST['city'];
    $zipcode = $_POST['zip'];
    $citizenship = $_POST['citezenship'];
    $contact = $_POST['number'];
    $tel = $_POST['telephone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pass = $_POST['password'];
    $confirmPassword = $_POST['cmpassword'];

    if ($pass !== $confirmPassword) {
        echo "Password and Confirm Password doesn't match!";
        exit(); // Stop further execution
    }

    $password_errors = validate_password($pass);
    if (!empty($password_errors)) {
        echo "<ul>";
        foreach ($password_errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        exit(); // Stop further execution
    }
    
    $password = password_hash($pass, PASSWORD_DEFAULT);
    
    // Check if email or username already exist
    $check_email_query = "SELECT * FROM user WHERE email='$email'";
    $check_username_query = "SELECT * FROM user WHERE username='$username'";
    $result_email = $conn->query($check_email_query);
    $result_username = $conn->query($check_username_query);

    if ($result_email->num_rows > 0 && $result_username->num_rows > 0) {
        // Both email and username already exist
        echo 'Both EMAIL and USERNAME already exist. Please choose different ones.';
    } elseif ($result_email->num_rows > 0) {
        // Only email already exists
        echo 'EMAIL already exists. Please choose a different one.';
    } elseif ($result_username->num_rows > 0) {
        // Only username already exists
        echo 'USERNAME already exists. Please choose a different one.';
    }  else {
        // Insert data into database
        $insert_query = "INSERT INTO user (last_name, first_name, mid_name, suffix, birthdate, age, birthplace, sex, status, religion, address, city, zip, citizenship, contact, tel, email, username, password) 
            VALUES ('$lname', '$fname', '$mi', '$suffix', '$birthdate', '$age', '$birthplace', '$sex', '$cstatus', '$religion', '$address', '$city', '$zipcode', '$citizenship', '$contact', '$tel', '$email', '$username', '$password')";
        if ($conn->query($insert_query) === TRUE) {
            // Redirect to a different page upon successful registration
            echo 'Successful';
            exit();
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>
