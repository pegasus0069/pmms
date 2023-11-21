<?php
  session_start();
  include_once('../config/db.php');
  
?>
<style>
/* Scrollbar Styles */
.existing-comments {
  max-height: 300px;
  overflow-y: auto;
  padding: 5px;
}

.existing-comments::-webkit-scrollbar {
  width: 12px;
}

.existing-comments::-webkit-scrollbar-thumb {
  background-color: #555; /* Dark color for the thumb */
  border-radius: 6px;
}

.existing-comments::-webkit-scrollbar-track {
  background-color: #999; /* Dark color for the track */
}

.existing-comments::-webkit-scrollbar-thumb:hover {
  background-color: #777; /* Lighter color on hover */
}

  </style>
<div class="container-fluid">
  <?php
    if( $_SESSION['userType'] != 'User' )
    {
  ?>
  <!-- Start Table for Complaints To You/Your Department -->
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-info">
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
              <thead class="text-dark text-center">
                <th>ID</th><th>Department</th><th>Service Category</th><th>Service Name</th><th>Subject</th><th>Description</th><th>Date</th><th>Status</th><th>Comments</th><?php if ( $_SESSION['userType'] != 'User' ) {echo"<th>Action</th>";}?>
              </thead>
              <tbody>
              <?php
                  $sql = "SELECT complaints.id,complaints.user_id,complaints.service_category,complaints.service_name,complaints.subject,complaints.description,complaints.created_at,complaints.status FROM `complaints` JOIN `users` ON complaints.dept_id=users.dept_id WHERE users.id='".$_SESSION['userId']."' ORDER BY complaints.id DESC";
                  $result = mysqli_query($conn, $sql);
                  $id = 0;
              
                  if (mysqli_num_rows($result) > 0)
                  {
                    while($row = mysqli_fetch_assoc($result))
                    {
                      // Get user_id and subject from the current complaint
                      $user_id = $row['user_id'];
                      $senderDept_id;                
                      // Query the users table to get the dept_id based on user_id
                      $userQuery = "SELECT dept_id FROM users WHERE id = '$user_id'";
                      $userResult = mysqli_query($conn, $userQuery);
                                      
                      if (mysqli_num_rows($userResult) > 0)
                      {
                          $userRow = mysqli_fetch_assoc($userResult);
                          $senderDept_id = $userRow['dept_id'];
                      }
                      $id += 1;
                      echo "<tr class=\"text-center\">";
                      echo "<td class=\"d-none\">".$row['id']."</td>";
                      echo "<td>".$id."</td><td>".$senderDept_id."</td><td>".$row['service_category']."</td><td>".$row['service_name']."</td><td>".$row['subject']."</td><td>".$row['description']."</td><td>".$row['created_at']."</td><td class=\"text-dark font-weight-bold\">".$row['status']."</td>";
                      echo "<td>";
                      echo "<div class='comments-section'>";
                      echo "<div class='existing-comments' data-complaint-id='".$row['id']."'></div>";
                      echo "<textarea class='form-control new-comment' rows='2' placeholder='Add a comment...'></textarea>";
                      echo "<button class='btn btn-sm btn-info add-comment-btn' data-complaint-id='".$row['id']."'>Comment</button>";
                      echo "</div>";
                      echo "</td>";
                      if ( $_SESSION['userType'] != 'User' )
                      {
                        if ( $row['status'] == 'Pending' )
                          echo "<td><button class=\"btn btn-success btn-round btn-fab\" id=\"Resolved\"><i class=\"material-icons\" data-toggle=\"tooltip\" data-html=\"true\" title=\"Resolved\">build</i></button></td>";
                        /*   echo "<td><button class=\"btn btn-info btn-round btn-fab\" id=\"Approved\"><i class=\"material-icons\" data-toggle=\"tooltip\" data-html=\"true\" title=\"Approve\">thumb_up_alt</i></button><button class=\"btn btn-danger btn-round btn-fab\" id=\"Unresolved\"><i class=\"material-icons\" data-toggle=\"tooltip\" data-html=\"true\" title=\"Reject\">thumb_down_alt</i></button></td>"; */
                        else if ( $row['status'] == 'Approved')
                          echo "<td>Completed</td>";  
                          /* echo "<td><button class=\"btn btn-success btn-round btn-fab\" id=\"Resolved\"><i class=\"material-icons\" data-toggle=\"tooltip\" data-html=\"true\" title=\"Resolved\">build</i></button></td>"; */
                        else if ( $row['status'] == 'Unresolved' )
                          echo "<td><button class=\"btn btn-success btn-round btn-fab\" id=\"Resolved\"><i class=\"material-icons\" data-toggle=\"tooltip\" data-html=\"true\" title=\"Resolved\">build</i></button></td>";
                          /* echo "<td>No Action</td>"; */
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
// Add new comment
$(document).off('click', '.add-comment-btn').on('click', '.add-comment-btn', function() {
    var complaintId = $(this).data('complaint-id');
    var commentTextarea = $(this).siblings('.new-comment');
    var comment = commentTextarea.val();
    var uid = <?php echo json_encode($_SESSION['userId']); ?>;
    if (comment.trim() === '') {
        md.showNotification('top', 'right', 'warning', 'Please Enter a Comment!');
        return;
    }

    $.ajax({
        type: "POST",
        url: "./saveComment.php",
        data: {complaint_id: complaintId, user_id: uid, comment: comment},
        dataType: "json",
        success: function(data) {
            if(data.status === 'success') {
                loadComments();
                commentTextarea.val('');
                md.showNotification('top', 'right', 'success', data.message);
            } else {
                md.showNotification('top', 'right', 'danger', 'Something went Wrong, Error:'+data.message);
            }
        },
        error: function(xhr, status, error) {
                console.error("Error fetching comments:", xhr.responseText);
            } 
    });
});

  $(document).ready(function(){
    // Load existing comments when the page loads
    loadComments();

    // Create Complaint form Request
    $('#createComplaint-form button[type="submit"]').click(function(e){
      e.preventDefault();
      
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
      e.preventDefault();

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
              case 'Unresolved': setAlertColor = 'warning'; break;
              case 'Resolved': setAlertColor = 'success'; break;
              case 'Completed': setAlertColor = 'success'; break;              
            }

            md.showNotification('top', 'right', setAlertColor, 'Complaint status updated to '+action);
            setTimeout(function(){location.reload();},3000);
          }
        }/* ,
        error: function(){md.showNotification('top', 'right', 'danger', 'Something went Wrong! Try Again');} */
      });
    });
  });

function loadComments() {
    $('.existing-comments').each(function() {
        var complaintId = $(this).data('complaint-id');
        var commentsDiv = $(this);
        // Fetch existing comments
        $.ajax({
            type: "POST",
            url: "./getComments.php",
            data: {complaint_id: complaintId},
            dataType: "json",
            success: function(data) {
                var commentsHtml = '';
                data.forEach(function(comment) {
                    commentsHtml += '<p><strong>' + comment.name + ':</strong> ' + comment.comment + ' (' + comment.created_at + ')</p>';
                });
                commentsDiv.html(commentsHtml);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching comments:", xhr.responseText);
            }  
          });
    });
}

</script>