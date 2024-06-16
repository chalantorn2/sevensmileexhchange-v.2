<?php

$conn = new mysqli("localhost", "root", "", "exchange_db");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['add'])) {
    $country_name = $_POST['country_name'];
    $denomination = $_POST['denomination'];
    $buying = $_POST['buying'];
    $currency_image = $_FILES['currency_image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["currency_image"]["name"]);

    if (move_uploaded_file($_FILES["currency_image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO currencies (country_name, denomination, buying, currency_image) VALUES ('$country_name', '$denomination', '$buying', '$currency_image')";
        if ($conn->query($sql) === TRUE) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $country_name = $_POST['country_name'];
    $denomination = $_POST['denomination'];
    $buying = $_POST['buying'];
    $currency_image = $_FILES['currency_image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["currency_image"]["name"]);

    if (move_uploaded_file($_FILES["currency_image"]["tmp_name"], $target_file)) {
        $sql = "UPDATE currencies SET country_name='$country_name', denomination='$denomination', buying='$buying', currency_image='$currency_image' WHERE id=$id";
    } else {
        $sql = "UPDATE currencies SET country_name='$country_name', denomination='$denomination', buying='$buying' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        header("Location: manage.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM currencies WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: manage.php");
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}

$conn->close();
