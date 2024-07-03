<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Address and Status Form</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body style="background:#f3f6f9;">

   <style type="text/css">
      .banner{
         background-image: url(../wp-content/plugins/address-redirection/public/src/images/setting.jpg);
         height: ;
         margin-bottom: 30px;
      }
   </style>



  <?php

   global $wpdb;

      $get_data = "SELECT * FROM {$wpdb->prefix}my_addresses";
      $result = $wpdb->get_results($get_data, ARRAY_A); // Use get_results instead of query




   ?>


    <div class="row p-4" id="wpwrap">
      <div class="banner">
      <h1 class="wp-heading-inline">Your Address</h1>
      <p>Set their status based on the location and enter your address.</p>
      </div>
      <div id="col-container" class="wp-clearfix">
   <div id="col-left">
      <div class="col-wrap">
         <div class="form-wrap">
            <h2>Add New Address</h2>
                <form method="POST" action="../wp-content/plugins/address-redirection/includes/send-data.php">
                
                <div class="form-field form-required term-name-wrap">
                   <label for="tag-name">Address</label>
					<input type="text" id="autocomplete" placeholder="Enter your address" name="address" aria-describedby="name-description" onFocus="initAutocomplete()">
                   <p id="name-description">The Adress is enter here.</p>
                </div>

                <div class="form-field term-slug-wrap">
                   <label for="tag-slug">City</label>
                   <input name="city"  id="locality"  type="text" value="" size="40" aria-describedby="slug-description" readonly>
                   <p id="slug-description">The City of the Address</p>
                </div>
                <div class="form-field term-slug-wrap">
                   <label for="tag-slug">State</label>
                   <input name="state" id="administrative_area_level_1" readonly type="text" value="" size="40" aria-describedby="slug-description">
                   <p id="slug-description">The State of the Address</p>
                </div>
                <div class="form-field term-slug-wrap">
                   <label for="tag-slug">Zip Code</label>
                   <input name="zip_code" id="postal_code" readonly type="text" value="" size="40" aria-describedby="slug-description">
                   <p id="slug-description">The Zip Code of the Address</p>
                </div>



                <div class="form-field term-slug-wrap">
                   <label for="tag-slug">Address URL</label>
                   <input name="redirect_url" id="redirect_url" type="url" value="" size="40" aria-describedby="slug-description">
                   <p id="slug-description">The Specific URL for the Address</p>
                </div>
					
					<div class="form-field term-slug-wrap">
                   <label for="tag-slug">City URL</label>
                   <input name="city_url" id="city_url" type="url" value="" size="40" aria-describedby="slug-description">
                   <p id="slug-description">The Specific URL for the city</p>
                </div>

                <div class="form-field term-parent-wrap">
                   <label for="parent">Status</label>
                   <select name="status" id="status" class="postform" aria-describedby="parent-description">
                      <option value="" disabled selected>Select status</option>
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                   </select>
                   <p id="parent-description">Set your Address Status according to you address</p>
                </div>

                <input type="submit" class="button button-primary" value="Add New Address">       
                
             </form>
         </div>
      </div>
   </div>
   <!-- /col-left -->
   <div id="col-right">
      <?php 
      if (isset($_GET['success'])) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
    echo '<i class="uil uil-exclamation-octagon me-2"></i>';
    echo 'The address has been successfully added.';
    echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
    echo '</div>';
   }

   if (isset($_GET['upated-successfully'])) {
       echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
       echo '<i class="uil uil-exclamation-octagon me-2"></i>';
       echo 'The address has been successfully updated.';
       echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
       echo '</div>';
   }

   if (isset($_GET['delete'])) {
       echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
       echo '<i class="uil uil-exclamation-octagon me-2"></i>';
       echo 'The address has been effectively removed.';
       echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
       echo '</div>';
   } ?>
      <div class="col-wrap">
         <table class="table table-hover wp-list-table widefat fixed striped table-view-list mt-2" id="dtBasicExample">
    <thead>
        <tr>
            <th scope="col" class="manage-column column-primary"><span>Address</span> </th>
            <th scope="col" class="manage-column column-primary"><span>Address URL</span> </th>
			 <th scope="col" class="manage-column column-primary"><span>City URL</span> </th>
            <th scope="col" class="manage-column column-primary"><span>Status</span> </th>
            <th scope="col" class="manage-column column-primary"><span>Change Status</span> </th>
            <th scope="col" class="manage-column column-primary"><span>Action</span> </th>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result) {
            foreach ($result as $row) {
        ?>
                <tr>
                    <td><?php echo $row['address'] . '&nbsp;' . $row['city'] . ', ' . $row['state'] . ', ' . $row['zip_code']; ?></td>
                    <td><?php echo $row['redirect_url']; ?></td>
					<td><?php echo $row['city_url']; ?></td>
                    <td>
                        <?php if ($row['status'] == 'active') { ?>
                            <p class="bg-success text-center text-light px-1 pt-1 pb-1 rounded">Active</p>
                        <?php } else { ?>
                            <p class="bg-danger text-center text-light px-1 pt-1 pb-1 rounded">Inactive</p>
                        <?php } ?>
                    </td>
                    <td>
                        <form action="../wp-content/plugins/address-redirection/includes/update.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                            <div class="row">
                                <div class="col-md-8">
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="" disabled selected>Change status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button style="padding: 1px 6px !important;" class="btn btn-success p-1 px-1" type="submit">
                                        <i class="fa fa-check" style="font-size: 13px;"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </td>
                    <td>
                        <a href="../wp-content/plugins/address-redirection/includes/delete.php?id=<?php echo $row['id']; ?>">
                            <button style="padding: 1px 6px !important;" class="btn btn-danger p-1 px-1" type="submit">
                                <i class="fa fa-trash" style="font-size: 13px;"></i>
                            </button>
                        </a>
                    </td>
                </tr>
        <?php
            }
        }
        ?>
    </tbody>
    <tfoot>
        <tr>
            <th scope="col" class="manage-column column-primary"><span>Address</span> </th>
            <th scope="col" class="manage-column column-primary"><span>Address URL</span> </th>
			<th scope="col" class="manage-column column-primary"><span>City URL</span> </th>
            <th scope="col" class="manage-column column-primary"><span>Status</span> </th>
            <th scope="col" class="manage-column column-primary"><span>Change Status</span> </th>
            <th scope="col" class="manage-column column-primary"><span>Action</span> </th>
        </tr>
    </tfoot>
</table>
      </div>
   </div>
   <!-- /col-right -->
</div>
    </div>

    <!-- Bootstrap JS and Popper.js (for Bootstrap's JavaScript components) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap.min.css" integrity="sha512-BMbq2It2D3J17/C7aRklzOODG1IQ3+MHw3ifzBHMBwGO/0yUqYmsStgBjI0z5EYlaDEFnvYV7gNYdD3vFLRKsA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.bootstrap4.min.css" integrity="sha512-PT0RvABaDhDQugEbpNMwgYBCnGCiTZMh9yOzUsJHDgl/dMhD9yjHAwoumnUk3JydV3QTcIkNDuN40CJxik5+WQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.jqueryui.min.css" integrity="sha512-x2AeaPQ8YOMtmWeicVYULhggwMf73vuodGL7GwzRyrPDjOUSABKU7Rw9c3WNFRua9/BvX/ED1IK3VTSsISF6TQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.uikit.min.css" integrity="sha512-v1si6kCoH7ODQMp4X4TZXOZzDTrhKhWRdd50pRuejFJMSYKrLoW68NQmmTJWjgs1B0VRYaE6oB1CDq6r5r306A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/css/dataTables.material.min.css" integrity="sha512-xvrm5KqgBtR7kE0ehXfSSkQvzArzm/iBSx6aXcINru5dM0YWCaqrHfsN1PHCQBgL03/7fJHqypWZoA5w0T6lMA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script>
      $(document).ready(function () {
        $('#dtBasicExample').DataTable();
        $('.dataTables_length').addClass('bs-select');
      });
    </script>
  <script>
    function initAutocomplete() {
      // Create the autocomplete object, restricting the search predictions to geographical location types.
      var autocomplete = new google.maps.places.Autocomplete(
        document.getElementById('autocomplete'), { types: ['geocode'] });

      // When the user selects an address from the dropdown, populate the city, state, and zip code fields in the form.
      autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (!place.geometry) {
          window.alert("No details available for input: '" + place.name + "'");
          return;
        }

        // Get the street address
        var streetAddress = place.name;

        // Get city, state, and zip code
        var city = "";
        var state = "";
        var zipCode = "";

        for (var i = 0; i < place.address_components.length; i++) {
          var component = place.address_components[i];
          if (component.types.includes('locality')) {
            city = component.long_name;
          } else if (component.types.includes('administrative_area_level_1')) {
            state = component.short_name;
          } else if (component.types.includes('postal_code')) {
            zipCode = component.short_name;
          }
        }

        // Populate the city, state, and zip code fields
        document.getElementById('locality').value = city;
        document.getElementById('administrative_area_level_1').value = state;
        document.getElementById('postal_code').value = zipCode;

        // Populate only the street address in the address input
        document.getElementById('autocomplete').value = streetAddress;
      });
    }
  </script>

</body>
</html>
