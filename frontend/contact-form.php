<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    // connect to mysql database
    $conn = new mysqli("localhost", "root", "", "test");

    // check connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect from data directly
    $fullName = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message']

    // Insert data (no escaping)
    $insert_query = "INSERT INTO contact (full_name, email, phone, message)
                    VALUES('$fullName', '$email', '$phone', '$message')";

    if($conn->query($insert_query) === TRUE){
        echo "Thank you for contact US .";
    }

    else{
        echo "Error: " .$conn->error;
    }

    $conn->close();
}
?>