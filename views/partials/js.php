	<script type="text/javascript">
		$( document ).ready(function() {

	     // Posting registration data
	     $('#register_user').on('click', function () {
	     	var username = $('#registration_username').val();
	     	var email = $('#email').val();
	     	var password = $('#registration_password').val();
	     	var password_confirmation = $('#password_confirmation').val();

	     	$.post('register', 
	     	{ 
	     		username: username,
	     		email: email,
	     		password: password,
	     		password_confirmation: password_confirmation
	     	}
	     	,function ( data, status ) {

	     		//if there are any errors show the div with id=alert

	     		if( ! Object.keys(data).length > 0){

	     			$('#Register').modal('hide');
	     			$(location).attr('href', window.location.origin + '/favorites')
	     		}	     		
	     			$("#alert").show();
	     			for (error in data){
	     			 $("#alert").append("<li>" + data[error] +"</li>")
	     			}
	     		
	     		
	     	})
	     })

	     //Posting login data
	     $("#login").on('click', function () {
	     	var email = $('#login_email').val();
	     	var password = $('#password').val();

	     	$.post('login', 
	     	{
		     	email: email,
		     	password: password
		    }
		     ,function ( data, status ) {
		     	//if there are no errors, login user
		     	if( ! Object.keys(data).length > 0 ){

		     		$('#Login').modal('hide');
	     			$(location).attr('href', window.location.origin + '/favorites')
	     			return;
		     	}

		     		$("#alert").show();
	     			for (error in data){
	     			$("#alert").append("<li>" + data[error] +"</li>")
	     			}
		     })
	     })
	     	

	     //logging out
	    $("#logout").click(function(){
		  $.post("logout", function(data, status){
		    	$(location).attr('href', window.location.origin )
		  })
		})

	     //directing to the favorites page
	     $('a').click(function(event) {
	     		event.preventDefault();
		        var id = $(this).attr('id');
		        if (id == 'favorites') {		            
		            $(location).attr('href', window.location.origin + '/favorites')
		        } else if( id == 'popular' ) {
		            $(location).attr('href', window.location.origin )
		        }
		    });

	     //directing to the contact page
	     $("#contact").click( function () {
	     	$(location).attr('href', window.location.origin + '/contact')
	     } )

	     //tooltip 
	     $('[data-toggle="tooltip"]').tooltip();

		});
	</script>