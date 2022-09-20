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
                <tr>
                    <td>1</td>
                    <td>Julia</td>
                    <td>323242</td>
                    <td>julia@gmail.com</td>
                    <td>099392999</td>
                    <td>Insein Quarter, Bogyote Road, Yangon</td>
                    <td>1994-15-11</td>
                    <td>30</td>
                    <td>11</td>
                    <td>2022-5-11</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#modalEditClient"><i class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                        </div>
                    </td>
                </tr>    
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
                            <input type="number" name="addIDDocument" id="addIDDocument" class="form-control input-log" placeholder="Add ID Document" required>
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
                            <input type="text" name="addPhone" id="addPhone" class="form-control input-log" placeholder="Add Phone" data-inputmask="'mask':'(95) 999-99999'" data-mask required>
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
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <input type="text" name="addBirthday" id="addBirthday" class="form-control input-log" placeholder="Add Birthday" data-inputmask="'alias':'yyy/mm/dd'" data-mask required>
                        </div>
                    </div>


                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save Client</button>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                </div>

                <?php

                ?>
              </form>
        </div>
    </div>
</div>

