function fetch() {
    // (A) GET SEARCH TERMS
    var data = new FormData();
    data.append('acctype', document.getElementById("acctype").value);
    data.append('fname', document.getElementById("fname").value);
    data.append('lname', document.getElementById("lname").value);
    data.append('dob', document.getElementById("dob").value);
    data.append('email', document.getElementById("email").value);
    //data.append('studentyear', document.getElementById("studentyear").value);
    //data.append('facultyrank', document.getElementById("facultyrank").value);

    // (B) AJAX SEARCH REQUEST
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "../src/usersearchlogic.php", true);
    xhr.onload = function () {
        var results = JSON.parse(this.response),
            wrapper = document.getElementById("results");
        if (results.length > 0)
        {
            wrapper.innerHTML = "";
            for (let res of results)
            {
                let row = document.createElement("tr");
                if(res['AccountType']==="Student")
                {
                    row.innerHTML = `<td class="search_results_output">${res['LName']}, ${res['FName']}</td> 
                                     <td class="search_results_output">${res['DOB']}</td>
                                     <td class="search_results_output">${res['Email']}</td> 
                                     <td class="search_results_output">${res['Year']}</td>
                                     <td class="search_results_output"><button type="button">Edit</button></td>`;
                }
                else
                {
                    row.innerHTML = `<td class="search_results_output">${res['LName']}, ${res['FName']}</td> 
                                     <td class="search_results_output">${res['DOB']}</td>
                                     <td class="search_results_output">${res['Email']}</td> 
                                     <td class="search_results_output">${res['Rank']}</td>
                                     <td><button type="button">Edit</button></td>`;
                }

                wrapper.appendChild(row);
            }
        }
        else
        {
                wrapper.innerHTML = "No results found";
        }
    };
    xhr.send(data);
    xhr.onloadend = function() {
        if(xhr.status === 404)
            throw new Error(' replied 404');
    }
    return false;
}