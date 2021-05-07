ECHO OFF
REM This starts up the database
cd ..
REM Sets temporary path for libs
SET PATH=php.exe
REM Populates initial database
php src/Startup.php
REM Opens web app in browser.
php -S localhost:8000
REM Note that when you close the window, the server closes automatically