<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <title>Phonebook</title>
  </head>
  <body>
    <div class="modal fade" id="contactAddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="saveContact">
                    <div class="modal-body">
                        <div id="errorMessage" class="alert alert-warning d-none"></div>
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Phone</label>
                            <input type="text" name="phone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Contact Group</label>
                            <input type="text" name="cgroup" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Contact</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="contactEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateContact">
                    <div class="modal-body">
                        <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>
                        <input type="hidden" name="contact_id" id="contact_id">
                        <div class="mb-3">
                            <label for="">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Phone</label>
                            <input type="text" name="phone" id="phone" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="">Contact Group</label>
                            <input type="text" name="cgroup" id="cgroup" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update Contact</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="contactViewModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">View Contact</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Name</label>
                        <p id="view_name" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <p id="view_email" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label for="">Phone</label>
                        <p id="view_phone" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label for="">Contact Group</label>
                        <p id="view_cgroup" class="form-control"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Phonebook
                            <button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#contactAddModal">
                                Add Contact
                            </button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Group</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                require 'dbcon.php';

                                $query = "SELECT * FROM `contacts`";
                                $query_run = mysqli_query($con, $query);

                                if(mysqli_num_rows($query_run) > 0){
                                    foreach($query_run as $contact){
                                        ?>
                                        <tr>
                                            <td><?= $contact['id']; ?></td>
                                            <td><?= $contact['name']; ?></td>
                                            <td><?= $contact['email']; ?></td>
                                            <td><?= $contact['phone']; ?></td>
                                            <td><?= $contact['cgroup']; ?></td>
                                            <td>
                                                <button type="button" value="<?=$contact['id'];?>" class="viewContactBtn btn btn-info btn-sm">View</button>
                                                <button type="button" value="<?=$contact['id'];?>" class="editContactBtn btn btn-success btn-sm">Edit</button>
                                                <button type="button" value="<?=$contact['id'];?>" class="deleteContactBtn btn btn-danger btn-sm">Delete</button>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>
        $(document).on('submit', '#saveContact', function(e){
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("save_contact", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422){
                        $('#errorMessage').removeClass('d-none');
                        $('#errorMessage').text(res.message);
                    }
                    else if(res.status == 200){
                        $('#errorMessage').addClass('d-none');
                        $('#contactAddModal').modal('hide');
                        $('#saveContact')[0].reset();

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#myTable').load(location.href + " #myTable");
                    }
                    else if(res.status == 500){
                        alert(res.message);
                    }
                }
            });
        });
        $(document).on('click', '.editContactBtn', function(){
            var contact_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code.php?contact_id=" + contact_id,
                success: function(response){
                    var res = jQuery.parseJSON(response);
                    if(res.status == 404) {
                        alert(res.message);
                    }
                    else if(res.status == 200){
                        $('#contact_id').val(res.data.id);
                        $('#name').val(res.data.name);
                        $('#email').val(res.data.email);
                        $('#phone').val(res.data.phone);
                        $('#cgroup').val(res.data.cgroup);

                        $('#contactEditModal').modal('show');
                    }
                }
            });
        });
        $(document).on('submit', '#updateContact', function(e){
            e.preventDefault();

            var formData = new FormData(this);
            formData.append("update_contact", true);

            $.ajax({
                type: "POST",
                url: "code.php",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    var res = jQuery.parseJSON(response);
                    if(res.status == 422){
                        $('#errorMessageUpdate').removeClass('d-none');
                        $('#errorMessageUpdate').text(res.message);
                    }
                    else if(res.status == 200){
                        $('#errorMessageUpdate').addClass('d-none');

                        alertify.set('notifier','position', 'top-right');
                        alertify.success(res.message);

                        $('#contactEditModal').modal('hide');
                        $('#updateContact')[0].reset();

                        $('#myTable').load(location.href + " #myTable");
                    }
                    else if(res.status == 500){
                        alert(res.message);
                    }
                }
            });
        });
        $(document).on('click', '.viewContactBtn', function(){
            var contact_id = $(this).val();
            $.ajax({
                type: "GET",
                url: "code.php?contact_id=" + contact_id,
                success: function(response){
                    var res = jQuery.parseJSON(response);
                    if(res.status == 404){
                        alert(res.message);
                    }
                    else if(res.status == 200){
                        $('#view_name').text(res.data.name);
                        $('#view_email').text(res.data.email);
                        $('#view_phone').text(res.data.phone);
                        $('#view_cgroup').text(res.data.cgroup);

                        $('#contactViewModal').modal('show');
                    }
                }
            });
        });
        $(document).on('click', '.deleteContactBtn', function(e){
            e.preventDefault();

            if(confirm('Are you sure you want to delete the contact from Phonebook?')){
                var contact_id = $(this).val();
                $.ajax({
                    type: "POST",
                    url: "code.php",
                    data: {
                        'delete_contact': true,
                        'contact_id': contact_id
                    },
                    success: function(response){
                        var res = jQuery.parseJSON(response);
                        if(res.status == 500){
                            alert(res.message);
                        }
                        else{
                            alertify.set('notifier','position','top-right');
                            alertify.success(res.message);

                            $('#myTable').load(location.href + " #myTable");
                        }
                    }
                });
            }
        });
    </script>
  </body>
</html>