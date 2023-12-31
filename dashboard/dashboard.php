<?php
    session_start();
    include_once('../config/db.php');
?>
<div class="container-fluid">
    <!-- Complaints to a user/ user's department -->
    <?php
        if( $_SESSION['userType'] != 'User' )
        {
    ?>
    <div class="row">
        <div class="card" style="background: none !important;">
            <div class="card-header card-header-info">
                <h4 class="card-title">Tickets Issued to You</h4>
                <p class="card-category">
                    Stats of the Tickets handled by you / your department 
                </p>
            </div>
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-danger card-header-icon">
                                <div class="card-icon"><a style="color: white" href="#process"><i class="material-icons">assessment</i></a></div>
                                <p class="card-category">Total</p>
                                <?php
                                    $sql = "SELECT complaints.created_at FROM `complaints` JOIN `users` ON complaints.dept_id=users.dept_id WHERE users.id='".$_SESSION['userId']."' ORDER BY complaints.created_at DESC";
                                    $result = mysqli_query($conn, $sql);
                                    $lastRecord = "No Record";
                                    
                                    if ( ($rowCount = mysqli_num_rows($result)) > 0 )
                                    {
                                        $row = mysqli_fetch_row($result);
                                        $lastRecord = "Last ".$row[0];
                                    }
                                    // Free result set
                                    mysqli_free_result($result);
                                ?>
                                <h3 class="card-title"><?php echo $rowCount;?></h3>        
                            </div>
                            <div class="card-footer">
                                <div class="stats"><i class="material-icons">date_range</i>  <?php echo $lastRecord;?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon"><a style="color: white" href="#process"><i class="material-icons">thumb_up_alt</i></a></div>
                                <p class="card-category">Completed</p>
                                <?php
                                    $sql = "SELECT complaints.created_at FROM `complaints` JOIN `users` ON complaints.dept_id=users.dept_id WHERE users.id='".$_SESSION['userId']."' AND complaints.status='Approved' ORDER BY complaints.created_at DESC";
                                    $result = mysqli_query($conn, $sql);
                                    $lastRecord = "No Record";
                                    
                                    if ( ($rowCount = mysqli_num_rows($result)) > 0 )
                                    {
                                        $row = mysqli_fetch_row($result);
                                        $lastRecord = "Last ".$row[0];
                                    }
                                    // Free result set
                                    mysqli_free_result($result);
                                ?>
                                <h3 class="card-title"><?php echo $rowCount;?></h3>        
                            </div>
                            <div class="card-footer">
                                <div class="stats"><i class="material-icons">date_range</i>  <?php echo $lastRecord;?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon"><a style="color: white" href="#process"><i class="material-icons">build</i></a></div>
                                <p class="card-category">Resolved</p>
                                <?php
                                    $sql = "SELECT complaints.created_at FROM `complaints` JOIN `users` ON complaints.dept_id=users.dept_id WHERE users.id='".$_SESSION['userId']."' AND complaints.status='Resolved' ORDER BY complaints.created_at DESC";
                                    $result = mysqli_query($conn, $sql);
                                    $lastRecord = "No Record";
                                    
                                    if ( ($rowCount = mysqli_num_rows($result)) > 0 )
                                    {
                                        $row = mysqli_fetch_row($result);
                                        $lastRecord = "Last ".$row[0];
                                    }
                                    // Free result set
                                    mysqli_free_result($result);
                                ?>
                                <h3 class="card-title"><?php echo $rowCount;?></h3>        
                            </div>
                            <div class="card-footer">
                                <div class="stats"><i class="material-icons">date_range</i>  <?php echo $lastRecord;?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon"><a style="color: white" href="#process"><i class="material-icons">info_outline</i></a></div>
                                <p class="card-category">Pending</p>
                                <?php
                                    $sql = "SELECT complaints.created_at FROM `complaints` JOIN `users` ON complaints.dept_id=users.dept_id WHERE users.id='".$_SESSION['userId']."' AND complaints.status='Pending' ORDER BY complaints.created_at DESC";
                                    $result = mysqli_query($conn, $sql);
                                    $lastRecord = "No Record";
                                    
                                    if ( ($rowCount = mysqli_num_rows($result)) > 0 )
                                    {
                                        $row = mysqli_fetch_row($result);
                                        $lastRecord = "Last ".$row[0];
                                    }
                                    // Free result set
                                    mysqli_free_result($result);
                                ?>
                                <h3 class="card-title"><?php echo $rowCount;?></h3>        
                            </div>
                            <div class="card-footer">
                                <div class="stats"><i class="material-icons">date_range</i>  <?php echo $lastRecord;?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Complaints to a user/ user's department Row -->
    
    <?php
        }
        if ( $_SESSION['userType'] != 'Admin' )
        {
    ?>

    <!-- Complaints by a user/ user's department -->
    <div class="row">
        <div class="card" style="background: none !important;">
            <div class="card-header card-header-info">
                <h4 class="card-title">Tickets Issued by You</h4>
                <p class="card-category">
                    Stats of the Tickets filed by you 
                </p>
            </div>
            <div class="card-body table-responsive">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-danger card-header-icon">
                                <div class="card-icon"><i class="material-icons">assessment</i></div>
                                <p class="card-category">Total</p>
                                <?php
                                    $sql = "SELECT `created_at` FROM `complaints` WHERE `user_id`='".$_SESSION['userId']."' ORDER BY `id` DESC";
                                    $result = mysqli_query($conn, $sql);
                                    $lastRecord = "No Record";
                                    
                                    if (($rowCount = mysqli_num_rows($result)) > 0)
                                    {
                                        $row = mysqli_fetch_row($result);
                                        $lastRecord = "Last ".$row[0];
                                    }
                                    // Free result set
                                    mysqli_free_result($result);
                                ?>
                                <h3 class="card-title"><?php echo $rowCount;?></h3>        
                            </div>
                            <div class="card-footer">
                                <div class="stats"><i class="material-icons">date_range</i>  <?php echo $lastRecord;?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon"><i class="material-icons">thumb_up_alt</i></div>
                                <p class="card-category">Approved</p>
                                <?php
                                    $sql = "SELECT `created_at` FROM `complaints` WHERE `user_id`='".$_SESSION['userId']."' AND `status`='Approved' ORDER BY `id` DESC";
                                    $result = mysqli_query($conn, $sql);
                                    $lastRecord = "No Record";
                                    
                                    if ( ($rowCount = mysqli_num_rows($result)) > 0 )
                                    {
                                        $row = mysqli_fetch_row($result);
                                        $lastRecord = "Last ".$row[0];
                                    }
                                    // Free result set
                                    mysqli_free_result($result);
                                ?>
                                <h3 class="card-title"><?php echo $rowCount;?></h3>        
                            </div>
                            <div class="card-footer">
                                <div class="stats"><i class="material-icons">date_range</i>  <?php echo $lastRecord;?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon"><i class="material-icons">build</i></div>
                                <p class="card-category">Resolved</p>
                                <?php
                                    $sql = "SELECT `created_at` FROM `complaints` WHERE `user_id`='".$_SESSION['userId']."' AND `status`='Resolved' ORDER BY `id` DESC";
                                    $result = mysqli_query($conn, $sql);
                                    $lastRecord = "No Record";
                                    
                                    if ( ($rowCount = mysqli_num_rows($result)) > 0 )
                                    {
                                        $row = mysqli_fetch_row($result);
                                        $lastRecord = "Last ".$row[0];
                                    }
                                    // Free result set
                                    mysqli_free_result($result);
                                ?>
                                <h3 class="card-title"><?php echo $rowCount;?></h3>        
                            </div>
                            <div class="card-footer">
                                <div class="stats"><i class="material-icons">date_range</i>  <?php echo $lastRecord;?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon">
                                <div class="card-icon"><i class="material-icons">info_outline</i></div>
                                <p class="card-category">Pending</p>
                                <?php
                                    $sql = "SELECT `created_at` FROM `complaints` WHERE `user_id`='".$_SESSION['userId']."' AND `status`='Pending' ORDER BY `id` DESC";
                                    $result = mysqli_query($conn, $sql);
                                    $lastRecord = "No Record";
                                    
                                    if ( ($rowCount = mysqli_num_rows($result)) > 0 )
                                    {
                                        $row = mysqli_fetch_row($result);
                                        $lastRecord = "Last ".$row[0];
                                    }
                                    // Free result set
                                    mysqli_free_result($result);
                                ?>
                                <h3 class="card-title"><?php echo $rowCount;?></h3>        
                            </div>
                            <div class="card-footer">
                                <div class="stats"><i class="material-icons">date_range</i>  <?php echo $lastRecord;?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Complaints by a user/ user's department -->
    <?php
        }
    ?>
    <div class="row">
        <div class="col-lg-5 col-md-12">
            <div class="card">
                <div class="card-header card-header-info">
                    <h4 class="card-title">Departments / Categories</h4>
                    <p class="card-category">
                        <?php
                            $sql    = "SELECT `created_at` FROM `departments` ORDER BY `id` DESC LIMIT 1";
                            $result = mysqli_query($conn, $sql);
                            $lastRecord = "No Record";

                            if ( ($rowCount = mysqli_num_rows($result)) > 0 )
                            {
                                $row = mysqli_fetch_row($result);
                                $lastRecord = "Last Created on ".$row[0];
                            }
                            // Free result set
                            mysqli_free_result($result);
                            echo $lastRecord;
                        ?>
                    </p>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead class="text-dark text-center">
                            <th>ID</th><th>Department Code</th><th>Department Name</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM `departments`";
                                $result = mysqli_query($conn, $sql);
                                $id = 0;

                                if ( mysqli_num_rows($result) > 0 )
                                {
                                    while ( $row = mysqli_fetch_assoc($result) )
                                    {
                                        $id += 1;
                                        echo "<tr class=\"text-center\">";
                                        echo "<td>".$id."</td><td>".$row['code']."</td><td>".$row['name']."</td>";
                                        echo "</tr>";
                                    }
                                }
                                else
                                    echo "<td>-</td><td>-</td><td>-</td>";
                                // Free result set
                                mysqli_free_result($result);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-md-12">
            <div class="card">
                <div class="card-header card-header-info">
                    <h4 class="card-title">Resolvers</h4>
                    <p class="card-category">
                        <?php
                            $sql    = "SELECT `created_at` FROM `users` WHERE `role`='Resolver' ORDER BY `id` DESC LIMIT 1";
                            $result = mysqli_query($conn, $sql);
                            $lastRecord = "No Record";

                            if ( ($rowCount = mysqli_num_rows($result)) > 0 )
                            {
                                $row = mysqli_fetch_row($result);
                                $lastRecord = "Last Created on ".$row[0];
                            }
                            // Free result set
                            mysqli_free_result($result);
                            echo $lastRecord;
                        ?>
                    </p>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead class="text-dark text-center">
                            <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Department</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT users.id,users.name,users.email,users.phone,departments.name AS dept_name FROM `users` JOIN `departments` ON users.dept_id=departments.code WHERE users.role='Resolver'";
                                $result = mysqli_query($conn, $sql);
                                $id = 0;

                                if ( mysqli_num_rows($result) > 0 )
                                {
                                    while ( $row = mysqli_fetch_assoc($result) )
                                    {
                                        $id += 1;
                                        echo "<tr class=\"text-center\">";
                                        echo "<td>".$id."</td><td>".$row['name']."</td><td>".$row['email']."</td><td>".$row['phone']."</td><td>".$row['dept_name']."</td>";
                                        echo "</tr>";
                                    }
                                }
                                else
                                    echo "<tr class=\"text-center\">"."<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>"."</tr>";
                                // Free result set
                                mysqli_free_result($result);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-7 col-md-12">
            <div class="card">
                <div class="card-header card-header-info">
                    <h4 class="card-title">Service List</h4>
                    <p class="card-category">
                        <?php
                            $sql    = "SELECT `created_at` FROM `services` ORDER BY `id` DESC LIMIT 1";
                            $result = mysqli_query($conn, $sql);
                            $lastRecord = "No Record";

                            if ( ($rowCount = mysqli_num_rows($result)) > 0 )
                            {
                                $row = mysqli_fetch_row($result);
                                $lastRecord = "Last Created on ".$row[0];
                            }
                            // Free result set
                            mysqli_free_result($result);
                            echo $lastRecord;
                        ?>
                    </p>
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-hover">
                        <thead class="text-dark text-center">
                            <th>ID</th><th>Service Name</th><th>Description</th><th>Offered By</th>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT services.id,services.name,services.description,departments.name AS dept_name FROM services JOIN departments ON services.department_id=departments.id";
                                $result = mysqli_query($conn, $sql);
                                $id = 0;

                                if ( mysqli_num_rows($result) > 0 )
                                {
                                    while ( $row = mysqli_fetch_assoc($result) )
                                    {
                                        $id += 1;
                                        echo "<tr class=\"text-center\">";
                                        echo "<td>".$id."</td><td>".$row['name']."</td><td>".$row['description']."</td><td>".$row['dept_name']."</td>";
                                        echo "</tr>";
                                    }
                                }
                                else
                                    echo "<tr class=\"text-center\">"."<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>"."</tr>";
                                // Free result set
                                mysqli_free_result($result);
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
    </div>
</div>