<?php
header('Content-type: application/json');

$response = array();
$error_log = array();

// Check if page is visited after clicking form button or not
if($_POST)
{
    require_once('../../includes/functions.inc.php');
    
    $name = $_POST['serviceName'];
    $description = htmlspecialchars($_POST['serviceDescription']);
    $deptID = $_POST['serviceideptid'];
    
    // Initial Validation and Error Handling
    if(empty($name)){
        $error_log['serviceName'] = 'Invalid Name!';
    }
    if(empty($description) || strlen($description) < 6){
        $error_log['serviceDescription'] = 'Must be minimum 10 characters in length!';
    }
    if (empty($deptID) && !in_array($deptID, array_column($departments, 'id'))){
        $error_log['serviceideptid'] = 'Invalid Department ID!';
    }
    // Initial Validation End

    // Check if there's any Error otherwise continue with signup
    if(count($error_log) == 0)
    {
        require_once('../../config/db.php');
        
        // Check if entered email is unique or not
        $sql = "SELECT name FROM services WHERE name=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql))
        {
            $error_log['sql'] = "Connection Failed! Please try again";
            $response['status'] = 'error';
        }
        else
        {
            mysqli_stmt_bind_param($stmt, "s", $name);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            if(mysqli_stmt_num_rows($stmt) > 0)
            {
                $error_log['serviceName'] = "Service already Exists!";
                $response['status'] = 'error';
            }
            else
            {
                // if not then insert user details to the table
                $sql = "INSERT INTO services (name, description, department_id, created_at) VALUES (?,?,?,NOW())";

                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql))
                {
                    $error_log['sql'] = "Connection Failed! Please try again";
                    $response['status'] = 'error';
                }
                else
                {
                    mysqli_stmt_bind_param($stmt, "sss", $name, $description, $deptID);
                    mysqli_stmt_execute($stmt);

                    $response['status'] = 'success';
                }
            }
        }
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    }
    else
    {
        // If errors are there return to index page with errors
        $response['status'] = 'error';
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