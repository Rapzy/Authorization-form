var sign_btn = document.getElementById("signup_btn");
var login_btn = document.getElementById("login_btn");
var signup_form = document.getElementById('signup_form');
var login_form = document.getElementById('login_form');

sign_btn.onclick = function(event){
	event.preventDefault();
	SendRequest(signup_form, 'sign_up.php')
}
login_btn.onclick = function(event){
	event.preventDefault();
	SendRequest(login_form, 'login.php')
}

function SendRequest(form,url){
	var xhr = new XMLHttpRequest();
	var FD = new FormData(form);
	var notice = document.getElementById("notice"); //Секция для уведомлений
	notice.classList.remove("success", "error");

	xhr.open("POST", url, true);
	xhr.send(FD);
	xhr.addEventListener("load", function(event) {
		response = JSON.parse(event.target.responseText);
		notice.classList.add(response.status);
		notice.innerHTML = response.msg;
	});
}

function ShowSignUp(event){
	event.preventDefault();
	login_form.style.display = "none";
	signup_form.style.display = "inline-block";
}

function ShowLogIn(event){
	event.preventDefault();signup_form.style.display = "none";
	login_form.style.display = "inline-block";	
}