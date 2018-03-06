<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> OVERSEAS</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="panel panel-default">
            <div class="panel-body">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#NEW_COUSTOMER" aria-controls="tab" role="tab" data-toggle="tab">NEW OVERSEAS</a>
                        </li>

                        <li role="presentation">
                            <a href="#overseas_record" aria-controls="tab" role="tab" data-toggle="tab">OVERSEAS RECORD</a>
                        </li>
                    </ul>
                
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="NEW_COUSTOMER">
                            
                            <div class="coustomer_panel" style="background: #eee">
                                <div class="col-md-4 col-lg-4 col-sm-4">
                                    
                                    <div class="form-group">
                                        <label for="">Product Name</label> <span class="label label-default">*</span>
                                        <input type="text" id="sale_product" class="form-control" onkeyup="product_search_over()" placeholder="Type Product Name" autofocus>
                                        <ul class="sell_cous_result">
                                            <span id="pro_cous_result1">
                                                
                                            </span>
                                        </ul>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Overseas Record</label>
                                        <select class="form-control" id="over_seas_name">
                                            <option value="">Select Cost</option>
                                            <?php 
                                            $query = $this->db->get("over_record");
                                            if ($query->num_rows()>0) {
                                                foreach ($query->result_array() as $result) {
                                                    $over_id = $result['over_id'];
                                                    $roots = $result['roots'];
                                                    $name = $result['name'];
                                                    if (!empty($roots) || !empty($name)) {
                                            ?>
                                        
                                            <option value="<?php echo $over_id.':'.$name.':'.$roots;  ?>"><?php echo $name; ?></option>
                                            <?php }}} ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Amount</label> <span class="label label-default">*</span>
                                        <input type="text" class="form-control" id="amount" placeholder="amount">
                                    </div>
                                    

                                    <div class="form-group">
                                        <label for="">Added date</label> <span class="label label-default">*</span>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-ui-calendar"></i>
                                        </span>
                                        <input type="text" id="dated" class="form-control" value="<?php echo date("Y-m-d") ?>">
                                    </div>
                                    <button type="submit" onclick="final_over_seas()" class="btn btn-info">SUBMIT</button>
                                </div>
                                <div class="col-md-6 col-lg-6 col-sm-6">
                                    <table class="table table-bordered" style="background: #fff">
                                        <thead>
                                            <tr>
                                                <th colspan="3" class="text-center" id="output_pname"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="over_seas_record_output">
                                            <tr>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>

                        <div role="tabpanel" class="tab-pane" id="overseas_record">
                            <div class="coustomer_panel" style="background: #eee">
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="name">Select type</label>
                                        <select class="form-control" id="roots">
                                            <option value="1">Debit (Expense)</option>
                                            <option value="2">Credit (Revenue)</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Overseas Name</label>
                                        <input type="text" class="form-control" id="over_seas_name" placeholder="Type Overseas Name">
                                    </div>

                                    <button type="submit" class="btn btn-primary" onclick="return overseas_record_add()">Added</button>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <table class="table" style="background: #ddd;">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Overseas Name</th>
                                                <th>Type</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $query = $this->db->get("over_record");
                                        if ($query->num_rows()>0) {
                                            foreach ($query->result_array() as $result) {
                                                $roots = $result['roots'];
                                                $name = $result['name'];
                                                if (!empty($roots) || !empty($name)) {
                                                    if ($roots==1) {
                                                        $roots_s = 'Debit (Expense)';
                                                    }if ($roots==2) {
                                                        $roots_s = 'Credit (Revenue)';
                                                    }
                                        ?>
                                            <tr>
                                                <td><?php echo $result['over_id'] ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $roots_s; ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal_sm" value="<?php echo $result['over_id'] ?>" onclick="over_recoed_edit(this)">
                                                        <i class="icofont icofont-ui-edit"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php }}} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
    $( "#dated" ).datepicker({dateFormat : 'yy-mm-dd'});
  } );
</script>