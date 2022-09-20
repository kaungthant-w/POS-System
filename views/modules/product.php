  <!-- Content page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Admin Product
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Porduct</a></li>
      </ol>
    </section>

    <section class="content">
      <div class="box">
        <div class="box-header with-border">
        <button class="btn btn-primary" data-toggle="modal" data-target = "#modalAddProduct">Add Product</button>
        </div>
        <div class="box-body">
          <table class="table table-striped table-bordered tablesProduct dt-responsive">
              <thead>

                <tr>
                    <th style="width:30px">#</th>
                    <th>Image</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Category</th>
                    <th>Stock</th>
                    <th>Buying Price</th>
                    <th>Selling Price</th>
                    <th>Date Added</th>
                    <th>Actions</th>
                </tr>
              </thead>
              <tbody>

                <!-- <?php
                    $item = null;
                    $value = null;
                    $products = ControllerProducts::ctrlShowProducts($item, $value);
                    // var_dump($products);

                    foreach( $products as $key => $value ) {
                        echo '
                            <tr>
                                <td>'.($key + 1).'</td>';

                                if($value["image"] != "") {
                                    echo '<td><img src="'.$value["image"].'" class="img-thumbnail" width="40px" /></td>';
                                  } else {
                                    echo '<td><img src="views/img/products/default/anonymous.png" class="img-thumbnail" width="40px" /></td>';
                                  }
                                  echo $value["image"];
                                
                                echo '<td>'.$value["code"].'</td>
                                <td>'.$value["description"].'</td>';

                                $item = "id";
                                $values = $value["category_id"];
                                $categories = ControllerCategories::ctrlShowCategories($item, $values);
                                // var_dump($categories);
                                // var_dump($categories["category"]);

                        echo '
                                <td>'.$categories["category"].'</td>
                                <td>'.$value["stock"].'</td>
                                <td>'.$value["buying_price"].'</td>
                                <td>'.$value["selling_price"].'</td>
                                <td>'.$value["date"].'</td>
                                <td>
                                    <div>
                                        <i class="btn btn-warning fa fa-pencil"></i>
                                        <i class="btn btn-danger fa fa-times"></i>
                                    </div>
                                </td>
                            </tr>
                        ';
                    }

                ?> -->
              </tbody>
          </table>
        </div>
        <div class="box-footer">
          Footer
        </div>
      </div>
    </section>
  </div>

  <!-- create products -->
  <div class="modal fade" id="modalAddProduct">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data" role="form">

                <div class="modal-header with-border">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Product</h4>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            <select name="newCategory"  id="newCategory" class="form-control input-log text-uppercase">
                                <option value="" class="text-lowercase" selected disabled>Select Category</option>
                                <?php

                                    $item = null;
                                    $value = null;

                                    $categories = ControllerCategories::ctrlShowCategories($item, $value);
                                    foreach($categories as $key => $value) {
                                        echo '<option value="'.$value["id"].'">'.$value["category"].'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="newCode" id="newCode" placeholder="Add Code" class="form-control input-log" readonly>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="text" name="newDescription" id="newDescription" placeholder="Add Description " class="form-control input-log" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="text" name="newStock" id="newStock" placeholder="Add Stock " class="form-control input-log" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="input-group"> 
                                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                                <input type="number" step="any" class="form-control input-lg" id="newBuyingPrice" name="newBuyingPrice" step="any" min="0" placeholder="Buying price" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6">  
                            <div class="input-group"> 
                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 
                                <input type="number" step="any" class="form-control input-lg" id="newSellingPrice" name="newSellingPrice" step="any" min="0" placeholder="Selling price" readonly>
                            </div> 
                            
                            <br>

                            <div class="col-xs-6"> 
                                <div class="form-group">   
                                    <label>     
                                        <input type="checkbox" class="minimal percentage" checked>
                                        Use percentage
                                    </label>
                                </div>
                            </div>

                            <div class="col-xs-6" style="padding:0">
                                <div class="input-group"> 
                                    <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                </div>
                            </div>

                        </div>
                    </div>   

                    <div class="form-group">
                        <div class="panel">Upload Image</div>
                        <input type="file" name="newPhoto" placeholder="New Photo" class="newPhoto form-control">
                        <p class="text-muted help-block">Please choose lower than 2MB</p>
                        <img src="views/img/products/default/anonymous.png" class="preview img-thumbnail" width="100px">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                </div>

                <?php

                    ControllerProducts::ctrlCreateProduct();
                  
                ?>
              </form>
        </div>
    </div>
</div>

<!-- edit product -->
<div class="modal fade" id="modalEditProduct">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="" method="post" enctype="multipart/form-data" role="form">

                <div class="modal-header with-border">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Product</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="editCode" id="editCode" class="form-control input-log" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="text" name="editDescription" id="editDescription" class="form-control input-log" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-users"></i></span>
                            <select name="editCategory" class="form-control input-log" readonly required>
                                <option id="editCategory"></option>
                                
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="text" name="editStock" id="editStock" class="form-control input-log" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <div class="col-xs-12 col-sm-6">
                            <div class="input-group"> 
                                <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 
                                <input type="number" class="form-control input-lg" id="editBuyingPrice" name="editBuyingPrice" step="any" min="0" required>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-6">  
                            <div class="input-group"> 
                                <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 
                                <input type="number" class="form-control input-lg" id="editSellingPrice" name="editSellingPrice" step="any" min="0" required readonly>
                            </div> 
                            
                            <br>

                            <div class="col-xs-6"> 
                                <div class="form-group">   
                                    <label>     
                                        <input type="checkbox" class="minimal percentage" checked>
                                        Use percentage
                                    </label>
                                </div>
                            </div>

                            <div class="col-xs-6" style="padding:0">
                                <div class="input-group"> 
                                    <input type="number" class="form-control input-lg newPercentage" min="0" value="40" required>
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                </div>
                            </div>

                        </div>
                    </div>   

                    <div class="form-group">
                        <div class="panel">Upload Image</div>
                        <input type="file" name="editPhoto" id="editPhoto" class="editPhoto form-control">
                        <p class="text-muted help-block">Please choose lower than 2MB</p>
                        <img src="views/img/products/default/anonymous.png" class="preview img-thumbnail" width="100px">
                        <input type="hidden" name="ActualImage" id="ActualImage">
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                </div>

                <?php
                  ControllerProducts::ctrlEditProducts();
                  ControllerProducts::ctrlDeleteProducts();
                ?>
              </form>
        </div>
    </div>
</div>