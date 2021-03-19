var pagetype = 1;
var contents = document.getElementById("ForgotPasswordContent");
const emailform = document.getElementById("emailform")
var emailrequest = new XMLHttpRequest();


function emailcheck(e)
{
 e.preventDefault();
 pagetype++;
}
function newpassword(e)
{
 e.preventDefault();
 location.replace("../public/index.php");
}


 if(pagetype ==1)
 {
   contents.innerHTML = '<p1>Please enter your Email</p1> <br><br>'+'<form id="emailform">'+
     '<label style="float: center" for="email">Email:&nbsp;&nbsp;</label>'+
     '<input type="text" id="email" name="email"><br><br>'+
       '<input type="submit" value = "Submit">';

 }

emailform.addEventListener("submit",emailcheck)



if(pagetype ==2)
{
 contents.innerHTML = '<form id="SecQform">'+
     '<label style="float: center" for="secR">Answer:&nbsp;&nbsp;</label>'+
     '<input type="text" id="secR" name="secR"><br><br>'+
     '<button type="submit">Submit</button>';

 emailform.addEventListener("Submit",emailcheck)

}

if(pagetype ==3)
{
 contents.innerHTML = '<p1>Please enter your new password</p1> <br><br>'+'<form id="passwordform">'+
     '<label style="float: center" for="newpassword">New password:&nbsp;&nbsp;</label>'+
     '<input type="text" id="newpassword" name="newpassword"><br><br>'+
     '<label style="float: center" for="newpasswordconfirm">New password confirm:&nbsp;&nbsp;</label>'+
     '<input type="text" id="newpasswordconfirm" name="newpasswordconfirm"><br><br>'+
     '<input type="submit" value="Submit">';
 emailform.addEventListener("submit",newpassword)


}