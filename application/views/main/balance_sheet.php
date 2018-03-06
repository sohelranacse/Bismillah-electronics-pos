<style>
  .printTable>table>thead>tr>th,.printTable>table>tbody>tr>td{padding: 5px 10px !important;}
</style>
<?php
$this->db->select_sum("due");
$cus_query = $this->db->get("coustomer");
if ($cus_query->num_rows()>0) {
  $customer =  $cus_query->row()->due;
} //customer due

$this->db->select_sum("loan");
$supp_query = $this->db->get("supplier");
if ($supp_query->num_rows()>0) {
  $supplier =  $supp_query->row()->loan;
} //supplier loan


$this->db->select_sum("amount");
$this->db->where("over_record_roots",1);
$over_query = $this->db->get("over_seas");
if ($over_query->num_rows()>0) {
  $over_seas_deb = $over_query->row()->amount;
} //debit overseas
$this->db->select_sum("amount");
$this->db->where("over_record_roots",2);
$over_query1 = $this->db->get("over_seas");
if ($over_query1->num_rows()>0) {
  $over_seas_credit = $over_query1->row()->amount;
} //debit overseas



$this->db->select_sum("total");
$expe_query = $this->db->get("expense");
if ($expe_query->num_rows()>0) {
  $expense =  $expe_query->row()->total;
} //total expense

$this->db->select_sum("discount");
$income_query = $this->db->get("income");
if ($income_query->num_rows()>0) {
  $income =  $income_query->row()->discount;
} //total income



$this->db->select_sum("total_price");
$income_product = $this->db->get("product");
if ($income_product->num_rows()>0) {
  $product_start =  $income_product->row()->total_price;
} //opening product

$this->db->select_sum("capital");
$capital_query = $this->db->get("capital");
if ($capital_query->num_rows()>0) {
  $muldhon = $capital_query->row()->capital;
}


$this->db->select_sum("amount");
$daI_qu = $this->db->get("daily_expense");
if ($daI_qu->num_rows()>0) {
  $daily_expense = $daI_qu->row()->amount;
}

$this->db->select_sum("gross_amount");
$this->db->where("roots",2);
$sale_purchase = $this->db->get("sale");
if ($sale_purchase->num_rows()>0) {
  $purchase =  $sale_purchase->row()->gross_amount;
} //purchase


$this->db->select_sum("gross_amount");
$this->db->where("roots",1);
$sale_sale = $this->db->get("sale");
if ($sale_sale->num_rows()>0) {
  $sale =  $sale_sale->row()->gross_amount;
} //purchase


$this->db->where("roots",1);
$this->db->select_sum("amount");
$cash_receive_data = $this->db->get("cash");
if ($cash_receive_data->num_rows()>0) {
  $cash_receive =  $cash_receive_data->row()->amount;
} //cash_receive

$this->db->where("roots",2);
$this->db->select_sum("amount");
$cash_payment_data = $this->db->get("cash");
if ($cash_payment_data->num_rows()>0) {
  $cash_payment =  $cash_payment_data->row()->amount;
} //payment


?>
<div id="page-wrapper">
    <!-- /.row -->
    <div class="row" style="padding-top: 43px">

        <div class="panel panel-default">
            <div class="panel-body printTable" style="background: #f6f6f6">

              <div class="col-md-12 col-lg-12 col-sm-12 text-center">
                <h4 style="padding-bottom: 7px;border-bottom: 2px solid #222;display: inline-block;margin-bottom: 15px;margin-top: 0">Statement of Financial Position <a class="btn btn-default btn-sm" href="<?php echo base_url() ?>home/balance_sheet_print" target="_blank">Print</a></h4>
              </div>

              <table width="100%" border="1">
                <thead>
                  <tr>
                    <th>SUBJECT OF MATTERS</th>
                    <th class="text-right">DEBIT</th>
                    <th class="text-right">CREDIT</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Purchase</td>
                    <td class="text-right"><?php echo number_format(round($purchase ,0), 2, '.', ',') ?></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td>Sales</td>
                    <td></td>
                    <td class="text-right"><?php echo number_format(round($sale ,0), 2, '.', ',') ?></td>
                  </tr>

                  <tr>
                    <td>Expense/Revenue (<small>Purchase/Sale</small>)</td>
                     <td class="text-right"><?php echo number_format(round($expense ,0), 2, '.', ',') ?></td>
                    <td class="text-right"><?php echo number_format(round($income ,0), 2, '.', ',') ?></td>
                  </tr>


                  <tr>
                    <td>Overseas (<small>Expense/Revenue</small>)</td>
                    <td class="text-right"><?php echo number_format(round($over_seas_deb ,0), 2, '.', ',') ?></td>
                    <td class="text-right"><?php echo number_format(round($over_seas_credit ,0), 2, '.', ',') ?></td>
                  </tr>

                  <tr>
                    <td>Opening Products</td>
                    <td class="text-right"><?php echo number_format(round($product_start ,0), 2, '.', ',') ?></td>
                    <td></td>
                  </tr>

                  <tr>
                    <td>Finish stock products</td>
                    <td></td>
                    <td class="text-right">
                    <?php
                      $main_bal=0;
                      $tot_pro_bal = $this->db->get("product");
                      if ($tot_pro_bal->num_rows()>0) {
                        foreach ($tot_pro_bal->result_array() as $Pro_value) {
                          $qty_p = $Pro_value['quantity'];
                          $qty_price = $Pro_value['price'];
                          $sohel = $qty_p*$qty_price;
                          $main_bal=$main_bal+$sohel;
                        }                
                        
                        echo number_format(round($main_bal ,0), 2, '.', ',');
                      }
                    ?>
                    </td>
                  </tr>


                  <?php


                  $total_debit = $purchase+$expense+$product_start+$over_seas_deb; //debit
                  $total_credit = $sale+$income+$main_bal+$over_seas_credit; //credit



                  if ($total_debit>$total_credit) {
                    $net_taka = $total_debit-$total_credit;
                    $net_string = "Total Loss";
                  }else if ($total_debit<$total_credit) {
                    $net_taka = $total_credit-$total_debit;
                    $net_string = "Total Profit";
                  }else{
                    $net_taka = '';
                    $net_string = "";
                  }


                  ?>
                  <tr>
                    <td><b>Total</b></td>
                    <td class="text-right"><b><?php echo number_format(round($total_debit ,0), 2, '.', ',') ?></b></td>
                    <td class="text-right"><b><?php echo number_format(round($total_credit ,0), 2, '.', ',') ?></b></td>
                  </tr>

                  <tr>
                   <td class="text-center" colspan="3"><b> <?php echo $net_string; ?> : <?php echo number_format(round($net_taka ,0), 2, '.', ','); ?></b></td>
                  </tr>





                </tbody>
              </table>
              
              <br><br></br>
              <table width="100%" border="1">
                <thead>
                  <tr>
                    <th width="30%">Assest</th>
                    <th width="20%" class="text-right">Taka</th>
                    <th width="30%">Liablities</th>
                    <th width="20%" class="text-right">Taka</th>
                  </tr>
                </thead>
                <tbody>
                  

                  <tr>
                    <td>Capital</td>
                    <td class="text-right"><?php echo number_format(round($muldhon ,0), 2, '.', ',') ?></td>
                    <td>Total Daily Expense</td>
                    <td class="text-right"><?php echo number_format(round($daily_expense ,0), 2, '.', ',') ?></td>
                  </tr>
                  
                  <tr>
                    <td>Customers</td>
                    <td class="text-right"><?php echo number_format(round($customer ,0), 2, '.', ',') ?></td>
                    <td>Suppliers</td>
                    <td class="text-right"><?php echo number_format(round($supplier ,0), 2, '.', ',') ?></td>
                  </tr>
                  <?php $cash_money = $cash_receive-$cash_payment; //previous ?>
                  <tr>
                    <td>Cash</td>
                    <td class="text-right"><?php echo number_format(round($cash_money ,0), 2, '.', ',') ?></td>
                    <td></td>
                    <td></td>
                  </tr>


                  <tr>
                    <td>Finish stock products</td>
                    <td class="text-right"> <?php echo number_format(round($main_bal ,0), 2, '.', ','); ?></td>
                    <td></td>
                    <td></td>
                  </tr>




                  <?php


                  $total_net_debit = $supplier+$daily_expense; //assest
                  $total_net_credit = $customer+$muldhon+$cash_money+$main_bal; //liablities


                  if ($total_net_debit>$total_net_credit) {
                    $net_taka_net = $total_net_debit-$total_net_credit;
                  }else if ($total_net_debit<$total_net_credit) {
                    $net_taka_net = $total_net_credit-$total_net_debit;
                  }else{
                    $net_taka_net = "";
                  }


                  ?>
                  <tr>
                    <td><b>Total</b></td>
                    <td class="text-right"><b><?php echo number_format(round($total_net_credit ,0), 2, '.', ',') ?></b></td>
                    <td><b>Total</b></td>
                    <td class="text-right"><b><?php echo number_format(round($total_net_debit ,0), 2, '.', ',') ?></b></td>
                  </tr>
                  <tr>
                   <td class="text-center" colspan="4"><b> Difference Between Assets and Liabilities : <?php echo number_format(round($net_taka_net ,0), 2, '.', ','); ?></b></td>
                  </tr>

                </tbody>
              </table>
            </div>
        </div>
        


    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->