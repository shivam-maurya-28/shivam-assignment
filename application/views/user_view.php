<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="container mt-3">
        <div class="heading text-center">
            <h3 class="text-danger">CURD Operation</h3>
        </div>
        <div class="addBtn d-flex justify-content-end">
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#ActionModal">Add
                New</button>
        </div>
        <div class="table-box mt-2">
            <table class="table table-danger">
                <thead>
                    <tr>
                        <th>SR.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Gender</th>
                        <th>State</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="tbl-body">
                </tbody>
            </table>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="ActionModal" tabindex="-1" aria-labelledby="ActionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ActionModalLabel">Form</h1>
                </div>
                <div class="modal-body">
                    <form id="form1">
                        <input type="hidden" name="id" id="id">
                        <div class="row">
                            <div class="col">
                                <label class="text-muted fw-bold text-nowrap">Name:</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="name" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label class="text-muted fw-bold text-nowrap">Email:</label>
                            </div>
                            <div class="col">
                                <input type="email" class="form-control" name="email" placeholder="Enter Email">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label class="text-muted fw-bold text-nowrap">Mobile:</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" name="mobile" placeholder="Enter mobile">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label class="text-muted fw-bold text-nowrap">gender:</label>
                            </div>
                            <div class="col">
                                <input type="radio" name="gender" value="Male"> Male
                                <input type="radio" name="gender" value="Female"> Female
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label class="text-muted fw-bold text-nowrap">state:</label>
                            </div>
                            <div class="col">
                                <select class="form-select" name="state">
                                    <option value="">Select State</option>
                                    <option value="Gujarat">Gujarat</option>
                                    <option value="Maharashtra">Maharashtra</option>
                                    <option value="Delhi">Delhi</option>
                                    <option value="Punjab">Punjab</option>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-4.0.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        function refreshData() {
            $.ajax({
                url: "<?php echo site_url('user/getUsers'); ?>",
                type: "GET",
                dataType: "json",
                success: function (response) {
                    var html = '';
                    $.each(response.data, function (index, user) {
                        html += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${user.name}</td>
                        <td>${user.email}</td>
                        <td>${user.mobile}</td>
                        <td>${user.gender}</td>
                        <td>${user.state}</td>
                        <td><button class="btn btn-sm btn-warning edit-btn" data-id="${user.id}">Edit</button>
                            <button class="btn btn-sm btn-danger delete-btn"data-id="${user.id}">Delete</button>
                        </td>
                    </tr>`;
                    });
                    $('.tbl-body').html(html);
                }
            });
        }
        $(document).ready(function () {
            refreshData();
            $('#form1').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                $.ajax({
                    url: "<?php echo site_url('user/saveUser'); ?>",
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.status == 'success') {
                            toastr.success(response.message);
                            $('#form1')[0].reset();
                            $('#ActionModal').modal('hide');
                            refreshData();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
            $(document).off('click','.edit-btn').on('click', '.edit-btn', function () {
                let id = $(this).data('id');
                $.ajax({
                    url: "<?php echo site_url('user/getUser'); ?>",
                    type: "POST",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function (res) {
                        $('#id').val(res.id);
                        $('input[name="name"]').val(res.name);
                        $('input[name="email"]').val(res.email);
                        $('input[name="mobile"]').val(res.mobile);
                        $('input[name="gender"][value="' + res.gender + '"]').prop('checked', true);
                        $('select[name="state"]').val(res.state);
                        $('#ActionModal').modal('show');
                    }
                });
            });
            $(document).off('click','.delete-btn').on('click', '.delete-btn', function () {
                let id = $(this).data('id');
                if (!confirm('Are you sure you want to delete this user')) {
                    return;
                }
                $.ajax({
                    url: "<?php echo site_url('user/deleteUser'); ?>",
                    type: "POST",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function (response) {
                        toastr.success(response.message);
                        refreshData();
                    }
                });
            });
        });
    </script>
</body>
</html>