<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    <div class="modal fade" id="ActionModal" tabindex="-1" aria-labelledby="ActionModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
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
                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label class="text-muted fw-bold text-nowrap">Email <span class="text-danger">*</span>:</label>
                            </div>
                            <div class="col">
                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email" required>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label class="text-muted fw-bold text-nowrap">Mobile:</label>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="Enter mobile">
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label class="text-muted fw-bold text-nowrap">gender <span class="text-danger">*</span>:</label>
                            </div>
                            <div class="col">
                                <input type="radio" name="gender" value="Male" > Male
                                <input type="radio" name="gender" value="Female" required> Female
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col">
                                <label class="text-muted fw-bold text-nowrap">state <span class="text-danger">*</span>:</label>
                            </div>
                            <div class="col">
                                <?php
                                $states = ["Andhra Pradesh","Arunachal Pradesh","Assam","Bihar","Chhattisgarh","Goa","Gujarat","Haryana","Himachal Pradesh","Jharkhand","Karnataka","Kerala","Madhya Pradesh","Maharashtra","Manipur","Meghalaya","Mizoram","Nagaland","Odisha","Punjab","Rajasthan","Sikkim","Tamil Nadu","Telangana","Tripura","Uttar Pradesh","Uttarakhand","West Bengal"];
                                ?>
                                <select class="form-select" name="state" id="stateName" required>
                                    <option value="">Select State</option>
                                    <?php foreach($states as $state){ ?>
                                        <option value="<?= $state; ?>"><?= $state; ?></option><?php } ?>
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="bs-modal-close">Close</button>
                    <button type="submit" class="btn btn-danger">Save</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $('#stateName').select2({
            dropdownParent: $('#ActionModal'),
            placeholder:'Select a state',
            width: '100%',
        });
        $('#bs-modal-close').off('click').on('click',function(){
            $('#form1')[0].reset();
            $('#id').val('');
            $('#stateName').val('').trigger('change');
        });
        $('#name').on('input',function(){
            this.value= this.value.replace(/[^a-zA-Z\s]/g,'');
        });
        $('#mobile').on('input',function(){
            this.value= this.value.replace(/[^0-9\+\s]/g,'').substring(0,14);
        });
        $('#email').on('input',function(){
            this.value= this.value.replace(/[^a-zA-Z0-9@.\s]/g,'');
        });
        function refreshData() {
            $.ajax({
                url: "<?php echo site_url('user/getUsers'); ?>",
                type: "GET",
                dataType: "json",
                success: function (response) {
                    var data = response.data;
                    var html = '';
                    if(data.length == 0){
                        html += `
                        <tr>
                            <td colspan ="7" class="text-center">No Rows found</tr>
                        </tr>
                        `;
                    }
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
                    processData:false,
                    contentType:false,
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
                        $('select[name="state"]').val(res.state).trigger('change');
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