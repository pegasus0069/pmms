<?php
// get_services.php

include_once('../config/db.php');

if (isset($_POST['serviceCategory'])) {
    $serviceCategory = $_POST['serviceCategory'];
    
    $sql = "SELECT services.id, services.name FROM services
     WHERE services.category = ?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $serviceCategory);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $services = mysqli_fetch_all($result, MYSQLI_ASSOC);

        echo json_encode($services);
    } else {
        echo json_encode([]);
    }

    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    echo json_encode([]);
}
?>
