Set up
Step 1: Setting up PHP
 Obtain binaries from https://windows.php.net/download/ 
Specifically, PHP version 7.3.27
Put these binaries into the same folder as your project.

Step 2: Directory structure
Using this skeleton https://github.com/php-pds/skeleton and using info from its read me. Specically, these folders are usually used:
| command-line executables                        | bin/                     |
| configuration files                             | config/                  |
| documentation files                             | docs/                    |
| web server files                                | public/                  |
| other resource files                            | resources/               |
| PHP source code                                 | src/                     |
| test code                                       | tests/                   |

Step 3: Starting the web server
Open command propmt and cd to the root of your project. 
If all the above steps have been performed, run the command php -S localhost:8000

Step 4: Reaching our index page
Upon opening a web browser, type in localhost:8000/public/index.html
If only localhost:8000 is entered, then you will not be directed to this page by default.
