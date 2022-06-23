/* Default */
$(document).ready(function(){
		 $('#loaderID').show();
		 checkAuth();
         defaiult_load();

});


function checkAuth(){
	 $.ajax({
        url: "/checkuser",
        type: "get",
        data: {},
        success: function (response) {

			 $('#loaderID').hide();
           var objJSON = JSON.parse(JSON.stringify(response));	   		   
		   
		    if(objJSON.code==401){
			   window.location.href = '/login';
		     } 
        },
        error: function(jqXHR, textStatus, errorThrown) {
           //console.log(textStatus, errorThrown);
        }
    });	
	
	
}


function defaiult_load(){
	
	 $.ajax({
        url: "/user/allusers",
        type: "get",
        data: {},
        success: function (response) {

			 $('#loaderID').hide();
           var objJSON = JSON.parse(JSON.stringify(response));
		   $("#display_data").html(objJSON);
		   		   
		   //alert(objJSON)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });	
	
	
}



/* For dashboard */
function dashboard(linkid){
	checkAuth();
	$('#loaderID').show();
	$('.nav-item a.active').removeClass('active');
	$('#'+linkid).addClass('active');	
	 $.ajax({
        url: "/user/allusers",
        type: "get",
        data: {},
        success: function (response) {

			 $('#loaderID').hide();
           var objJSON = JSON.parse(JSON.stringify(response));
		   $("#display_data").html(objJSON);
		   		   
		   //alert(objJSON)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           //console.log(textStatus, errorThrown);
        }
    });
	
}


/* For Orders */
function orders(linkid){
	checkAuth();
	$('#loaderID').show();
	$('.nav-item a.active').removeClass('active');
	$('#'+linkid).addClass('active');	
		 
		 
		 
	 $.ajax({
        url: "/dashboard/orders",
        type: "get",
        data: {},
        success: function (response) {

			 $('#loaderID').hide();
           var objJSON = JSON.parse(JSON.stringify(response));
		   $("#display_data").html(objJSON);
		   		   
		   //alert(objJSON)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           //console.log(textStatus, errorThrown);
        }
    });
	
}



/* For Categories */
function category(linkid){
	checkAuth();
	$('#loaderID').show();
	$('.nav-item a.active').removeClass('active');
	$('#'+linkid).addClass('active');	

	 $.ajax({
        url: "/dashboard/categories",
        type: "get",
        data: {},
        success: function (response) {

			 $('#loaderID').hide();
           var objJSON = JSON.parse(JSON.stringify(response));
		   $("#display_data").html(objJSON);
		   		   
		   //alert(objJSON)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
	
}


/* For Products */
function product(linkid){
	checkAuth();
	$('#loaderID').show();
	$('.nav-item a.active').removeClass('active');
	$('#'+linkid).addClass('active');	

	 $.ajax({
        url: "/dashboard/products",
        type: "get",
        data: {},
        success: function (response) {

			 $('#loaderID').hide();
           var objJSON = JSON.parse(JSON.stringify(response));
		   $("#display_data").html(objJSON);
		   		   
		   //alert(objJSON)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
	
}


function product_create(linkid){
	checkAuth();
	$('#loaderID').show();
	$('#'+linkid).addClass('active');	

	 $.ajax({
        url: "/dashboard/products/create",
        type: "get",
        data: {},
        success: function (response) {

			 $('#loaderID').hide();
           var objJSON = JSON.parse(JSON.stringify(response));
		   $("#display_data").html(objJSON);
		   		   
		  // alert(objJSON)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
	
}

function product_edit(editID){
	checkAuth();
	$('#loaderID').show();	

	 $.ajax({
        url: "/dashboard/products/edit/"+editID,
        type: "get",
        data: {},
        success: function (response) {

			 $('#loaderID').hide();
           var objJSON = JSON.parse(JSON.stringify(response));
		   $("#display_data").html(objJSON);
		   		   
		  // alert(objJSON)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
	
}



/* Update quantity */

function updatecart(changeq,unit_price,product_id){
	
	
	
	checkAuth();
	$('#loading').show();

	 $.ajax({
        url: "/cart/updatecart",
        type: "post",
        data: {'changeq': changeq,'unit_price': unit_price,'product_id': product_id },
        success: function (response) {

			 $('#loading').hide();
           var objJSON = JSON.parse(response);
		   
		   if(objJSON.code==200){
			   
			   window.location.href = '/cart';
			   
		   }
		   		   
		  // alert(objJSON)
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
	
}