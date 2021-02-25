function fetch() {
    // (A) GET SEARCH TERMS
    var data = new FormData();
    data.append('acctype', document.getElementById("acctype").value);
    data.append('fname', document.getElementById("fname").value);
    data.append('lname', document.getElementById("lname").value);
    data.append('dob', document.getElementById("dob").value);
    data.append('email', document.getElementById("email").value);
    data.append('studentyear', document.getElementById("studentyear").value);
    data.append('facultyrank', document.getElementById("facultyrank").value);

    // (B) AJAX SEARCH REQUEST
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "usersearchlogic.php");
    xhr.onload = function () {
        var results = JSON.parse(this.response),
            wrapper = document.getElementById("results");
        if (results.length > 0)
        {
            wrapper.innerHTML = "";
            for (let res of results)
            {
                let line = document.createElement("div");
                line.innerHTML = `${res['lname']}, ${res['fname']} - ${res['DOB']} - ${res['email']} - ${res['studentyear']}`;
                wrapper.appendChild(line);
            }
        }
        else
        {
                wrapper.innerHTML = "No results found";
        }
    };
    xhr.send(data);
    return false;
}