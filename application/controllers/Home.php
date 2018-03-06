<?php
class Home extends CI_Controller
{

    function __construct() {
        parent::__construct();

        $this->load->library('session');
        
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->library('pagination');


        $admin_user = $this->session->userdata('username');
        if(empty($admin_user))
        {   
            redirect('login');
        }


        $this->load->model('Header_model', 'header');
    } 

    

    public function index() {
        $data=[];
        $data['title']="Dashboard";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 


        $this->load->view('home'); //important

        $this->load->view("footer");
    }
    
    function logout(){
        $this->session->unset_userdata('username');
        redirect('login');      
    }

    //login and logout session control


    //password change process
    public function PasswordChange1(){
        echo '
            <div class="input-group">
                <span class="input-group-addon"><i class="icofont icofont-lock"></i></span>
                <input type="password" class="form-control" name="password" placeholder="Enter old Password" onblur="return PasswordChange2(this)">
            </div>
            <input type="hidden" value="'.$this->session->userdata('id').'" id="hiddenSessionId">
            <div id="password2Result"></div>
        ';
    }
    public function loginPassword2(){
        $passwordIn = md5($this->input->post('passwordIn'));
        $hiddenSessionId = $this->input->post('hiddenSessionId');
        $result = $this->header->changePassword2($passwordIn ,$hiddenSessionId);
        if ($result) {
            echo '
            <br>
            <div class="passInputGroup">
                <div class="input-group">
                    <span class="input-group-addon"><i class="icofont icofont-ui-unlock"></i></span>
                    <input type="password" class="form-control" id="passwordNew" placeholder="Enter new Password">
                </div> <br>
                <div class="input-group">
                    <span class="input-group-addon"><i class="icofont icofont-ui-unlock"></i></span>
                    <input type="password" class="form-control" id="passwordNewCon" placeholder="Enter confirm Password" onblur="return passwordNewCon3()">
                </div> <br>
                <div id="password3Result"></div>
                <div id="password4Result"></div>
            </div>
            ';
        }else{
            echo '<span style="margin-top:9px;font-size:12px;color:red;display: block">password does not exist.</span>';
        }
    }

    public function loginPassword3(){
        $id = $this->session->userdata('id');
        $passwordNewCon = md5($this->input->post('passwordNewCon'));
        $result = $this->header->changePassword3($passwordNewCon, $id);
        if ($result) {
            echo '
                <div class="alert alert-success" style="margin-top:10px">Password Successfully Changed.</div>
                <a class="btn btn-info btn-block" href="'.base_url().'home/logout">Login Now</div>
            ';
        }else{
            echo '<span style="margin-top:9px;font-size:12px;color:red;display: block">Present password can not be changed</span>';
        }

    }
    //change password end


    //page menu
    public function menu(){
        $data=[];
        $data['title']="Menu";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); //100% need

        $selectMenu['selectMenu'] = $this->header->selectMenu();
        $this->load->view('menu', $selectMenu); //important

        $this->load->view("footer");
    }

    public function menuCreate(){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('menu','menu','trim|required');
        $this->form_validation->set_rules('icon','icon','trim|required');
        $this->form_validation->set_rules('menuid','menuid','trim|required');
        $this->form_validation->set_rules('submenu','submenu','trim|required');
        $this->form_validation->set_rules('sub_link','sub_link','trim|required');
        if ($this->form_validation->run()==false) {
            $this->menu();
        }else{
            $menus=array(
                'menu' => $this->input->post('menu'),
                'icon' => $this->input->post('icon'),
                'menuid' => $this->input->post('menuid'),
                'submenu' => $this->input->post('submenu'),
                'sub_link' => $this->input->post('sub_link')
            );
            $result = $this->header->menuCreate($menus);
            redirect('home/menu');
        }
    }

    public function subMenuCreate(){
        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('menu','menu','trim|required');
        $this->form_validation->set_rules('icon','icon','trim|required');
        $this->form_validation->set_rules('menuid','menuid','trim|required');
        $this->form_validation->set_rules('submenu','submenu','trim|required');
        $this->form_validation->set_rules('sub_link','sub_link','trim|required');

        if ($this->form_validation->run()==false) {
            $this->menu();
        }else{
            $menus=array(
                'menu' => $this->input->post('menu'),
                'icon' => $this->input->post('icon'),
                'menuid' => $this->input->post('menuid'),
                'submenu' => $this->input->post('submenu'),
                'sub_link' => $this->input->post('sub_link')
            );
            $result = $this->header->subMenuCreate($menus);
            redirect('home/menu');
        }
    }//menu and submenu created complete




    //user list created process

    public function New_User(){
        $data=[];
        $data['title']="New User";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 

        $this->load->view("New_User");

        $this->load->view("footer");
    }


    public function user_access(){
        $id = $this->input->post('id');
        $result = $this->header->selectMenu();
        if ($result) {
            echo '
                <div class="well components2">
                    <h4 class="alert alert-success"><i class="icofont icofont-ui-settings"></i> Settings</h4>
                    <ul class="sidebar_ul2">
                    
            ';
           foreach ($result as $value) {
                $id = $value->id;
                $icon = $value->icon;
                $menu = $value->menu;
                
                if (!$menu==0) {
                    echo '                    
                        <li><input type="checkbox" id="'.$id.'c" value="'.$id.':0" onclick="ttt('.$id.')"> <i class="icofont icofont-'.$icon.'"></i>  '.$menu.'</li>
                        <div class="col-xs-12 bac" id="'.$id.'p"></div>
                    ';
                }
           }
           echo '
                    </ul>
                </div>
            ';
        }

    }

    public function user_access_sub_menu(){
        $id = $this->input->post('id');
        $result = $this->header->selectMenuheader2($id);
        if ($result) {
            echo '
                <ul class="lsitul">
            ';
            foreach ($result as $sub) {
                $subId = $sub->id;
                $submenu = $sub->submenu;

                echo '<li class="listCheck"><input type="checkbox" value="'.$id.':'.$subId.'" name="menu_sub[]" checked> '.$submenu.'</li>';

            }
            echo '
                </ul>
            ';
        }
    }


    public function userSubmit(){
        $menu_sub = $this->input->post('menu_sub');

        $this->load->helper(array('form','url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username','username','trim|required');
        $this->form_validation->set_rules('password','password','trim|required');
        $this->form_validation->set_rules('role','role','trim|required');
        $this->form_validation->set_rules('status','status','trim|required');

        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));
        $role = $this->input->post('role');
        $status = $this->input->post('status');

        
        if ($this->form_validation->run()==false) {
            $this->New_User();
        }else{

            $userData=array(
                'username' => $username,
                'password' => $password,
                'role' => $role,
                'status' => $status
            );

            $insertuser = $this->db->insert('users',$userData);

            if ($insertuser) {

                $resulss = $this->header->selectlastuser();
                if ($resulss) {
                    foreach ($resulss as $lastid) {
                        $id = $lastid->id;


                        foreach ($menu_sub as $value) {

                            $sohel = explode(':',$value);
                            $menuid = $sohel[0];
                            $submenuid = $sohel[1];

                            $menus=array(
                                'userId' => $id,
                                'menuid' => $menuid,
                                'submenuid' => $submenuid
                            );

                            $this->db->insert('role',$menus);
                        }


                        redirect('home/User_List');
                    }
                }
            }

        } //else insert function
        
    } //end add user

    public function userstatus(){
        $id = $this->input->post('editg');

        $this->db->where("id",$id);
        $category_info=$this->db->get("users");
        foreach ($category_info->result_array() as $category_info_all) {
            $status = $category_info_all['status'];
            if ($status==1) {
               $data=array(
                    'status' => 0
                );

                $this->db->where("id",$id); 
                $this->db->update('users',$data);
            }else{
                $data=array(
                    'status' => 1
                );

                $this->db->where("id",$id); 
                $this->db->update('users',$data);
            }

        }
    }
    public function userdel(){
        $delid = $this->input->post('delid');

        $this->db->where('id',$delid);
        $this->db->delete('users');

        $this->db->where('userId',$delid);
        $this->db->delete('role');
    }



    public function User_List(){
        $data=[];
        $data['title']="User List";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 

        
        $this->load->view("User_List");

        $this->load->view("footer");
    }
    public function updateprofile(){
        
        $id = $this->input->post('id');

        
        $users=array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'name' => $this->input->post('name')
        );
        $this->db->where('id',$id);
        $results = $this->db->update('users',$users);
        if ($results) {
            echo 'Profile Update Successfully.';
        }else{
            echo 'Profile Update Failed.';
        }
    }


    /*=============== admin panel complete==============*/

    public function coustomer(){
        $data=[];
        $data['title']="Coustomer";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 


        //pagination start
        $config = array();
        $config["base_url"] = base_url() . "home/coustomer";
        $config["total_rows"] = $this->header->cous_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = 'FIRST';
        $config["uri_segment"] = 3;
        $config['last_link'] = 'LAST';
        $config['next_link'] = '...NEXT';
        $config['prev_link'] = 'PREV...';

        $config['full_tag_open'] = '<div class="paginations">';
        $config['full_tag_close'] = '</div>';
        $config['anchor_class'] = 'class="number" ';
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data1["results"] = $this->header->fetch_coustomer($config["per_page"], $page);
        $data1["links"] = $this->pagination->create_links();
        //pagination end

        
        $this->load->view("main/coustomer", $data1);

        $this->load->view("footer");
    }

    public function crm_add(){
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $city = $this->input->post('city');
        $company = $this->input->post('company');
        $prev_due = $this->input->post('prev_due');
        $mobile_phone = $this->input->post('mobile_phone');
        $tel_phone = $this->input->post('tel_phone');
        $email = $this->input->post('email');

        $coustomers=array(
            'name'      => $name,
            'address'   => $address,
            'city'      => $city,
            'company'   => $company,
            'due'       => $prev_due,
            'mobile_phone' => $mobile_phone,
            'tel_phone' => $tel_phone,
            'dated' => $this->input->post('dated'),
            'email'     => $email
        );

        $results = $this->header->crm_add($coustomers);
        if ($results) {
            $msg = 'Coustomer Added Successfully.';
        }else{
            $msg = 'Coustomer Added Failed.';
        }

        echo json_encode($msg);
    }


    public function new_product(){
        $data=[];
        $data['title']="New Product";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data);

        $this->load->view("main/new_product");

        $this->load->view("footer");
    }
    public function product_code_check(){
        $pcode = $this->input->post('pcode');

        $query = $this->header->check_product_code($pcode);
        if ($query==true) {
            $msg = 'Product Code not Available';
        }else{
            $msg = 'Success. Product Code Available.';
        }
        echo json_encode($msg);
    }
    public function product_add(){
        $name = $this->input->post('name');
        $product_code = $this->input->post('product_code');
        $quantity = $this->input->post('quantity');
        $price = $this->input->post('price');
        $sell_price = $this->input->post('sell_price');
        $opening_stock = $this->input->post('opening_stock');
        $price_type = $this->input->post('price_type');


        $description = $this->input->post('description');

        $opening_stock_price = $this->input->post('opening_stock_price');

        $opening_price = $opening_stock*$opening_stock_price; //stock

        $products=array(
            'name'              => $name,
            'product_code'      => $product_code,
            'price'             => $price,
            'sell_price'        => $sell_price,
            'add_date'          => $price_type,
            'description'       => $description,
            'opening_stock'     => $opening_stock,
            'opening_stock_price'=> $opening_stock_price,
            'quantity'          => $opening_stock,
            'total_price'       => $opening_price
        );

        $results = $this->header->product_add($products);
        if ($results) {
            $msg = 'Product Added Successfully.';
        }else{
            $msg = 'Product Added Failed.';
        }

        echo json_encode($msg);
    }

    public function all_product(){
        $data=[];
        $data['title']="All Product";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 


        //pagination start
        $config = array();
        $config["base_url"] = base_url() . "home/all_product";
        $config["total_rows"] = $this->header->product_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = 'FIRST';
        $config["uri_segment"] = 3;
        $config['last_link'] = 'LAST';
        $config['next_link'] = '...NEXT';
        $config['prev_link'] = 'PREV...';

        $config['full_tag_open'] = '<div class="paginations">';
        $config['full_tag_close'] = '</div>';
        $config['anchor_class'] = 'class="number" ';
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data1["results"] = $this->header->fetch_product($config["per_page"], $page);
        $data1["links"] = $this->pagination->create_links();
        //pagination end

        
        $this->load->view("main/all_product", $data1);

        $this->load->view("footer");
    }
    public function new_sale(){
        $data=[];
        $data['title']="New Sale";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data);

        $this->load->view("main/new_sale");

        $this->load->view("footer");
    }
    public function sell_cous_search(){
        $sell_cous = $this->input->post('sell_cous');
        $results = $this->header->sell_cous_search($sell_cous);
        echo json_encode($results);
    }
    public function product_sale(){
        $roots = $this->input->post('roots');
        $sell_invoice = $this->input->post('sell_invoice');
        $sell_date = $this->input->post('sell_date');
        $cmrid = $this->input->post('cmrid');

        $created_by = $this->session->userdata('name');

        $sale_pro=array(
            'roots'         => $roots,
            'sell_invoice'  => $sell_invoice,
            'sell_date'     => $sell_date,
            'cmrid'         => $cmrid,
            'created_by'    => $created_by
        );
        $results = $this->header->product_sale($sale_pro);
        if ($results) {
            $msg = '';
        }else{
            $msg = '';
        }

        echo json_encode($msg);
    }
    public function pro_cous_result(){
        $sale_product = $this->input->post('sale_product');
        $results = $this->header->pro_cous_result($sale_product);
        echo json_encode($results);
    }
    public function productidByprice(){
        $pid = $this->input->post('pid');
        $results = $this->header->productidByprice($pid);
        echo json_encode($results);
    }
    public function product_sale_last(){
        $roots = $this->input->post('roots');
        $pid = $this->input->post('pid');
        $pname = $this->input->post('pname');
        $qty = $this->input->post('qty');
        $price = $this->input->post('price');
        $total = $this->input->post('total');

        $saleid = $this->input->post('saleid');


        $this->db->where("invoice_id",$saleid);
        $this->db->where("pid",$pid);
        $query = $this->db->get("sale_product");
        if ($query->num_rows()>0) {

            
            $sale_up2=array(
                'qty'    => $qty,
                'price'  => $price,
                'gross_amount'=> $total
            );
            $results = $this->header->product_sale_last_update($sale_up2,$saleid,$pid);


        }else{
            
            $sale_up=array(
                'roots' => $roots,
                'invoice_id' => $saleid,
                'pid'    => $pid,
                'pname'    => $pname,
                'qty'    => $qty,
                'price'  => $price,
                'gross_amount'=> $total
            );
            $results = $this->header->product_sale_last($sale_up);

        }


            


        if ($results) {
            $s_report = $this->header->sales_report($saleid);
            echo json_encode($s_report);
        }else{
            echo false;
        }
    }
    public function product_sale_final(){
        $saleid = $this->input->post('saleid');

        $gross_amount = $this->input->post('gross_amount');
        $discount = $this->input->post('discount');
        $cash = $this->input->post('cash');

        $dbdis = ($gross_amount/100)*$discount;
        $dbcash = $gross_amount-$dbdis;

        $due = $dbcash-$cash;

        $sale_up_final=array(
            'gross_amount'  => $gross_amount, //dbcash
            'discount'  => $discount,
            'cash'      => $cash,
            'due'       => $due
        );
        $this->db->where("sell_invoice", $saleid);
        $this->db->update("sale", $sale_up_final);

        // income
        $expense_dis=array(
            'invoice_id'  => $saleid,
            'total'  => $dbdis
        );
        $this->db->insert("expense", $expense_dis);
        //end income


        $this->db->where("sell_invoice", $saleid);
        $query = $this->db->get("sale");
        $row = $query->row();

        $invoice_id = $row->sell_invoice; //invoice id
        $cmrid = $row->cmrid; //customer id

        $this->db->where("cmrid", $cmrid);
        $query2 = $this->db->get("coustomer");
        $row2 = $query2->row();

        $prevdue = $row2->due;

        $currrendue = $prevdue+$due;

        $cous_due_up=array('due' => $currrendue);
        $this->db->where("cmrid", $cmrid);
        $this->db->update("coustomer", $cous_due_up); //customer complete

        $this->db->where("invoice_id", $invoice_id);
        $query_product = $this->db->get("sale_product");
        foreach ($query_product->result_array() as $own_product) {
            $pid = $own_product['pid'];
            $sale_qty = $own_product['qty'];



            $this->db->where("pid", $pid);
            $query3 = $this->db->get("product");
            $row3 = $query3->row();
            $pro_quantity = $row3->quantity;

            $pro_quantity_up = $pro_quantity-$sale_qty;

            $pro_qty_up=array('quantity' => $pro_quantity_up);
            $this->db->where("pid", $pid);
            $result = $this->db->update("product", $pro_qty_up);
            if ($result) {
                $msg = 'Sale Successfully Complete.';
            }else{
                $msg = 'Sale Failed.';
            }
        } //foreach end
        echo json_encode($msg);
        
    }


















    public function daily_invoice_reports(){
        $data=[];
        $data['title']="Daily Invoice Reports";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data);

        //pagination start
        $config = array();
        $config["base_url"] = base_url() . "home/daily_invoice_reports";
        $config["total_rows"] = $this->header->invoice_count();
        $config["per_page"] = 25;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = 'FIRST';
        $config["uri_segment"] = 3;
        $config['last_link'] = 'LAST';
        $config['next_link'] = '...NEXT';
        $config['prev_link'] = 'PREV...';

        $config['full_tag_open'] = '<div class="paginations">';
        $config['full_tag_close'] = '</div>';
        $config['anchor_class'] = 'class="number" ';
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data1["results"] = $this->header->fetch_invoice($config["per_page"], $page);
        $data1["links"] = $this->pagination->create_links();
        //pagination end

        $this->load->view("main/daily_invoice_reports", $data1);

        $this->load->view("footer");
    }
    public function daily_invoice_reports_print($sell_invoice,$cmrid){

        $data1['sell_invoice'] = $sell_invoice;
        $data1['cmrid'] = $cmrid;
        $this->load->view("main/daily_invoice_reports_print", $data1);
    }

    public function supplier(){
        $data=[];
        $data['title']="Coustomer";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 


        //pagination start
        $config = array();
        $config["base_url"] = base_url() . "home/supplier";
        $config["total_rows"] = $this->header->supp_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = 'FIRST';
        $config["uri_segment"] = 3;
        $config['last_link'] = 'LAST';
        $config['next_link'] = '...NEXT';
        $config['prev_link'] = 'PREV...';

        $config['full_tag_open'] = '<div class="paginations">';
        $config['full_tag_close'] = '</div>';
        $config['anchor_class'] = 'class="number" ';
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data1["results"] = $this->header->fetch_supplier($config["per_page"], $page);
        $data1["links"] = $this->pagination->create_links();
        //pagination end

        
        $this->load->view("main/supplier", $data1);

        $this->load->view("footer");
    }
    public function supp_add(){
        $name = $this->input->post('name');
        $address = $this->input->post('address');
        $city = $this->input->post('city');
        $company = $this->input->post('company');
        $prev_due = $this->input->post('prev_due');
        $mobile_phone = $this->input->post('mobile_phone');
        $tel_phone = $this->input->post('tel_phone');
        $email = $this->input->post('email');

        $suppliers=array(
            'name'      => $name,
            'address'   => $address,
            'city'      => $city,
            'company'   => $company,
            'loan'      => $prev_due,
            'mobile_phone' => $mobile_phone,
            'tel_phone' => $tel_phone,
            'dated' => $this->input->post('dated'),
            'email'     => $email
        );

        $results = $this->header->supp_add($suppliers);
        if ($results) {
            $msg = 'Supplier Added Successfully.';
        }else{
            $msg = 'Supplier Added Failed.';
        }

        echo json_encode($msg);
    }
    public function new_purchase(){
        $data=[];
        $data['title']="New Purchase";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data);

        $this->load->view("main/new_purchase");

        $this->load->view("footer");
    }



    public function sell_supp_search(){
        $sell_cous = $this->input->post('sell_cous');
        $results = $this->header->sell_supp_search($sell_cous);
        echo json_encode($results);
    }

    public function product_purchase_final(){
        $saleid = $this->input->post('saleid');

        $gross_amount = $this->input->post('gross_amount');
        $discount = $this->input->post('discount');
        $cash = $this->input->post('cash');

        $vat = $this->input->post('vat');
        $tariff = $this->input->post('tariff');
        $transport = $this->input->post('transport');
        $others = $this->input->post('others');

        $dbdis = ($gross_amount/100)*$discount;
        $dbcash = $gross_amount-$dbdis;

        $due = $dbcash-$cash;

        $sale_up_final=array(
            'gross_amount'  => $gross_amount, //$dbcash
            'discount'  => $discount,
            'cash'      => $cash,
            'due'       => $due
        );
        $this->db->where("sell_invoice", $saleid);
        $this->db->update("sale", $sale_up_final);


        $this->db->where("sell_invoice", $saleid);
        $query = $this->db->get("sale");
        $row = $query->row();

        $invoice_id = $row->sell_invoice; //invoice id
        $cmrid = $row->cmrid; //customer id

        $this->db->where("cmrid", $cmrid);
        $query2 = $this->db->get("supplier");
        $row2 = $query2->row();

        $prevloan = $row2->loan;

        $currrenloan = $prevloan+$due;

        $cous_due_up=array('loan' => $currrenloan);
        $this->db->where("cmrid", $cmrid);
        $this->db->update("supplier", $cous_due_up); //supplier complete

        $this->db->where("invoice_id", $invoice_id);
        $query_product = $this->db->get("sale_product");
        foreach ($query_product->result_array() as $own_product) {
            $pid = $own_product['pid'];
            $sale_qty = $own_product['qty'];



            $this->db->where("pid", $pid);
            $query3 = $this->db->get("product");
            $row3 = $query3->row();
            $pro_quantity = $row3->quantity;

            $pro_quantity_up = $pro_quantity+$sale_qty;


            $pro_qty_up=array(
                'quantity' => $pro_quantity_up
            );
            $this->db->where("pid", $pid);
            $result = $this->db->update("product", $pro_qty_up);
            if ($result) {
                // income
                $expense_dis=array(
                    'invoice_id'  => $saleid,
                    'discount'  => $dbdis
                );
                $this->db->insert("income", $expense_dis);
                //end income

                // expense
                $expense_dis=array(
                    'invoice_id'=> $saleid,
                    'vat'       => $vat,
                    'tariff'    => $tariff,
                    'transport' => $transport,
                    'others'    => $others,
                    'total'     => $vat+$tariff+$transport+$others
                );
                $result = $this->db->insert("expense", $expense_dis);
                //end expense
                if ($result) {
                    $msg = 'Purchase Successfully Complete.';
                }
            }else{
                $msg = 'Purchase Failed.';
            }
        } //foreach end
        echo json_encode($msg);
        
    }








    //update sms Setting
    public function updated_sms_settings(){
        $id = 1;

        $setting=array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password'),
            'sender' => $this->input->post('sender')
        );
        $this->db->where('id',$id);
        $results = $this->db->update('sms_setting',$setting);
        if ($results) {
            echo 'SMS Setting Update Successfully.';
        }else{
            echo 'SMS Setting Update Failed.';
        }
    }
    public function send_sms_coustomer(){
        $value = $this->input->post('value');

        $explode = explode('/',$value);

        $invoice_id = $explode[0];
        $cmrid = $explode[1];

        //step 1
        $this->db->where("sell_invoice", $invoice_id);
        $sale_info = $this->db->get("sale");
        $rowsale = $sale_info->row();
        $sale_due = $rowsale->due;

        //step 2
        $this->db->where("cmrid", $cmrid);
        $cmrid_info = $this->db->get("coustomer");
        $rowcmr = $cmrid_info->row();
        $cmr_name = $rowcmr->name;
        $mobile = $rowcmr->mobile_phone;

        $total_due = $rowcmr->due;

        $prev_due = $total_due-$sale_due;



        $forms_sms = '
        <div class="form-group">
            <label for="">Coustomer Name : </label>
            <input type="hidden" id="invoice_id" value="'.$invoice_id.'" readonly>
            <input type="hidden" id="cmrid" value="'.$cmrid.'" readonly>

            <input type="text" class="form-control" id="cmr_name" value="'.$cmr_name.'" readonly>
        </div>
        <div class="form-group">
            <label for="">Mobile Number : </label> <span class="label label-success">Example: 8801812345678</span>
            <input type="text" class="form-control" id="mobile" value="'.$mobile.'">
        </div>
        <div class="form-group">
            <label for="">Message : </label>
            <textarea id="message" class="form-control" rows="4" readonly>Dear Customer '.$cmr_name.', Invoice no:'.$invoice_id.'.Your Previous due:'.$prev_due.' and current due:'.$sale_due.'=Total due:'.$total_due.' Tk.</textarea>
        </div>
        <button class="btn btn-success" onclick="send_sms_now()">Send</button>
        ';
        echo json_encode($forms_sms);
    }
    public function send_sms_coustomer_only(){
        $cmrid = $this->input->post('value');

        //step 2
        $this->db->where("cmrid", $cmrid);
        $cmrid_info = $this->db->get("coustomer");
        $rowcmr = $cmrid_info->row();
        $cmr_name = $rowcmr->name;
        $mobile = $rowcmr->mobile_phone;

        $total_due = $rowcmr->due;

        $this->db->where("cmrid", $cmrid);
        $sms_info = $this->db->get("sms");
        $row_count = $sms_info->num_rows();

        $forms_sms = '
        <div class="well">
            '.$row_count.' Times Count SMS
        </div>
        <div class="form-group">
            <label for="">Coustomer Name : </label>
            <input type="hidden" id="cmrid" value="'.$cmrid.'" readonly>

            <input type="text" class="form-control" id="cmr_name" value="'.$cmr_name.'" readonly disabled>
        </div>
        <div class="form-group">
            <label for="">Mobile Number : </label> <span class="label label-success">Example: 8801812345678</span>
            <input type="text" class="form-control" id="mobile" value="'.$mobile.'">
        </div>
        <div class="form-group">
            <label for="">Message : </label>
            <textarea id="message" class="form-control" rows="4" readonly disabled>Dear Customer '.$cmr_name.', Id no:'.$cmrid.'.Your Total due:'.$total_due.' Tk.</textarea>
        </div>
        <button class="btn btn-success" onclick="send_sms_now_only()">Send</button>
        ';
        echo json_encode($forms_sms);
    }

    public function send_sms_confirm_only(){
        $cmrid = $this->input->post('cmrid');
        $cmr_name = $this->input->post('cmr_name');
        $mobile = $this->input->post('mobile');
        $message = $this->input->post('message');

        $this->db->where("id",1);
        $getsms = $this->db->get("sms_setting");
        $row_sms = $getsms->row();

        $username = $row_sms->username;
        $password = $row_sms->password;
        $sender = $row_sms->sender;


        
        $curlPost = 'user='.$username.'&password='.$password.'&sender='.$sender.'&SMSText='.$message.'&GSM='.$mobile;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://api.bulksms.icombd.com/api/v3/sendsms/plain');
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);
        curl_close($ch);


        if ($ch==true) {

            $sms_added=array(
                'cmrid' => $this->input->post('cmrid'),
                'cmr_name' => $this->input->post('cmr_name'),
                'mobile' => $this->input->post('mobile'),
                'message' => $this->input->post('message')
            );

            $results = $this->db->insert('sms',$sms_added);
            if ($results) {
                $msg = 'SMS Sending Successfully.';
            }else{
                $msg = 'SMS Sending Failed.';
            }

           
        }else{
            $msg = 'SMS Sent Failed.';
        }

        echo json_encode($msg);
    }
    public function send_sms_confirm(){
        $invoice_id = $this->input->post('invoice_id');
        $cmrid = $this->input->post('cmrid');
        //$pid = $this->input->post('pid');
        $cmr_name = $this->input->post('cmr_name');
        $mobile = $this->input->post('mobile');
        $message = $this->input->post('message');

        $this->db->where("id",1);
        $getsms = $this->db->get("sms_setting");
        $row_sms = $getsms->row();

        $username = $row_sms->username;
        $password = $row_sms->password;
        $sender = $row_sms->sender;


        
        $curlPost = 'user='.$username.'&password='.$password.'&sender='.$sender.'&SMSText='.$message.'&GSM='.$mobile;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://api.bulksms.icombd.com/api/v3/sendsms/plain');
        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $curlPost);
        $data = curl_exec($ch);
        curl_close($ch);


        if ($ch==true) {

            $sms_added=array(
                'invoice_id' => $this->input->post('invoice_id'),
                'cmrid' => $this->input->post('cmrid'),
                'cmr_name' => $this->input->post('cmr_name'),
                'mobile' => $this->input->post('mobile'),
                'message' => $this->input->post('message')
            );

            $results = $this->db->insert('sms',$sms_added);
            if ($results) {
                $msg = 'SMS Sending Successfully.';
            }else{
                $msg = 'SMS Sending Failed.';
            }

           
        }else{
            $msg = 'SMS Sent Failed.';
        }

        echo json_encode($msg);
    }


    //friday 21-04-2017
    public function stock_summary(){
        $data=[];
        $data['title']="Stock Summary";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 


        //pagination start
        $config = array();
        $config["base_url"] = base_url() . "home/stock_summary";
        $config["total_rows"] = $this->header->product_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = 'FIRST';
        $config["uri_segment"] = 3;
        $config['last_link'] = 'LAST';
        $config['next_link'] = '...NEXT';
        $config['prev_link'] = 'PREV...';

        $config['full_tag_open'] = '<div class="paginations">';
        $config['full_tag_close'] = '</div>';
        $config['anchor_class'] = 'class="number" ';
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data1["results"] = $this->header->fetch_product($config["per_page"], $page);
        $data1["links"] = $this->pagination->create_links();
        //pagination end

        
        $this->load->view("main/stock_summary", $data1);

        $this->load->view("footer");
    }

    public function details_product($id){
        $data1['id'] = $id;
        $this->load->view("main/details_product", $data1);
    }
    public function overseas_product($id){
        $data1['id'] = $id;
        $this->load->view("main/overseas_product", $data1);
    }

    public function sales_product($id){
        $data=[];
        $data['title']="Sales_product";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 


        $data1["pid"] = $id;
        $data1["results"] = $this->header->sale_fetch_product($id);
        $this->load->view("main/sales_product", $data1);

        $this->load->view("footer");
    }
    public function purchase_product($id){
        $data=[];
        $data['title']="Sales_product";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 


        $data1["pid"] = $id;
        $data1["results"] = $this->header->purchase_fetch_product($id);
        $this->load->view("main/purchase_product", $data1);

        $this->load->view("footer");
    }


    //customer reports
    public function customer_reports(){
        $data=[];
        $data['title']="Customer Reports";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 


        //pagination start
        $config = array();
        $config["base_url"] = base_url() . "home/customer_reports";
        $config["total_rows"] = $this->header->cous_count();
        $config["per_page"] = 10;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = 'FIRST';
        $config["uri_segment"] = 3;
        $config['last_link'] = 'LAST';
        $config['next_link'] = '...NEXT';
        $config['prev_link'] = 'PREV...';

        $config['full_tag_open'] = '<div class="paginations">';
        $config['full_tag_close'] = '</div>';
        $config['anchor_class'] = 'class="number" ';
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data1["results"] = $this->header->fetch_coustomer($config["per_page"], $page);
        $data1["links"] = $this->pagination->create_links();
        //pagination end

        
        $this->load->view("main/customer_reports", $data1);

        $this->load->view("footer");
    }

    public function details_customer($id){
        $data1['cmrid'] = $id;
        $this->load->view("main/details_customer", $data1);
    }

    public function customer_products($cmrid){
        $data=[];
        $data['title']="Customer Product Reports";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 


        $data1["cmrid"] = $cmrid;
        $data1["results"] = $this->header->customer_fetch_product($cmrid);
        $this->load->view("main/customer_products", $data1);

        $this->load->view("footer");
    }
    public function sale_product_own($sell_invoice){
        $data1['invoice_id'] = $sell_invoice;
        $this->load->view("main/sale_product_own", $data1);
    }

    //supplier reports
    public function reports_supplier(){
        $data=[];
        $data['title']="Supplier Reports";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 


        //pagination start
        $config = array();
        $config["base_url"] = base_url() . "home/reports_supplier";
        $config["total_rows"] = $this->header->supp_count();
        $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = 'FIRST';
        $config["uri_segment"] = 3;
        $config['last_link'] = 'LAST';
        $config['next_link'] = '...NEXT';
        $config['prev_link'] = 'PREV...';

        $config['full_tag_open'] = '<div class="paginations">';
        $config['full_tag_close'] = '</div>';
        $config['anchor_class'] = 'class="number" ';
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data1["results"] = $this->header->fetch_supplier($config["per_page"], $page);
        $data1["links"] = $this->pagination->create_links();
        //pagination end

        
        $this->load->view("main/reports_supplier", $data1);

        $this->load->view("footer");
    }
    public function details_supplier($id){
        $data1['cmrid'] = $id;
        $this->load->view("main/details_supplier", $data1);
    }
    public function supplier_products($cmrid){
        $data=[];
        $data['title']="Supplier Product Reports";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data); 


        $data1["cmrid"] = $cmrid;
        $data1["results"] = $this->header->supplier_fetch_product($cmrid);
        $this->load->view("main/supplier_products", $data1);

        $this->load->view("footer");
    }


    public function cash_receives(){
        $data=[];
        $data['title']="Cash Receives | Debit";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data);

        $data1['roots'] = 1;
        $this->load->view("main/cash", $data1);

        $this->load->view("footer");
    }
    public function cash_payment(){
        $data=[];
        $data['title']="Cash Payment | Credit";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data);

        $data1['roots'] = 2;
        $this->load->view("main/cash", $data1);

        $this->load->view("footer");
    }

    public function cash_process(){
        $cmrid = $this->input->post("cmrid");

        $cash_insert = array(
            'cash_id' => $this->input->post("cash_id"), 
            'roots' => $this->input->post("roots"), 
            'name' => $this->input->post("cmrid"), 
            'amount' => $this->input->post("amount"), 
            'dated' => $this->input->post("dated"),
            'details' => $this->input->post("details")
        );
        $this->db->insert("cash",$cash_insert);
        if ($this->db->affected_rows() > 0) {
            if ($this->input->post("roots")==1) {
                $this->db->where("cmrid",$cmrid);
                $query = $this->db->get("coustomer");
                if ($query->num_rows()>0) {
                    $result = $query->row();
                    $due = $result->due;

                    $db_due = $due-$this->input->post("amount");

                    $up_due = array('due' => $db_due );
                    $this->db->where("cmrid",$cmrid);
                    $this->db->update("coustomer",$up_due);
                    if ($this->db->affected_rows() > 0) {
                        $msg = 'Successfully Inserted';
                    }
                }
            }elseif ($this->input->post("roots")==2) {
                $this->db->where("cmrid",$cmrid);
                $query = $this->db->get("supplier");
                if ($query->num_rows()>0) {
                    $result = $query->row();
                    $loan = $result->loan;

                    $db_due = $loan-$this->input->post("amount");

                    $up_due = array('loan' => $db_due );
                    $this->db->where("cmrid",$cmrid);
                    $this->db->update("supplier",$up_due);
                    if ($this->db->affected_rows() > 0) {
                        $msg = 'Successfully Inserted';
                    }
                }
            }

        }else{
            $msg = 'Failed';
        }
        echo json_encode($msg);
    }
    public function balance_sheet(){
        $data=[];
        $data['title']="Balance Sheet";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data);

        $this->load->view("main/balance_sheet");

        $this->load->view("footer");
    }



    public function check_product_qty(){
        $pid = $this->input->post('pid');
        $qty = $this->input->post('qty');

        $this->db->where("pid",$pid);
        $query = $this->db->get("product");
        if ($query->num_rows()>0) {
            $row_query = $query->row();
            $quantity = $row_query->quantity;
            if ($quantity>$qty || $quantity==$qty) {
               $msg = 'Quantity Available';
            }else{
                $msg = 'Product Quantity not available';
            }
            echo json_encode($msg);
        }
    }

    public function cash_reports(){
        $data=[];
        $data['title']="Daily Cash Reports";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data);

        //pagination start
        $config = array();
        $config["base_url"] = base_url() . "home/cash_reports";
        $config["total_rows"] = $this->header->cash_counts();
        $config["per_page"] = 25;
        $config["uri_segment"] = 3;
        $config['use_page_numbers'] = TRUE;
        $config['first_link'] = 'FIRST';
        $config["uri_segment"] = 3;
        $config['last_link'] = 'LAST';
        $config['next_link'] = '...NEXT';
        $config['prev_link'] = 'PREV...';

        $config['full_tag_open'] = '<div class="paginations">';
        $config['full_tag_close'] = '</div>';
        $config['anchor_class'] = 'class="number" ';
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data1["results"] = $this->header->fetch_cash($config["per_page"], $page);
        $data1["links"] = $this->pagination->create_links();
        //pagination end

        $this->load->view("main/cash_reports", $data1);

        $this->load->view("footer");
    }

    public function details_cash_reports($id,$roots){
        $data1['id'] = $id;
        $data1['roots'] = $roots;
        $this->load->view("main/details_cash_reports", $data1);
    }


    public function capital(){
        $data=[];
        $data['title']="Capital";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data);

        $data1['roots'] = 2;
        $this->load->view("main/capital", $data1);

        $this->load->view("footer");
    }
    public function add_capital(){
        $add_capital = array(
            'capital' => $this->input->post("capital"), 
            'name' => $this->input->post("name") 
        );
        $this->db->insert("capital",$add_capital);
        if ($this->db->affected_rows() > 0) {
            $msg = "Successfully Added";
        }else{
            $msg = "Added Failed/";
        }
        echo json_encode($msg);
    }

    public function balance_sheet_print(){
        $this->load->view("main/balance_sheet_print");
    }


    public function overseas(){
        $data=[];
        $data['title']="Overseas";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data);
       
        $this->load->view("main/overseas");

        $this->load->view("footer");
    }
    public function daily_expense(){
        $data=[];
        $data['title']="Overseas";
        $data['menuList'] = $this->header->selectMenuheader();
        $data['userlistAll'] = $this->header->userlistAll();
        $this->load->view("header", $data);
       
        $this->load->view("main/daily_expense");

        $this->load->view("footer");
    }
} 
?>