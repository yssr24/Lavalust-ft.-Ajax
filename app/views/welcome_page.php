<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to LavaLust</title>
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">
    <style type="text/css">
        .user-list {
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            position: relative;
        }
        .btn-add-user {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: 0 auto;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="header text-center my-4">
            <h1>Lavalust ft. Ajax</h1>
        </div>
        <div class="main">
            <div id="userListDiv" class="user-list">
                <h2>User List</h2>
                <button id="showAddUserForm" class="btn btn-primary btn-add-user">Add User</button>
                <div id="userList" class="table-responsive">
                    <table id="userTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                        <tbody>
                            <!-- User data will be appended here -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="addUserDiv" class="d-none">
                <form id="userForm" class="form-container">
                    <h2>Add User</h2>
                    <div class="form-group">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <select name="gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="address" class="form-control" placeholder="Address" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Add User</button>
                    <button id="backToUserList" type="button" class="btn btn-secondary">Back</button>
                </form>
            </div>
            <div id="editUserDiv" class="d-none">
                <form id="editUserForm" class="form-container">
                    <h2>Edit User</h2>
                    <input type="hidden" name="user_id" id="edit_user_id">
                    <div class="form-group">
                        <input type="text" name="first_name" id="edit_first_name" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" name="last_name" id="edit_last_name" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" id="edit_email" class="form-control" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <select name="gender" id="edit_gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="address" id="edit_address" class="form-control" placeholder="Address" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Update User</button>
                    <button id="backToUserListFromEdit" type="button" class="btn btn-secondary">Back</button>
                </form>
            </div>
        </div>
        <div class="footer text-center my-4">
            Footer content here
        </div>
    </div>

    <script>
        $(document).ready(function() {
            function loadUsers() {
                $.ajax({
                    url: '<?= site_url('user/get');?>',
                    type: 'GET',
                    success: function(response) {
                        let users = JSON.parse(response);
                        let userList = '';
                        users.forEach(function(user) {
                            userList += '<tr>';
                            userList += '<td>' + user.yjp_last_name + ' ' + user.yjp_first_name + '</td>';
                            userList += '<td>' + user.yjp_gender + '</td>';
                            userList += '<td>' + user.yjp_email + '</td>';
                            userList += '<td>' + user.yjp_address + '</td>';
                            userList += '<td>';
                            userList += '<button class="btn btn-warning btn-sm edit-user" data-id="' + user.id + '">Edit</button> ';
                            userList += '<button class="btn btn-danger btn-sm delete-user" data-id="' + user.id + '">Delete</button>';
                            userList += '</td>';
                            userList += '</tr>';
                        });
                        $('#userTable tbody').html(userList);
                        $('#userTable').DataTable({
                            "paging": true,
                            "searching": true,
                            "lengthMenu": [1, 2, 3, 4, 5, 10, 25, 50],
                            "pageLength": 1,
                        });
                    }
                });
            }

            $('#userForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?= site_url('user/add');?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.status === 'success') {
                            alert('User added successfully');
                            loadUsers();
                            $('#addUserDiv').addClass('d-none');
                            $('#userListDiv').removeClass('d-none');
                        } else {
                            alert('Error adding user');
                        }
                    }
                });
            });

            $('#editUserForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    url: '<?= site_url('user/update');?>',
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.status === 'success') {
                            alert('User updated successfully');
                            loadUsers();
                            $('#editUserDiv').addClass('d-none');
                            $('#userListDiv').removeClass('d-none');
                        } else {
                            alert('Error updating user');
                        }
                    }
                });
            });

            $(document).on('click', '.edit-user', function() {
                let userId = $(this).data('id');
                $.ajax({
                    url: '<?= site_url('user/edit');?>',
                    type: 'GET',
                    data: { id: userId },
                    success: function(response) {
                        let user = JSON.parse(response);
                        $('#edit_user_id').val(user.id);
                        $('#edit_first_name').val(user.yjp_first_name);
                        $('#edit_last_name').val(user.yjp_last_name);
                        $('#edit_email').val(user.yjp_email);
                        $('#edit_gender').val(user.yjp_gender);
                        $('#edit_address').val(user.yjp_address);
                        $('#userListDiv').addClass('d-none');
                        $('#editUserDiv').removeClass('d-none');
                    }
                });
            });

            $(document).on('click', '.delete-user', function() {
                let userId = $(this).data('id');
                if (confirm('Are you sure you want to delete this user?')) {
                    $.ajax({
                        url: '<?= site_url('user/delete');?>',
                        type: 'POST',
                        data: { id: userId },
                        success: function(response) {
                            let res = JSON.parse(response);
                            if (res.status === 'success') {
                                alert('User deleted successfully');
                                loadUsers();
                            } else {
                                alert('Error deleting user');
                            }
                        }
                    });
                }
            });

            $('#showAddUserForm').on('click', function() {
                $('#userListDiv').addClass('d-none');
                $('#addUserDiv').removeClass('d-none');
            });

            $('#backToUserList').on('click', function() {
                $('#addUserDiv').addClass('d-none');
                $('#userListDiv').removeClass('d-none');
            });

            $('#backToUserListFromEdit').on('click', function() {
                $('#editUserDiv').addClass('d-none');
                $('#userListDiv').removeClass('d-none');
            });

            loadUsers();
        });
    </script>
</body>
</html>