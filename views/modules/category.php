  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Admin Category
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Admin Category</a></li>
      </ol>
    </section>

    <section class="content">

      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddCategory">Add Category</button>
        </div>
        <div class="box-body">
          <table class="table table-stripped table-bordered tables">
            <thead>
              <tr>
                <th style="width: 10px;">#</th>
                <th>Categories</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>

            <?php
              $item = null;
              $values = null;
              $categories = ControllerCategories::ctrlShowCategories($item, $values);
              
              foreach($categories as $key => $value) {
                echo '
                <tr>
                <td>'.($key+1).'</td>
                <td class="text-uppercase">'.$value["category"].'</td>
                <td>
                  <div class="btn btn-group">

                    <i class="btn btn-warning fa fa-pencil btnEditCategory" data-toggle="modal" data-target="#modalEditCategory" idCategory="'.$value["id"].'"></i>

                    <i class="btn btn-danger fa fa-times btnDeleteCategory" idCategory="'.$value["id"].'"></i>
                  </div>
                </td>
              </tr>
                ';
              }

            ?>

            </tbody>
          </table>
      </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Add Category -->
  <div class="modal fade" id="modalAddCategory">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" role="form">

                <div class="modal-header with-border">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Category</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-th"></i></span>
                            <input type="text" name="newCategory" placeholder="Add Category" class="form-control input-log" required>
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Category</button>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                </div>

                <?php
                  // ControllerUsers::ctrlCreateUser();
                  $createCategories = new ControllerCategories();
                  $createCategories -> ctrlCreateCategories();
                ?>
              </form>
        </div>
    </div>
</div>

<!-- edit Category -->
<div class="modal fade" id="modalEditCategory">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" method="post" role="form">

                <div class="modal-header with-border">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Category</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-th"></i></span>
                            <input type="text" name="editCategory" id="editCategory" class="form-control input-log" required>
                            <input type="hidden" name="idCategory" id="idCategory">
                        </div>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Category</button>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                </div>

                <?php
                  ControllerCategories::ctrleditCategories();
                  // $editCategories = new ControllerCategories();
                  // $editCategories -> ctrleditCategories();
                ?>
              </form>
        </div>
    </div>
</div>

<?php
  $deleteCategory = new ControllerCategories;
  $deleteCategory -> ctrDeleteCategories();
?>