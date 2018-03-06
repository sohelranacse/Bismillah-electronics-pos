<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> <?php if ($roots==1) {
              echo 'CASH RECEIVES (CUSTOMER)';
              $colummn_roots = '1';
            }elseif ($roots==2) {
              echo "CASH PAYMENT (SUPPLIER)";
              $colummn_roots = '2';
            } ?></h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
<?php
  $this->db->order_by('cash_id', 'desc');
  $this->db->limit(1);
  $query = $this->db->get('cash');

  $row = $query->row();
  $rowcount = $query->num_rows();

  if ($rowcount==0 || $rowcount<0) {
      $id = 1;
  }else{
      $cash_id = $row->cash_id;
      $id = $cash_id+1;
  }

  
?>  

        <div class="panel panel-default">
            <div class="panel-body" style="background: #f6f6f6">

                <div class="col-md-6 col-sm-6 col-lg-6">
                  <div class="form-group">
                    <label for="name">Cash Id</label>
                    <input type="text" class="form-control" id="cash_id" value="<?php echo $id; ?>" readonly="" disabled="">
                    <input type="hidden" class="form-control" id="roots" value="<?php echo $colummn_roots; ?>" readonly="" disabled="">
                  </div>
                  <div class="form-group">
                    <label for="name">Amount</label> <span class="label label-default">*</span>
                    <input type="text" class="form-control" id="amount" placeholder="Type Amount" autofocus="1">
                  </div>
                  <?php if ($roots==1) { ?>
                  <div class="form-group">
                    <label for="name">Type Customer Name</label> <span class="label label-default">*</span>


                      <input type="text" id="sell_cous" class="form-control" onkeyup="sell_cous_search()" placeholder="Type Coustomer Name" autocomplete="off">
                      <ul class="sell_cous_result" style="z-index: 9999;">
                          <span id="sell_cous_result">
                              
                          </span>
                      </ul>
                  </div>
                  <?php }elseif ($roots==2) { ?>
                    
                  <div class="form-group">
                    <label for="name">Type Supplier Name</label> <span class="label label-default">*</span>


                      <input type="text" id="sell_cous" class="form-control" onkeyup="sell_supp_search()" placeholder="Type Supplier Name" autocomplete="off">
                      <ul class="sell_cous_result" style="z-index: 9999;">
                          <span id="sell_cous_result">
                              
                          </span>
                      </ul>
                  </div>

                  <?php } ?>
                  <div class="form-group">
                      <label for="">Dated</label> <span class="label label-default">*</span>
                  </div>
                  <div class="form-group input-group">
                      <span class="input-group-addon"><i class="icofont icofont-ui-calendar"></i>
                      </span>
                      <input type="text" id="dated" class="form-control" value="<?php echo date("Y-m-d") ?>">
                  </div>
                </div>

                <div class="col-md-6 col-sm-6 col-lg-6">
                  <div class="form-group">
                    <label for="name">Details</label>
                    <textarea class="form-control" id="details" rows="12" placeholder="Type Description"></textarea>
                  </div>
                </div>


                <div class="col-md-12 col-sm-12 text-center">
                  <button class="btn btn-info" onclick="return cash_process()">Submit</button>
                </div>

            </div>
        </div>


    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

  <script>
  $( function() {
    $( "#dated" ).datepicker({dateFormat : 'yy-mm-dd'});
  } );
  </script>