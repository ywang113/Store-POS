<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Point Of Sale</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />    
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/chosen/chosen.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/daterangepicker/daterangepicker.css" rel="stylesheet" type="text/css" />    
    <link href="assets/plugins/dataTables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/plugins/dataTables/dataTables.bootstrap.min.css" rel="stylesheet" type="text/css" />    
    <link href="assets/css/pages.css" rel="stylesheet" type="text/css" />
    <?php
	    include('functions.php');
	    if(isset($_GET['error']))
                {
                  $errormessage=$_GET['error'];
                  //show error message using javascript alert
                  echo "<script>alert('$errormessage'); window.location = './index.php';</script>";
                }
      ?>
    </head>
  <body>
    
  <div class="main_app">

  <div id="loading"></div>
  <div class="container">
        <div class="row">
                <div class="col-sm-12">

                    <div class="button-list pull-left m-t-15 m-l-10">  
                        
                            <div class="btn-group p_one">
                            <button id="productModal" data-toggle="modal" data-target="#Products" type="button" class="btn btn-default waves-effect waves-light">
                                    <span class="btn-label"><i class=" 	glyphicon glyphicon-barcode"></i> </span>  Products   
                            </button>
                            <button id="newProductModal" data-toggle="modal" data-target="#newProduct" type="button" class="btn btn-warning waves-effect waves-light">
                                    <i class="fa fa-plus"></i> 
                            </button>
                            </div>

                            <div class="btn-group p_two">
                            <button id="categoryModal" data-toggle="modal" data-target="#Categories" type="button" class="btn btn-default waves-effect waves-light">
                                    <span class="btn-label"><i class="glyphicon glyphicon-th"></i> </span>  Categories   
                            </button>
                            <button id="newCategoryModal" data-toggle="modal" data-target="#newCategory" type="button" class="btn btn-warning waves-effect waves-light">
                                <i class="fa fa-plus"></i> 
                            </button>
                            </div>
                   
                            <button id="viewRefOrders" data-toggle="modal" data-target="#holdOrdersModal" type="button" class="btn btn-info waves-effect waves-light">
                                    <span class="btn-label"><i class="fa fa-shopping-basket"></i> </span> Open Tabs
                            </button>
            
                            <button id="viewCustomerOrders" data-toggle="modal" data-target="#customerModal" type="button" class="btn btn-info waves-effect waves-light">
                                    <span class="btn-label"><i class="fa fa-user"></i> </span> Customer Orders
                            </button>
                        
                    </div>



                    
                    <!--img  class="loading m-t-5" style="margin-left: 35%" height="50px" src="assets/images/loading.gif" alt=""-->

                    <div class="button-list pull-right m-t-15 m-l-10">  

                            <button id="settings" data-toggle="modal" data-target="#settingsModal"  type="button"  class="btn btn-default waves-effect waves-light p_five">
                                <i class="glyphicon glyphicon-cog"></i>
                            </button>

                            <button id="transactions" type="button" class="btn btn-default waves-effect waves-light p_three">
                            <span class="btn-label"><i class=" 	glyphicon glyphicon-credit-card"></i> </span>  Transactions 
                            </button>

                            <button id="pointofsale" type="button" class="btn btn-default waves-effect waves-light">
                                <span class="btn-label"><i class=" 	glyphicon glyphicon-shopping-cart"></i> </span>  Point of Sale
                            </button>

                            <div class="btn-group p_four">
                                <button id="usersModal" data-toggle="modal" data-target="#Users" type="button" class="btn btn-default waves-effect waves-light">
                                        <span class="btn-label"><i class=" 	glyphicon glyphicon-user"></i> </span>  Users  
                                </button>
                                <button id="add-user" data-toggle="modal"   type="button" class="btn btn-dark waves-effect waves-light">
                                        <i class="fa fa-plus"></i> 
                                </button>
                            </div>


                            <button type="button"  class="btn btn-light waves-effect waves-light" id="cashier">
                                <span class="btn-label"><i class="glyphicon glyphicon-user"></i> </span> <span id="loggedin-user"></span>
                            </button>

                            <button id="log-out" onClick="window.location.href='index.php'" type="button"  class="btn btn-warning waves-effect waves-light">
                                    <i class="glyphicon glyphicon-refresh"></i>
                            </button>
            
            
                            <button id="quit"  type="button" class="btn btn-danger waves-effect waves-light">
                                    <i class="glyphicon glyphicon-off"></i>
                            </button>
                        
                    </div>
        
                </div>
            </div>
            <br>

    <div id="transactions_view">
        <div class="row">
            <div class="col-md-12">
                <div class="card-box"> 
                    <div class="row">               
                        <h3 class="col-md-2">Transactions</h3> 
                        <!--
                        <div class="col-md-1">
                            <span>Till</span>
                            <select id="tills" class="form-control">                              
                            </select>
                        </div>
                        <div class="col-md-2">
                            <span>Cashier</span>
                            <select id="users" class="form-control">
                            </select>
                        </div>
                        <div class="col-md-1">
                            <span>Status</span>
                            <select id="status" class="form-control status">
                                <option value="1">Paid</option>
                                <option value="0">Unpaid</option>
                            </select>
                        </div>
                        -->
                        <div class="col-md-3">
                            <span style="width: 100%;">Date</span>
                            <div id="reportrange">
                                <i class="fa fa-calendar"></i>&nbsp;
                                <span>
                                  <input type="text" name="datefilter" value="" />
                                </span>
                            </div>
                        </div>
                    </div>   
                        <hr>
                        <div class="row">
                           

                            <div class="col-md-5">
                                <div class="row">
                                    <div class="col-md-8" id="productSales">
                                            <h4>Products</h4>
                                            <hr>
                                            <table class="table tablesaw-enhanced" id="productsSold">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Sold</th>
                                                        <th>Price</th> 
                                                        <th>Sales</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="product_sales">
                                                	<?php listSold(); ?>
                                                </tbody>
                                            </table>
                                    </div>
                                    <div class="col-md-4" id="totals">
                                            <h4>Total</h4>
                                            <button id="settlement" class="btn btn-danger waves-effect waves-light">
                                            	settlement
                                            </button>
                                            <hr>
                                    
                                            <div id="total_sales" class="btn-success">
                                                <h5>SALES</h5>
                                                <div id="counter">$ 
                                                	<?php showTotalSales(); ?>
                                                </div>
                                            </div>
                                       
                                            <div id="total_transactions" class="btn-warning">
                                                <h5>TRANSACTIONS</h5>
                                                <div id="counter">
                                                	<?php showTotalTransaction(); ?>
                                                </div>
                                            </div>
                                
                                            <div id="total_items" class="btn-info">
                                                <h5>ITEMS</h5>
                                                <div id="counter">
                                                	<?php showTotalItems(); ?>
                                                </div>
                                            </div>

                                            <div id="total_products" class="btn-default">
                                                <h5>PRODUCTS</h5>
                                                <div id="counter">
                                                	<?php showTotalProducts(); ?>
                                                </div>
                                            </div>
                                                                         
                                    </div>
                                   
                               </div>
                           </div>

                           <div class="col-md-7">
                            <table class="table tablesaw-enhanced" id="transactionList">
                                <thead>
                                    <tr>            
                                        <th>Invoice</th>                                      
                                        <th>Date</th>
                                        <th>Total</th>
                                        <th>Paid</th>
                                        <th>Change</th>
                                        <th>Method</th>
                                        <th>Till</th>
                                        <th><i class="fa fa-print"></i></th>
                                    </tr>
                                </thead>
                                <tbody id="transaction_list">
                                	<?php listTransaction(); ?>
                                </tbody>
                            </table>
                        </div>

                      </div>                    
                </div>
            </div>
        </div>
   </div>


   <div id="pos_view">
      <div class="row">
          <div class="col-md-4">
              <div class="card-box" id="card-box">
                  <div class="col-md-12">
                      <div class="row">
                          <div class="col-md-10">
                              <select name="" id="customer" class="form-control"><?php
                              optionCustomer();
                            ?></select>
                          </div>
                          <div class="col-md-2">
                              <button data-toggle="modal" data-target="#newCustomer" class="btn btn-success"><i class="fa fa-plus"></i></button>
                          </div>
                      </div>
                      <div class="input-group m-t-5">
                          <form id="searchBarCode" action="scanBarcode.php" method="post">
                              <input type="text" required id="skuCode" name="skuCode" class="form-control" placeholder="Scan barcode or type the number then hit enter" aria-label="Recipient's username" aria-describedby="basic-addon2" autocomplete="off" autofocus>
                              <input type="submit" id="scansubmit" style="display:none;">
                          </form>
                          <span class="input-group-addon" id="basic-addon2">
                              <i class="glyphicon glyphicon-ok"></i>
                          </span>
                      </div>
                  </div>
                  <div>
                      <table class="table m-0" id="cartTable"style = "display:block; min-width: 100% ; max-height: 600px ;overflow-y:scroll;">
  
                          <thead class="cartList" id = "cartList">
                          <tr>
                              <th width="50px">#</th>
                              <th width="150px">Item</th>
                              <th width="120px" style="text-align:center;">Qty</th>
                              <th width="100px">Price</th>
                              <th width="5px">
                                  <button data-toggle="modal" data-target="#cancelcart" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button>
                              </th>
                          </tr>
                          <!-- add cart details -->
                          </thead>
                          <tbody>
                          	<?php listCart(); ?>
                          </tbody>
  
                      </table>
                  </div>
  
                  <hr>
                 <div class="m-t-5" style="margin-bottom: 20px">
                     <div class="row">
                         <div class="col-md-3"> <span style="font-weight:bold; font-size: 1em;">Total Item(s) :</span></div>
                         <div class="col-md-3"> <span id="total"  style="font-weight:bold; font-size: 1em;"><?php
                            calculateitems();?></span></div>
                        <div class="col-md-3"> <span style="font-weight:bold; font-size: 1em;">Gross Price :</span></div>
                        <div class="col-md-3"> <span id="gross_price" style="font-weight:bold; font-size: 1em;">
                         	<?php calculateprice();?>
                        </span>
                     	</div>  
                     </div>
  
                 </div>
  
                  <div class="button-list pull-right">

                    <button data-toggle="modal" data-target="#orderModal"  type="button" class="btn btn-info waves-effect waves-light">
                        <i class="fa fa-print"></i> 
                    </button>

                      <button  data-toggle="modal" data-target="#cancelcart" type="button" class="btn btn-danger waves-effect waves-light">
                          <span class="btn-label"><i class="fa fa-ban"></i></span>Cancel
                      </button>
  
                      <button type="button" id="hold" data-toggle="modal" data-target="#dueModal" class="btn btn-default waves-effect waves-light">
                          <span class="btn-label"><i class="fa fa-hand-paper-o"></i></span>Hold
                      </button>
  
                      <button type="button" id="payButton" data-toggle="modal" data-target="#paymentModel" class="btn btn-success waves-effect waves-light" onclick="setPaymentmodelPrice();">
                          <span class="btn-label"><i class="fa fa-money"></i></span>Pay
                      </button>
                  </div>
                  <hr>
  
              </div>
          </div>
          <div class="col-md-8">
              <div class="card-box">
                  <div class="row">
                  	<!--
                      <div class="col-md-4">
                          <input type="text" id="search" class="form-control" placeholder="Search product by name or sku">
                      </div>
                    -->
                      <div class="col-md-8">
                          <div class="button-list pull-left m-t-15 m-l-10" id="categories">
								<div class="category btn-group" role="group" aria-label="..." >
                              		<?php categorybutton(); ?>
                              	</div>
                          </div>
                      </div>
                  </div>
                  <hr>
                  <div class="row" id="parent"> 
                    
                      <?php allMenu(); ?>
                     
                  </div>
  
              </div>
          </div>
      </div>
  </div>
  
  <div id="dueModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-sm">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="mySmallModalLabel">Hold Order
                      <img  class="loading m-t-5" style="margin-left: 35%" height="50px" src="assets/images/loading.gif" alt="">
                  </h4>
              </div>
              <div class="modal-body">
                  <form action="">
                      <input type="text" id="refNumber" placeholder="Enter a reference" class="form-control">
                  </form>
                  <hr>
                  <div class="row">
                      <div class="col-md-4">
                          <button onclick="$(this).go(1,true);" class="btn btn-success btn-lg btn-block">1</button>
                      </div>
                      <div class="col-md-4">
                          <button onclick="$(this).go(2,true);" class="btn btn-success btn-lg btn-block">2</button>
                      </div>
                      <div class="col-md-4">
                          <button onclick="$(this).go(3,true);" class="btn btn-success btn-lg btn-block">3</button>
                      </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col-md-4">
                          <button onclick="$(this).go(4,true);" class="btn btn-success btn-lg btn-block">4</button>
                      </div>
                      <div class="col-md-4">
                          <button onclick="$(this).go(5,true);" class="btn btn-success btn-lg btn-block">5</button>
                      </div>
                      <div class="col-md-4">
                          <button onclick="$(this).go(6,true);" class="btn btn-success btn-lg btn-block">6</button>
                      </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col-md-4">
                          <button onclick="$(this).go(7,true);" class="btn btn-success btn-lg btn-block">7</button>
                      </div>
                      <div class="col-md-4">
                          <button onclick="$(this).go(8,true);" class="btn btn-success btn-lg btn-block">8</button>
                      </div>
                      <div class="col-md-4">
                          <button onclick="$(this).go(9,true);" class="btn btn-success btn-lg btn-block">9</button>
                      </div>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col-md-4">
                          <button onclick="$('#refNumber').val($('#refNumber').val().substr(0,$('#refNumber').val().length -1))" class="btn btn-success btn-lg btn-block">⌫</button>
                      </div>
                      <div class="col-md-4">
                          <button onclick="$(this).go(0,true);" class="btn btn-success btn-lg btn-block">0</button>
                      </div>
                      <div class="col-md-4">
                          <button onclick="$('#refNumber').val('')" class="btn btn-success btn-lg btn-block">AC</button>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" onclick="$(this).submitDueOrder(0);" class="btn btn-primary btn-block btn-lg waves-effect waves-light">Hold Order</button>
              </div>
  
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!--  Modal content for the above example -->
  <div id="paymentModel" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="myLargeModalLabel">Payment</h4>
              </div>
              <div class="modal-body">
                  <div class="row">
                      <div class="col-md-4">
                          <div class="list-group">
                              <a href="javascript:void(0)" id="cash" onclick="methodchange2cash()" class="list-group-item active">
                                  Cash
                              </a>
                            <a href="javascript:void(0)" id="card" onclick="methodchange2card()" class="list-group-item">Card</a>
                          </div>
                      </div>
                      <div class="col-md-8">
                          <div class="input-group" onclick="priceCopy()">
                              <span class="input-group-addon" id="basic-addon3">Price <span id="price_curr"></span>
                              <input id="payablePrice" readonly type="text" class="form-control" aria-describedby="basic-addon3" value="0.0">
                          </div>
                          <br>
                          <div class="input-group">
                              <span class="input-group-addon" id="basic-addon3">Payment  <span id="payment_curr"></span> </span>
                              <input type="text" placeholder="0.0" class="form-control" id="payment" aria-describedby="basic-addon3" onchange="calculatechange()" onkeyup="this.onchange();" onpaste="this.onchange();" oninput="this.onchange();">
                          </div>
                      </div>
                  </div>
              </div>
              <div class="modal-footer">
                  <div class="row">
                      <div class="col-md-6">
                        <div class="btn btn-primary btn-block btn-lg waves-effect waves-light">Change <span id="change_curr"></span><span id="change"></span> </div>
                      </div>
                      <div class="col-md-6">
                        <form action="confirmPayment.php" method="post">
                          <input type="hidden" id="confirmgross_price" name="confirmgross_price">
                          <input type="hidden" id="confirmgivenamount" name="confirmgivenamount">
                          <input type="hidden" id="confirmchange" name="confirmchange">
                          <input type="hidden" id="confirmmethod" name="confirmmethod" value="cash">
                        <input type="submit" id="confirmPayment" class="btn btn-default btn-block btn-lg waves-effect waves-light" value="Confirm Payment">
                        </form>
                    </div>
                  </div>
                  
                  
              </div>
          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  
  <div id="newCustomer" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
      <div class="modal-dialog modal-sm">
          <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h4 class="modal-title" id="mySmallModalLabel">New Customer
                      <img  class="loading m-t-5" style="margin-left: 35%" height="50px" src="assets/images/loading.gif" alt="">
                  </h4>
              </div>
              <div class="modal-body">
                  <form id="saveCustomer" action="newCustomer.php" data-parsley-validate>
                      <div class="form-group">
                          <label for="userName">Customer Name*</label>
                          <input type="text" required="required"  name="name" parsley-trigger="change" placeholder="Enter name" class="form-control" id="userName">
                      </div>
                      <div class="form-group">
                          <label for="userName">Customer Phone</label>
                          <input type="text" name="phone" parsley-trigger="change" placeholder="Enter Phone number" class="form-control" id="phoneNumber">
                      </div>
                      <div class="form-group">
                          <label for="userName">Customer Email</label>
                          <input type="email" name="email" parsley-trigger="change" placeholder="Enter email address" class="form-control" id="emailAddress">
                      </div>
                      <div class="form-group">
                          <label for="userName">Customer Address</label>
                          <input type="text" name="address" parsley-trigger="change" placeholder="Enter address" class="form-control" id="userAddress">
                      </div>

                      <input type="submit" class="btn btn-primary btn-block waves-effect waves-light">
                  </form>
              </div>
          </div>
      </div>
  </div>



  <div id="newProduct" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="mySmallModalLabel">Product
                        <img  class="loading m-t-5" style="margin-left: 35%" height="50px" src="assets/images/loading.gif" alt="">
                    </h4>
                </div>
                <div class="modal-body">
                    <form id="saveProduct" encType="multipart/form-data" action="newProduct.php">
                        <input type="hidden" name="id" id="product_id">
                        <input type="hidden" name="img" id="img">
                        <input type="hidden" name="remove" id="remove_img">
                        <div class="form-group">
                            <label for="userName">Category</label>
                            <select name="category" class="form-control" id="category">
                            	<?php optionCategory(); ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="userName">Product Name</label>
                            <input type="text" required="required"  name="name" parsley-trigger="change" placeholder="Enter a product name" class="form-control" id="productName">
                        </div>
                        <div class="form-group">
                            <label for="userName">Barcode</label>
                            <input type="text" name="barcode" placeholder="Scan barcode" class="form-control" id="product_barcode">
                        </div>
                        <div class="form-group">
                            <label for="userName">Price</label>
                            <input type="text" required="required" name="price" placeholder="Price" class="form-control" id="product_price">
                        </div>
                        <div class="form-group">
                            <label for="userName">Stock</label>
                            <input type="text" name="quantity" placeholder="Available stock" class="form-control" id="quantity">
                        </div>
                        <div class="form-group">
                            <label><input type="checkbox" name="stock" id="stock" style="max-width: 30px; float: left;"> <-- GST 10%</label>
                        </div>
                        <div class="form-group">
                            <label for="userName"><span id="rmv_img" class="btn btn-xs btn-warning">Remove</span> Picture </label>                      
                            <div id="current_img"></div>
                            <input type="file" name="imagename" id="imagename">                            
                        </div>
  
                        <input type="submit" id="submitProduct" class="btn btn-primary btn-block waves-effect waves-light">
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div id="newCategory" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="mySmallModalLabel">Category
                            <img  class="loading m-t-5" style="margin-left: 35%" height="50px" src="assets/images/loading.gif" alt="">
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form id="saveCategory" action="newCategory.php">
                            <div class="form-group">
                                <label for="userName">Name</label>
                                <input id="category_id" type="hidden" name="id">
                                <input id="categoryName" type="text" required="required"  name="name" placeholder="Enter a category name" class="form-control" >
                            </div>
                          
                            <input type="submit" value="submit" id="submitCategory" class="btn btn-primary btn-block waves-effect waves-light">
                        </form>
                    </div>
               </div>
          </div>
     </div>

     <div id="cancelcart" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="mySmallModalLabel">Cancel
                            <img  class="loading m-t-5" style="margin-left: 35%" height="50px" src="assets/images/loading.gif" alt="">
                        </h4>
                    </div>
                    <div class="modal-body">
                        <form id="cancelcartform" action="cancelcart.php">
                            <div class="form-group">
                                <label>Do you really want to cancel the order?</label>
                            </div>
                            <input type="submit" value="Yes" id="submitcancelcart" class="btn btn-primary btn-block waves-effect waves-light">
                        </form>
                    </div>
               </div>
          </div>
     </div>

     <div id="Products" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="mySmallModalLabel">Products
                            <img  class="loading m-t-5" style="margin-left: 35%" height="50px" src="assets/images/loading.gif" alt="">
                            <button class="btn btn-white pull-right" id="print_list">Download</button>
                        </h4>                        
                    </div>
                     <div class="modal-body" id="all_products" style="padding: 20px; padding-right: 40px;"> 
                        <table class="table table-bordered" id="productList">
                            <thead>
                                <tr>                                                                      
                                    <th>Name</th>                                      
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Barcode</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="product_list">
                            	<?php listProduct(); ?></tbody>
                        </table>

                    </div>
               </div>
          </div>
     </div>




     <div id="Users" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="mySmallModalLabel">Users
                        <img  class="loading m-t-5" style="margin-left: 35%" height="50px" src="assets/images/loading.gif" alt="">
                     </h4>                        
                </div>
                 <div class="modal-body" id="all_userss" style="padding: 20px; padding-right: 40px;"> 
                    <table class="table table-bordered" id="userList">
                        <thead>
                            <tr>    
                                <th>Name</th>                                      
                                <th>Username</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="user_list">
                        	<?php listUser(); ?>
                       	</tbody>
                    </table>

                </div>
           </div>
      </div>
 </div>




     <div id="Categories" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="mySmallModalLabel">Categories
                            <img  class="loading m-t-5" style="margin-left: 35%" height="50px" src="assets/images/loading.gif" alt="">
                        </h4>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered" id="categoryList">
                            <thead>
                                <tr> 
                                    <th>Name</th>                                      
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="category_list">
                            	<?php listCategory(); ?></tbody>
                        </table>

                    </div>
               </div>
          </div>
     </div>


     <!--
     <div id="userModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h4 class="modal-title" id="mySmallModalLabel">Account Infomarion
                        <img  class="loading m-t-5" style="margin-left: 35%" height="50px" src="assets/images/loading.gif" alt="">
                    </h4>
                </div>
                <div class="modal-body">
                    <form id="saveUser" data-parsley-validate>
                        <input type="hidden" name="id" id="user_id">
                        <div class="form-group">
                            <label for="userName">Name*</label>
                            <input type="text" required="required"  name="fullname" parsley-trigger="change" placeholder="Enter name" class="form-control" id="fullname">
                        </div>
                        <div class="form-group">
                            <label for="userName">Username*</label>
                            <input type="text" name="username" parsley-trigger="change" placeholder="Login Username" class="form-control" id="username">
                        </div>
                        <div class="form-group">
                            <label for="userName">Password</label>
                            <input type="password" name="password" parsley-trigger="change" placeholder="Password" class="form-control" id="password">
                        </div>
                        <div class="form-group">
                            <label for="userName">Repeat Password</label>
                            <input type="password" name="pass" parsley-trigger="change" placeholder="Repeat" class="form-control" id="pass">
                        </div>

                        <div class="perms">

                            <h4 style="font-size: 22px; margin-top: 20px;">Permissions</h4>
                            <hr>
    
                            <div class="form-group">
                                  <span><input type="checkbox" name="perm_products" id="perm_products"> Manage Products and Stock </span>
                            </div>
                            <div class="form-group">
                                <span><input type="checkbox" name="perm_categories" id="perm_categories"> Manage Product Categories </span>
                          </div>
                          <div class="form-group">
                            <span><input type="checkbox" name="perm_transactions" id="perm_transactions"> View Transactions </span>
                           </div>
                                <div class="form-group">
                                    <span><input type="checkbox" name="perm_users" id="perm_users"> Manage Users and Permissions </span>
                            </div>
                            <div class="form-group">
                                <span><input type="checkbox" name="perm_settings" id="perm_settings"> Manage Settings </span>
                            </div>
    
                        </div>
           
                        <input type="submit" class="btn btn-primary btn-block waves-effect waves-light">
                    </form>
                </div>
           </div>
      </div>
 </div>
-->





 <div id="holdOrdersModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Open Orders</h4>
            </div>
            <div class="modal-body">
                <input type="text" id="holdOrderInput" placeholder="Search order by reference" class="holdOrderInput form-control">
                <div class="holdOrderKeyboard"></div>
                <br>
                <div class="row" style="height: 460px;overflow-x: hidden;overflow-y:scroll" id="randerHoldOrders">
                    <p>please wait <span class="dot"></span> </p>  
                </div>
            </div>
        </div>
    </div>
</div>




 
<div id="customerModal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myLargeModalLabel">Customer Orders</h4>
            </div>
            <div class="modal-body">
                <input type="text" id="holdCustomerOrderInput" placeholder="Search order by customer name" class="holdCustomerOrderInput form-control">
                <div class="customerOrderKeyboard"></div>
                <br>
                <div class="row" style="height: 460px; overflow: scroll;" id="randerCustomerOrders">
                    <p>please wait <span class="dot"></span> </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="orderModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button class="btn btn-sm btn-default" onclick="printdiv('viewTransaction');">Print</button> <br> <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body" id="viewTransaction">
            	<?php printreceipt(); ?>
            </div>

            <div class="modal-header">
                <button class="btn btn-lg btn-default" data-dismiss="modal" onclick="printdiv('viewTransaction');"><i class="fa fa-print"></i>Print</button>
                <button class="btn btn-lg btn-warning pull-right" data-dismiss="modal">close</button>
            </div>
        </div>
    </div>
</div>

     <div id="settingsModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog modal-md">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="mySmallModalLabel">Settings
                            <img  class="loading m-t-5" style="margin-left: 35%" height="50px" src="assets/images/loading.gif" alt="">
                        </h4>
                    </div>
                    <div class="modal-body">  
                        
                        
                        <div class="form-group">
                        <label for="app">Application</label>
                        <select name="app" id="app" class="form-control">
                            <option>Standalone Point of Sale</option>
                        </select>
                 </div>
                 <!--
                <form id="net_settings_form">
                 <div class="row">
                    <div class="form-group">
                        <label for="userName">Server IP Address*</label>
                        <input type="text" required="required" placeholder="Enter the IP address of the admin computer." name="ip" class="form-control" id="ip">
                    </div>
                    <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="userName">Till Number*</label>
                                    <input type="text" required="required" placeholder="Enter a number" name="till" class="form-control" id="till">
                                </div>
                            </div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <label for="userName">Hardware Identification Number </label>
                                    <input type="text" required="required" name="mac" class="form-control" id="mac" readonly="readonly">
                                </div>
                            </div>
                    </div>
                     <div class="form-group">
                        <input id="save_settings" type="submit" class="btn btn-default btn-block waves-effect waves-light" value="Save Settings">
                    </div>
                 </div>
                </form>
                -->


                 <form id="settings_form" encType="multipart/form-data">

                    <input type="hidden" name="id" id="settings_id">
                    <input type="hidden" name="img" id="logo_img">
                    <input type="hidden" name="remove" id="remove_logo">

                        <div class="row">
                            <div class="col-md-6">
                               
                                 <div class="form-group">
                                    <label for="userName">Store Name</label>
                                    <input type="text" required="required"  name="store" class="form-control" id="store">
                                 </div>
                                 <div class="form-group">
                                        <label for="userName">Address Line 1</label>
                                        <input type="text" required="required"  name="address_one" class="form-control" id="address_one">
                                 </div>
                                 <div class="form-group">
                                        <label for="userName">Address Line 2</label>
                                        <input type="text" required="required"  name="address_two" class="form-control" id="address_two">
                                 </div>
                                 <div class="form-group">
                                        <label for="userName">Contact Number</label>
                                        <input type="text" name="contact" class="form-control" id="contact">
                                 </div>
                                 <div class="form-group">
                                        <label for="userName">Vat Number</label>
                                        <input type="text" name="tax" parsley-trigger="change" class="form-control" id="tax">
                                 </div>
                              

                            </div>
                            <div class="col-md-6">
                                    <div class="form-group">
                                            <label for="userName">Currency Symbol</label>
                                            <input type="text" required="required"  name="symbol" class="form-control" id="symbol">
                                     </div>
    
                                     <div class="form-group">
                                            <label for="userName">Vat Percentage</label>
                                            <div style="width: 80%; float:left;">
                                            <input type="text" required="required"  name="percentage" class="form-control" id="percentage">
                                            </div>
                                            <div class="pull-right p-t-10"> % </div>
                                     </div>
                                     <br><br>
                                     <div class="form-group">
                                        <label><input type="checkbox" name="charge_tax" id="charge_tax"> Charge Vat</label>
                                     </div>
                                     <div class="form-group">       
                                        <label for="userName"><span id="rmv_logo" class="btn btn-xs btn-warning">Remove</span> Logo </label>              
                                        <div id="current_logo"></div>                                        
                                       
                                        <input type="file" name="imagename" id="logoname">                            
                                    </div>
                                    <div class="form-group">
                                        <label for="userName">Receipt Footer</label>
                                        <textarea name="footer" class="form-control" id="footer"></textarea>
                                    </div>                                    
                            </div>
                           
                        </div>

                       
                        <div class="form-group">
                                <input id="save_settings" type="submit" class="btn btn-default btn-block waves-effect waves-light" value="Save Settings">
                        </div>

                    </form>
                    </div>
               </div>
          </div>
     </div>

<div id="calculatorModal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            	<h3>Calculate Price</h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              </div>
            <div class="modal-body" id="calculatorbody" name="calculatorbody"> 
            	<input type="hidden" name="selectedcalitem" id="selectedcalitem">
            	<table border="1">
			        <tr>
			            <td colspan="4">
			                <input type="text" id="display" style="width:240px;font-size:30px;">
			            </td>
			        </tr>
			        <tr>
			            <td colspan="4">
			                <input type="text" id="result" value="$ 0" style="width:240px;font-size:30px;">
			            </td>
			        </tr>
			        <tr>
			            <td type="button" class="btn btn-success waves-effect waves-light" onclick="add(7)" id="calculator_btn1">7</td>
			            <td type="button" class="btn btn-success waves-effect waves-light" onclick="add(8)" id="calculator_btn1">8</td>
			            <td type="button" class="btn btn-success waves-effect waves-light" onclick="add(9)" id="calculator_btn1">9</td>
			            <td type="button" class="btn btn-warning waves-effect waves-light" onclick="subtract()" id="calculator_btn1">⌫</td>
			        </tr>
			        <tr>
			            <td type="button" class="btn btn-success waves-effect waves-light" onclick="add(4)" id="calculator_btn1">4</td>
			            <td type="button" class="btn btn-success waves-effect waves-light" onclick="add(5)" id="calculator_btn1">5</td>
			            <td type="button" class="btn btn-success waves-effect waves-light" onclick="add(6)" id="calculator_btn1">6</td>
			            <td type="button" class="btn btn-default waves-effect waves-light" onclick="add('*')" id="calculator_btn1">*</td>
			        </tr>
			        <tr>
			            <td type="button" class="btn btn-success waves-effect waves-light" onclick="add(1)" id="calculator_btn1">1</td>
			            <td type="button" class="btn btn-success waves-effect waves-light" onclick="add(2)" id="calculator_btn1">2</td>
			            <td type="button" class="btn btn-success waves-effect waves-light" onclick="add(3)" id="calculator_btn1">3</td>
			            <td type="button" class="btn btn-default waves-effect waves-light" onclick="add('+')" id="calculator_btn1">+</td>
			        </tr>
			        <tr>
			            <td type="button" class="btn btn-success waves-effect waves-light" onclick="add(0)" id="calculator_btn1">0</td>
			            <td type="button" class="btn btn-success waves-effect waves-light" onclick="add('.')" id="calculator_btn1">.</td>
			            <td type="button" class="btn btn-danger waves-effect waves-light" onclick="reset()" id="calculator_btn1">AC</td>
			            <td type="button" class="btn btn-primary waves-effect waves-light" onclick="submitcalculator()" id="calculator_btn1">OK</td>
			        </tr>
			    </table>
			    <div class="modal-footer">
                  <button type="button" onclick="submitcalculator()" class="btn btn-primary btn-block btn-lg waves-effect waves-light">OK</button>
              	</div>

			    <script>
			    	var numberClicked = false; // 전역 변수로 numberClicked를 설정
			        function add (char) {
				        if(numberClicked == false) { // 만약 이전에 연산자를 입력 했는데,
				            if(isNaN(char) == true) { // 입력 받은 값이 또 다시 연산자면,
				                document.getElementById('display').value = document.getElementById('display').value.slice(0,-1);
				                document.getElementById('display').value += char;
				            } else { // 연산자가 아니라면!
				                document.getElementById('display').value += char; // 식 뒤에 값을 추가한다.
				                calculate();
				            }
				        } else { // 만약에 이전에 숫자를 입력 했으면,
				            document.getElementById('display').value += char; // 식 뒤에 값을 추가한다.				        	
				            if(isNaN(char) == false) { // 입력 받은 값이 숫자면,
				                calculate(); // 실시간계산
				            }
				        }
				 
				        // 다음 입력을 위해 이번 입력에 숫자가 눌렸는지 연산자가 눌렸는지 설정한다.
				        if(isNaN(char) == true) { // "만약 숫자가 아닌게 참이라면" = "연산자를 눌렀다면"
				            numberClicked = false; // numberClicked를 false로 설정한다.
				        } else {
				            numberClicked = true; // numberClicked를 true로 설정한다.
				        }
				    }

				    function subtract () {
				    	if(isNaN(document.getElementById('display').value.slice(0,-1))){// 만약 연산자를 지웠을경우
				    		numberClicked = true; 
				    	}
				        document.getElementById('display').value = document.getElementById('display').value.slice(0,-1);
				    }

			        function calculate() {
			            var display = document.getElementById('display');
			            var result = eval(display.value); // 식을 계산하고 result 변수에 저장합니다.
			            document.getElementById('result').value = "$ "+result.toFixed(2);
			        }

			        function reset() {
			            document.getElementById('display').value = "";
			            document.getElementById('result').value = "$ ";
			        }

			        function submitcalculator() {
			        	var calculatedResult = document.getElementById('result').value.slice(2);
			        	var productname = document.getElementById('selectedcalitem').value;
			        	console.log(productname+"- submitcalculator:"+calculatedResult);
			        	reset();

			        	$.ajax({
				          type: "POST",
				          url: "addtakeawaytocart.php",
				          data: { name:productname, price: calculatedResult }
				        }).done(function( msg ) {
				          location.reload();
				          //alert( "Data Saved: " + msg );
				        });
			        }
			    </script>
            </div>
        </div>
    </div>
</div>


  </div>

</div>
<script src="assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <!-- add library tabledit-->
    <script src="assets/plugins/tabledit/jquery.tabledit.js"></script>
    <script src="assets/plugins/tabledit/jquery.tabledit.min.js"></script>
    
    <script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    <script src="assets/plugins/chosen/chosen.jquery.min.js"></script>
    <script src="assets/plugins/jquery-ui/jquery.form.min.js"></script>
    <script src="assets/plugins/daterangepicker/daterangepicker.min.js"></script>
    <script src="assets/plugins/dataTables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/dataTables/jquery.dataTables.bootstrap.js"></script>
    <!-- <script src="assets/plugins/jquery-ui/jquery-ui.min.js"></script>
    <script src="assets/plugins/jq-keyboard/jqkeyboard-min.js"></script>
    <script src="assets/plugins/jq-keyboard/jqk.layout.en.js"></script>
    <script src="assets/plugins/onscreen-keyboard/jquery.caret.min.js"></script> -->

    
    <script>
      //Payment confirmation modal function
      function RoundTo(number, roundto){
		  return roundto * Math.round(number/roundto);
	  }

      function setPaymentmodelPrice(){
        var gross_price = document.getElementById('gross_price').innerHTML;
        gross_price= parseFloat(gross_price.slice(1));
        document.getElementById("payablePrice").value = "$ "+RoundTo(gross_price,0.05).toFixed(2);
      }

      function calculatechange(){
        var gross_price = document.getElementById("payablePrice").value;
        var givenamount = document.getElementById('payment').value;

        givenamount = parseFloat(givenamount);
        gross_price = parseFloat(gross_price.substr(1));

        var change = givenamount-gross_price;
        document.getElementById("change").innerHTML = "$ "+ RoundTo(change,0.05).toFixed(2);
        document.getElementById("confirmgross_price").value = gross_price.toFixed(2);
        document.getElementById("confirmgivenamount").value = givenamount.toFixed(2);
        document.getElementById("confirmchange").value = change.toFixed(2);
      }

      function priceCopy(){
        var gross_price = document.getElementById("payablePrice").value;
        document.getElementById('payment').value= gross_price.substr(2);
        calculatechange();
        document.getElementById('payment').focus();
      }

      $('#paymentModel').on('shown.bs.modal', function () {
        $('#payment').focus();
      }) 

      $('.list-group-item').click(function(e){
        $('.list-group-item').css({"background-color": "white", "color":"black"});
        $(this).css({"background-color": "#5fbeaa", "color":"white"});
        $('#payment').focus();
      });      
      
      function methodchange2cash(){
        document.getElementById("confirmmethod").value = "cash";
        document.getElementById('payment').value="";
        setPaymentmodelPrice();
      }

      function methodchange2card(){
        document.getElementById("payablePrice").value = document.getElementById('gross_price').innerHTML;
		priceCopy();
        document.getElementById("confirmmethod").value = "card";

      }

      $('#transactionList').Tabledit({
	      url: 'deletetransaction.php',
	      dataType:"json",
	      columns: {
	        identifier: [0, 'invoice'],
	        editable: []
	      },
	      editButton:false,
	      restoreButton:false,
	      onAlways:function() {
	      	//location.reload(true);
	      },
      });

      function togglecategory(category){
      	if(category!="Standard"){
	        category = ".toggle" + category;
	        var divided = category.split(" ");
	        //console.log(divided[0]);

	        $(divided[0]).show("slow", function() {}).siblings(".togglecategory").hide();
        }else{
        	$(".togglecategory").show();
        }
      }

      //when menu box click pass variable to php
      $('.box').click(function() {
        var clickBtnValue = $(this).attr("value");
        //console.log(clickBtnValue);
        if(clickBtnValue == "Take Away"
          ||clickBtnValue == "No Tax product"
        	||clickBtnValue == "product"
        	||clickBtnValue == "Tomato"
        	||clickBtnValue == "Apple"
        	||clickBtnValue == "Carrot"
        	||clickBtnValue == "Onion"
        	||clickBtnValue == "Mushroom"
        	||clickBtnValue == "banana"
        	||clickBtnValue == "lemon_"
        	||clickBtnValue == "redonion"
        	||clickBtnValue == "capsicum"
        	||clickBtnValue == "zucchini"
        	||clickBtnValue == "Vegie"
        	||clickBtnValue == "JOURNAL&CARD"
          ||clickBtnValue == "CHIPS"
        	){
        	document.getElementById('selectedcalitem').value = clickBtnValue;
        	$('#calculatorModal').modal('show');
        }else{
        	$.ajax({
	          type: "POST",
	          url: "addtocart.php",
	          data: { name: clickBtnValue }
	        }).done(function( msg ) {
	          location.reload();
	          //alert( "Data Saved: " + msg );
	        });
        }
      });

      $('.past_receipt').click(function() {
      	var clickBtnValue = $(this).attr("value");
      	
      	$.ajax({
	          type: "POST",
	          url: "past_receipt.php",
	          data: { date: clickBtnValue }
	        }).done(function( msg ) {
	        	document.getElementById('viewTransaction').innerHTML = msg;
	        	$('#orderModal').modal('show');
	        	//alert(msg);
	        });
      });

      //transaction view
      function transactionsopen(){
        transactions_view = document.getElementById('transactions_view');
        pos_view = document.getElementById('pos_view');

        transactions_view.style.display = "inline";
        pos_view.style.display = "none";
      }

      const transactionsBtn = document.getElementById('transactions');
      const pointofsaleBtn = document.getElementById('pointofsale');
      const transactions_view = document.getElementById('transactions_view');
      const pos_view = document.getElementById('pos_view');

      transactionsBtn.addEventListener("click", function(){
        transactionsBtn.style.display = "none";
        pointofsaleBtn.style.display = "inline";
        transactions_view.style.display = "inline";
        pos_view.style.display = "none";
      });

      pointofsaleBtn.addEventListener("click", function(){
        transactionsBtn.style.display = "inline";
        pointofsaleBtn.style.display = "none";
        transactions_view.style.display = "none";
        pos_view.style.display = "inline";
      });

	
		function printdiv(printpage) {
            var headstr = "<html><head><title></title></head><body>";
            var footstr = "</body></html>";
            var newstr = document.all.item(printpage).innerHTML;
            var oldstr = document.body.innerHTML;
            document.body.innerHTML = headstr + newstr + footstr;
            window.print();
            document.body.innerHTML = oldstr;
            location.reload(true);
            return false;
        }

        //[print settlement]
      $('#settlement').click(function() {
      	$.ajax({
	          type: "POST",
	          url: "settlement.php",
	        }).done(function( msg ) {
	        	//alert(msg);
	        	var headstr = "<html><head><title></title></head><body>";
	            var footstr = "</body></html>";
	            var newstr = msg;
	            var oldstr = document.body.innerHTML;
	            document.body.innerHTML = headstr + newstr + footstr;
	            window.print();
	            document.body.innerHTML = oldstr;
	            location.reload(true);
	        });
      });

   
      //btn-group category color change
      $(".category > button").on("click", function() {

		  var defaultClass = "btn btn-outline-secondary btn-sm";
		  var toBeAssignedClass = $(this).attr("data-btn-class");

		  $(".btn-group > button").attr("class", defaultClass);
		  $(this).attr("class", toBeAssignedClass);
		});

      //test function
      function testfunction(){
        console.log("<<<<<<<<<testfunction executed!!!!!!!!!!!!!!!!!!!1>>>>>>>>>>>");
      }
      

    // $(function () {
    //  "use strict";
    //     jqKeyboard.init({
    //         icon: "light"
    //       });
    //  });
 

    //  $('.holdOrderKeyboard').onscreenKeyboard({
	//     allowTypingClass: 'holdOrderInput'
    //   });


    //   $('.customerOrderKeyboard').onscreenKeyboard({
	//     allowTypingClass: 'holdCustomerOrderInput'
    //   });
        var testresult = localStorage.getItem('test123')
        console.log(testresult)
     </script>
    <script type="text/javascript" src="./assets/js/cartControl.js"></script>
  </body>
</html>
