<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> DAILY EXPENSE</h3>
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
                            <a href="#NEW_COUSTOMER" aria-controls="tab" role="tab" data-toggle="tab">NEW EXPENSE</a>
                        </li>

                        <li role="presentation">
                            <a href="#overseas_record" aria-controls="tab" role="tab" data-toggle="tab">EXPENSE SECTOR</a>
                        </li>
                    </ul>
                
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="NEW_COUSTOMER">
                            
                            <div class="coustomer_panel" style="background: #eee">
                                <div class="col-md-4 col-lg-4 col-sm-4">
                                    
                                    <div class="form-group">
                                        <label for="">Expense Sector</label> <span class="label label-default">*</span>
                                        <select class="form-control" id="daily_id">
                                            <option value="">Select Sector</option>
                                            <?php 
                                            $query = $this->db->get("daily");
                                            if ($query->num_rows()>0) {
                                                foreach ($query->result_array() as $result) {
                                                    $id = $result['id'];
                                                    $name = $result['name'];
                                                    if (!empty($roots) || !empty($name)) {
                                            ?>
                                        
                                            <option value="<?php echo $id.':'.$name;  ?>"><?php echo $name; ?></option>
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

                                    <div class="form-group">
                                        <label for="">Purpose</label>
                                        <textarea id="purpose" rows="3" placeholder="Type Purpose" class="form-control"></textarea>
                                    </div>

                                    <button type="submit" onclick="final_daily_expense()" class="btn btn-info">SUBMIT</button>
                                </div>
                                <div class="col-md-8 col-lg-8 col-sm-8">
                                    <div class="form-group input-group col-md-6 col-sm-6">
                                        <span class="input-group-addon"><i class="icofont icofont-ui-calendar"></i>
                                        </span>
                                        <input type="text" id="dateded" class="form-control" value="<?php echo date("Y-m-d") ?>" onchange="return searchBydate_expense()">
                                    </div>
                                    <table class="table table-bordered" style="background: #fff">
                                        <thead>
                                            <tr>
                                                <th colspan="4" class="text-center" id="output_pname2"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="over_seas_record_output2">
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
                                        <label for="name">Expense Title</label>
                                        <input type="text" class="form-control" id="daily_title" placeholder="Type Expense Title">
                                    </div>

                                    <button type="submit" class="btn btn-primary" onclick="return expense_record_add()">Added</button>
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6">
                                    <table class="table" style="background: #ddd;">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>Expense Title</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                        $query = $this->db->get("daily");
                                        if ($query->num_rows()>0) {
                                            foreach ($query->result_array() as $result) {
                                                $name = $result['name'];
                                                if (!empty($name)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $result['id'] ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td>
                                                    <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal_sm" value="<?php echo $result['id'] ?>" onclick="daily_ex_edit(this)">
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
    $( "#dateded" ).datepicker({dateFormat : 'yy-mm-dd'});
  } );
</script>