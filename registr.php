<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "onlinebookstore";


    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $email = $_POST['mailid'];
    $password = $_POST['password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];


    $checkUserQuery = "SELECT * FROM users WHERE username = '$email'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        // Foydalanuvchi allaqachon mavjud bo'lsa, xabarni chiqarish
        echo "<script>
            alert('Bu email allaqachon bor');
            window.location.href = 'CustomerRegister.html';
        </script>";
    } else {

        $sql = "INSERT INTO users (username, password, firstname, lastname, address, phone, mailid, usertype) VALUES ('$email', '$password', '$firstname', '$lastname', '$address', '$phone', '$email', 2)";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            include_once ("login.html");
            exit;
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
?>