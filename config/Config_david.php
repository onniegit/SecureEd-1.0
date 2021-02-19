<?php
   class MyDB extends SQLite3 
   {
      function __construct() 
	{
         $this->open('Secure.db');
      	}
   }
   
$db = new SecureDB();
   if(!$db) 
	{
      		echo $db->lastErrorMsg();
   	} 
	else 
	{
      		echo "Opened database successfully\n";
   	}


//deletes any existing values, then inserts new config values---------------
$sql =<<<EOF

DELETE from User where Email != NULL;		
DELETE from Course where CourseID != NULL;
DELETE from Grade where StudentName != NULL;

	INSERT INTO USER (Email, AccountType, Password, Name, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('Admin@email.com', 'Admin', 'Password1', 'John', '2001-05-10', NULL, NULL, 'Favorite Relative?', 'Bobsmyuncle');

	INSERT INTO USER (Email, AccountType, Password, Name, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('DrProfessor@email.com', 'Professor', 'Password2', 'DrProfessor', '1932-09-01', NULL, Professor, 'Favorite Relative?', 'Notmyuncle');
	
	INSERT INTO USER (Email, AccountType, Password, Name, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('Student@email.com', 'Student', 'Password3', 'Pepe', '2002-06-12', '3', NULL, 'Favorite Relative?', 'JoeyBatey');
EOF;
   



	$ret = $db->exec($sql);
   if(!$ret)
	{
      		echo $db->lastErrorMsg();
   	} 
	else 
	{
      		echo "Config entered successfully\n";
   	}
   $db->close();
?>