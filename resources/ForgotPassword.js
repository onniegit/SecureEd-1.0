var contents = document.getElementById("ForgotPasswordContent");
const Eform = document.getElementById("emailform")
var emailrequest = new XMLHttpRequest();

contents.innerHTML = '<p1>Please enter your Email</p1> <br><br>'+'<form id="emailform">'+
    '<label style="float: center" for="email">Email:&nbsp;&nbsp;</label>'+
    '<input type="text" id="email" name="email"><br><br>'+
    '<input type="submit" value = "submit">';



document.getElementById("emailform").addEventListener("submit",emailcheck)




function emailcheck(e)
{
 e.preventDefault();

 contents.innerHTML = '<form id="SecQform">'+
     '<label style="float: center" for="secR">Answer:&nbsp;&nbsp;</label>'+
     '<input type="text" id="secR" name="secR"><br><br>'+
     '<button type="submit">Submit</button>';
 document.getElementById("SecQform").addEventListener("submit",answercheck)
}

function answercheck(e)
{
 e.preventDefault();

 contents.innerHTML = '<p1>Please enter your new password</p1> <br><br>'+'<form id="passwordform">'+
     '<label style="float: center" for="newpassword">New password:&nbsp;&nbsp;</label>'+
     '<input type="text" id="newpassword" name="newpassword"><br><br>'+
     '<label style="float: center" for="newpasswordconfirm">New password confirm:&nbsp;&nbsp;</label>'+
     '<input type="text" id="newpasswordconfirm" name="newpasswordconfirm"><br><br>'+
     '<input type="submit" value="Submit">';
  document.getElementById("passwordform").addEventListener("submit",newpassword)

}


function newpassword(e)
{

 e.preventDefault();
 location.replace("../public/index.php");
}




