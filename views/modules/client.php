  <!-- page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Administractor Clients
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Administractor Clients</a></li>
      </ol>
    </section>

    <section class="content">
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddClient">Add Client</button>
          <div class="box-body">
            <table class="table table-striped table-bordered dt-responsive tables">
              <thead>

                <tr>
                <th style="width:10px">#</th>
                <th>Name</th>
                <th>I.D Document</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Birthday</th>
                <th>Total purchases</th>
                <th>Last Purchase</th>
                <th>Last login</th>
                <th>Actions</th>
                </tr>
              </thead>
              <tbody>

              <?php

                $item = null;
                $value = null;
                $clients = ClientController::ctrlShowClients($item, $value);

                foreach($clients as $key => $value) {
                  echo '
                  
                  <tr>
                    <td>'.($key+1).'</td>
                    <td>'.$value["name"].'</td>
                    <td>'.$value["id_document"].'</td>
                    <td>'.$value["email"].'</td>
                    <td>'.$value["phone"].'</td>
                    <td>'.$value["address"].'</td>
                    <td>'.$value["birthday"].'</td>
                    <td>'.$value["total_purchases"].'</td>
                    <td>'.$value["last_purchases"].'</td>
                    <td>'.$value["last_login"].'</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-warning btnEditClient" data-toggle="modal" data-target="#modalEditClient" clientId="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger btnDeleteClient" clientId="'.$value["id"].'"><i class="fa fa-times"></i></button>
                        </div>
                    </td>
                </tr> 
                  
                  ';
                }
              ?>
   
              </tbody>
            </table>
          </div>

        </div>
      </div>
    </section>
  </div>

  <!-- create client -->
  <div class="modal fade" id="modalAddClient">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="" method="post" role="form">

                <div class="modal-header with-border">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add Client</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="addName" id="addName" class="form-control input-log" placeholder="Add Name" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="number" name="addDocumentId" id="addDocumentId" class="form-control input-log" placeholder="Add ID Document" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" name="addEmail" id="addEmail" class="form-control input-log" placeholder="Add Email" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="text" name="addPhone" id="addPhone" class="form-control input-log" placeholder="Add Phone" data-inputmask="'mask':'(+95) 999-9999'" data-mask required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            <input type="text" name="addAddress" id="addAddress" class="form-control input-log" placeholder="Add Address" required>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                            <input type="text" name="addBirthday" id="addBirthday" class="form-control input-log" placeholder="Add Birthday" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-th"></i></span>
                            <input type="number" name="addTotalPurchase" id="addTotalPurchase" class="form-control input-log" placeholder="Add Total Purchase" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Client</button>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                </div>

                <?php
                  ClientController::ctrlCreateClients();
                ?>
              </form>
        </div>
    </div>
</div>

  <!-- edit client -->
  <div class="modal fade" id="modalEditClient">
    <div class="modal-dialog">
        <div class="modal-content">

            <form action="" method="post" role="form">

                <div class="modal-header with-border">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Edit Client</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-user"></i></span>
                            <input type="text" name="editName" id="editName" class="form-control input-log" required>
                            <input type="hidden" name="clientId" id="clientId">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-key"></i></span>
                            <input type="number" name="editDocumentId" id="editDocumentId" class="form-control input-log" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                            <input type="email" name="editEmail" id="editEmail" class="form-control input-log" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                            <input type="text" name="editPhone" id="editPhone" class="form-control input-log" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                            <input type="text" name="editAddress" id="editAddress" class="form-control input-log" required>
                        </div>
                    </div>

                    
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-birthday-cake"></i></span>
                            <input type="text" name="editBirthday" id="editBirthday" class="form-control input-log" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-th"></i></span>
                            <input type="number" name="editTotalPurchase" id="editTotalPurchase" class="form-control input-log" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Client</button>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                </div>

                <?php
                  ClientController::ctrlEditClients();
                ?>
              </form>
        </div>
    </div>
</div>

<?php
ClientController::ctrlDeleteClients();
?>

