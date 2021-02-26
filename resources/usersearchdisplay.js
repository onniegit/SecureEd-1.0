function fetch() {
    // (A) GET SEARCH TERMS
    var data = new FormData();
    data.append('acctype', document.getElementById("acctype").value);
    data.append('fname', document.getElementById("fname").value);
    data.append('lname', document.getElementById("lname").value);
    data.append('dob', document.getElementById("dob").value);
    data.append('email', document.getElementById("email").value);
    //The two underneath need to be discussed
    //data.append('studentyear', document.getElementById("studentyear").value);
    //data.append('facultyrank', document.getElementById("facultyrank").value);

    // (B) AJAX SEARCH REQUEST
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "../src/usersearchlogic.php", true);
    xhr.onload = function () {
        //there must be no other echos except the JSON file or JSON.parse fails
        var results = JSON.parse(this.response),
            wrapper = document.getElementById("results");
        if (results.length > 0)
        {
            wrapper.innerHTML = "";
            var fixedDOB = "";
            for (let res of results)
            {
                let row = document.createElement("tr");
                if(res['AccountType']==="Student")
                {
                    fixedDOB = dateFromUTC(res['DOB'], '-'); //create a Date object using SQLite's format
                    row.innerHTML = `<td class="search_results_output">${res['LName']}, ${res['FName']}</td> 
                                     <td class="search_results_output">${fixedDOB.getMonth()}/${fixedDOB.getDay()}/${fixedDOB.getFullYear()}</td>
                                     <td class="search_results_output">${res['Email']}</td> 
                                     <td class="search_results_output">${res['Year']}</td>
                                     <td class="search_results_output"><button type="button">Edit</button></td>`;
                }
                else
                {
                    fixedDOB = dateFromUTC(res['DOB'], '/');
                    row.innerHTML = `<td class="search_results_output">${res['LName']}, ${res['FName']}</td> 
                                     <td class="search_results_output">${fixedDOB.getMonth()}/${fixedDOB.getDay()}/${fixedDOB.getFullYear()}</td>
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

function dateFromUTC( dateAsString, ymdDelimiter ) {
    //sqlite pattern is YYYY-MM-DD HH:MM:SS
    var pattern = new RegExp( "(\\d{4})" + ymdDelimiter + "(\\d{2})" + ymdDelimiter + "(\\d{2})" );
    var parts = dateAsString.match( pattern );

    return new Date( Date.UTC(
        parseInt( parts[1] )
        , parseInt( parts[2], 10 ) - 1
        , parseInt( parts[3], 10 )
        , 0
        , 0
        , 0
        , 0
    ));
}