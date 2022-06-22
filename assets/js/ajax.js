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
		   /* if(objJSON.code==200 && objJSON.code !="Access granted"){
			   window.location.href = '/login';
		   } */
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

function product_create_submit(linkid){
	
	$('#loaderID').show();
	$('#'+linkid).addClass('active');	

		$.ajax({
			url: '/dashboard/products/store',
			data: $('#file').attr('files'),
			cache: false,
			contentType: 'multipart/form-data',
			processData: false,
			type: 'POST',
			success: function(data){
				alert(data);
			}
		});
	
}