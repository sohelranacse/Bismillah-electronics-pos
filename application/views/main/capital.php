<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> CAPITAL</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">


        <div class="panel panel-default">
            <div class="panel-body" style="background: #f6f6f6">

                <div class="col-md-5 col-sm-5 col-lg-5">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Type Name" autofocus="1">
                    </div>
                    <div class="form-group">
                        <label for="">Capital</label> <span class="label label-success"> Tk.</span>
                        <input type="text" class="form-control" id="capital" placeholder="Type Capital Tk.">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" onclick="return add_capital()">Added</button>
                    </div>
                </div>

                <div class="col-md-7 col-sm-7 col-lg-7">
                    <table class="table table-bordered" style="background: #fff">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Name</th>
                                <th>Dated</th>
                                <th>Amount</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $this->db->order_by("id","desc");
                        $query = $this->db->get("capital");
                        if ($query->num_rows()>0) {
                        $i = 1;
                        foreach ($query->result_array() as $result) {
                            if (!empty($result['capital'])) {
                                $a_date = $result['added_date'];
                                $create_date = date_create($a_date);
                                $added_date = date_format($create_date, 'd M, Y');
                                $times = date_format($create_date, 'h-i-s a');
                        ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $result['name']; ?></td>
                                <td><?php echo $added_date.' | '.$times; ?></td>
                                <td><?php echo number_format(round($result['capital'] ,0), 2, '.', ',') ?></td>
                                <td>
                                    <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal_sm" value="<?php echo $result['id']; ?>" onclick="return update_capital(this)"><i class="icofont icofont-ui-edit"></i></button>
                                </td>
                            </tr>
                        <?php }}}                    
                            $this->db->select_sum("capital");
                            $capital_query = $this->db->get("capital");
                            if ($capital_query->num_rows()>0) {
                              $capitaL_value = $capital_query->row()->capital;
                        ?>
                            <tr>
                                <td colspan="3" class="text-center"><b>Total</b></td>
                                <td><b><?php echo number_format(round($capitaL_value ,0), 2, '.', ',') ?> Tk.</b></td>
                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>

            </div>
        </div>


    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->