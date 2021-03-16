<?php
$GLOBALS['dbPath'] = 'db/persistentconndb.sqlite';

$db = new SQLite3($GLOBALS['dbPath'],  $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , $encryptionKey = "");

if(!$db)
	{
      	echo $db->lastErrorMsg();
   	} 
	else 
	{
      	//echo "Opened database successfully\n";
   	}

   $sql =<<<EOF
      
CREATE TABLE User
      	(
	Email		TEXT 	PRIMARY KEY     NOT NULL	UNIQUE,
	AccountType    	TEXT    NOT NULL,
	Password    	TEXT    NOT NULL,      		
	FName          	TEXT    NOT NULL,
	LName           TEXT    NOT NULL,
	DOB		TEXT	NOT NULL,
      	Year		INT,
	Rank		TEXT,
	SQuestion	TEXT	NOT NULL,
	SAnswer		TEXT	NOT NULL
	);

CREATE TABLE Course
    (
	CourseID	INT 	PRIMARY KEY     NOT NULL	UNIQUE,
	CourseName      TEXT    NOT NULL,
	CourseCode      TEXT    NOT NULL,
	SectionLetter   TEXT    NOT NULL,
	Semester    	TEXT    NOT NULL,
	StartTime	TEXT	NOT NULL,
	EndTime		TEXT	NOT NULL,
    	Location	TEXT	NOT NULL,
	Professor    	TEXT,      		
	FOREIGN KEY (Professor) REFERENCES User (Email) ON
    		DELETE SET NULL ON UPDATE CASCADE
	);
    
CREATE TABLE CourseEnroll
    	(
	CourseID	INT 	PRIMARY KEY     NOT NULL	UNIQUE,
	Student		TEXT    NOT NULL,		
	FOREIGN KEY (Student) REFERENCES User (Email) ON
    		DELETE SET NULL ON UPDATE CASCADE
	FOREIGN KEY (CourseID) REFERENCES Course (CourseID) ON
    		DELETE SET NULL ON UPDATE CASCADE
	);
	
CREATE TABLE Grade
      	(
	CourseID	INT     NOT NULL	UNIQUE,
	StudentEmail	TEXT    NOT NULL,
    	LetterGrade	TEXT	NOT NULL,
	PRIMARY KEY(CourseID,StudentEmail),  		
	FOREIGN KEY (StudentEmail) REFERENCES User (Email) ON
    		DELETE SET NULL ON UPDATE CASCADE
	FOREIGN KEY (CourseID) REFERENCES Course (CourseID) ON
    		DELETE SET NULL ON UPDATE CASCADE
	);


/*--------------User Values-----------------*/
/*---------Emails must be lowercase---------*/
	INSERT INTO User (Email, AccountType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('admin@email.com', 'Admin', 'Password1', 'John', 'Doe', '2001-05-10', NULL, NULL, 'Favorite Relative?', 'Bobsmyuncle');

	INSERT INTO User (Email, AccountType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('scienceguy@email.com', 'Faculty', 'Password2', 'Bill', 'Nye', '1955-11-27', NULL, 'Associate Professor', 'Favorite Relative?', 'Charity Nye');
	
	INSERT INTO User (Email, AccountType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('student@email.com', 'Student', 'Password3', 'Pepe', 'Frog', '2002-06-12', '3', NULL, 'Favorite Relative?', 'JoeyBatey');

	INSERT INTO User (Email, AccountType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('student2@email.com', 'Student', 'Password4', 'Pepe', 'Le Pew', '2002-06-12', '3', NULL, 'Favorite Relative?', 'PituLePew');

/*--------------Course Values-----------------*/
	INSERT INTO Course (CourseID, CourseName, CourseCode, SectionLetter, Semester, StartTime, EndTime, Location, Professor)
      	VALUES ('123', 'Intro to CyberSecurity', 'CYBR2200' , 'A', 'Fall 2030', '08:30:00', '09:45:00', 'Building A', 'DrProfessor@email.com');

	INSERT INTO Course (CourseID, CourseName, CourseCode, SectionLetter, Semester, StartTime, EndTime, Location, Professor)
      	VALUES ('456', 'Intermediate CyberSecurity', 'CYBR2480' ,'B', 'Spring 2030', '13:30:00', '14:45:00', 'Building A', 'DrProfessor@email.com');


/*--------------CourseEnroll Values-----------------*/
	INSERT INTO CourseEnroll (CourseID, Student)
      	VALUES ('123', 'student@email.com');

	INSERT INTO CourseEnroll (CourseID, Student)
      	VALUES ('456', 'student@email.com');


/*--------------Grade Values-----------------*/
	INSERT INTO Grade (CourseID, StudentEmail, LetterGrade)
      	VALUES ('123', 'student@email.com', 'D');

	INSERT INTO Grade (CourseID, StudentEmail, LetterGrade)
      	VALUES ('456', 'student@email.com', 'F');

EOF;

    $ret = $db->exec($sql);
    //echo "Config attempt...\n";
    if (!$ret) 
	{
        echo $db->lastErrorMsg();
	}
	else
    {
        // echo "Table created successfully\n";
    }

?>