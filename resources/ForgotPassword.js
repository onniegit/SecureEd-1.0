var data = new FormData();
data.append('email', document.getElementById("email").value);
data.append('SecQuestion', document.getElementById("secQ").value);
data.append('SecAnswer', document.getElementById("secA").value);
data.append('SecResponse', document.getElementById("secR").value);
data.append('Newpassword', document.getElementById("newpassword").value);
data.append('NewpasswordConfirm', document.getElementById("newpasswordconfirm").value);

var contents = document.getElementById("ForgotPasswordContent");

contents = <form id="EmailCheck" method="POST">
    <label style="float: center" for="email">Email:&nbsp;&nbsp;</label>
<input type="text" id="email" name="email"><br><br>
<input type="submit" value="Submit">;
