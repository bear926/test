$(document).ready(function() {

	var str;
	var field;
				
	function valid(attri){
		
		for (var i = 0; i < attri.length; i++) {
			var sl = /\/|<|>/;
			str = attri[i].attr('value');
			if (sl.test(str)){
				field = attri[i].attr('name');
				alert('Forbidden symbol in '+field+'.');
				event.preventDefault();
				break;
			}
			field = attri[i].attr('name');
			if (field == 'email'){
				str = attri[i].attr('value');
				var email = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
				if (!email.test(str)){
					alert('Email must be emai.');
					event.preventDefault();
				
				}
			}
			
			str = attri[i].attr('value');
			if (str == '') {
				field = attri[i].attr('name');
				alert('You dont entry '+field+'.');
				event.preventDefault();
				break;
			}
		}
		

	}	

	var form = $('#formreg');
	var submitr = $('#submitr');
	submitr.click(function(event) {
		var loginr = $('#loginr');
		var passr = $('#passr');
		var passrr = $('#passrr');
		var email = $('#email');
		var capt = $('#capt');
		
		mas = new Array(loginr,passr,passrr,email,capt);
		valid(mas);
		
	});	

});




		