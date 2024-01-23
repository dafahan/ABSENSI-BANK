function loading() {
	$("#stat").html('<div class="alert alert-info"><i>Authenticating..</i></div>');
}
$(document).ready(function () {
	$("#login").click(function () { login(); });
});

function login() {
	if ($("#username").val() == "" || $("#password").val() == "") {

		$("#stat").fadeTo('slow', '1.99');
		$("#stat").fadeIn('slow', function () { $("#stat").html('<div class="alert alert-warning">Username/Password belum lengkap !</div>'); })
		return false;
	}
	else {
		loading();
		var username = $("#username").val();
		var password = $("#password").val();
		$.getJSON("../login/login-proses.php",{ username: username, password: password }, function (json) {
			if (json.response.error == "0")	// jika login gagal
			{

				$("#stat").fadeTo('slow', '1.99');
				$("#stat").fadeIn('slow', function () { $("#stat").html('<div class="alert alert-danger">Username atau Password Salah!</div>'); });
			}
			else	// Login sukses
			{
				$("#stat").fadeOut('slow', function () {
					window.location.replace("../");
				});
			}
		});
		return false;
	}
};