<?php

    global $db;
    $db = new SQLite3("", $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE, $encryptionKey = "");

    if (!$db) {
        echo $db->lastErrorMsg();
    }
    else {
        echo "Opened database successfully\n";
    }

    $sql = <<<EOF
      CREATE TABLE User
      	(
	Email		TEXT 	PRIMARY KEY     NOT NULL	UNIQUE,
	AccountType    	TEXT    NOT NULL,
	Password    	TEXT    NOT NULL,      		
	Name           	TEXT    NOT NULL,
	DOB             DATE,
    Year            INT,
	Rank		    TEXT,
	SQuestion	    TEXT	NOT NULL,
	SAnswer		    TEXT	NOT NULL
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
	FOREIGN KEY (Professor) REFERENCES User (Email) ON
    DELETE SET NULL ON UPDATE CASCADE
	);
    
    	CREATE TABLE CourseEnroll
    	(
	CourseID	INT 	PRIMARY KEY     NOT NULL	UNIQUE,
	StudentName	TEXT    NOT NULL,
	MaxSize    	INT     NOT NULL,		
	FOREIGN KEY (StudentName) REFERENCES User (Email) ON
    		DELETE SET NULL ON UPDATE CASCADE
	);
	
	CREATE TABLE Grade
      	(
	CourseID	INT     NOT NULL	UNIQUE,
	StudentEmail	TEXT    NOT NULL,
    	LetterGrade	Text	NOT NULL,
	PRIMARY KEY(CourseID,StudentEmail),  		
	FOREIGN KEY (StudentEmail) REFERENCES User (Email) ON
    		DELETE SET NULL ON UPDATE CASCADE
	);

/*--------------User Values-----------------*/
	INSERT INTO User (Email, AccountType, Password, Name, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('Admin@email.com', 'Admin', 'Password1', 'John', '2001-05-10', NULL, NULL, 'Favorite Relative?', 'Bobsmyuncle');

	INSERT INTO User (Email, AccountType, Password, Name, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('DrProfessor@email.com', 'Professor', 'Password2', 'DrProfessor', '1932-09-01', NULL, 'Professor', 'Favorite Relative?', 'Notmyuncle');
	
	INSERT INTO User (Email, AccountType, Password, Name, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('Student@email.com', 'Student', 'Password3', 'Pepe', '2002-06-12', '3', NULL, 'Favorite Relative?', 'JoeyBatey');


/*--------------Course Values-----------------*/
	INSERT INTO Course (CourseID, CourseName, Semester, StartTime, EndTime, Location, Professor)
      	VALUES ('123', 'Intro to CyberSecurity', 'Fall 2030', '08:30:00', '09:45:00', 'Building A', 'DrProfessor@email.com');

	INSERT INTO Course (CourseID, CourseName, Semester, StartTime, EndTime, Location, Professor)
      	VALUES ('456', 'Intermediate CyberSecurity', 'Spring 2030', '13:30:00', '14:45:00', 'Building A', 'DrProfessor@email.com');


/*--------------CourseEnroll Values-----------------*/
	INSERT INTO CourseEnroll (CourseID, StudentName, MaxSize)
      	VALUES ('123', 'Student@email.com', '30');

	INSERT INTO CourseEnroll (CourseID, StudentName, MaxSize)
      	VALUES ('456', 'Student@email.com', '30');


/*--------------Grade Values-----------------*/
	INSERT INTO Grade (CourseID, StudentEmail, LetterGrade)
      	VALUES ('123', 'Student@email.com', 'D');

	INSERT INTO Grade (CourseID, StudentEmail, LetterGrade)
      	VALUES ('456', 'Student@email.com', 'F');

EOF;

    $ret = $db->exec($sql);
    echo "Config attempt...\n";
    if (!$ret) 
	{
        echo $db->lastErrorMsg();
    	}
	else
	{
        echo "Table created successfully\n";
    	}


?>