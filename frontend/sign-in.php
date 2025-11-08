
<?php

// start session
session_start();

// check if form is submitted
if($_SERVER["REOUEST_METHOD"] == "POST"){

    // get form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    // create connection
    $conn = new mysqli("localhost", "root", "", "test");

    // check connection
    if($conn->connect_error){
        die("Connection failed: " . $conn->connect_error);
    }

    // prevent sql injection
    $email = $conn->real_escape_string($email);
    $password = $conn->real_escape_string($password);

    // query the database
    $sql = "SELECT * FROM student WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if($result->num_rows == 1){
        // login sucess
        $_SESSION['username'] = $email;
        echo "Login sucessful. Welcome,";

        // redirect to dashbord or home page if needed
        header("Location: index.html");
        exit()
    }

    else{
        // login failed
        echo "Invalid username or password"
    }

    $conn->close();
}
?>
