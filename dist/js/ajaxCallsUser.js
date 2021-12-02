jQuery(document).ready(function() {

    URL = "http://localhost:8088/laravelapp/public/api/auth/";
	TOKEN = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODA4OFwvbGFyYXZlbGFwcFwvcHVibGljXC9hcGlcL2F1dGhcL2xvZ2luIiwiaWF0IjoxNjMzNTk4MjcxLCJleHAiOjE2MzM2MDE4NzEsIm5iZiI6MTYzMzU5ODI3MSwianRpIjoidUt2TzcwREFTZEZXZXVwZCIsInN1YiI6MywicHJ2IjoiMjNiZDVjODk0OWY2MDBhZGIzOWU3MDFjNDAwODcyZGI3YTU5NzZmNyJ9.NHQPujxHK4x-cLbLAaySzr_MHX1y5eSX96-JtdbIO4I";
	
    get_user_data();

	$("#user-post-error").hide();
	$("#user-epost-error").hide();
	$("#user-del-error").hide();
	
});


//returns user data here--
function get_user_data(){

    $("#p_tbody_id").empty();
	

	var settings = {
	  "url": URL+"user-details",
	  "method": "GET",
	  "timeout": 0,
	  "headers": {
		"Content-Type": "application/json",
		"Accept": "application/json",
		"Authorization": "Bearer "+TOKEN,
	  },
	};

	$.ajax(settings).done(function (response) {
	  
		if (response) {
			$.each(response, function(i, item) {
				var $tr = $('<tr>').append(
					$('<td class="text-center">').text(item.first_name),
					$('<td class="text-center">').text(item.last_name),
					$('<td class="text-center">').text(item.email),
					$('<td class="text-center">').text(item.contact_no),
					$('<td>').html('<a href="#editEmployeeModal" class="Add" data-toggle="modal" onclick="add_new_addr('+ item.id +');" title="Add">Add new Address &nbsp;</a><a href="#deleteEmployeeModal" class="delete" data-toggle="modal" onclick="view_addr('+ item.id +');"title="Delete">/ view Address</a>')
				);
				$('#tbl_policy_group > tbody:last-child').append($tr);
			});
		} else {
		alert('Some problem occurred, please try again.');
		}
	  
	});
}


//add new user here--
function save_user(){
	
	var first_name = $("#first_name").val();
	var last_name = $("#last_name").val();
	var email = $("#email").val();
	var password = $("#password").val();
	var password_confirmation = $("#password_confirmation").val();
	var contact_no = $("#contact_no").val();

	if(first_name==''||last_name==''|| password=='' || password_confirmation == '' || contact_no == '')
	{
		$("#user-post-error").text("");
		$("#user-post-error").removeClass("alert alert-success");
		$("#user-post-error").addClass("alert alert-danger");
		$("#user-post-error").text("Please Fill All Fields");
		$("#user-post-error").fadeTo(2000, 500).slideUp(500, function() {
			$("#user-post-error").slideUp(500);
		});
	}
	else
	{
		
		var form = new FormData();
		
		form.append("first_name", first_name);
		form.append("last_name", last_name);
		form.append("email", email);
		form.append("password", password);
		form.append("password_confirmation ",  password_confirmation);
		form.append("contact_no", contact_no);

		var settings = {
		  "url": URL+"create",
		  "method": "POST",
		  "timeout": 0,
		  "headers": {
			"Accept": "application/json"
		  },
		  "processData": false,
		  "mimeType": "multipart/form-data",
		  "contentType": false,
		  "data": form
		};

		$.ajax(settings).done(function (response) {
			console.log(response);
			console.log(response.message);
			
			$("#user-post-error").text("");
			$("#user-post-error").removeClass("alert alert-danger");
			$("#user-post-error").addClass("alert alert-success");
			$("#user-post-error").text(response.message);
			$("#user-post-error").fadeTo(2000, 500).slideUp(500, function() {
				$("#user-post-error").slideUp(300);
				$("#addEmployeeModal").css('display','none');
				$('.modal-backdrop').remove();
			});
			
			$('.modal-backdrop').remove();
			get_user_data();
			
			$("#first_name").val('');
			$("#last_name").val('');
			$("#email").val('');
			$("#password").val('');
			$("#password_confirmation").val('');
			$("#contact_no").val('');
		});
	}
}

function add_new_addr(user_id){
	$("#user_id").val(user_id);
}

function view_addr(user_id){
	var settings = {
		"url": URL+"address/"+user_id,
		"method": "GET",
		"timeout": 0,
		"headers": {
			"Accept": "application/json",
			"Authorization": "Bearer "+TOKEN,
		},
	};

	$.ajax(settings).done(function (response) {
		console.log(response);
		$("#addr_tbody_id").html('');
		if (response) {
			$.each(response, function(i, item) {
				var $tr = $('<tr>').append(
					$('<td class="text-center">').text(item.street_1),
					$('<td class="text-center">').text(item.street_2),
					$('<td class="text-center">').text(item.city),
					$('<td class="text-center">').text(item.state),
					$('<td class="text-center">').text(item.country),
				);
				$('#tbl_address_group > tbody:last-child').append($tr);
			});
		} else {
		alert('Some problem occurred, please try again.');
		}
		
	});
}

function update_user_address(){
	var user_id = $("#user_id").val();
	var street_1 = $("#street_1").val();
	var street_2 = $("#street_2").val();
	var city = $("#city").val();
	var state = $("#state").val();
	var postcode = $("#postcode").val();
	var country = $("#country").val();
	var is_type = $("#is_type").val().toString();
	
	var form = new FormData();
	form.append("street_1", street_1);
	form.append("street_2", street_2);
	form.append("city", city);
	form.append("state", state);
	form.append("postcode", postcode);
	form.append("country", country);
	form.append("is_type", is_type);
	form.append("user_id", user_id);

	var settings = {
	  "url": URL+"users/address/add",
	  "method": "POST",
	  "timeout": 0,
	  "headers": {
		"Authorization": "Bearer "+TOKEN,
	  },
	  "processData": false,
	  "mimeType": "multipart/form-data",
	  "contentType": false,
	  "data": form
	};

	$.ajax(settings).done(function (response) {
	  console.log(response);
	  
		$("#user-post-error").text("");
		$("#user-post-error").removeClass("alert alert-danger");
		$("#user-post-error").addClass("alert alert-success");
		$("#user-post-error").text('');
		$("#editEmployeeModal").css('display','none');
		// $("#user-post-error").fadeTo(2000, 500).slideUp(500, function() {
			// $("#user-post-error").slideUp(300);
			// $('.modal-backdrop').remove();
		// });
		
		$('.modal-backdrop').remove();
		
		$("#user_id").val('');
		$("#street_1").val('');
		$("#street_2").val('');
		$("#city").val('');
		$("#state").val('');
		$("#postcode").val('');
		$("#country").val('');
	  
	});
	
	
}

//open_save_user
function open_save_user(type){
	
	var first_name = $("#first_name").val();
	var last_name = $("#last_name").val();
	var email = $("#email").val();
	var password = $("#password").val();
	var password_confirmation = $("#password_confirmation").val();
	var contact_no = $("#contact_no").val();
	
	var form = new FormData();
	form.append("first_name", first_name);
	form.append("last_name", last_name);
	form.append("email", email);
	form.append("password", password);
	form.append("password_confirmation ",  password_confirmation);
	form.append("contact_no", contact_no);

	var settings = {
	  "url": URL+"register",
	  "method": "POST",
	  "timeout": 0,
	  "headers": {
		"Accept": "application/json"
	  },
	  "processData": false,
	  "mimeType": "multipart/form-data",
	  "contentType": false,
	  "data": form
	};

	$.ajax(settings).done(function (response) {
	  console.log(response);
	});
}