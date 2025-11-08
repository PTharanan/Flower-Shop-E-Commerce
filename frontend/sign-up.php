<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // connect to mysql database
    $conn = new mysqli("localhost", "root", "", "test");

    // check connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect from data directly
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $telephone = $_POST['Mobile'];
    $pasword = $_POST['password'];
    $reTypePassword = $_POST['reTypePassword'];

    // check if password and re-typed password match
    if($pasword !== $reTypePassword){
        echo "Passwords do not match.";
        exit();
    }

    // chech if firstname, lastname, email, mobile already exists
    $check_val = "SELECT * FROM students WHERE first_name = '$firstName', last_name = '$lastName', email = '$email', mobile = '$telephone'";
    $reqult = $conn->query($check_val);

    if($reqult->num_rows > 0){
        echo "Email is already registred.";
        exit();
    }
    
    // Hash password
    $hashed_password = password_hash($pasword,PASSWORD_DEFAULT);

    // Insert data (no escaping)
    $insert_query = "INSERT INTO student (first_name, last_name, email, mobile, password)
                    VALUES('$firstName', '$lastName', '$email', '$telephone', '$hashed_password')";

    if($conn->query($insert_query) === TRUE){
        echo "Registration sucessfull You can now <a href='login.html'>Login</a>.";
    }

    else{
        echo "Error: " .$conn->error;
    }

    $conn->close();
}
?>