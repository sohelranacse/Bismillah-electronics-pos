<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> NEW PRODUCT</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">


        <div class="panel panel-default">
            <div class="panel-body">

                <div class="">
                    <div class="col-md-6 col-lg-6 col-sm-6">
                        <h3 class="text-center">Product Information</h3>
                        <div class="product_settel1">
                            <div class="form-group">
                                <label for="">Product Name</label> <span class="label label-default">*</span>
                                <input type="text" class="form-control" id="name" placeholder="Type Product Name" autofocus>
                            </div>
                            <div class="form-group">
                                <label for="">Product Code</label> <span class="label label-default">*</span> 
                                <input type="text" class="form-control" id="product_code" placeholder="Type Product Code" onblur="product_code_check()">
                                <p><span class="label label-danger" id="product_code_check_out"></span></p>
                            </div>
                            <div class="form-group">
                                <label for="">Buy Price</label> <span class="label label-success">Tk.</span> <span class="label label-default">*</span>
                                <input type="text" class="form-control" id="price" placeholder="Type Buy Price">
                            </div>
                            <div class="form-group">
                                <label for="">Sale Price</label> <span class="label label-success">Tk.</span> <span class="label label-default">*</span>
                                <input type="text" class="form-control" id="sell_price" placeholder="Type Sell Price">
                            </div>
                            <div class="form-group">
                                <label for="">Added date</label> <span class="label label-default">*</span>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="icofont icofont-ui-calendar"></i>
                                </span>
                                <input type="text" id="price_type" class="form-control" value="<?php echo date("Y-m-d") ?>">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-6">
                        <h3 class="text-center">Previous Product Stock</h3>
                        <div class="product_settel">
                            <div class="form-group">
                                <label for="">Opening Stock Quantity</label>
                                <input type="text" class="form-control" id="opening_stock" placeholder="Type Opening Stock">
                            </div>
                            <div class="form-group">
                                <label for="">Opening Stock Product Price</label> <span class="label label-success">Tk.</span>
                                <input type="text" class="form-control" id="opening_stock_price" placeholder="Type Opening Stock Product Price">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-6 col-sm-6">
                        <div class="product_settel">
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea class="form-control" id="description" rows="4"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-12 col-sm-12 text-center">
                        <button type="submit" onclick="product_add()" class="btn btn-info">SUBMIT</button>
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
    $( "#price_type" ).datepicker({dateFormat : 'yy-mm-dd'});
  } );
</script>