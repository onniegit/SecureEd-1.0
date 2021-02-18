<?php
   class MyDB extends SQLite3 {
      function __construct() {
         $this->open('Secure.db');
      }
   }
   $db = new SecureDB();
   if(!$db) {
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully\n";
   }

   $sql =<<<EOF
      CREATE TABLE User
      	(
	Email		TEXT 	PRIMARY KEY     NOT NULL	UNIQUE,
	Account_type    TEXT    NOT NULL,
	Password    	TEXT    NOT NULL,      		
	Name           	TEXT    NOT NULL,
	DOB		DATE,
      	Year		TEXT,
	Rank		TEXT,
	SecQuestion	TEXT	NOT NULL,
	SecAnswer	TEXT	NOT NULL
	);
      
	CREATE TABLE Course
      	(
	CourseID	INT 	PRIMARY KEY     NOT NULL	UNIQUE,
	CourseName      TEXT    NOT NULL,
	Semester    	TEXT    NOT NULL,
      	Location	TEXT	NOT NULL,
	Professor    	TEXT,      		
	FOREIGN KEY (Professor) REFERENCES User (NAME) ON
    DELETE SET NULL ON UPDATE CASCADE
	);
	CREATE TABLE Grades
      	(
	CourseID	INT     NOT NULL	UNIQUE,
	StudentName     TEXT    NOT NULL,
      	Grade		Text	NOT NULL,
	PRIMARY KEY(CourseID,StudentName),
     		
	FOREIGN KEY (StudentName) REFERENCES User (NAME) ON
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