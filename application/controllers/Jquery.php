<?php
class Jquery extends CI_Controller
{

    function __construct() {
        parent::__construct();

        $this->load->library('session');
        
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');


        $admin_user = $this->session->userdata('username');
        if(empty($admin_user))
        {   
            redirect('login');
        }
        $this->load->model('Header_model', 'header');
        $this->load->model('Work_model', 'work');
    }
    public function capital_update(){
        $id = $this->input->post("capital_id");
        $this->db->where("id", $id);
        $query = $this->db->get("capital");
        if ($query->num_rows()>0) {
            $result = $query->row();
        ?>
        <form action="<?php echo base_url() ?>jquery/edit_capital" method="POST">
            <div class="form-group">
                <label for="">Capital</label> <span class="label label-success"> Tk.</span>
                <input type="text" class="form-control" name="capital" onfocus="1" value="<?php echo $result->capital; ?>">
            </div>
            <div class="form-group">
                <label for="">Name</label>
                <input type="hidden" name="capital_id" value="<?php echo $result->id; ?>">
                <input type="text" class="form-control" name="name" value="<?php echo $result->name; ?>">
            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit">Update</button>
            </div>
        </form>
        <?php
        }
    }
    public function edit_capital(){
        $this->form_validation->set_rules('capital_id','capital_id','trim|required');
        $this->form_validation->set_rules('name','name','trim|required');
        $this->form_validation->set_rules('capital','capital','trim|required');

        if ($this->form_validation->run()==false) {
            redirect('home/capital');
        }else{
            $edit_capital = array(
                'capital' => $this->input->post("capital"), 
                'name' => $this->input->post("name")
            );
            $this->db->where("id", $this->input->post("capital_id"));
            $this->db->update("capital",$edit_capital);
            if ($this->db->affected_rows() > 0) {
                redirect('home/capital');
            }
            
        }
        
    }
    public function update_product(){
        $pid = $this->input->post("pid");
        $this->db->where("pid", $pid);
        $query = $this->db->get("product");
        if ($query->num_rows()>0) {
            $result = $query->row();
        ?>
        <form action="<?php echo base_url() ?>jquery/edit_product" method="POST">
            <div class="col-md-6 col-lg-6 col-sm-6">
                <div class="product_settel1">
                    <div class="form-group">
                        <label for="">Product Name</label> <span class="label label-default">*</span>
                        <input type="hidden" name="pid" value="<?php echo $result->pid; ?>">
                        <input type="text" class="form-control" name="name" value="<?php echo $result->name; ?>" autofocus required>
                    </div>
                    <div class="form-group">
                        <label for="">Product Code</label> <span class="label label-default">*</span> 
                        <input type="text" class="form-control" name="product_code" value="<?php echo $result->product_code; ?>" required>
                        <p><span class="label label-danger" name="product_code_check_out"></span></p>
                    </div>
                    <div class="form-group">
                        <label for="">Buy Price</label> <span class="label label-success">Tk.</span> <span class="label label-default">*</span>
                        <input type="text" class="form-control" name="price"  value="<?php echo $result->price; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">Sale Price</label> <span class="label label-success">Tk.</span> <span class="label label-default">*</span>
                        <input type="text" class="form-control" name="sell_price" value="<?php echo $result->sell_price; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">Added_date</label> <span class="label label-default">*</span>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="icofont icofont-ui-calendar"></i>
                        </span>
                        <input type="text" name="add_date" class="form-control" value="<?php echo $result->add_date; ?>" required>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-sm-6">
                <div class="product_settel">
                    <div class="form-group">
                        <label for="">Current Quantity</label>
                        <input type="text" class="form-control" name="quantity" value="<?php echo $result->quantity; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="">Description</label>
                        <textarea class="form-control" name="description" rows="10"><?php echo $result->description; ?></textarea>
                    </div>
                </div>
            </div>

            <div class="col-md-12 col-lg-12 col-sm-12 text-center">
                <button type="submit" class="btn btn-info" name="product_update">SUBMIT</button>
            </div>
        </form>
        <?php
        }
    }

    public function edit_product(){
        $this->form_validation->set_rules('pid','pid','trim|required');
        $this->form_validation->set_rules('name','name','trim|required');
        $this->form_validation->set_rules('product_code','product_code','trim|required');
        $this->form_validation->set_rules('price','price','trim');
        $this->form_validation->set_rules('sell_price','sell_price','trim');
        $this->form_validation->set_rules('add_date','add_date','trim');
        $this->form_validation->set_rules('quantity','quantity','trim');
        $this->form_validation->set_rules('description','description','trim');

        if ($this->form_validation->run()==false) {
            redirect('home/all_product');
        }else{
            $edit_product = array(
                'name' => $this->input->post("name"), 
                'product_code' => $this->input->post("product_code"), 
                'price' => $this->input->post("price"), 
                'sell_price' => $this->input->post("sell_price"), 
                'add_date' => $this->input->post("add_date"), 
                'quantity' => $this->input->post("quantity"),
                'description' => $this->input->post("description")
            );
            $this->db->where("pid", $this->input->post("pid"));
            $this->db->update("product",$edit_product);
            if ($this->db->affected_rows() > 0) {
                redirect('home/all_product');
            }
            
        }
        
    }

    public function all_product_search(){
        $from_date = $this->input->post("from_date");
        $to_date = $this->input->post("to_date");

        //$this->db->where("add_date", $to_date,$from_date);
        $this->db->where('add_date >=', $from_date);
        $this->db->where('add_date <=', $to_date);
        $query = $this->db->get("product");
        if ($query->num_rows()>0) {
            echo '
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>#ID</th>
                            <th>Name</th>
                            <th>Product Code</th>
                            <th>Buy Price</th>
                            <th>Sell Price</th>
                            <th>Quantity</th>
                            <th>Added Date</th>
                            <th>Overseas</th>
                            <th>View</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
            ';
            foreach ($query->result_array() as $results) {
               echo '
                <tr>
                    <td>'.$results['pid'].'</td>
                    <td>'.$results['name'].'</td>
                    <td>'.$results['product_code'].'</td>
                    <td><b>'.$results['price'].'</b></td>
                    <td><b>'.$results['sell_price'].'</b></td>
                    <td><b>'.$results['quantity'].'</b></td>
                    <td>'.$results['add_date'].'</td>
                    <td>
                        <a href="'.base_url().'home/overseas_product/'.$results['pid'].'" target="_blank"  class="btn btn-sm btn-info"><i class="icofont icofont-bow"></i></a>
                    </td>
                    <td>
                        <a href="'.base_url().'home/details_product/'.$results['pid'].'" target="_blank"  class="btn btn-sm btn-success"><i class="icofont icofont-plus"></i></a>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal_lg" value="'.$results['pid'].'" onclick="return update_product(this)"><i class="icofont icofont-ui-edit"></i></button>
                    </td>
                </tr>
               ';
            }
            echo '
            
                    </tbody>
                </table>
            </div>
            ';
        }
    }
    public function invoice_report_search(){
        $from_date = $this->input->post("from_date");
        $to_date = $this->input->post("to_date");

        
        $this->db->where('sell_date >=', $from_date);
        $this->db->where('sell_date <=', $to_date);
        $this->db->order_by('id','desc');
        $query = $this->db->get("sale");
        if ($query->num_rows()>0) {
            echo '
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                       <tr class="success">
                            <th>Invoice No</th>
                            <th>Invoice Type</th>
                            <th>Invoice Date</th>
                            <th>Name</th>
                            <th>Sale Date</th>
                            <th>Print</th>
                            <th>SMS</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
            ';

            foreach ($query->result_array() as $invoice_data) {
                $id = $invoice_data['id'];
                $sell_invoice = $invoice_data['sell_invoice'];
                $sell_date = $invoice_data['sell_date'];
                $cmrid = $invoice_data['cmrid'];

                $roots = $invoice_data['roots'];
                if ($roots==1) {
                    $in_type = 'Sale';

                    $this->db->where('cmrid',$cmrid);
                    $query = $this->db->get("coustomer");
                    $row = $query->row();
                    $rowcount = $query->num_rows();
                    if ($rowcount = $query->num_rows()) {
                       $cous_name = $row->name;
                    }else{
                        $cous_name = '';
                    }
                }else{
                    $in_type = 'Purchase';

                    $this->db->where('cmrid',$cmrid);
                    $query = $this->db->get("Supplier");
                    $row = $query->row();
                    $rowcount = $query->num_rows();
                    if ($rowcount = $query->num_rows()) {
                       $cous_name = $row->name;
                    }else{
                        $cous_name = '';
                    }
                }
                $gross_amount = $invoice_data['gross_amount'];
                $due = $invoice_data['due'];
                $created_by = $invoice_data['created_by'];

                $a_date = $invoice_data['added_date'];
                $create_date = date_create($a_date);
                $added_date = date_format($create_date, 'd-m-Y');

                if (!empty($sell_invoice) || !empty($gross_amount)|| !empty($due)|| !empty($created_by)) {
            ?>
                <tr>
                    <td>#<?php echo $sell_invoice; ?></td>
                    <td><?php echo $in_type; ?></td>
                    <td><?php echo $sell_date; ?></td>
                    <td><?php echo $cous_name.' * '.$cmrid; ?></td>
                    <td><?php echo $sell_date; ?></td>
                    <td>
                        <a href="<?php echo base_url(); ?>home/daily_invoice_reports_print/<?php echo $sell_invoice.'/'.$cmrid; ?>" target="_blank" class="btn btn-sm btn-info"><i class="icofont icofont-print"></i></a>
                    </td>
                    <td><?php 
                    if ($roots == 1) { 
                        $this->db->where('invoice_id',$sell_invoice);
                        $this->db->where('cmrid',$cmrid);
                        //$this->db->where('pid',$pid);
                        $rowsmsCount=$this->db->get("sms");
                        $rowcountsms = $rowsmsCount->num_rows();

                        if ($rowcountsms) { ?>
                            <button class="btn btn-sm btn-default" disabled><i class="icofont icofont-ui-check"></i></button>
                        <?php }else{ ?>                                                                            
                            <button class="btn btn-sm btn-primary" value="<?php echo $sell_invoice.'/'.$cmrid; ?>" onclick="send_sms_coustomer(this);" data-toggle="modal" data-target="#send_sms_coustomer">
                                <i class="icofont icofont-ui-message"></i>
                            </button>
                        <?php }} ?>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-danger"><i class="icofont icofont-ui-close"></i></button>
                    </td>
                </tr>

            <?php } }
            echo '
            
                    </tbody>
                </table>
            </div>
            ';
        }
    }

    public function stock_summary_search(){
        $from_date = $this->input->post("from_date");
        $to_date = $this->input->post("to_date");

        $this->db->where('add_date >=', $from_date);
        $this->db->where('add_date <=', $to_date);
        $this->db->order_by('pid','desc');
        $query = $this->db->get("product");
        if ($query->num_rows()>0) {
            foreach ($query->result_array() as $results) {
               echo '
                <tr>
                    <td>'.$results['pid'].'</td>
                    <td>'.$results['name'].'</td>
                    <td>'.$results['product_code'].'</td>
                    <td>'.$results['add_date'].'</td>
                    <td>
                        <a href="'.base_url().'home/details_product/'.$results['pid'].'" target="_blank" class="btn btn-sm btn-default"><i class="icofont icofont-plus"></i> Details</a>
                    </td>
                    <td>
                        <a href="'.base_url().'home/purchase_product/'.$results['pid'].'" target="_blank" class="btn btn-sm btn-info"><i class="icofont icofont-plus"></i> Purchase</a>
                    </td>
                    <td>
                        <a  href="'.base_url().'home/sales_product/'.$results['pid'].'" target="_blank" target="_blank" class="btn btn-sm btn-success"><i class="icofont icofont-plus"></i> Sales</a>
                    </td>
                </tr>
               ';
            }
        }
    }
    public function customer_reports_search(){
        $from_date = $this->input->post("from_date");
        $to_date = $this->input->post("to_date");

        $this->db->where('dated>=', $from_date);
        $this->db->where('dated<=', $to_date);
        $this->db->order_by('cmrid','desc');
        $query = $this->db->get("coustomer");
        if ($query->num_rows()>0) {
            foreach ($query->result_array() as $results) {
               echo '
                <tr>
                    <td>'.$results['cmrid'].'</td>
                    <td>'.$results['name'].'</td>
                    <td>'.$results['company'].'</td>
                    <td>'.$results['mobile_phone'].'</td>
                    <td>'.$results['dated'].'</td>

                    <td>
                        <a href="'.base_url().'home/details_customer/'.$results['cmrid'].'" target="_blank" class="btn btn-sm btn-default"><i class="icofont icofont-plus"></i> Details</a>
                    </td>
                    <td>
                        <a href="'.base_url().'home/customer_products/'.$results['cmrid'].'" target="_blank" class="btn btn-sm btn-success"><i class="icofont icofont-plus"></i> Sales</a>
                    </td>
                </tr>
               ';
            }
        }
    }

    public function supplier_reports_search(){
        $from_date = $this->input->post("from_date");
        $to_date = $this->input->post("to_date");

        $this->db->where('dated>=', $from_date);
        $this->db->where('dated<=', $to_date);
        $this->db->order_by('cmrid','desc');
        $query = $this->db->get("supplier");
        if ($query->num_rows()>0) {
            foreach ($query->result_array() as $results) {
               echo '
                <tr>
                    <td>'.$results['cmrid'].'</td>
                    <td>'.$results['name'].'</td>
                    <td>'.$results['company'].'</td>
                    <td>'.$results['mobile_phone'].'</td>
                    <td>'.$results['dated'].'</td>

                    <td>
                        <a href="'.base_url().'home/details_supplier/'.$results['cmrid'].'" target="_blank" class="btn btn-sm btn-default"><i class="icofont icofont-plus"></i> Details</a>
                    </td>
                    <td>
                        <a href="'.base_url().'home/supplier_products/'.$results['cmrid'].'" target="_blank" class="btn btn-sm btn-success"><i class="icofont icofont-plus"></i> Purchase</a>
                    </td>
                </tr>
               ';
            }
        }
    }
    public function cash_reports_search(){
        $from_date = $this->input->post("from_date");
        $to_date = $this->input->post("to_date");

        $this->db->where('dated>=', $from_date);
        $this->db->where('dated<=', $to_date);
        $this->db->order_by('cash_id','desc');
        $query = $this->db->get("cash");
        if ($query->num_rows()>0) {
            foreach ($query->result_array() as $results) {
                $id = $results['id'];
                $cash_id = $results['cash_id'];
                $roots = $results['roots'];
                if ($roots==1) {
                    $type = 'Cash Receive';
                }else if ($roots==2) {
                    $type = 'Cash Payment';
                }
               echo '
                <tr>
                    <td>'.$cash_id.'</td>
                    <td>'.$type.'</td>
                    <td><b>'. number_format(round($results['amount'] ,0), 2, '.', ',').' Tk. </b></td>
                    <td>'.$results['dated'].'</td>
                    <td>
                        <a href="'.base_url().'home/details_cash_reports/'.$id.'/'.$roots.'" target="_blank" class="btn btn-sm btn-default"><i class="icofont icofont-plus"></i> Details</a>
                    </td>
                </tr>
               ';
            }
        }
    }

    public function search_name_cus(){
        $value = $this->input->post("value");

        $this->db->like('name', $value);
        $this->db->order_by('cmrid','desc');
        $query = $this->db->get("coustomer");
        if ($query->num_rows()>0) {
            foreach ($query->result_array() as $results) {
               echo '
                <tr>
                    <td>'.$results['cmrid'].'</td>
                    <td>'.$results['name'].'</td>
                    <td>'.$results['company'].'</td>
                    <td>'.$results['mobile_phone'].'</td>
                    <td>'.$results['address'].'</td>
                    <td>'.$results['city'].'</td>
                    <td>'.$results['tel_phone'].'</td>
                    <td>'.$results['email'].'</td>
                    <td><b>'.$results['due'].'</b></td>
                    <td>'.$results['dated'].'</td>

                    <td>
                        <a href="'.base_url().'home/details_customer/'.$results['cmrid'].'" target="_blank" class="btn btn-sm btn-default"><i class="icofont icofont-user"></i></a>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-danger"><i class="icofont icofont-ui-close"></i></button>
                    </td>
                </tr>
               ';
            }
        }
    }
    public function search_name_supp(){
        $value = $this->input->post("value");

        $this->db->like('name', $value);
        $this->db->order_by('cmrid','desc');
        $query = $this->db->get("supplier");
        if ($query->num_rows()>0) {
            foreach ($query->result_array() as $results) {
               echo '
                <tr>
                    <td>'.$results['cmrid'].'</td>
                    <td>'.$results['name'].'</td>
                    <td>'.$results['company'].'</td>
                    <td>'.$results['mobile_phone'].'</td>
                    <td>'.$results['address'].'</td>
                    <td>'.$results['city'].'</td>
                    <td>'.$results['tel_phone'].'</td>
                    <td>'.$results['email'].'</td>
                    <td><b>'.$results['loan'].'</b></td>
                    <td>'.$results['dated'].'</td>

                    <td>
                        <a href="'.base_url().'home/details_supplier/'.$results['cmrid'].'" target="_blank" class="btn btn-sm btn-default"><i class="icofont icofont-user"></i></a>
                    </td>
                    <td>
                        <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal_lg" value="'.$results['cmrid'].'" onclick="return update_supplier(this)"><i class="icofont icofont-ui-edit"></i></button>
                    </td>
                </tr>
               ';
            }
        }
    }


    public function update_supplier(){
        $cmrid = $this->input->post("cmrid");
        $this->db->where("cmrid", $cmrid);
        $query = $this->db->get("supplier");
        if ($query->num_rows()>0) {
            $result = $query->row();
        ?>
        <form action="<?php echo base_url() ?>jquery/update_supplier_final" method="POST">
            <div class="coustomer_panel" style="background: #eee">
                <div class="col-md-6 col-lg-6 col-sm-6">
                    <div class="form-group">
                        <label for="">Supplier Name</label> <span class="label label-default">*</span>
                        <input type="hidden" name="cmrid" value="<?php echo $result->cmrid; ?>">
                        <input type="text" class="form-control" name="name" value="<?php echo $result->name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Address</label> <span class="label label-default">*</span>
                        <input type="text" class="form-control" name="address"  value="<?php echo $result->address; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">City</label>
                        <input type="text" class="form-control" name="city"  value="<?php echo $result->city; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Company</label>
                        <input type="text" class="form-control" name="company"  value="<?php echo $result->company; ?>">
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-6">
                    
                    <div class="form-group">
                        <label for="">Added date</label> <span class="label label-default">*</span>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="icofont icofont-ui-calendar"></i>
                        </span>
                        <input type="text" name="dated" class="form-control"  value="<?php echo $result->dated; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Mobile Number</label> <span class="label label-default">*</span>
                        <input type="text" class="form-control" name="mobile_phone" value="<?php echo $result->mobile_phone; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Telephone Number</label>
                        <input type="text" class="form-control" name="tel_phone" value="<?php echo $result->tel_phone; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $result->email; ?>">
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12 text-center">
                    <button type="submit" class="btn btn-info">UPDATE</button>
                </div>
            </div>

        </form>
        <?php
        }
    }

    public function update_supplier_final(){
        $this->form_validation->set_rules('cmrid','cmrid','trim|required');
        $this->form_validation->set_rules('name','name','trim|required');
        $this->form_validation->set_rules('address','address','trim');
        $this->form_validation->set_rules('company','company','trim');
        $this->form_validation->set_rules('city','city','trim');
        $this->form_validation->set_rules('dated','dated','trim');
        $this->form_validation->set_rules('mobile_phone','mobile_phone','trim');
        $this->form_validation->set_rules('tel_phone','tel_phone','trim');
        $this->form_validation->set_rules('email','email','trim');

        if ($this->form_validation->run()==false) {
            redirect('home/supplier');
        }else{
            $edit_supplier = array(
                'name' => $this->input->post("name"), 
                'address' => $this->input->post("address"), 
                'company' => $this->input->post("company"), 
                'city' => $this->input->post("city"), 
                'dated' => $this->input->post("dated"), 
                'mobile_phone' => $this->input->post("mobile_phone"), 
                'tel_phone' => $this->input->post("tel_phone"),
                'email' => $this->input->post("email")
            );
            $this->db->where("cmrid", $this->input->post("cmrid"));
            $this->db->update("supplier",$edit_supplier);
            if ($this->db->affected_rows() > 0) {
                redirect('home/supplier');
            }
            
        }
    }

    public function update_customer(){
        $cmrid = $this->input->post("cmrid");
        $this->db->where("cmrid", $cmrid);
        $query = $this->db->get("coustomer");
        if ($query->num_rows()>0) {
            $result = $query->row();
        ?>
        <form action="<?php echo base_url() ?>jquery/update_customer_final" method="POST">
            <div class="coustomer_panel" style="background: #eee">
                <div class="col-md-6 col-lg-6 col-sm-6">
                    <div class="form-group">
                        <label for="">Customer Name</label> <span class="label label-default">*</span>
                        <input type="hidden" name="cmrid" value="<?php echo $result->cmrid; ?>">
                        <input type="text" class="form-control" name="name" value="<?php echo $result->name; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Address</label> <span class="label label-default">*</span>
                        <input type="text" class="form-control" name="address"  value="<?php echo $result->address; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">City</label>
                        <input type="text" class="form-control" name="city"  value="<?php echo $result->city; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Company</label>
                        <input type="text" class="form-control" name="company"  value="<?php echo $result->company; ?>">
                    </div>
                </div>

                <div class="col-md-6 col-lg-6 col-sm-6">
                    
                    <div class="form-group">
                        <label for="">Added date</label> <span class="label label-default">*</span>
                    </div>
                    <div class="form-group input-group">
                        <span class="input-group-addon"><i class="icofont icofont-ui-calendar"></i>
                        </span>
                        <input type="text" name="dated" class="form-control"  value="<?php echo $result->dated; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Mobile Number</label> <span class="label label-default">*</span>
                        <input type="text" class="form-control" name="mobile_phone" value="<?php echo $result->mobile_phone; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Telephone Number</label>
                        <input type="text" class="form-control" name="tel_phone" value="<?php echo $result->tel_phone; ?>">
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="email" value="<?php echo $result->email; ?>">
                    </div>
                </div>
                <div class="col-md-12 col-lg-12 col-sm-12 text-center">
                    <button type="submit" class="btn btn-info">UPDATE</button>
                </div>
            </div>

        </form>
        <?php
        }
    }

    public function update_customer_final(){
        $this->form_validation->set_rules('cmrid','cmrid','trim|required');
        $this->form_validation->set_rules('name','name','trim|required');
        $this->form_validation->set_rules('address','address','trim');
        $this->form_validation->set_rules('company','company','trim');
        $this->form_validation->set_rules('dated','dated','trim');
        $this->form_validation->set_rules('city','city','trim');
        $this->form_validation->set_rules('mobile_phone','mobile_phone','trim');
        $this->form_validation->set_rules('tel_phone','tel_phone','trim');
        $this->form_validation->set_rules('email','email','trim');

        if ($this->form_validation->run()==false) {
            redirect('home/coustomer');
        }else{
            $edit_supplier = array(
                'name' => $this->input->post("name"), 
                'address' => $this->input->post("address"), 
                'company' => $this->input->post("company"), 
                'dated' => $this->input->post("dated"), 
                'city' => $this->input->post("city"), 
                'mobile_phone' => $this->input->post("mobile_phone"), 
                'tel_phone' => $this->input->post("tel_phone"),
                'email' => $this->input->post("email")
            );
            $this->db->where("cmrid", $this->input->post("cmrid"));
            $this->db->update("coustomer",$edit_supplier);
            if ($this->db->affected_rows() > 0) {
                redirect('home/coustomer');
            }
            
        }
    }



    //delete invoce
    public function delete_invoice(){
        $del_data = $this->input->post('del_data');

        $explode = explode(":", $del_data);
        $sell_invoice = $explode[01]; //need
        $roots = $explode[0]; //need

        //go sale table
        $this->db->where("sell_invoice",$sell_invoice);
        $this->db->where("roots",$roots);
        $sale_q = $this->db->get("sale");
        if ($sale_q->num_rows()>0) {            
            $sale_result = $sale_q->row();

            $due = $sale_result->due; //need
            $cmrid = $sale_result->cmrid; //need

            $this->db->where("invoice_id",$sell_invoice);
            $ex_query = $this->db->get('expense');
            if ($ex_query->num_rows()>0) {
                $this->db->where("invoice_id",$sell_invoice);
                $this->db->delete("expense");
            }
            $this->db->where("invoice_id",$sell_invoice);
            $in_query = $this->db->get('income');
            if ($in_query->num_rows()>0) {
                $this->db->where("invoice_id",$sell_invoice);
                $this->db->delete("income");
            }


            $this->db->where("roots",1);
            $this->db->where("invoice_id",$sell_invoice);
            $sale_p_query = $this->db->get('sale_product');
            if ($sale_p_query->num_rows()>0) {

                foreach ($sale_p_query->result_array() as $sale_p_value) {
                    $pid = $sale_p_value['pid']; //need
                    $qty = $sale_p_value['qty']; //need

                    $this->db->where("pid",$pid);
                    $product_query = $this->db->get('product');
                    if ($product_query->num_rows()>0) {
                        $p_data = $product_query->row();

                        $p_qty = $p_data->quantity;

                        $p_qty_up = array('quantity' => $p_qty+$qty );

                        $this->db->where("pid",$pid);
                        $this->db->update("product",$p_qty_up);
                    }

                    $this->db->where("roots",1);
                    $this->db->where("invoice_id",$sell_invoice);
                    $this->db->delete("sale_product");

                }
            }//sale

            $this->db->where("roots",2);
            $this->db->where("invoice_id",$sell_invoice);
            $sale_p_query = $this->db->get('sale_product');
            if ($sale_p_query->num_rows()>0) {

                foreach ($sale_p_query->result_array() as $sale_p_value) {
                    $pid = $sale_p_value['pid']; //need
                    $qty = $sale_p_value['qty']; //need

                    $this->db->where("pid",$pid);
                    $product_query = $this->db->get('product');
                    if ($product_query->num_rows()>0) {
                        $p_data = $product_query->row();

                        $p_qty = $p_data->quantity;

                        $p_qty_up = array('quantity' => $p_qty-$qty );

                        $this->db->where("pid",$pid);
                        $this->db->update("product",$p_qty_up);
                    }

                    $this->db->where("roots",2);
                    $this->db->where("invoice_id",$sell_invoice);
                    $this->db->delete("sale_product");

                }
            }


            //customer due substance for sale
            if ($roots==1) {
                $this->db->where("cmrid",$cmrid);
                $cus_query = $this->db->get('coustomer');
                if ($cus_query->num_rows()>0) {
                    
                    $cus_row = $cus_query->row();
                    $cus_due = $cus_row->due;

                    $cus_due_up = array('due' => $cus_due-$due );

                    $this->db->where("cmrid",$cmrid);
                    $this->db->update("coustomer",$cus_due_up);
                }
            }

            if ($roots==2) {
                $this->db->where("cmrid",$cmrid);
                $supp_query = $this->db->get('supplier');
                if ($supp_query->num_rows()>0) {
                    
                    $supp_row = $supp_query->row();
                    $supp_loan = $supp_row->loan;

                    $sup_loan_up = array('loan' => $supp_loan-$due );

                    $this->db->where("cmrid",$cmrid);
                    $this->db->update("supplier",$sup_loan_up);
                }
            }


        }

        //sale row delete
        $this->db->where("sell_invoice",$sell_invoice);
        $this->db->delete("sale");
        if ($this->db->affected_rows()>0) {
            echo 'Success';
        }else{
            echo "Failed";
        }

        



    }


    //overseas
    public function overseas_record_add(){
        $overseas_add = array('roots' => $this->input->post('roots'),'name' => $this->input->post('name') );
        $this->db->insert("over_record",$overseas_add);
        if ($this->db->affected_rows()>0) {
            echo "Added Successfull";
        }else{
            echo "Added Failed";
        }
    }

    public function final_over_seas(){
        $final_added = array(
            'pid' => $this->input->post('pid'), 
            'amount' => $this->input->post('amount'), 
            'dated' => $this->input->post('dated'), 
            'over_record_id' => $this->input->post('over_record_id'), 
            'over_record_name' => $this->input->post('over_record_name'), 
            'over_record_roots' => $this->input->post('over_record_roots'), 
        );
        $this->db->insert("over_seas",$final_added);
        if ($this->db->affected_rows()>0) {
            $result = $this->header->final_over_seas($this->input->post('pid'));
        }
        echo json_encode($result);
    }

    public function over_seas_final_deleted(){
        $this->db->where('id',$this->input->post('cid'));
        $this->db->delete("over_seas");
        if ($this->db->affected_rows()>0) {
            $msg = 'delete Successfull.';
        }else{
            $msg = "delete Failed";
        }
        echo json_encode($msg);
    }
    public function product_all_oversease(){
         $result = $this->header->final_over_seas($this->input->post('pid'));
         echo json_encode($result);
    }


    public function over_recoed_edit(){
        $this->db->where('over_id',$this->input->post('over_id'));
        $query = $this->db->get("over_record");
        if ($query->num_rows()>0) {
            $result = $query->row();
        ?>
        <form action="<?php echo base_url() ?>jquery/over_recorded_update" method="POST">
            <div class="form-group">
                <label for="name">Select type</label>
                <select class="form-control" name="roots">
                    <option 
                    <?php if ($result->roots==1): ?>
                        selected="selected"
                    <?php endif ?>
                    value="1">Debit (Expense)</option>
                    <option                
                    <?php if ($result->roots==2): ?>
                        selected="selected"
                    <?php endif ?> 
                    value="2">Credit (Revenue)</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Overseas Name</label>
                <input type="hidden" name="over_id" value="<?php echo $result->over_id; ?>">
                <input type="text" class="form-control" name="over_seas_name" value="<?php echo $result->name; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    <?php 
        }
    }

    public function over_recorded_update(){
        $this->form_validation->set_rules('over_id','over_id','trim');
        $this->form_validation->set_rules('roots','roots','trim');
        $this->form_validation->set_rules('over_seas_name','over_seas_name','trim');

        if ($this->form_validation->run()==false) {
            redirect('home/supplier');
        }else{
            $edit_supplier = array(
                'roots' => $this->input->post("roots"), 
                'name' => $this->input->post("over_seas_name")
            );
            $this->db->where("over_id", $this->input->post("over_id"));
            $this->db->update("over_record",$edit_supplier);
            if ($this->db->affected_rows() > 0) {
                redirect('home/overseas');
            }
            
        }
    }


    //expense added
    //overseas
    public function expense_record_add(){
        $overseas_add = array('name' => $this->input->post('name'));
        $this->db->insert("daily",$overseas_add);
        if ($this->db->affected_rows()>0) {
            echo "Added Successfull";
        }else{
            echo "Added Failed";
        }
    }
    public function daily_ex_edit(){
        $this->db->where('id',$this->input->post('daily_id'));
        $query = $this->db->get("daily");
        if ($query->num_rows()>0) {
            $result = $query->row();
        ?>
        <form action="<?php echo base_url() ?>jquery/daily_ex_update" method="POST">
            <div class="form-group">
                <label for="name">Overseas Name</label>
                <input type="hidden" name="id" value="<?php echo $result->id; ?>">
                <input type="text" class="form-control" name="over_seas_name" value="<?php echo $result->name; ?>">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    <?php 
        }
    }

    public function daily_ex_update(){
        $this->form_validation->set_rules('id','id','trim');
        $this->form_validation->set_rules('over_seas_name','over_seas_name','trim');

        if ($this->form_validation->run()==false) {
            redirect('home/supplier');
        }else{
            $edit_daily = array(
                'name' => $this->input->post("over_seas_name")
            );
            $this->db->where("id", $this->input->post("id"));
            $this->db->update("daily",$edit_daily);
            if ($this->db->affected_rows() > 0) {
                redirect('home/daily_expense');
            }
            
        }
    }
    public function final_daily_expense(){
        $final_added = array(
            'amount' => $this->input->post('amount'), 
            'dated' => $this->input->post('dated'), 
            'title' => $this->input->post('daily_id'),
            'name' => $this->input->post('name'),
            'purpose' => $this->input->post('purpose')
        );
        $this->db->insert("daily_expense",$final_added);
        if ($this->db->affected_rows()>0) {
            $result = $this->header->final_daily_expense($this->input->post('dated'));
        }
        echo json_encode($result);
    }
    public function daily_expense_final_deleted(){
        $this->db->where('id',$this->input->post('cid'));
        $this->db->delete("daily_expense");
        if ($this->db->affected_rows()>0) {
            $msg = 'delete Successfull.';
        }else{
            $msg = "delete Failed";
        }
        echo json_encode($msg);
    }
    public function searchBydate_expense(){
        $result = $this->header->final_daily_expense($this->input->post('dated'));
        echo json_encode($result);
    }
    public function daily_expense_report($dated){
        $data1['dated'] = $dated;
        $this->load->view("main/daily_expense_report", $data1);
    }


}
?>