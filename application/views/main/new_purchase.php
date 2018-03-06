<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> NEW PURCHASE</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">


        <div class="panel panel-default">
            <div class="panel-body" style="background: #f6f6f6">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="success">
                                <th width="20%">Invoice Id</th>
                                <th width="30%">Date</th>
                                <th width="40%">Supplier</th>
                                <th width="10%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                <?php
                                    $this->db->order_by('id', 'desc');
                                    $this->db->limit(1);
                                    $query = $this->db->get('sale');

                                    $row = $query->row();
                                    $rowcount = $query->num_rows();

                                    if ($rowcount==0 || $rowcount<0) {
                                        $invo = 1;
                                    }else{
                                        $saleid = $row->sell_invoice;
                                        $invo = $saleid+1;
                                    }

                                    
                                ?>
                                    <input type="hidden" id="roots" value="2">
                                    <input type="text" id="sell_invoice" class="form-control" value="<?php echo $invo; ?>" readonly>
                                </td>
                                <td>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-ui-calendar"></i>
                                        </span>
                                        <input type="text" id="sell_date" class="form-control" value="<?php echo date("Y-m-d") ?>">
                                    </div>
                                </td>
                                <td>
                                    <input type="text" id="sell_cous" class="form-control" onkeyup="sell_supp_search()" placeholder="Type Supplier Name" autofocus="1" autocomplete="off">
                                    <ul class="sell_cous_result" style="z-index: 9999;">
                                        <span id="sell_cous_result">
                                            
                                        </span>
                                    </ul>
                                </td>
                                <td>
                                    <button type="button" onclick="product_sale()" class="btn btn-info">NEXT</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="success">
                                <th>Product Name</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <tr id="secondStep">
                                <td>
                                    <input type="text" id="sale_product" class="form-control" onkeyup="product_search2()" placeholder="Type Product Name">
                                    <ul class="sell_cous_result">
                                        <span id="pro_cous_result">
                                            
                                        </span>
                                    </ul>
                                </td>
                                <td>
                                    <input type="hidden" id="saleid" value="<?php echo $invo; ?>">
                                    <input type="text" id="qty" class="form-control" placeholder="Type Quantity">
                                </td>
                                <td>
                                    <input type="text" id="price" class="form-control" value="">
                                </td>
                                <td>
                                    <button type="button" onclick="product_sale_last()" class="btn btn-info">NEXT</button>
                                </td>
                            </tr>
                        </tbody>                                                     
                            <tbody id="thirdStep">
                                
                            </tbody>
                    </table>
                </div>

                <div class="col-md-offset-6 col-lg-offset-6 col-md-6 col-lg-6 col-sm-6">
                    <div class="table-responsive">
                        <table class="table" style="border: 1px solid #ddd">
                            <thead>
                                <tr class="success">
                                    <th colspan="2" class="text-center">Sale</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th>Gross Amount</th>
                                <td>
                                    <input type="text" id="gross_amount" class="form-control" readonly>
                                </td>
                            </tr>

                            <tr>
                                <th>Vat <span class="label label-success"> Tk. </span></th>
                                <td>
                                    <input type="text" id="vat" class="form-control">
                                </td>
                            </tr>

                            <tr>
                                <th>Tariff <span class="label label-success"> Tk. </span></th>
                                <td>
                                    <input type="text" id="tariff" class="form-control">
                                </td>
                            </tr>

                            <tr>
                                <th>Transportation <span class="label label-success"> Tk. </span></th>
                                <td>
                                    <input type="text" id="transport" class="form-control">
                                </td>
                            </tr>

                            <tr>
                                <th>Others Cast <span class="label label-success"> Tk. </span></th>
                                <td>
                                    <input type="text" id="others" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <th>Discount <span class="label label-success"> % </span></th>
                                <td>
                                    <input type="text" id="discount" class="form-control" onkeyup="discount_map()" autocomplete="off">
                                    <span id="fourthStep" style="color: #f00;font-size: 16px;"></span>
                                </td>
                            </tr>
                            <tr>
                                <th>Cash <span class="label label-success"> Tk. </span></th>
                                <td>
                                    <input type="text" id="cash" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center" colspan="2"><button type="button" onclick="product_purchase_final()" class="btn btn-info">SUBMIT</button></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>


    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

  <script>
  $( function() {
    $( "#sell_date" ).datepicker({dateFormat : 'yy-mm-dd'});
  } );
  $("#secondStep").fadeOut();
  </script>