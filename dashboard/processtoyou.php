<?php
  session_start();
  include_once('../config/db.php');
?>
<div class="container-fluid">
  <?php
    if( $_SESSION['userType'] != 'User' )
    {
  ?>
  <!-- Start Table for Complaints To You/Your Department -->
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <div class="row">
            <div class="col-12 col-xl-9 col-lg-8">
              <h4 class="card-title">Tickets Issued To You</h4>
              <p class="card-category">Listing of all Tickets with Status and Actions filed to your Department</p>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="complaints-table">
              <thead class="text-primary text-center">
                <th>ID</th><th>Subject</th><th>Description</th><th>Date</th><th>Status</th><?php if ( $_SESSION['userType'] != 'User' ) {echo"<th>Action</th>";}?>
              </thead>
              <tbody>
              <?php
                  $sql = "SELECT complaints.id,complaints.subject,complaints.description,complaints.created_at,complaints.status FROM `complaints` JOIN `users` ON complaints.dept_id=users.dept_id WHERE users.id='".$_SESSION['userId']."'";
                  $result = mysqli_query($conn, $sql);
                  $id = 0;

                  if (mysqli_num_rows($result) > 0)
                  {
                    while($row = mysqli_fetch_assoc($result))
                    {
                      $id += 1;
                      echo "<tr class=\"text-center\">";
                      echo "<td class=\"d-none\">".$row['id']."</td>";
                      echo "<td>".$id."</td><td>".$row['subject']."</td><td>".$row['description']."</td><td>".$row['created_at']."</td><td class=\"text-primary font-weight-bold\">".$row['status']."</td>";

                      if ( $_SESSION['userType'] != 'User' )
                      {
                        if ( $row['status'] == 'Pending' )
                          echo "<td><button class=\"btn btn-info btn-round btn-fab\" id=\"Approved\"><i class=\"material-icons\" data-toggle=\"tooltip\" data-html=\"true\" title=\"Approve\">thumb_up_alt</i></button><button class=\"btn btn-danger btn-round btn-fab\" id=\"Rejected\"><i class=\"material-icons\" data-toggle=\"tooltip\" data-html=\"true\" title=\"Reject\">thumb_down_alt</i></button></td>";
                        else if ( $row['status'] == 'Approved')
                          echo "<td><button class=\"btn btn-success btn-round btn-fab\" id=\"Resolved\"><i class=\"material-icons\" data-toggle=\"tooltip\" data-html=\"true\" title=\"Resolved\">build</i></button></td>";
                        else if ( $row['status'] == 'Rejected' )
                          echo "<td>No Action</td>";
                        else
                          echo "<td>No Action</td>";
                      }
                      echo "</tr>";
                    }
                  }
                  else
                  {
                    echo "<tr class=\"text-center\">";
                    echo "<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>";
                    if( $_SESSION['userType'] != 'User' ) echo "<td>-</td>";
                    echo "</tr>";   
                  }
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
  <!-- End Table for Complaints To You/Your Department -->
  <?php
    }
  ?>
</div>
<script>
  // Toggle Department Select Menu
  $(document).ready(function(){
    
    // Create Complaint form Request
    $('#createComplaint-form button[type="submit"]').click(function(e){
      e.);
      
      $('#createComplaint-form input').removeClass('is-invalid');
      $('.invalid-feedback').remove();
      
      $.ajax({
        type : 'POST',
        url  : './includes/createComplaint.inc.php',
        data : $('#createComplaint-form').serialize(),
        dataType : 'json',
        success : function(data){
          $('#createComplaint-form button[type="submit"]').html('Submitting ...').attr('disabled', 'disabled');
          if ( data.status === 'error' )
          {
            // alert('error');
            $.each( data.errors, function(key, value){
              if( key == 'sql' )
              {
                $("#createComplaint-form button[type='reset']").before('<div class="alert alert-danger">'+value+'</div>');
              }
              else
              {
                if( key == 'complaintBody' )
                {
                    $("#createComplaint-form textarea[name="+key+"]").addClass('is-invalid')
                    .after('<div class="invalid-feedback">'+value+'</div>');
                }
                else
                {
                    $("#createComplaint-form input[name="+key+"]").addClass('is-invalid')
                    .after('<div class="invalid-feedback">'+value+'</div>');
                }
              }
            });
          }
          else
          {
            // alert('success');
            $("#createComplaint-form")[0].reset();
            $("#createComplaint-form .modal-footer").before('<div class="alert alert-success">Complaint submitted successfully.</div>');
            setTimeout(function(){location.reload();},1500);
          }
          $('#createComplaint-form button[type="submit"]').html('Create').removeAttr('disabled');
        },
        error: function(){$("#createComplaint-form .modal-footer").before('<div class="alert alert-danger">Something went Wrong! Try Again</div>');}
      });
    }, {passive:false});

    // Action Buttons Request
    $('#complaints-table button').click(function(e){
      e.);

      action = $(this).attr('id');
      name   = $(this).parent().siblings('.d-none').text();
      
      //create an ajax request for the specified action
      $.ajax({
        type: "POST",
        url: "./includes/updateComplaintStatus.inc.php",
        data: {action: action, name: name},
        dataType : 'json',
        success : function(data){
          if ( data.status === 'error' )
          {
            // alert('error');
            $.each( data.errors, function(key, value){
              if( key == 'sql' )
              {
                md.showNotification('top', 'right', 'warning', value);
              }
            });
          }
          else
          {
            // alert('success');
            switch(action)
            {
              case 'Approved': setAlertColor = 'info'; break;
              case 'Rejected': setAlertColor = 'warning'; break;
              case 'Resolved': setAlertColor = 'success'; break;
            }

            md.showNotification('top', 'right', setAlertColor, 'Complaint status updated to '+action);
            setTimeout(function(){location.reload();},4000);
          }
        },
        error: function(){md.showNotification('top', 'right', 'danger', 'Something went Wrong! Try Again');}
      });
    }, {passive:false});
  });
</script>