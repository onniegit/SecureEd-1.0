<?php
   class MyDB extends SQLite3 
   {
      function __construct() 
	{
         $this->open('Secure.db');
      	}
   }
   
global $db = new SecureDB("",  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");
   
	if(!$db) 
	{
      	echo $db->lastErrorMsg();
   	} 
	else 
	{
      	echo "Opened database successfully\n";
   	}

   $sql =<<<EOF
      CREATE TABLE User
      	(
	Email		TEXT 	PRIMARY KEY     NOT NULL	UNIQUE,
	AccountType    	TEXT    NOT NULL,
	Password    	TEXT    NOT NULL,      		
	Name           	TEXT    NOT NULL,
	DOB		DATE,
      	Year		INT,
	Rank		TEXT,
	SQuestion	TEXT	NOT NULL,
	SAnswer		TEXT	NOT NULL
	);
      
	CREATE TABLE Course
      	(
	CourseID	INT 	PRIMARY KEY     NOT NULL	UNIQUE,
	CourseName      TEXT    NOT NULL,
	Semester    	TEXT    NOT NULL,
	StartTime	TIME	NOT NULL,
	EndTime		TIME	NOT NULL,
      	Location	TEXT	NOT NULL,
	Professor    	TEXT,      		
	FOREIGN KEY (Professor) REFERENCES User (NAME) ON
    DELETE SET NULL ON UPDATE CASCADE
	);
	
	CREATE TABLE Grade
      	(
	CourseID	INT     NOT NULL	UNIQUE,
	StudentEmail     TEXT    NOT NULL,
      	Grade		Text	NOT NULL,
	PRIMARY KEY(CourseID,StudentEmail),  		
	FOREIGN KEY (StudentEmail) REFERENCES User (Email) ON
    DELETE SET NULL ON UPDATE CASCADE
	);
EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Table created successfully\n";
   }
   $db->close();
?>