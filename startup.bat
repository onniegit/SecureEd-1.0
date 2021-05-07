cd "%~dp0"\app\bin
REM Starts the webserver.
START cmd /k CALL webserv.bat
REM Opens browser and points to the localhost after a couple of seconds.
SET WAIT_TIME=2
START http://localhost:8000/public/index.php