function swapselection() //changes the value entry based on faculty or student
{
 //get elements from page
 var studentselect = document.getElementById("studentyear");
 var facultyselect = document.getElementById("facultyrank");
 var acctype = document.getElementById("acctype");
 var positionlabel = document.getElementById("positionlabel");

 //change parts of page depending on student or faculty
 if(acctype.options[acctype.selectedIndex].text === "Faculty")
 {
  studentselect.style.display = "none";
  facultyselect.style.display = "inline";
  positionlabel.innerText = "Rank:";
 }
 else
 {
  studentselect.style.display = "inline";
  facultyselect.style.display = "none";
  positionlabel.innerText = "Year:";
 }
}

function submitAccount() //checks for basic errors when submitting
{
 //get elements from page
 var pass = document.getElementById("password");
 var confirmpass = document.getElementById("confirmpassword");
 var email = document.getElementById("email");
 var confirmemail = document.getElementById("confirmemail");
 var submiterror = document.getElementById("submiterror");
 var accform = document.getElementById("accform");
 var cansubmit = true;

 try
 {
  while (submiterror.removeChild(submiterror.childNodes[0]) !== null)
  {
   //tries to remove all previous error messages if they exist
  }
 }
 catch
 {
  //succeeds when it throws exception
 }

 //reset the element for errors to a default state
 submiterror.innerText = "";
 submiterror.style.display = "none";

 //check if pass is empty
 if(pass.value === "")
 {
  cansubmit = false;
  submiterror.innerText = "Password is empty. \n";
  submiterror.style.display = "block";
 }
 //check if pass and confirm pass are not the same
 if (pass.value !== confirmpass.value)
 {
  cansubmit = false;
  submiterror.innerText = submiterror.innerText.concat("Password and Confirm Password are not the same. \n");
  submiterror.style.display = "block";
 }
 //check if email is empty
 if(email.value === "")
 {
  cansubmit = false;
  submiterror.innerText = submiterror.innerText.concat("Email is empty. \n");
  submiterror.style.display = "block";
 }
 //check if email and confirmemail are not the same
 if (email.value !== confirmemail.value)
 {
  cansubmit = false;
  submiterror.innerText = submiterror.innerText.concat("Email and Confirm Email are not the same. \n");
  submiterror.style.display = "block";
 }
 if(cansubmit)
 {
  accform.submit();
 }
}