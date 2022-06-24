/* For login */
function login(email,Password){
	 $('#loaderID').show();
	 $.ajax({
        url: "/login",
        type: "post",
        data: {'email': email,'Password': Password },
        success: function (response) {

			 $('#loaderID').hide();
             var objJSON = JSON.parse(JSON.stringify(response));
		   	
	         if (objJSON.message.indexOf('@@') > -1){
					const myArray = objJSON.message.split("@@");

					const myArray1 = myArray[1].split("=");
					
					 if(objJSON.code==200 && myArray[0]=="Successful login" && myArray1[0]=="admin" && myArray1[1]==1){
						 
						 window.location.href = '/dashboard';
					 }else{
						 window.location.href = '/dashboard/orders';
						 
					 }
			 }else{
                        $("#logi").html(objJSON.message);

			 }				 
	   


        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
	
}

/* For registration */
function registration(username,email,Password){
	 $('#loaderID').show();
	 $.ajax({
        url: "/register",
        type: "post",
        data: { 'username': username,'email': email,'Password': Password },
        success: function (response) {

			 $('#loaderID').hide();
           var objJSON = JSON.parse(JSON.stringify(response));
		   		   
		   if(objJSON.code==200 && objJSON.message=="Registration Successful."){
			  
				   window.location.href = base_url+'/login';
		   }else{
			   
			   $("#uni").html(objJSON.message);
			   
		   }

        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
	
} 