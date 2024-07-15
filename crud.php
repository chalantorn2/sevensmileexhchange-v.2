<?php
include 'config.php';

if (isset($_POST['add'])) {
    $country_name = $_POST['country_name'];
    $denomination = $_POST['denomination'];
    $buying = $_POST['buying'];
    $currency_image = $_FILES['currency_image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["currency_image"]["name"]);

    if (move_uploaded_file($_FILES["currency_image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO currencies (currency_image, country_name, denomination, buying) VALUES (:currency_image, :country_name, :denomination, :buying)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':currency_image', $currency_image);
        $stmt->bindParam(':country_name', $country_name);
        $stmt->bindParam(':denomination', $denomination);
        $stmt->bindParam(':buying', $buying);
        
        if ($stmt->execute()) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->errorInfo()[2];
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
        $sql = "UPDATE currencies SET currency_image=:currency_image, country_name=:country_name, denomination=:denomination, buying=:buying WHERE id=:id";
    } else {
        $sql = "UPDATE currencies SET country_name=:country_name, denomination=:denomination, buying=:buying WHERE id=:id";
    }

    $stmt = $conn->prepare($sql);
    if (isset($currency_image) && !empty($currency_image)) {
        $stmt->bindParam(':currency_image', $currency_image);
    }
    $stmt->bindParam(':country_name', $country_name);
    $stmt->bindParam(':denomination', $denomination);
    $stmt->bindParam(':buying', $buying);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: manage.php");
    } else {
        echo "Error updating record: " . $conn->errorInfo()[2];
    }
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM currencies WHERE id=:id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        header("Location: manage.php");
    } else {
        echo "Error deleting record: " . $conn->errorInfo()[2];
    }
}
?>
