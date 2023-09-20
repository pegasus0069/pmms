<?php
include_once('../config/db.php');

$comments = array();

if(isset($_POST['complaint_id'])) {
    $complaint_id = $_POST['complaint_id'];

    $sql = "SELECT c.comment, u.username, c.created_at FROM comments c JOIN users u ON c.user_id = u.id WHERE c.complaint_id = '$complaint_id' ORDER BY c.created_at DESC";

    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row;
    }
}

echo json_encode($comments);
?>
