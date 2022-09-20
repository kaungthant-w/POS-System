  <!-- page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Administractor Users
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Administractor Users</a></li>
      </ol>
    </section>

    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target = "#modalAddUser">Add User</button>
          <div class="box-body">
            <table class="table table-striped table-bordered dt-responsive tables">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>User</th>
                  <th>Photo</th>
                  <th>Profile</th>
                  <th>Status</th>
                  <th>Last Login</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
              <tr>

                <?php
                  $item = null;
                  $value = null;
                  $users = ControllerUsers::ctrlShowUser($item, $value);
                  foreach($users as $key => $value) {

                    echo '
                      <tr>
                        <td>'.($key + 1).'</td>
                        <td>'.$value["name"].'</td>
                        <td>'.$value["user"].'</td>';

                        if($value["photo"] != "") {
                          echo '<td><img src="'.$value["photo"].'" class="img-thumbnail" width="40px" /></td>';
                        } else {
                          echo '<td><img src="views/img/users/default/anonymous.png" class="img-thumbnail" width="40px" /></td>';
                        }

                        echo '<td>'.$value["profile"].'</td>';

                        if($value["status"]!=0) {
                          echo '<td><button class="btn btn-success btn-sm btnActive" idUser="'.$value["id"].'" statusUser="0">Active</button></td>';
                        } else {
                          echo '<td><button class="btn btn-danger btn-sm btnActive" idUser="'.$value["id"].'" statusUser="1" >Deactived</button></td>';
                        }
                        
                        echo '
                            <td>'.$value["last_login"].'</td>
                            <td>
                              <div class="btn btn-group">

                                <i class="btn btn-danger fa fa-pencil btnEditUser" data-toggle="modal" data-target = "#modalEditUser" idUser="'.$value["id"].'" ></i>

                                <i class="btn btn-warning fa fa-times btnDeleteUser" userId="'.$value["id"].'" userPhoto="'.$value["photo"].'" user="'.$value["user"].'"></i>

                              </div>
                            </td>
                      </tr>';
                  }

                  $deleteUser = new ControllerUsers;
                  $deleteUser -> ctrlDeleteUser();

                  ?>

              </tbody>
            </table>
          </div>

        </div>
      </div>
    </section>
  </div>
  <!-- Add User -->
  <div class="modal fade" id="modalAddUser">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data" role="form">

                <div class="modal-header with-border">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add User</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="newName" placeholder="Add Name" class="form-control input-log" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="text" name="newUser" id="newUser" placeholder="Add User " class="form-control input-log" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" name="newPassword" placeholder="Add Password " class="form-control input-log" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            <select name="newProfile" class="form-control input-log">
                                <option value="">Select Profile</option>
                                <option value="Administrator">Administrator</option>
                                <option value="Staff">Staff</option>
                                <option value="Worker">Worker</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="panel">Photo</div>
                        <input type="file" name="newPhoto" placeholder="New Photo" class="newPhoto form-control">
                        <p class="text-muted help-block">Please choose lower than 2MB</p>
                        <img src="views/img/users/default/anonymous.png" class="preview img-thumbnail" width="150px" alt="">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                </div>

                <?php
                  // ControllerUsers::ctrlCreateUser();
                  $createUser = new ControllerUsers();
                  $createUser -> ctrlCreateUser();
                ?>
              </form>
        </div>
    </div>
</div>

<!-- Edit User -->
<div class="modal fade" id="modalEditUser">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" enctype="multipart/form-data" role="form">

                <div class="modal-header with-border">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit User</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="editName" id="editName" class="form-control input-log" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="text" name="editUser" id="editUser" class="form-control input-log" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                            <input type="password" name="editPassword" class="form-control input-log" required>
                            <input type="hidden" name="passwordActual" id="passwordActual">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            <select name="editProfile"  class="form-control input-log">
                                <option value="" id="editProfile">Select Profile</option>
                                <option value="Administrator">Administrator</option>
                                <option value="Staff">Staff</option>
                                <option value="Worker">Worker</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="panel">Photo</div>
                        <input type="file" name="editPhoto" class="newPhoto preview form-control" >
                        <p class="text-muted help-block">Please choose lower than 2MB</p>
                        <img src="views/img/users/default/anonymous.png" class="preview img-thumbnail" width="150px">
                        <input type="hidden" id="photoActual" name="photoActual">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                </div>

                <?php
                  // ControllerUsers::ctrlCreateUser();
                  $updateUser = new ControllerUsers();
                  $updateUser -> ctrlUpdateUser();
                ?>
              </form>
        </div>
    </div>
</div>