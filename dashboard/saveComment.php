<?php
include_once('../config/db.php');

#$response = array('status' => 'error', 'message' => 'Something went wrong!');
$response = array('status' => 'success', 'message' => 'Comment added successfully!');


if(isset($_POST['complaint_id']) && isset($_POST['user_id']) && isset($_POST['comment'])) {
    $complaint_id = $_POST['complaint_id'];
    $comment = $_POST['comment'];
    $user_id = $_POST['user_id'];

    $sql = "INSERT INTO comments (complaint_id, user_id, comment) VALUES ('$complaint_id', '$user_id', '$comment')";

    if(mysqli_query($conn, $sql)) {
        $response['status'] = 'success';
        $response['message'] = 'Comment added successfully!';
    } else {
        $response['message'] = 'Failed to add comment!';
    }
}
echo json_encode($response);
?>
