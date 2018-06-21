var form = document.getElementById("myForm");
	  form.addEventListener("submit", function (event) {
	    event.preventDefault();
	    SignUp();
	  });

		function SignUp() {
			var xhr = new XMLHttpRequest();
			var FD = new FormData(form);
			var notice = document.getElementById("notice");
			notice.classList.remove("success", "error");

			xhr.open("POST", "sign_up.php", true);
			xhr.send(FD);
	    xhr.addEventListener("load", function(event) {
	    	response = JSON.parse(event.target.responseText);
	    	notice.classList.add(response.status);
	      notice.innerHTML = response.msg;
	    });

	  }