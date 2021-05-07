var SecurityQuestion = document.getElementById("Secq");

var xhr = new XMLHttpRequest();
xhr.open('POST', "../src/ForgotPasswordLogic.php", true);
xhr.onload = function () {
 //there must be no other echos except the JSON file or JSON.parse fails
 var results = JSON.parse(this.response);
 renderHTML(results);
 }

function renderHTML()
{
 var htmlString="test";
SecurityQuestion.insertAdjacentHTML('beforeend',htmlString)
}

