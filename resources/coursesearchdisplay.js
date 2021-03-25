function fetch() {
    // (A) GET SEARCH TERMS
    var data = new FormData();
    data.append('courseid', document.getElementById("courseid").value);
    data.append('semester', document.getElementById("semester").value);
    data.append('coursename', document.getElementById("coursename").value);
    data.append('department', document.getElementById("department").value);

    // (B) AJAX SEARCH REQUEST
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "../src/coursesearchlogic.php", true);
    xhr.onload = function () {
        //there must be no other echos except the JSON file or JSON.parse fails
        var results = JSON.parse(this.response),
            wrapper = document.getElementById("results");
        try
        {
            while (wrapper.removeChild(wrapper.childNodes[0]) !== null)
            {
                //tries to remove all previous search results if they exist
            }
        }
        catch
        {
            //succeeds when it throws exception
        }

        if (results !== null) //using results.length crashed when there was no search results
        {
            wrapper.innerHTML = "";
            var starttime = "";
            var endtime = "";
            for (let res of results) {
                let row = document.createElement("span");
                    starttime = timeToDate(res['StartTime'], ':'); //create a Date object from a time
                    endtime = timeToDate(res['EndTime'], ':')

                row.innerHTML = `<form method="post" action="course_enroll.php"><table class="course_search_table"><tr>
                                         <td class="course_search_results_output"><input type="hidden" value="${res['CourseName']}" name="coursename">${res['CourseName']}</input></td> 
                                         <td class="course_search_results_output">${res['CRN']}</td>
                                         <td class="course_search_results_output">${res['Email']}</td> 
                                         <td class="course_search_results_output">${dateToTime(starttime)} - ${dateToTime(endtime)}</td> 
                                         <td class="course_search_results_output">${res['Location']}</td>
                                         <td class="course_search_results_output"><button name="Enroll" id="Enroll" type="submit">Enroll</button></td>
                                         </tr></table></form>`;
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

function timeToDate( timeAsString, ymdDelimiter ) {
    //sqlite time pattern is HH:MM:SS
    var pattern = new RegExp( "(\\d{2})" + ymdDelimiter + "(\\d{2})" + ymdDelimiter + "(\\d{2})" );
    var parts = timeAsString.match( pattern );

    //only gets hours, minutes, and seconds from db
    return new Date( Date.UTC(
         0
        , 0
        , 0
        ,  parseInt( parts[1] ) //hours
        , parseInt( parts[2], 10 ) //minutes
        ,  parseInt( parts[3], 10 ) //seconds
        , 0
    ));
}

function dateToTime(Date)
{
    //Returns a string of form HH:MM AM/PM where if minutes<10 it returns 0M

    var returnTime = "";
    var isPM = false;

    if(Date.getHours()>12) //check AM/PM
    {
        returnTime = returnTime + (Date.getHours() - 12) + ':';
        isPM = true;
    }
    else
    {
        returnTime = returnTime + Date.getHours() + ':';
    }

    if(Date.getMinutes()<10)
    {
        returnTime = returnTime + '0' + Date.getMinutes();
    }
    else
    {
        returnTime = returnTime + Date.getMinutes();
    }

    /* Uncomment if seconds are desired
    if(Date.getSeconds()<10)
    {
        returnTime = returnTime + '0' + Date.getSeconds();
    }
    else
    {
        returnTime = returnTime + Date.getSeconds();
    }*/

    //apply AM/PM
    if(isPM)
    {
        return returnTime = returnTime + "PM";
    }
    else
    {
        return returnTime = returnTime +"AM";
    }
}