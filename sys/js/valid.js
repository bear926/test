

				
function valid(attr){
	var str;
	str = attr.getAttribute('value');
	alert (str);
		if (str == '') {
			var field;
			field = attr.getAttribute('name');
			alert('You dont entry '+field+'.');
			event.preventDefault();
    }
}

var submitr = document.getElementById('submitr');

submitr.onclick = function(event) {
	var loginr = document.getElementById('loginr');
	valid(loginr);
	var passr = document.getElementById('passr');
	valid(passr);
	var passrr = document.getElementById('passrr');
	valid(passrr);
	var email = document.getElementById('email');
	valid(email);
	var capt = document.getElementById('capt');
	valid(capt);

	}	






		