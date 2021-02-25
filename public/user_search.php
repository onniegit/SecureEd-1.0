<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="secure_app.css">
    <meta charset="utf-8" />
    <title>Secure App - User Search</title>
</head>
<body>
<div id="wrapper">
    <header>
        <table class="header_table">
            <table>
                <thead>
                <tr>
                    <th></th>
                </tr>
                </thead>
            </table>
            <tr>

                <td class="lock"><img src="Header_Lock_Image.svg" style="width:9vh;" alt=""></td>

                <td class="title"><b>Secure App</b></td>

                <td class="header_table_cell"></td>

            </tr>
            </tbody>
        </table>
    </header>

    <main>
        <!--Navigation Buttons-->
        <nav>
            <button class="button_large" type="button">Dashboard</button>
            <button class="button_large" type="button">Log Out</button>
        </nav>

        <br>

        <!--Heading-->
        <h1>User Search</h1>
        <div class=horizontal_line>
            <hr>
        </div>

        <br><br>

        <div style="text-align:center">
            <div class = "search_pane">
                <h1>Search Filters:</h1>
                <div class=horizontal_line>
                    <hr>
                </div>
                <!--Search filters-->
                <form>
                    <table>
                    <tbody>
                    <tr>
                        <td class="search_filter">
                            <label class="search_filter">
                                Account type:
                            </label>
                        </td>

                        <td class="search_filter_input">
                            <input type="text" id ="acctype" name="acctype">
                        </td>

                        <td class="search_filter">
                            <label class="search_filter">
                                Position:
                            </label>
                        </td>

                        <td class="search_filter_input">
                            <input type="text">
                        </td>
                    </tr>

                    <tr>
                        <td class="search_filter">
                            <label class="search_filter">
                                First Name:
                            </label>
                        </td>
                        <td class="search_filter_input">
                            <input type="text" id="fname" name="fname">
                        </td>

                        <td class="search_filter">
                            <label class="search_filter">
                                Last Name:
                            </label>
                        </td>
                        <td>
                            <input type="text" id="lname" name="lname">
                        </td>
                    </tr>

                    <tr>
                        <td class="search_filter">
                            <label>
                                Date of Birth:
                            </label>
                        </td>
                        <td class="search_filter_input">
                            <input type="date" id="dob" name="dob">
                        </td>

                        <td></td>
                        <td></td>
                    </tr>

                    <tr>
                        <td class="search_filter">
                            <label class="search_filter">
                                Email
                            </label>
                        </td>
                        <td class="search_filter_input"> <input type="email" name="email" id="email"> </td>

                        <td></td>
                        <td style="text-align: right">
                            <button class="button_large" type="submit">
                                Search
                            </button></td>
                    </tr>
                    </tbody>
                    </table>
                </form>
            </div>
            <br>
            <div style="text-align: left;">

            </div>
            <br><br><br>

            <div class="search_results">
                <h1>Results:</h1>
                <div class="horizontal_line">
                    <hr>
                </div>
                <table>
                    <thead>
                    <tr>
                        <td class="search_results_output">
                            <b><u>Name</u></b>
                        </td>

                        <td class="search_results_output">
                            <b><u>DOB</u></b>
                        </td>

                        <td class="search_results_output">
                            <b><u>Email</u></b>
                        </td>

                        <td class="search_results_output">
                            <b><u>Position</u></b>
                        </td>

                        <td class="search_results_output">
                        </td>
                    </tr>
                    </thead>




                    <tbody>
                    <tr>
                        <td class="search_results_output">
                            Test McTesterson
                        </td>

                        <td class="search_results_output">
                            00/00/0000
                        </td>

                        <td class="search_results_output">
                            test
                        </td>

                        <td class="search_results_output">
                            some dude
                        </td>

                        <td class="search_results_output">
                            <button type="button">Edit</button>
                        </td>
                    </tr>
                    </tbody>



                </table>

            </div>
        </div>
    </main>

</div>
</body>
</html>
