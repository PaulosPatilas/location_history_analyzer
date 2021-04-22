  (function ($) {
    "use strict";

    /*==================================================================
    [ Focus Contact2 ]*/
    $('.input100').each(function(){
        $(this).on('blur', function(){
            if($(this).val().trim() != "") {
                $(this).addClass('has-val');
            }
            else {
                $(this).removeClass('has-val');
            }
        })
    })

    /*==================================================================
    [ Validate ]*/
    var input = $('.validate-input .input100');
	var ct = 0 ;
	var check = true;
    $('.validate-form').on('submit',function(e){
        for(var i=0; i<input.length; i++) {
            if(validate(input[i]) == false){
                showValidate(input[i]);
                check=false;
				ct++;
            }
        }





				if(ct === 0){
				e.preventDefault();
			var username = $('#username').val();
      var password = $('#password').val();
				$.ajax({
						type:'POST',
						url : 'login.php',
						data: {username : username, password : password},
						success: function(data){
              if (data == 'admin'){
                window.location.replace("http://localhost/dashboard/web/admin/home.php");
              }
								},
						error: function(data){
									Swal.fire({
										title: 'ERROR',
										text : 'Some errors have accured. Try again!',
										type : 'error'
									})
								}
				});
}
    });



    $('.validate-form .input100').each(function(){
        $(this).focus(function(){
           hideValidate(this);
        });
    });

    function validate (input) {
        if($(input).attr('type') == 'email' || $(input).attr('name') == 'email') {
            if($(input).val().trim().match(/^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{1,5}|[0-9]{1,3})(\]?)$/) == null) {
                return false;
            }
        }
        else {
            if($(input).val().trim() == ''){
                return false;
            }
        }
    }

    function showValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).addClass('alert-validate');
    }

    function hideValidate(input) {
        var thisAlert = $(input).parent();

        $(thisAlert).removeClass('alert-validate');
    }
})(jQuery);
