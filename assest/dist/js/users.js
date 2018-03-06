//var li="http://www.abradix.com/hrs/";
var li="http://localhost/hrs/";

var overlay = document.getElementById("overlay"); //for loader

//loader
/*
window.addEventListener('load', function(){
  overlay.style.display = 'none';
});
*/
overlay.style.display = 'none';
//loader



//password changed
function PasswordChange(){
	$(overlay).fadeIn();
	$.ajax({
        type: "POST",
        url:li+'home/PasswordChange1',
      }).done (function(data) { 
           $("#PasswordChange1").html(data);
           $(overlay).fadeOut();
        }).fail (function()  {       
    });
}

function PasswordChange2(data){
	var passwordIn = $(data).val().trim();
	var hiddenSessionId = $('#hiddenSessionId').val().trim();
	//alert(hiddenSessionId);

	if (passwordIn != '' && hiddenSessionId != '') {
		$.ajax({
	        type: "POST",
	        url:li+'home/loginPassword2',
	        data: {passwordIn:""+passwordIn+"", hiddenSessionId:""+hiddenSessionId+""}
	      }).done (function(data) { 
	           $("#password2Result").html(data);
	        }).fail (function()  {       
	    });
	}
	
}
function passwordNewCon3(){
	var passwordNew = $('#passwordNew').val().trim();
	var passwordNewCon = $('#passwordNewCon').val().trim();

	if (passwordNew != '' || passwordNewCon != '') {
		if (passwordNew==passwordNewCon) {
			$passMass = document.getElementById('password3Result').innerHTML = '<span style="margin:5px 0;font-size:12px;color:green;display: block">password matched</span><button value="'+passwordNew+'" onclick="return submitPassword(this)" type="submit"class="btn btn-primary">Changed Password</button>';

		}else{
			document.getElementById('password3Result').innerHTML = '<div class="alert alert-warning">Password not matched</div>';
		}
	}
}
function submitPassword(data){
	var passwordNewCon = $(data).val().trim();
	//alert(passwordNew);

	$.ajax({
        type: "POST",
        url:li+'home/loginPassword3',
        data: {passwordNewCon:""+passwordNewCon+""}
      }).done (function(data) { 
           $("#password4Result").html(data);
        }).fail (function()  {       
    });
}
//change password end
function updateprofile(){
	var id = $("#pro_id").val().trim();
	var username = $("#pro_username").val().trim();
	var email = $("#pro_email").val().trim();
	var name = $("#pro_name").val().trim();

	if(id == '' || username == '' || email == '' || name == ''){
		alert('Information Incomplete');
	}else{
		$.ajax({
	        type: "POST",
	        url: li+"home/updateprofile",
	        data: {id:""+id+"",username:""+username+"",email:""+email+"",name:""+name+""}
	      }).done (function(data) { 
	           alert(data);
	        }).fail (function()  {       
	    });
	}
}


function per_type(data){
	var id = $(data).val().trim();

	if(id == 0){

		$(overlay).fadeIn();

		$.ajax({
	        type: "POST",
	        url: li+"home/user_access",
	        data: {id:""+id+""}
	      }).done (function(data) { 
	           $('#per').html(data);
	           $(overlay).fadeOut();
	        }).fail (function()  {       
	    });


	}else{
		$("#per").empty();
	}
}

function ttt(id){
	//alert(id);
	if(document.getElementById(id+"c").checked){
		$(overlay).fadeIn();
		$.ajax({
	        type: "POST",
	        url: li+"home/user_access_sub_menu",
	        data: {id:""+id+""}
	      }).done (function(data) { 
	           $("#"+id+"p").html(data);
	           document.getElementById("getsumitbutton").innerHTML='<button type="submit" class="btn btn-info">Confirm</button>';
	           $(overlay).fadeOut();
	        }).fail (function()  {       
	    });

    }else{
    	$("#"+id+"p").empty();
	    document.getElementById("getsumitbutton").innerHTML='';
    }


}

$("#showPass").click(function(){
		
	if($(this).is(":checked")){
		$("#passShowId").attr('type','text');
	}
	else{			
		$(".#passShowId").attr('type','password');
	}
});



function userstatus(data){
  var editg = $(data).val().trim();
  
  $.ajax({
        type: "POST",
        url: li+"home/userstatus",
        data: {editg:""+editg+""}
      }).done (function(data) { 
           location.reload();
        }).fail (function()  {       
    });
}
function userdel(data){
  var delid = $(data).val().trim();
  var alerts = confirm("Are you sure to delete !");
  if (alerts == 1) {
    $.ajax({
          type: "POST",
          url: li+"home/userdel",
          data: {delid:""+delid+""}
        }).done (function(data) { 
             $('#delu'+delid).fadeOut(data);
          }).fail (function()  {       
     });
  }
}


/*########### admin panel end #############*/

function crm_add(){
	var name = $("#name").val().trim();
	var address = $("#address").val().trim();
	var city = $("#city").val().trim();
	var company = $("#company").val().trim();
	var prev_due = $("#prev_due").val().trim();
	var mobile_phone = $("#mobile_phone").val().trim();
	var tel_phone = $("#tel_phone").val().trim();
	var email = $("#email").val().trim();
	var dated = $("#dated").val().trim();

	if (name != '' && address !='' && mobile_phone !='' && dated !='') {
		

		$.ajax({
	        type: 'POST',
	        url:li+'home/crm_add',
	        data:{name:name,address:address,city:city,company:company,prev_due:prev_due,mobile_phone:mobile_phone,tel_phone:tel_phone,email:email,dated:dated},
	        dataType:'json',
	        success: function(response){
	          alert(response);
	          location.reload();
	        },
	        error: function(){
	          alert('Error reply.');
	        }
	    });


	}else{
		alert('Information Incomplete.');
	}
}

function product_add(){
	var name = $("#name").val().trim();
	var product_code = $("#product_code").val().trim();

	var price = $("#price").val().trim();
	var sell_price = $("#sell_price").val().trim();
	var opening_stock = $("#opening_stock").val().trim();
	var price_type = $("#price_type").val().trim();


	var description = $("#description").val().trim();

	var opening_stock_price = $("#opening_stock_price").val().trim();


	if (name != '' && product_code !='' && price !='' && sell_price !='' && price_type !='') {
		

		$.ajax({
	        type: 'POST',
	        url:li+'home/product_add',
	        data:{name:name,product_code:product_code,price:price,sell_price:sell_price,opening_stock:opening_stock,price_type:price_type,opening_stock_price:opening_stock_price,description:description},
	        dataType:'json',
	        success: function(response){
	          alert(response);
	          location.reload();
	        },
	        error: function(){
	          alert('Error reply.');
	        }
	    });


	}else{
		alert('Information Incomplete.');
	}
} //product added ok.

function sell_cous_search(){
	$(overlay).fadeIn();
	var sell_cous = $("#sell_cous").val().trim();
	$('#sell_cous_result').fadeIn();
	if (sell_cous != '') {
		$.ajax({
	        type: 'POST',
	        url:li+'home/sell_cous_search',
	        data:{sell_cous:sell_cous},
	        dataType:'json',
	        success: function(data){
	           var html = '';
	           var i;
		       for(i=0; i<data.length;i++){
		        var name = data[i].name;
		        var id = data[i].cmrid;
		        html += 
		          '<li class="linkSc" data="'+name+':'+id+'">'+name+' * '+id+'</li>'
		        ;
		      }
	          $("#sell_cous_result").html(html);
	          $(overlay).fadeOut();
	        },
	        error: function(){
	          alert('Error reply.');
	        }
	    });
	}else{
		$("#sell_cous_result").empty();
	}
}
$('#sell_cous_result').on('click', '.linkSc', function(){
    $('#sell_cous').val($(this).text());
	$('#sell_cous_result').fadeOut();
});

function product_sale(){
	var roots = $("#roots").val().trim();
	var sell_invoice = $("#sell_invoice").val().trim();
	var sell_date = $("#sell_date").val().trim();
	var sell_cous = $("#sell_cous").val().trim();

	var explode = sell_cous.split("*");
  	var cmrid = explode[1];

	if (roots != '' && sell_cous != '' && cmrid !='' && sell_invoice !='' && sell_date !='') {
		$.ajax({
	        type: 'POST',
	        url:li+'home/product_sale',
	        data:{roots:roots,sell_invoice:sell_invoice,sell_date:sell_date,cmrid:cmrid},
	        dataType:'json',
	        success: function(response){	          
				$("#secondStep").fadeIn();
	        },
	        error: function(){
	          alert('Error reply.');
	        }
	    });
	}else{
		alert('Information incomplete.');
	}
}
function product_search(){
	$(overlay).fadeIn();
	var sale_product = $("#sale_product").val().trim();
	$('#pro_cous_result').fadeIn();
	if (sale_product != '') {
		$.ajax({
	        type: 'POST',
	        url:li+'home/pro_cous_result',
	        data:{sale_product:sale_product},
	        dataType:'json',
	        success: function(data){
	           var html = '';
	           var i;
		       for(i=0; i<data.length;i++){
		        var name = data[i].name;
		        var id = data[i].pid;
		        html += 
		          '<li class="linkPro" data="'+name+':'+id+'">'+name+' * '+id+'</li>'
		        ;
		      }
	          $("#pro_cous_result").html(html);
	          $(overlay).fadeOut();
	        },
	        error: function(){
	          alert('Error reply.');
	        }
	    });
	}else{
		$("#pro_cous_result").empty();
	}
}
//sale price
$('#pro_cous_result').on('click', '.linkPro', function(){
    $('#sale_product').val($(this).text());
	$('#pro_cous_result').fadeOut();

	var proData = $(this).attr('data');

	var explode = proData.split(":");
  	var pid = explode[1];

	if (pid != '') {
		$.ajax({
	        type: 'POST',
	        url:li+'home/productidByprice',
	        data:{pid:pid},
	        dataType:'json',
	        success: function(data){
	           
	            var i;
		        for(i=0; i<data.length;i++){
			        var price = data[i].sell_price;

			        $('#price').val(price);
		        }
		    
	        
	    	},
	        error: function(){
	          alert('Error reply.');
	        }
	    });
	}
});

function check_product_qty(){
	var pd = $(".linkPro").attr('data');
	var explode = pd.split(":");
	var pid = explode[1];

	var qty = $("#qty").val().trim();

	if (pid != '') {
		$.ajax({
	        type: 'POST',
	        url:li+'home/check_product_qty',
	        data:{pid:pid,qty:qty},
	        dataType:'json',
	        success: function(data){
	           
	            alert(data);
		    
	        
	    	},
	        error: function(){
	          alert('Error !.');
	        }
	    });
	}
}


//purchase price
function product_search2(){
	var sale_product = $("#sale_product").val().trim();
	$('#pro_cous_result').fadeIn();
	if (sale_product != '') {
		$(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'home/pro_cous_result',
	        data:{sale_product:sale_product},
	        dataType:'json',
	        success: function(data){
	           var html = '';
	           var i;
		       for(i=0; i<data.length;i++){
		        var name = data[i].name;
		        var id = data[i].pid;
		        html += 
		          '<li class="linkPro1" data="'+name+':'+id+'">'+name+' * '+id+'</li>'
		        ;
		      }
	          $("#pro_cous_result").html(html);
	          $(overlay).fadeOut();
	        },
	        error: function(){
	          alert('Error reply.');
	        }
	    });
	}else{
		$("#pro_cous_result").empty();
	}
}
$('#pro_cous_result').on('click', '.linkPro1', function(){
    $('#sale_product').val($(this).text());
	$('#pro_cous_result').fadeOut();

	var proData = $(this).attr('data');

	var explode = proData.split(":");
  	var pid = explode[1];

	if (pid != '') {
		$.ajax({
	        type: 'POST',
	        url:li+'home/productidByprice',
	        data:{pid:pid},
	        dataType:'json',
	        success: function(data){
	           
	            var i;
		        for(i=0; i<data.length;i++){
			        var price = data[i].price;

			        $('#price').val(price);
		        }
		    
	        
	    	},
	        error: function(){
	          alert('Error reply.');
	        }
	    });
	}
});


function product_sale_last(){
	var roots = $("#roots").val().trim();
	var sale_product = $("#sale_product").val().trim();
	var explode = sale_product.split("*");
  	var pid = explode[1];
  	var pname = explode[0];

	var saleid = $("#saleid").val().trim();
	var qty = $("#qty").val().trim();
	var price = $("#price").val().trim();

	var total = qty*price;

	if (pid != '' && qty != '' && price != '' && total != '' && saleid != '' && roots != '') {
		
		$.ajax({
	        type: 'POST',
	        url:li+'home/product_sale_last',
	        data:{pid:pid,qty:qty,price:price,total:total,saleid:saleid,pname:pname,roots:roots},
	        dataType:'json',
	        success: function(data){
	           
	            var i;
	            var thirdS='';
	            var sum=0;
		        for(i=0; i<data.length;i++){
			        var gross_amount = data[i].gross_amount;
			        var db_qty = data[i].qty;
			        var p_name = data[i].pname;

			        sum=sum+parseInt(gross_amount);
			        

			        thirdS += '<tr class="danger"><td>'+p_name+'</td>'+
        			'<td>'+db_qty+'</td>'+
        			'<td>'+gross_amount+'</td></tr>';
		        }

		        //alert(db_qty);
		        $('#gross_amount').val(sum);


		        

		    
	        	$("#thirdStep").html(thirdS);
	    	},
	        error: function(){
	          alert('Error reply.');
	        }
	    });

	}else{
		alert('sorry');
	}
}

function discount_map(){
	var gross_amount = $("#gross_amount").val().trim();
	var discount = $("#discount").val().trim();

	var sub = (gross_amount/100)*discount;

	var mainacc = gross_amount-sub;

	var grandsub = gross_amount+' - '+sub+' = '+mainacc;

	if (discount = '') {
		$("#fourthStep").empty();
	}else{
		$("#fourthStep").html(grandsub);
		$("#cash").val(mainacc);
	}
}

function product_sale_final(){
	var saleid = $("#saleid").val().trim();
	var gross_amount = $("#gross_amount").val().trim();
	var discount = $("#discount").val().trim();
	var cash = $("#cash").val().trim();

	if (gross_amount != '' && cash != ''&& discount != '') {
		$.ajax({
	        type: 'POST',
	        url:li+'home/product_sale_final',
	        data:{saleid:saleid,gross_amount:gross_amount,discount:discount,cash:cash},
	        dataType:'json',
	        success: function(data){
	           alert(data);
	           //window.location.href = li+'home/daily_invoice_reports';	        
	           window.location=li+'home/daily_invoice_reports';
	    	},
	        error: function(){
	          alert('Error Sale.');
	        }
	    });
	}else{
		alert('Information Incomplete.');
	}
}

//suplier and new purchase
function supp_add(){
	var name = $("#name").val().trim();
	var address = $("#address").val().trim();
	var city = $("#city").val().trim();
	var company = $("#company").val().trim();
	var prev_due = $("#prev_loan").val().trim();
	var mobile_phone = $("#mobile_phone").val().trim();
	var tel_phone = $("#tel_phone").val().trim();
	var email = $("#email").val().trim();
	var dated = $("#dated").val().trim();

	if (name != '' && address !='' && mobile_phone !='' && dated !='') {
		

		$.ajax({
	        type: 'POST',
	        url:li+'home/supp_add',
	        data:{name:name,address:address,city:city,company:company,prev_due:prev_due,mobile_phone:mobile_phone,tel_phone:tel_phone,email:email,dated:dated},
	        dataType:'json',
	        success: function(response){
	          alert(response);
	          location.reload();
	        },
	        error: function(){
	          alert('Error reply.');
	        }
	    });


	}else{
		alert('Information Incomplete.');
	}
}






function sell_supp_search(){
	$(overlay).fadeIn();
	var sell_cous = $("#sell_cous").val().trim();
	$('#sell_cous_result').fadeIn();
	if (sell_cous != '') {
		$.ajax({
	        type: 'POST',
	        url:li+'home/sell_supp_search',
	        data:{sell_cous:sell_cous},
	        dataType:'json',
	        success: function(data){
	           var html = '';
	           var i;
		       for(i=0; i<data.length;i++){
		        var name = data[i].name;
		        var id = data[i].cmrid;
		        html += 
		          '<li class="linkSc" data="'+name+':'+id+'">'+name+' * '+id+'</li>'
		        ;
		      }
	          $("#sell_cous_result").html(html);
	          $(overlay).fadeOut();
	        },
	        error: function(){
	          alert('Error reply.');
	        }
	    });
	}else{
		$("#sell_cous_result").empty();
	}
}
function product_purchase_final(){
	var saleid = $("#saleid").val().trim();
	var gross_amount = $("#gross_amount").val().trim();
	var discount = $("#discount").val().trim();
	var cash = $("#cash").val().trim();

	var vat = $("#vat").val().trim();
	var tariff = $("#tariff").val().trim();
	var transport = $("#transport").val().trim();
	var others = $("#others").val().trim();

	if (gross_amount != '' && cash != ''&& discount != '') {
		$.ajax({
	        type: 'POST',
	        url:li+'home/product_purchase_final',
	        data:{saleid:saleid,gross_amount:gross_amount,discount:discount,vat:vat,tariff:tariff,transport:transport,others:others,cash:cash},
	        dataType:'json',
	        success: function(data){
	           alert(data);
	           window.location=li+'home/daily_invoice_reports';
	    	},
	        error: function(){
	          alert('Error Sale.');
	        }
	    });
	}else{
		alert('Information Incomplete.');
	}
}


//update sms Setting
function updated_sms_settings(){
	var username = $("#sett_username").val().trim();
	var password = $("#sett_password").val().trim();
	var sender = $("#sett_sender").val().trim();

	if(username == '' || password == '' || sender == ''){
		alert('Information Incomplete');
	}else{
		$.ajax({
	        type: "POST",
	        url: li+"home/updated_sms_settings",
	        data: {username:""+username+"",password:""+password+"",sender:""+sender+""}
	      }).done (function(data) { 
	           alert(data);
	        }).fail (function()  {       
	    });
	}
}
//coustomer SMS Sending System
function send_sms_coustomer(values){
	var value = $(values).val().trim();
	if (value=='') {
		alert('Information Incomplete');
	}else{
		$.ajax({
	        type: 'POST',
	        url:li+'home/send_sms_coustomer',
	        data:{value:value},
	        dataType:'json',
	        success: function(data){
	           $("#send_sms_coustomer_output").html(data);
	    	},
	        error: function(){
	          alert('Error Sale.');
	        }
	    });
	}
}
function send_sms_now(){
	var invoice_id = $("#invoice_id").val().trim();
	var cmrid = $("#cmrid").val().trim();

	var cmr_name = $("#cmr_name").val().trim();
	var mobile = $("#mobile").val().trim();
	var message = $("#message").val().trim();


	if (invoice_id==''|| cmrid==''|| cmr_name==''|| mobile==''|| message=='') {
		alert('Information Incomplete');
	}else{
		$.ajax({
	        type: 'POST',
	        url:li+'home/send_sms_confirm',
	        data:{invoice_id:invoice_id,cmrid:cmrid,cmr_name:cmr_name,mobile:mobile,message:message},
	        dataType:'json',
	        success: function(data){
	           location.reload();
	           alert(data);
	    	},
	        error: function(){
	          alert('Error Sending.');
	        }
	    });
	}
}
//coustomer SMS Send Complete


//product code check
function product_code_check(){
	var pcode = $("#product_code").val().trim();
	$.ajax({
        type: 'POST',
        url:li+'home/product_code_check',
        data:{pcode:pcode},
        dataType:'json',
        success: function(data){
           $("#product_code_check_out").html(data).fadeIn().delay(5000).fadeOut();
    	},
        error: function(){
          alert('Error !.');
        }
    });
	
}


//cash

function cash_process(){
	var cash_id = $("#cash_id").val().trim();
	var roots = $("#roots").val().trim();
	var amount = $("#amount").val().trim();
	var dated = $("#dated").val().trim();
	var details = $("#details").val().trim();
	//var name = $("#name").val().trim();

	var sell_cous = $("#sell_cous").val().trim();
	var explode = sell_cous.split("*");
  	var cmrid = explode[1];


	if (cash_id != '' && roots !='' && amount !='' && dated !=''&& cmrid !='') {
		

		$.ajax({
	        type: 'POST',
	        url:li+'home/cash_process',
	        data:{cash_id:cash_id,roots:roots,amount:amount,dated:dated,details:details,cmrid:cmrid},
	        dataType:'json',
	        success: function(response){
	          alert(response);
	          location.reload();
	        },
	        error: function(){
	          alert('Error reply.');
	        }
	    });


	}else{
		alert('Information Incomplete.');
	}

} 


function add_capital(){
	var capital = $("#capital").val().trim();
	var name = $("#name").val().trim();


	if (capital==''|| name=='') {
		alert('Information Incomplete');
	}else{
		$.ajax({
	        type: 'POST',
	        url:li+'home/add_capital',
	        data:{capital:capital,name:name},
	        dataType:'json',
	        success: function(data){
	           location.reload();
	           alert(data);
	    	},
	        error: function(){
	          alert('Error Sending.');
	        }
	    });
	}
}
//capital share


// now edit and delete working
function update_capital(data){
	var capital_id = $(data).val().trim();
	$(overlay).fadeIn();
    $.ajax({
        type: "POST",
        data: {capital_id:""+capital_id+""},
        url:li+'jquery/capital_update',
      }).done (function(response) { 
           $("#modal_sm_result").html(response);
           $(overlay).fadeOut();
        }).fail (function()  {       
    });
}

function update_product(data){
	var pid = $(data).val().trim();
	$(overlay).fadeIn();
    $.ajax({
        type: "POST",
        data: {pid:""+pid+""},
        url:li+'jquery/update_product',
      }).done (function(response) { 
           $("#modal_lg_result").html(response);
           $(overlay).fadeOut();
        }).fail (function()  {       
    });
}
function all_product_search(){
	var from_date = $("#from_date").val().trim();
	var to_date = $("#to_date").val().trim();
	if (from_date =='' || to_date == '') {
		alert("Please Select Date");
	}else{
		$(overlay).fadeIn();
		$.ajax({
	        type: "POST",
	        data: {from_date:""+from_date+"",to_date:""+to_date+""},
	        url:li+'jquery/all_product_search',
	      }).done (function(response) { 
	           $("#all_product_search").html(response);
	           $(overlay).fadeOut();
	        }).fail (function()  {       
	    });
	}

}

function invoice_report_search(){
	var from_date = $("#from_date").val().trim();
	var to_date = $("#to_date").val().trim();
	if (from_date =='' || to_date == '') {
		alert("Please Select Date");
	}else{
		$(overlay).fadeIn();
		$.ajax({
	        type: "POST",
	        data: {from_date:""+from_date+"",to_date:""+to_date+""},
	        url:li+'jquery/invoice_report_search',
	      }).done (function(response) { 
	           $("#invoice_report_search").html(response);
	           $(overlay).fadeOut();
	        }).fail (function()  {       
	    });
	}

}

function stock_summary_search(){
	var from_date = $("#from_date").val().trim();
	var to_date = $("#to_date").val().trim();
	if (from_date =='' || to_date == '') {
		alert("Please Select Date");
	}else{
		$(overlay).fadeIn();
		$.ajax({
	        type: "POST",
	        data: {from_date:""+from_date+"",to_date:""+to_date+""},
	        url:li+'jquery/stock_summary_search',
	      }).done (function(response) { 
	           $("#stock_summary_search").html(response);
	           $(overlay).fadeOut();
	        }).fail (function()  {       
	    });
	}

}


function customer_reports_search(){
	var from_date = $("#from_date").val().trim();
	var to_date = $("#to_date").val().trim();
	if (from_date =='' || to_date == '') {
		alert("Please Select Date");
	}else{
		$(overlay).fadeIn();
		$.ajax({
	        type: "POST",
	        data: {from_date:""+from_date+"",to_date:""+to_date+""},
	        url:li+'jquery/customer_reports_search',
	      }).done (function(response) { 
	           $("#customer_reports_search").html(response);
	           $(overlay).fadeOut();
	        }).fail (function()  {       
	    });
	}

}

function supplier_reports_search(){
	var from_date = $("#from_date").val().trim();
	var to_date = $("#to_date").val().trim();
	if (from_date =='' || to_date == '') {
		alert("Please Select Date");
	}else{
		$(overlay).fadeIn();
		$.ajax({
	        type: "POST",
	        data: {from_date:""+from_date+"",to_date:""+to_date+""},
	        url:li+'jquery/supplier_reports_search',
	      }).done (function(response) { 
	           $("#supplier_reports_search").html(response);
	           $(overlay).fadeOut();
	        }).fail (function()  {       
	    });
	}

}


function cash_reports_search(){
	var from_date = $("#from_date").val().trim();
	var to_date = $("#to_date").val().trim();
	if (from_date =='' || to_date == '') {
		alert("Please Select Date");
	}else{
		$(overlay).fadeIn();
		$.ajax({
	        type: "POST",
	        data: {from_date:""+from_date+"",to_date:""+to_date+""},
	        url:li+'jquery/cash_reports_search',
	      }).done (function(response) { 
	           $("#cash_reports_search").html(response);
	           $(overlay).fadeOut();
	        }).fail (function()  {       
	    });
	}

}
function search_name_cus(datas){
	var value = $(datas).val().trim();
	$(overlay).fadeIn();
	$.ajax({
        type: "POST",
        data: {value:""+value+""},
        url:li+'jquery/search_name_cus',
      }).done (function(response) { 
           $("#search_name_cus").html(response);
           $(overlay).fadeOut();
        }).fail (function()  {       
    });
}

function search_name_supp(datas){
	var value = $(datas).val().trim();
	$(overlay).fadeIn();
	$.ajax({
        type: "POST",
        data: {value:""+value+""},
        url:li+'jquery/search_name_supp',
      }).done (function(response) { 
           $("#search_name_supp").html(response);
           $(overlay).fadeOut();
        }).fail (function()  {       
    });
}

function update_supplier(data){
	var cmrid = $(data).val().trim();
	$(overlay).fadeIn();
    $.ajax({
        type: "POST",
        data: {cmrid:""+cmrid+""},
        url:li+'jquery/update_supplier',
      }).done (function(response) { 
           $("#modal_lg_result").html(response);
           $(overlay).fadeOut();
        }).fail (function()  {       
    });
}

function update_customer(data){
	var cmrid = $(data).val().trim();
	$(overlay).fadeIn();
    $.ajax({
        type: "POST",
        data: {cmrid:""+cmrid+""},
        url:li+'jquery/update_customer',
      }).done (function(response) { 
           $("#modal_lg_result").html(response);
           $(overlay).fadeOut();
        }).fail (function()  {       
    });
}

function delete_invoice(data){
	var del_data = $(data).val().trim();
	var alerts = confirm("Are you sure to delete ?");
	if (alerts==true) {
		$(overlay).fadeIn();
		$.ajax({
	        type: "POST",
	        data: {del_data:""+del_data+""},
	        url:li+'jquery/delete_invoice',
	      }).done (function(response) { 
	      		alert(response);
	      		location.reload();
	      		$(overlay).fadeOut();
	        }).fail (function()  {       
	    });
	}
	
}


//overseas
function overseas_record_add(){
	var roots = $("#roots").val().trim();
	var name = $("#over_seas_name").val().trim();
	if (roots=='' && name=='') {
		alert('Information Incomplete');
	}else{
		$.ajax({
	        type: "POST",
	        data: {roots:""+roots+"",name:""+name+""},
	        url:li+'jquery/overseas_record_add',
	      }).done (function(response) { 
	      		alert(response);
	      		location.reload();
	        }).fail (function()  {       
	    });
	}
}
function final_over_seas(){
	var pd = $(".linkPro").attr('data');
	var explode = pd.split(":");
	var p_name = explode[0];
	var pid = explode[1];

	var amount = $("#amount").val().trim();
	var dated = $("#dated").val().trim();

	var over_seas_name = $("#over_seas_name").val().trim();
	var split = over_seas_name.split(":");
	var over_record_id = split[0];
	var over_record_names = split[1];
	var over_record_roots = split[2];

	

	if (pid=='' || amount=='' || dated=='' || over_record_id==''|| over_record_names==''|| over_record_roots=='') {
		alert('Information Incomplete');
	}else{

		$(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'jquery/final_over_seas',
	        data:{pid:pid,amount:amount,dated:dated,over_record_id:over_record_id,over_record_name:over_record_names,over_record_roots:over_record_roots},
	        dataType:'json',
	        success: function(data){


	            
	            var i;
	            var thirdS='';
	        	for(i=0; i<data.length;i++){
			        var amount = data[i].amount;	        
			        var over_record_name = data[i].over_record_name;	        
			        var id = data[i].id;	        

			        thirdS += '<tr class="'+id+'del">'+
		        			'<td>'+over_record_name+'</td>'+
		        			'<td>'+amount+'</td>'+
		        			'<td><button class="btn btn-sm btn-danger cart_del" data="'+id+'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>'+
        				'</tr>';

        			$("#output_pname").html(p_name);
        			$("#over_seas_record_output").html(thirdS);

        			$(overlay).fadeOut();
		        }

	        	
	          
	        },
	        error: function(){
	          alert('error !.');
	        }
	    });


	}
}

$('#over_seas_record_output').on('click', '.cart_del', function(){
  var cid =$(this).attr('data');
  var alerts = confirm("Are you sure to delete !");
  if (alerts == 1) {
  	$(overlay).fadeIn();
    $.ajax({
      type: 'POST',
      url:li+'jquery/over_seas_final_deleted',
      data:{cid:cid},
      dataType:'json',
      success: function(response){
        $("."+cid+"del").fadeOut(); 
        $(overlay).fadeOut(); 
      },
      error: function(){
        alert('error');
      }
    });
  }

});

function product_search_over(){
	$(overlay).fadeIn();
	var sale_product = $("#sale_product").val().trim();
	$('#pro_cous_result1').fadeIn();
	if (sale_product != '') {
		$.ajax({
	        type: 'POST',
	        url:li+'home/pro_cous_result',
	        data:{sale_product:sale_product},
	        dataType:'json',
	        success: function(data){
	           var html = '';
	           var i;
		       for(i=0; i<data.length;i++){
		        var name = data[i].name;
		        var id = data[i].pid;
		        html += 
		          '<li class="linkPro" data="'+name+':'+id+'">'+name+' * '+id+'</li>'
		        ;
		      }
	          $("#pro_cous_result1").html(html);
	          $(overlay).fadeOut();
	        },
	        error: function(){
	          alert('Error reply.');
	        }
	    });
	}else{
		$("#pro_cous_result1").empty();
	}
}
$('#pro_cous_result1').on('click', '.linkPro', function(){
    $('#sale_product').val($(this).text());
	$('#pro_cous_result1').fadeOut();

	var proData = $(this).attr('data');

	var explode = proData.split(":");
  	var p_name = explode[0];
  	var pid = explode[1];

	$(overlay).fadeIn();
	if (pid != '') {
		$.ajax({
	        type: 'POST',
	        url:li+'jquery/product_all_oversease',
	        data:{pid:pid},
	        dataType:'json',
	        success: function(data){
	        	if (data==false) {
	        		$("#over_seas_record_output").empty();
	        		$("#output_pname").html(p_name);
	        	}else{
	            var i;
		            var thirdS='';
		        	for(i=0; i<data.length;i++){
				        var amount = data[i].amount;	        
				        var over_record_name = data[i].over_record_name;	        
				        var id = data[i].id;	        

				        thirdS += '<tr class="'+id+'del">'+
			        			'<td>'+over_record_name+'</td>'+
			        			'<td>'+amount+'</td>'+
			        			'<td><button class="btn btn-sm btn-danger cart_del" data="'+id+'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>'+
	        				'</tr>';

	        			$("#output_pname").html(p_name);
	        			$("#over_seas_record_output").html(thirdS);

	        			
			        }
			    }
	        
	    	},
	        error: function(){
	          alert('Error reply.');
	        }
	    });
	}
	$(overlay).fadeOut();
});


function over_recoed_edit(datas){
	var over_id = $(datas).val().trim();
	$(overlay).fadeIn();
    $.ajax({
        type: "POST",
        data: {over_id:""+over_id+""},
        url:li+'jquery/over_recoed_edit',
      }).done (function(response) { 
           $("#modal_sm_result").html(response);
           $(overlay).fadeOut();
        }).fail (function()  {       
    });
}
//send sms
//coustomer SMS Sending System
function send_sms_coustomer_only(values){
	var value = $(values).val().trim();
	if (value=='') {
		alert('Information Incomplete');
	}else{
		$(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'home/send_sms_coustomer_only',
	        data:{value:value},
	        dataType:'json',
	        success: function(data){
	           $("#modal_md_result").html(data);
			   $(overlay).fadeOut();
	    	},
	        error: function(){
	          alert('error!');
	        }
	    });
	}
}

function send_sms_now_only(){
	var cmrid = $("#cmrid").val().trim();

	var cmr_name = $("#cmr_name").val().trim();
	var mobile = $("#mobile").val().trim();
	var message = $("#message").val().trim();


	if (cmrid==''|| cmr_name==''|| mobile==''|| message=='') {
		alert('Information Incomplete');
	}else{
		$(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'home/send_sms_confirm_only',
	        data:{cmrid:cmrid,cmr_name:cmr_name,mobile:mobile,message:message},
	        dataType:'json',
	        success: function(data){
	           $(overlay).fadeOut();
	           alert(data);
	           location.reload();
	    	},
	        error: function(){
	          alert('error sending.');
	        }
	    });
	}
}
//coustomer SMS Send Complete



//daily Expense
function expense_record_add(){
	var name = $("#daily_title").val().trim();
	if (name=='') {
		alert('Information Incomplete');
	}else{
		$.ajax({
	        type: "POST",
	        data: {name:""+name+""},
	        url:li+'jquery/expense_record_add',
	      }).done (function(response) { 
	      		alert(response);
	      		location.reload();
	        }).fail (function()  {       
	    });
	}
}
function daily_ex_edit(datas){
	var daily_id = $(datas).val().trim();
	$(overlay).fadeIn();
    $.ajax({
        type: "POST",
        data: {daily_id:""+daily_id+""},
        url:li+'jquery/daily_ex_edit',
      }).done (function(response) { 
           $("#modal_sm_result").html(response);
           $(overlay).fadeOut();
        }).fail (function()  {       
    });
}
function final_daily_expense(){
	var amount = $("#amount").val().trim();
	var dated = $("#dated").val().trim();
	var purpose = $("#purpose").val().trim();

	var daily = $("#daily_id").val().trim();
	var split = daily.split(":");
	var daily_id = split[0];
	var name = split[1];

	

	if (amount=='' || dated=='' || daily_id==''|| name=='') {
		alert('Information Incomplete');
	}else{

		$(overlay).fadeIn();
		$.ajax({
	        type: 'POST',
	        url:li+'jquery/final_daily_expense',
	        data:{amount:amount,dated:dated,daily_id:daily_id,purpose:purpose,name:name},
	        dataType:'json',
	        success: function(data){


	            
	            var i;
	            var thirdS='';
	        	for(i=0; i<data.length;i++){
			        var amount = data[i].amount;	        
			        var purposee = data[i].purpose;	        
			        var db_dated = data[i].dated;	        
			        var db_name = data[i].name;	        
			        var id = data[i].id;	        

			        thirdS += '<tr class="'+id+'del">'+
		        			'<td>'+db_name+'</td>'+
		        			'<td>'+amount+'</td>'+
		        			'<td>'+purposee+'</td>'+
		        			'<td><button class="btn btn-sm btn-danger cart_del" data="'+id+'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>'+
        				'</tr>';

        			$("#output_pname2").html(db_dated);
        			$("#over_seas_record_output2").html(thirdS);

        			$("#amount").val('');
					$("#purpose").val('');
        			$(overlay).fadeOut();
		        }

	        	
	          
	        },
	        error: function(){
	          alert('error !.');
	        }
	    });


	}
}

$('#over_seas_record_output2').on('click', '.cart_del', function(){
  var cid =$(this).attr('data');
  var alerts = confirm("Are you sure to delete !");
  if (alerts == 1) {
  	$(overlay).fadeIn();
    $.ajax({
      type: 'POST',
      url:li+'jquery/daily_expense_final_deleted',
      data:{cid:cid},
      dataType:'json',
      success: function(response){
        $("."+cid+"del").fadeOut(); 
        $(overlay).fadeOut(); 
      },
      error: function(){
        alert('error');
      }
    });
  }

});
function searchBydate_expense(){
	dated = $("#dateded").val().trim();
	if (dated=='') {
		alert('Select Date');
	}else{
		
		$.ajax({
		    type: 'POST',
		    url:li+'jquery/searchBydate_expense',
		    data:{dated:dated},
		    dataType:'json',
		    success: function(data){
		    	$(overlay).fadeIn();

		    	if (data==2) {
		    		$("#output_pname2").html(dated+' <a href="'+li+'jquery/daily_expense_report/'+dated+'" class="btn btn-sm btn-default" target="_blank"> Print</a>');
		    		$("#over_seas_record_output2").html('No Data Found');
		    	}else{

			        var i;
			        var thirdS='';
			    	for(i=0; i<data.length;i++){
				        var amount = data[i].amount;	        
				        var purposee = data[i].purpose;	        
				        var db_dated = data[i].dated;	        
				        var db_name = data[i].name;	        
				        var id = data[i].id;	        

				        thirdS += '<tr class="'+id+'del">'+
			        			'<td>'+db_name+'</td>'+
			        			'<td>'+amount+'</td>'+
			        			'<td>'+purposee+'</td>'+
			        			'<td><button class="btn btn-sm btn-danger cart_del" data="'+id+'"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button></td>'+
							'</tr>';

						$("#output_pname2").html(db_dated+' <a href="'+li+'jquery/daily_expense_report/'+dated+'" class="btn btn-sm btn-default" target="_blank"> Print</a>');
						$("#over_seas_record_output2").html(thirdS);

						
			        }
			    }
			    $(overlay).fadeOut();

		    	
		      
		    },
		    error: function(){
		      alert('error !.');
		    }
		});
	}
}