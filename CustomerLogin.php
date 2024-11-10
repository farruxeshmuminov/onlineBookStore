<?php

    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "onlinebookstore";


    $conn = new mysqli($servername, $username, $password, $dbname);


    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();

        $user = $result->fetch_assoc();

        if ($result->num_rows > 0 and $user['usertype'] == 2) {
            header("Location: CustomerHome.html");
            exit();
        } else {
            echo "<script>
                alert('Login yoki parol noto\'g\'ri.');
                window.location.href = 'CustomerLogin.html';
                </script>";
        }

        $stmt->close();
        $conn->close();
    }

?>