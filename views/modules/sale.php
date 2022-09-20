  <!-- page content -->
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Sales management
      </h1>
      <ol class="breadcrumb">
        <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Sales management</a></li>
      </ol>
    </section>

    <section class="content">
      <div class="box">
        <div class="box-header with-border">
            
        <a href="create-sale">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalAddSales">
                Add Sales
            </button>
        </a>

        <button type="button" class="btn btn-default pull-right" id="daterange-btn">
            <span>
              <i class="fa fa-calendar"></i> Range Of Date 
            </span>
            <i class="fa fa-caret-down"></i>

        </button>
         
          <div class="box-body">
            <table class="table table-striped table-bordered dt-responsive tables">
              <thead>
                <tr>
                <th style="width:10px">#</th>
                <th>Bill Code</th>
                <th>Client</th>
                <th>Seller</th>
                <th>Payment Method</th>
                <th>Net cost</th>
                <th>Total cost</th>
                <th>Date</th>
                <th>Actions</th>
                </tr>
              </thead>
              <tbody>

                <?php

                if(isset($_GET["initialDate"])) {
                  $initialDate = $_GET["initialDate"];
                  $endDate = $_GET["endDate"];
                } else {
                  $initialDate = null;
                  $endDate = null;
                }

                  // $item = null;
                  // $value = null;
                  $represent = ControllerSell::ctrlDateRangeSale($initialDate, $endDate);
                  // var_dump($represent);

                  foreach($represent as $key => $value) {
                    echo '
                      <tr>
                        <td>'.($key+1).'</td>
                        <td>'.$value["code"].'</td>';

                        $itemClient = "id";
                        $valueClient = $value["client_id"];

                        $represent = ClientController::ctrlShowClients($itemClient, $valueClient);
                        
                        echo '<td>'.$represent["name"].'</td>';

                        $itemUser = "id";
                        $valueUser = $value["seller_id"];

                        $represent = ControllerUsers::ctrlShowUser($itemUser, $valueUser);
                        
                        echo '<td>'.$represent["user"].'</td>
                        <td>'.$value["payment_method"].'</td>
                        <td>$'.number_format($value["net_price"], 2).'</td>
                        <td>$'.number_format($value["total"], 2).'</td>
                        <td>'.$value["date"].'</td>

                        <td>
                            <div class="btn-group">
                                <button class="btn btn-info"><i class="fa fa-print btnPrintBill" saleCode="'.$value["code"].'"></i></button>
                              <button class="btn btn-warning btnEditSale" saleId="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger btnDeleteSale" saleId="'.$value["id"].'"><i class="fa fa-times"></i></button>
                            </div>
                        </td>
                      </tr>';
                  }
                ?>
              </tbody>
            </table>

            <?php

              ControllerSell::ctrlDeleteSale();

            ?>
            
          </div>

        </div>
      </div>
    </section>
  </div>




