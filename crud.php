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
        $sql = "INSERT INTO currencies (currency_image, country_name, denomination, buying) VALUES ('$currency_image', '$country_name', '$denomination', '$buying')";
        if ($conn->exec($sql)) {
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->errorInfo()[2];
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

if (isset($_POST['update_all'])) {
    $ids = $_POST['id'];
    $country_names = $_POST['country_name'];
    $denominations = $_POST['denomination'];
    $buyings = $_POST['buying'];
    $currency_images = $_FILES['currency_image'];

    for ($i = 0; $i < count($ids); $i++) {
        $id = $ids[$i];
        $country_name = $country_names[$i];
        $denomination = $denominations[$i];
        $buying = $buyings[$i];
        $currency_image = $currency_images['name'][$i];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($currency_images["name"][$i]);

        if (move_uploaded_file($currency_images["tmp_name"][$i], $target_file)) {
            $sql = "UPDATE currencies SET currency_image='$currency_image', country_name='$country_name', denomination='$denomination', buying='$buying' WHERE id=$id";
        } else {
            $sql = "UPDATE currencies SET country_name='$country_name', denomination='$denomination', buying='$buying' WHERE id=$id";
        }

        if (!$conn->exec($sql)) {
            echo "Error updating record for ID $id: " . $conn->errorInfo()[2];
        }
    }
    header("Location: manage.php");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM currencies WHERE id=$id";
    if ($conn->exec($sql)) {
        header("Location: manage.php");
    } else {
        echo "Error deleting record: " . $conn->errorInfo()[2];
    }
}
?>
