jQuery(document).ready(function() {

    URL = "http://localhost:8088/laravelapp/public/api/auth/user/search";
	TOKEN = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODA4OFwvbGFyYXZlbGFwcFwvcHVibGljXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNjMzNTk4MjcxLCJleHAiOjE2MzM2MDE4NzEsIm5iZiI6MTYzMzU5ODI3MSwianRpIjoidUt2TzcwREFTZEZXZXVwZCIsInN1YiI6MywicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.NHQPujxHK4x-cLbLAaySzr_MHX1y5eSX96-JtdbIO4I";
	
	
});


//returns user data here--
function search_user(){

	var search_var = $("#search_var").val();
	
	if(search_var == ""){
		alert('Please enter details to serach the user'); return false;
	}
	
	
	var settings = {
		"url": URL+'/'+search_var,
		"method": "GET",
		"timeout": 0,
		"headers": {
			"Authorization": "Bearer "+TOKEN
		},
	};

	$.ajax(settings).done(function (response) {
		console.log(response);
		$("#p_tbody_id").html('');
		if (response) {
			$.each(response, function(i, item) {
				var $tr = $('<tr>').append(
						$('<td class="text-center">').text(item.first_name),
						$('<td class="text-center">').text(item.last_name),
						$('<td class="text-center">').text(item.email),
						$('<td class="text-center">').text(item.contact_no),
						$('<td class="text-center">').text(item.u_email)						
				);
				$('#tbl_policy_group').append($tr);
			});
		} else {
			alert('Some problem occurred, please try again.');
		}
	});
}