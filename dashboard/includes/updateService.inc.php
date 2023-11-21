<?php
header('Content-type: application/json');
session_start();
    
$response = array();
$error_log = array();

// Check if page is visited after clicking form button or not
if($_POST)
{
    $status = $_POST['action'];
    
    if ( $status == 'update' )
    {
        $rowId   = $_POST['serviceNewIdentity'];
        $newCategory = $_POST['serviceNewCategory'];
        $newName = $_POST['serviceNewName'];
        $newDescription = $_POST['serviceNewDescription'];
        $newdeptID = $_POST['serviceNewideptid'];

        require_once('../../includes/functions.inc.php');
        // Initial Validation and Error Handling
        if(empty($newCategory)){
            $error_log['serviceNewCategory'] = 'Invalid Category!';
        }
        if(empty($newName)){
            $error_log['serviceNewName'] = 'Invalid Name!';
        }
        if(empty($newDescription) || strlen($newDescription) < 6){
            $error_log['serviceNewDescription'] = 'Must be minimum 10 characters in length!';
        }
        if (empty($newdeptID) && !in_array($newdeptID, array_column($departments, 'id'))){
            $error_log['serviceNewideptid'] = 'Invalid Department ID!';
        }
        // Initial Validation End

        if(count($error_log) == 0)
        {
            require_once('../../config/db.php');

            // if not then insert user details to the table
            $sql = "UPDATE `services` SET `category`=?,`name`=?,`description`=?,`department_id`=?,`created_at`=NOW() WHERE `id`=?";
            
            $stmt = mysqli_stmt_init($conn);

            if(!mysqli_stmt_prepare($stmt, $sql))
            {
                $response['status'] = 'error';
                $error_log['sql'] = 'Connection Failed! Please try again';
            }
            else
            {
                mysqli_stmt_bind_param($stmt, "sssss", $newCategory, $newName, $newDescription, $newdeptID, $rowId);
                mysqli_stmt_execute($stmt);

                $response['status'] = 'success';
            }
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
        }
        else
        {
            // If errors are there return to index page with errors
            $response['status'] = 'error';
        }
    }
    else if( $status == 'delete' )
    {
        $rowId  = $_POST['name'];
        
        require_once('../../config/db.php');

        $sql = "DELETE FROM `services` WHERE `id`=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            $response['status'] = 'error';
            $error_log['sql'] = "Connection Failed! Please try again";
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $rowId);
            mysqli_stmt_execute($stmt);

            $response['status'] = 'success';
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    else
    {
        // Protection from invalid input
        $response['status'] = 'error';
        $error_log['sql'] = "Something went Wrong! Try Again";
    }
    
    $response['errors'] = $error_log;
    echo json_encode($response);
}
else
{
    header('Location: ../');
    exit();
}

?>