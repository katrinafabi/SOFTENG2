<?php
include 'db_connection.php'; // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data

    require_once('uniretrieve.php');
    
    $user = $_SESSION['user'];
    
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $mid_initial = $_POST['middle_name'];
    $suffix = $_POST['suffix'];
    $dob = $_POST['dob'];
    $age = $_POST['age'];
    $birthplace = $_POST['birthplace'];
    $sex = $_POST['gender'];
    $status = $_POST['civil'];
    $religion = $_POST['religion'];
    $address = $_POST['address1'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $citizenship = $_POST['citezenship'];
    $contact = $_POST['number'];
    $tel = $_POST['telephone'];
    $email = $_POST['email'];
    $username = $_POST['username'];

    // Update user profile query
    $update_query = "UPDATE user SET last_name=?, first_name=?, mid_name=?, suffix=?, birthdate=?, age=?, birthplace=?, sex=?, status=?, religion=?, address=?, city=?, zip=?, citizenship=?, contact=?, tel=?, email=?, username=? WHERE id=?";
    $stmt = $conn->prepare($update_query);

    // Bind parameters
    $stmt->bind_param("ssssssssssssssssssi", $last_name, $first_name, $mid_initial, $suffix, $dob, $age, $birthplace, $sex, $status, $religion, $address, $city, $zip, $citizenship, $contact, $tel, $email, $username, $user['id']);

    // Execute the statement
    if ($stmt->execute()) {
        // Manually update session variables
        $_SESSION['user']['last_name'] = $last_name;
        $_SESSION['user']['first_name'] = $first_name;
        $_SESSION['user']['mid_name'] = $mid_initial;
        $_SESSION['user']['suffix'] = $suffix;
        $_SESSION['user']['birthdate'] = $dob;
        $_SESSION['user']['age'] = $age;
        $_SESSION['user']['birthplace'] = $birthplace;
        $_SESSION['user']['sex'] = $sex;
        $_SESSION['user']['status'] = $status;
        $_SESSION['user']['religion'] = $religion;
        $_SESSION['user']['address'] = $address;
        $_SESSION['user']['city'] = $city;
        $_SESSION['user']['zip'] = $zip;
        $_SESSION['user']['citizenship'] = $citizenship;
        $_SESSION['user']['contact'] = $contact;
        $_SESSION['user']['tel'] = $tel;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['username'] = $username;

        echo 'Successfull';
        exit();
    } else {
        echo '<script>alert("Error updating profile: ' . $conn->error . '");</script>';
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>