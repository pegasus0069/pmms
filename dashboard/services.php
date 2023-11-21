<?php
  session_start();
  include_once('../config/db.php');
  // Function to fetch departments for the list
    function fetchDepartments($conn) {
        $sql = "SELECT id, name FROM departments";
        $result = mysqli_query($conn, $sql);
        $departments = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $departments;
        
    }
    $departments = fetchDepartments($conn);
  if ( $_SESSION['userType'] == 'Admin' )
  {
?>
<div class="container-fluid">
  <div class="row">  
    <!-- Table Column -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-info">
          <div class="row">
            <div class="col-12 col-xl-9 col-lg-8">
              <h4 class="card-title">Services</h4>
              <p class="card-category">Listing of all available Services</p>
            </div>
            <div class="col-12 col-xl-3 col-lg-3">
                <button class="card-title btn btn-success pl-0 mt-1" data-toggle="modal" data-target="#createServiceModal"><i class="material-icons pl-3 pr-2">add</i>Add Service</button>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table" id="services-table">
              <thead class="text-dark text-center">
                <th>ID</th><th>Service Category</th><th>Service Name</th><th class="text-left">Service Description</th><th>Issued Dept. ID</th><th>Action</th>
              </thead>
              <tbody>
                <?php
                  $sql = "SELECT * FROM services";
                  $result = mysqli_query($conn, $sql);
                  $id = 0;

                  if (mysqli_num_rows($result) > 0)
                  {
                    while($row = mysqli_fetch_assoc($result))
                    {
                      $id += 1;
                      echo "<tr class=\"text-center\">";
                      echo "<td class=\"d-none\">".$row['id']."</td>";
                      echo "<td>".$row['id']."</td><td>".$row['category']."</td><td class=\"text-left\">".$row['name']."</td><td class=\"text-left\">".$row['description']."</td><td>".$row['department_id']."</td>";

                      echo "<td><button class=\"btn btn-info btn-round btn-fab\" id=\"updateService\" data-toggle=\"modal\" data-target=\"#updateServiceModal\"><i class=\"material-icons\" data-toggle=\"tooltip\" data-html=\"true\" title=\"Edit\">create</i></button><button class=\"btn btn-danger btn-round btn-fab\" id=\"deleteService\"><i class=\"material-icons\" data-toggle=\"tooltip\" data-html=\"true\" title=\"Remove\">delete_forever</i></button></td>";
                      echo "</tr>";
                    }
                  }
                  else
                  {
                    echo "<tr class=\"text-center\">";
                    echo "<td>-</td><td>-</td><td>-</td><td>-</td><td>-</td>";
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
</div>

<!-- Create Services Modal -->
<div class="modal fade" id="createServiceModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document" >
    <div class="modal-content card">
      <div class="modal-header card-header-info">
        <h5 class="modal-title card-title" id="exampleModalLongTitle">Add New Service</h5>
        <button type="button" class="close card-header-icon" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" class="card-body" id="createService-form">
        <div class="modal-body">
          
          <!-- Service Category -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating" style="font-size:12pt;">Service Category</label>
                <input type="text" name="serviceCategory" class="form-control" placeholder="Enter Service Category!" required>
              </div>
            </div>
          </div>

          <!-- Service Name -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating" style="font-size:12pt;">Service Name</label>
                <input type="text" name="serviceName" class="form-control" placeholder="Enter Service Name!" required>
              </div>
            </div>
          </div>

          <!-- Service Description -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating" style="font-size:12pt;">Service Description</label>
                <textarea type="text" name="serviceDescription" class="form-control" rows="5" placeholder="Enter the description of the service in details." required></textarea>
              <!--<input type="text" name="serviceDescription" class="form-control" placeholder="Enter the description of the service in details." required>-->
            </div>
            </div>
          </div>
          
          <!-- Service Issued Department ID -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating" style="font-size:12pt;">Service Issued Department ID</label>
                <input type="text" name="serviceideptid" class="form-control" placeholder="Enter Dept. ID from the list!" required>
              </div>
            </div>
            <!-- List of Departments on the right side -->

            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating" style="font-size:12pt;">Departments List</label>
                <ul id="departmentsList" class="list-group">
                  <?php foreach ($departments as $department): ?>
                    <li class="list-group-item">
                      <span class="badge badge-primary badge-pill" style="font-size:14px;"><?php echo $department['id']; ?></span>
                      <?php echo $department['name']; ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        
        <!-- Submit Buttons -->
        <div class="modal-footer">
          <button type="reset" class="btn btn-danger btn-round">Reset</button>
          <button type="submit" class="btn btn-success btn-round">Add Service</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Create Services Modal -->

<!-- Update Services Modal -->
<div class="modal fade" id="updateServiceModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content card">
      <div class="modal-header card-header-info">
        <h5 class="modal-title card-title" id="exampleModalLongTitle">Update Service</h5>
        <button type="button" class="close card-header-icon" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" class="card-body" id="updateService-form">
        <div class="modal-body">
          
          <input type="hidden" name="action">
          <input type="hidden" name="serviceNewIdentity">

          <!-- Service Category -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">Service Category</label>
                <input type="text" name="serviceNewCategory" class="form-control" required>
              </div>
            </div>
          </div>

          <!-- Service Name -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">Service Name</label>
                <input type="text" name="serviceNewName" class="form-control" required>
              </div>
            </div>
          </div>

          <!-- Service Description -->
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label class="bmd-label-floating">Service Description</label>
                <!--<textarea type="text" name="serviceNewDescription" class="form-control" rows="5" placeholder="Enter the description of the service in details." required></textarea>-->
                <input type="text" name="serviceNewDescription" class="form-control" required>
              </div>
            </div>
          </div>

          <!-- Service Issued Department ID -->
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating" style="font-size:12pt;">Service Issued Department ID</label>
                <input type="text" name="serviceNewideptid" class="form-control" placeholder="Enter Dept. ID from the list!" required>
              </div>
            </div>
            <!-- List of Departments on the right side -->

            <div class="col-md-6">
              <div class="form-group">
                <label class="bmd-label-floating" style="font-size:12pt;">Departments List</label>
                <ul id="departmentsList" class="list-group">
                  <?php foreach ($departments as $department): ?>
                    <li class="list-group-item">
                      <span class="badge badge-primary badge-pill" style="font-size:14px;"><?php echo $department['id']; ?></span>
                      <?php echo $department['name']; ?>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>

          <div class="clearfix"></div>
        </div>
        
        <!-- Submit Buttons -->
        <div class="modal-footer">
          <button type="submit" class="btn btn-info btn-round">Update Service</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Update Services Modal -->

<script>
  
  $(document).ready(function(){
    
    // Update Action Button Request
    // Called before the below modal is opened - Bootstrap event
    $('#updateServiceModal').on('show.bs.modal', function (e) {
      row = $(e.relatedTarget).parent().siblings().map(function() {return $(this).text();}).get();
      
      $('#updateService-form input[name="action"]').val('update');
      $('#updateService-form input[name="serviceNewIdentity"]').val(row[0]);
      $('#updateService-form input[name="serviceNewCategory"]').val(row[2]);
      $('#updateService-form input[name="serviceNewName"]').val(row[3]);
      $('#updateService-form input[name="serviceNewDescription"]').val(row[4]);
      $('#updateService-form input[name="serviceNewideptid"]').val(row[5]);

    });

    // Delete Action Button Request
    $('#services-table button#deleteService').click(function(e){
      e.preventDefault();

      action = $(this).attr('id').split('S')[0];
      name   = $(this).parent().siblings('.d-none').text();
        console.log(action);
        console.log(name);
      //create an ajax request for the specified action
      $.ajax({
        type: "POST",
        url: "./includes/updateService.inc.php",
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
            md.showNotification('top', 'right', 'warning', 'Service deleted successfully');
            setTimeout(function(){location.reload();},3000);
          }
        },
        error: function(data){md.showNotification('top', 'right', 'danger', 'Something went Wrong! Try Again');}
      });
    });

    // Create Service form Request
    $('#createService-form button[type="submit"]').click(function(e){
      e.preventDefault();
      
      $('#createService-form input').removeClass('is-invalid');
      $('.invalid-feedback').remove();
      
      $.ajax({
        type : 'POST',
        url  : './includes/createService.inc.php',
        data : $('#createService-form').serialize(),
        dataType : 'json',
        success : function(data){
          $('#createService-form button[type="submit"]').html('Adding Service...').attr('disabled', 'disabled');
          if ( data.status === 'error' )
          {
            // alert('error');
            $.each( data.errors, function(key, value){
              if( key == 'sql' )
              {
                $("#createService-form button[type='reset']").before('<div class="alert alert-danger">'+value+'</div>');
              }
              else
              {
                $("#createService-form input[name="+key+"]").addClass('is-invalid')
                .after('<div class="invalid-feedback">'+value+'</div>');
              }
            });
          }
          else
          {
            // alert('success');
            $("#createService-form")[0].reset();
            $("#createService-form .modal-footer").before('<div class="alert alert-success">Service created successfully.</div>');
            setTimeout(function(){location.reload();},1500);
          }
          $('#createService-form button[type="submit"]').html('Add Service').removeAttr('disabled');
        },
        error: function(){$("#createService-form .modal-footer").before('<div class="alert alert-danger">Something went Wrong! Try Again</div>');}
      });
    });

    // Update Service form Request
    $('#updateService-form button[type="submit"]').click(function(e){
      e.preventDefault();
      
      $('#updateService-form input').removeClass('is-invalid');
      $('.invalid-feedback').remove();
      console.log($('#updateService-form').serialize());
      $.ajax({
        type : 'POST',
        url  : './includes/updateService.inc.php',
        data : $('#updateService-form').serialize(),
        dataType : 'json',
        success : function(data){
          $('#updateService-form button[type="submit"]').html('Updating ...').attr('disabled', 'disabled');
          if ( data.status === 'error' )
          {
            // alert('error');
            $.each( data.errors, function(key, value){
              if( key == 'sql' )
              {
                $("#updateService-form .modal-footer").before('<div class="alert alert-danger">'+value+'</div>');
              }
              else
              {
                $("#updateService-form input[name="+key+"]").addClass('is-invalid')
                .after('<div class="invalid-feedback">'+value+'</div>');
              }
            });
          }
          else
          {
            // alert('success');
            $("#updateService-form")[0].reset();
            $("#updateService-form .modal-footer").before('<div class="alert alert-success">Service updated successfully.</div>');
            setTimeout(function(){location.reload();},1500);
          }
          $('#updateService-form button[type="submit"]').html('Update Service').removeAttr('disabled');
        },
        error: function(){$("#updateService-form .modal-footer").before('<div class="alert alert-danger">Something went Wrong! Try Again</div>');}
      });
    });

  });
</script>
<?php
  }
  else
  {
    header('Location: ./');
    exit();
  }
?>