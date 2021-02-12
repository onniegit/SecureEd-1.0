Set up

Step 1: Setting up PHP

Obtain binaries from https://windows.php.net/download/ (version 7.3.27). Put these binaries into the same folder as your project.

Step 2: Directory structure
Using this skeleton https://github.com/php-pds/skeleton and using info from its read me. Specically, these folders are usually used:<br>
| command-line executables                        | bin/                     |<br>
| configuration files                             | config/                  |<br>
| documentation files                             | docs/                    |<br>
| web server files                                | public/                  |<br>
| other resource files                            | resources/               |<br>
| PHP source code                                 | src/                     |<br>
| test code                                       | tests/                   |<br>

Step 3: Starting the web server<br>
Open command prompt and cd to the root of your project. <br>
If all the above steps have been performed, run the command php -S localhost:8000

Step 4: Reaching our index page<br>
Upon opening a web browser, type in localhost:8000/public/index.html<br>
If only localhost:8000 is entered, then you will not be directed to this page by default.<br>
