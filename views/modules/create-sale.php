  <!-- page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Administractor create-sale
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Administractor create-sale</a></li>
      </ol>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-lg-5 col-xs-12">
                <div class="box box-success">
                    <div class="box-header with-border">

                        <form action="" method="post" class="formSale">
                        <div class="box-body">
                                <div class="box">

                                    <div class="form-group">
                                        <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                                <input type="text" id="newSeller" name="newSeller" class="form-control" value="<?php echo $_SESSION["name"]; ?>" readonly>

                                                <input type="hidden" name="sellerId" value="<?php echo $_SESSION["id"] ?>">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                                                <?php

                                                    $item = null;
                                                    $value = null;
                                                    $sales = ControllerSell::ctrlShowSell($item, $value);

                                                    if(!$sales) {
                                                        echo ' <input type="text" id="newSale" name="newSale" class="form-control" value="1001" readonly>';
                                                    } else {
                                                        foreach($sales as $key => $value) {
                                                            // var_dump($value["code"]);
                                                        }

                                                        $code = $value["code"] + 1;

                                                        echo ' <input type="text" id="newSale" name="newSale" class="form-control" value="'.$code.'" readonly>';
                                                    }

                                                ?> 
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                            <select name="selectClient" id="selectClient" class="form-control" placeholder="New Clients" required>
                                                <option value="">Select Client</option>

                                                <?php
                                                    $item = null;
                                                    $value = null;
                                                    $customers = ClientController::ctrlShowClients($item, $value);

                                                    foreach($customers as $key => $value) {
                                                        echo '<option value="'.$value["id"].'">'.$value["name"].'</option>';
                                                    }
                                                ?>
                                            </select>   

                                            <span class="input-group-addon"><button class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalNewClients" data-dismiss="modal">New Clients</button></span>

                                        </div>
                                    </div>

                                    <div class="form-group row newProduct">
                                        
                                    </div>

                                    <input type="hidden" name="productsList" id="productsList">
                                    
                                </div>

                                <button type="button" class="btn btn-default hidden-lg newAddProduct">Add Product</button>
                                
                                <hr>

                                <div class="row">
                                    <div class="col-xs-8 pull-right">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Taxes</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="width:50%">
                                                        <div class="input-group">
                                                            <input type="number" name="newTaxSale" class="form-control" id="newTaxSale" placeholder="0" min="0" required>

                                                            <input type="hidden" name="newPriceTaxes" id="newPriceTaxes" required>
                                                            <input type="hidden" name="newNetPrice" id="newNetPrice" required>

                                                            <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                                        </div>
                                                    </td>

                                                    <td style="width:50%">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="ion ion-social-usd" ></i></span>
                                                            <input type="text" class="form-control" name="newSaleTotal" id="newSaleTotal" total ="" placeholder="00000" totalSale="" readonly required>
                                                            <input type="hidden" name="saleTotal" id="saleTotal" required>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row form-group">
                                    <div class="col-xs-6" style="padding-right:0">
                                        <div class="input-group">
                                            <select class="form-control" name="newPaymentMethod" id="newPaymentMethod" required>
                                                <option value="">Select payment method</option>
                                                <option value="cash">Cash</option>
                                                <option value="CC">Credit Card</option>
                                                <option value="DC">Debit Card</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="paymentMethodBoxes"></div>

                                    <input type="hidden" name="listPaymentMethod" id="listPaymentMethod" required>
                                    
 
                                </div>
                            </div>

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary pull-right">Save sale</button>
                                </div>
                        </form>

                        <?php

                         $createSlaes = new ControllerSell();
                         $createSlaes -> ctrlCreateSale();
                        ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
                <div class="box box-warning">
                    
                <div class="box-header with-border"></div>

                <div class="box-body">
                <table class="table table-bordered table-striped dt-responsive salesTable">
                    <thead>
                        <tr>
                            <th style="width:10px">#</th>
                            <th>Image</th>
                            <th style="width:30px">Code</th>
                            <th>Description</th>
                            <th>Stock</th>
                            <th>Actions</th>
                        </tr> 
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </section>

</div>
  </div>


