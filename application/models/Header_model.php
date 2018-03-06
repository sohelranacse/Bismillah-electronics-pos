<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class header_model extends CI_Model
{

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    //chenge password
    public function changePassword2($passwordIn ,$hiddenSessionId){
    	$this->db->where('id', $hiddenSessionId);
        $this->db->like('password', $passwordIn);
        $query = $this->db->get('users');
        if ($query->num_rows() > 0) {
            return $query->row();
        }else{return false;}
    }
    public function changePassword3($passwordNewCon, $id){
    	$field = array(
			'password' => $passwordNewCon
		);	
		$this->db->where('id',$id);
		$this->db->update('users', $field);

		if ($this->db->affected_rows() > 0) {
			return true;
		}else{
			return false;
		}
    }
    //change password end


    //menu submenu create
    public function menuCreate($menus){
    	$this->db->insert('menu',$menus);
    }
    public function selectMenu(){
        $this->db->select('*');
		$this->db->from('menu');
		$this->db->order_by('id','DESC');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->result();
		}else{
			return FALSE;
		}
    }
    public function subMenuCreate($menus){
    	$this->db->insert('menu',$menus);
    }
    public function selectMenuheader(){
        $this->db->select('*');
		$this->db->from('menu');
        $this->db->order_by('id', 'desc');
		$query = $this->db->get();
		if ($query->num_rows()>0) {
			return $query->result();
		}else{
			return FALSE;
		}
    }
    public function selectMenuheader2($id){
        $this->db->select('*');
        $this->db->from('menu');
        $this->db->where('menuid',$id);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            return $query->result();
        }else{
            return FALSE;
        }
    }//menu submenu create end


    public function selectlastuser(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->order_by('id','desc');
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            return $query->result();
        }else{
            return FALSE;
        }
    }//user last insert user id


    public function userlistAll(){
        $this->db->select('*');
        $this->db->from('users');
        $this->db->order_by('id', 'desc');
        $query = $this->db->get();
        if ($query->num_rows()>0) {
            return $query->result();
        }else{
            return FALSE;
        }
    }
    /*######## admin panel end########*/

    public function crm_add($coustomers){
        $this->db->insert('coustomer',$coustomers);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }

    public function cous_count() {
        return $this->db->count_all("coustomer");
    }
    public function fetch_coustomer($limit, $start){
        $this->db->limit($limit, $start);
        $this->db->order_by("cmrid",'desc');
        $query=$this->db->get("coustomer");
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    } //coustomer

    
    public function product_add($products){
        $this->db->insert('product',$products);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
    public function product_add_expense($products_expense){
        $this->db->insert('expense',$products_expense);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    } //product added complete
    public function product_count() {
        return $this->db->count_all("product");
    }
    public function fetch_product($limit, $start){
        $this->db->limit($limit, $start);
        $this->db->order_by("pid",'desc');
        $query=$this->db->get("product");
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    } //product

    public function sell_cous_search($sell_cous){
        $query = $this->db->like("name", $sell_cous);
        $query = $this->db->get("coustomer");
        if ($query->num_rows()>0) {
            return $query->result();
        }else{
            return FALSE;
        }
    }

    public function product_sale($sale_pro){
        $this->db->insert('sale',$sale_pro);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
    public function pro_cous_result($sell_cous){
        $query = $this->db->like("name", $sell_cous);
        $query = $this->db->get("product");
        if ($query->num_rows()>0) {
            return $query->result();
        }else{
            return FALSE;
        }
    }
    public function productidByprice($pid){
        $query = $this->db->where("pid", $pid);
        $query = $this->db->get("product");
        if ($query->num_rows()>0) {
            return $query->result();
        }else{
            return FALSE;
        }
    }
    public function product_sale_last($sale_up){
        $query = $this->db->insert("sale_product",$sale_up);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }
    public function product_sale_last_update($sale_up2,$saleid,$pid){
        $this->db->where("invoice_id",$saleid);
        $this->db->where("pid",$pid);
        $query = $this->db->update("sale_product",$sale_up2);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    } //new
    public function sales_report($saleid){
        $query = $this->db->where("invoice_id", $saleid);
        $query = $this->db->get("sale_product");
        if ($query->num_rows()>0) {
            return $query->result();
        }else{
            return FALSE;
        }
    } //sales_report

    public function invoice_count() {
        return $this->db->count_all("sale");
    }
    public function fetch_invoice($limit, $start){
        $this->db->limit($limit, $start);
        $this->db->order_by("id",'desc');
        $query=$this->db->get("sale");
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    } //invoice

    public function supp_count() {
        return $this->db->count_all("supplier");
    }
    public function fetch_supplier($limit, $start){
        $this->db->limit($limit, $start);
        $this->db->order_by("cmrid",'desc');
        $query=$this->db->get("supplier");
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    } //coustomer
    public function supp_add($suppliers){
        $this->db->insert('supplier',$suppliers);
        if ($this->db->affected_rows() > 0) {
            return true;
        }else{
            return false;
        }
    }




    public function sell_supp_search($sell_cous){
        $query = $this->db->like("name", $sell_cous);
        $query = $this->db->get("supplier");
        if ($query->num_rows()>0) {
            return $query->result();
        }else{
            return FALSE;
        }
    }



    public function sale_fetch_product($id){
        $this->db->where("roots",1);
        $this->db->where("pid",$id);
        $this->db->order_by("id",'desc');
        $query=$this->db->get("sale_product");
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    } // sales product
    public function purchase_fetch_product($id){
        $this->db->where("roots",2);
        $this->db->where("pid",$id);
        $this->db->order_by("id",'desc');
        $query=$this->db->get("sale_product");
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    } // purchase product


    public function customer_fetch_product($cmrid){
        $this->db->where("roots",1);
        $this->db->where("cmrid",$cmrid);
        $this->db->order_by("id",'desc');
        $query=$this->db->get("sale");
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    } // customer product
    public function supplier_fetch_product($cmrid){
        $this->db->where("roots",2);
        $this->db->where("cmrid",$cmrid);
        $this->db->order_by("id",'desc');
        $query=$this->db->get("sale");
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    } // customer product

    public function check_product_code($pcode){
        $query = $this->db->where("product_code", $pcode);
        $query = $this->db->get("product");
        if ($query->num_rows()>0) {
            return $query->result();
        }else{
            return FALSE;
        }
    } //sales_report


    public function cash_counts() {
        return $this->db->count_all("cash");
    }
    public function fetch_cash($limit, $start){
        $this->db->limit($limit, $start);
        $this->db->order_by("id",'desc');
        $query=$this->db->get("cash");
        
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                $data[] = $row;
            }
            return $data;
        }
        return false;
    } //cash


    public function final_over_seas($pid){
        $this->db->order_by("id", 'desc');
        $this->db->where("pid", $pid);
        $query = $this->db->get("over_seas");
        if ($query->num_rows()>0) {
            return $query->result();
        }else{
            return FALSE;
        }
    }
    public function final_daily_expense($dated){
        $this->db->order_by("id", 'desc');
        $this->db->where("dated", $dated);
        $query = $this->db->get("daily_expense");
        if ($query->num_rows()>0) {
            return $query->result();
        }else{
            return 2;
        }
    }


}