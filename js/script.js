var sign_btn = document.getElementById("signup_btn");
var login_btn = document.getElementById("login_btn");
var signup_form = document.getElementById('signup_form');
var login_form = document.getElementById('login_form');
var logout_form = document.getElementById('logout_form');
var logout_btn = document.getElementById('logout_btn');

sign_btn.onclick = function(event){
	event.preventDefault();
	let fields = signup_form.getElementsByTagName('input');
	for (var i = 0; i < fields.length; i++) {
		if(!fields[i].checkValidity()){
			notice.classList.add("error");
			notice.innerHTML = fields[i].validationMessage;
			return;
		}
	}
	SendRequest(signup_form, 'sign_up.php');

}
login_btn.onclick = function(event){
	event.preventDefault();
	SendRequest(login_form, 'login.php')
}
logout_btn.onclick = function(event){
	event.preventDefault();
	SendRequest(logout_form, 'logout.php');
	logout_form.style.display = "none";
	ShowLogIn(event);	
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
		if (response.status == "success"){
			signup_form.reset();
			login_form.reset();
		}
		if (response.logged){
			HideForms();
			logout_form.style.display = "inline-block";
		}
		else{
			if(url == 'check.php'){
				ShowLogIn(event);
			}
		}
	});
}

function ShowSignUp(event){
	event.preventDefault();
	login_form.style.display = "none";
	signup_form.style.display = "inline-block";
	signup_form.reset();
	login_form.reset();
}

function ShowLogIn(event){
	event.preventDefault();
	signup_form.style.display = "none";
	login_form.style.display = "inline-block";	
	signup_form.reset();
	login_form.reset();
}
function HideForms(){
	login_form.style.display = "none";
	signup_form.style.display = "none";
}

SendRequest(logout_form, 'check.php');