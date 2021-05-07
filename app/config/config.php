<?php
try {
    $GLOBALS['dbPath'] = 'db/persistentconndb.sqlite';

    $db = new SQLite3($GLOBALS['dbPath'], $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE, $encryptionKey = "");

    if (!$db)
    {
        echo $db->lastErrorMsg();
    } else
    {
        //Opened database successfully
    }

    //Set up passwords for hashing
    $passwords = [0 => 'Password1', 1 => 'Password2', 2 => 'Password3', 3 => 'Password4', 4 => 'Password5',
        5 => 'Password6', 6 => 'Password7', 7 => 'Password8', 8 => 'Password9', 9 => 'Password10', 10 => 'Password11',
        11 => 'Password12', 12 => 'Password13', 13 => 'Password14', 14 => 'Password15', 15 => 'Password16',
        16 => 'Password17', 17 => 'Password18', 18 => 'Password19', 19 => 'Password20', 20 => 'Password21',
        21 => 'Password22', 22 => 'Password23', 23 => 'Password24'
    ];

    //Create variables for hashed passwords
    $count = 0; //tracks array index
    $HashedPasswords = [];

    //Hash all the passwords as 80 byte hash using ripemd256
    foreach($passwords as $pass)
    {
        $HashedPasswords[$count] = hash('ripemd256', $pass);
        $count++;
    }

    $sql = <<<EOF
      
CREATE TABLE User
      	(
	UserID	    	INT	    PRIMARY KEY     NOT NULL	UNIQUE,
	Email		    TEXT 	NOT NULL	UNIQUE,
	AccType    	    INT     NOT NULL,
	Password    	TEXT    NOT NULL,      		
	FName          	TEXT    NOT NULL,
	LName           TEXT    NOT NULL,
	DOB		        TEXT	NOT NULL,
    Year		    INT,
	Rank		    TEXT,
	SQuestion	    TEXT	NOT NULL,
	SAnswer		    TEXT	NOT NULL,
	FOREIGN KEY (AccType) REFERENCES Role (RoleID) ON
    		DELETE SET NULL ON UPDATE CASCADE
	);

CREATE TABLE Section
    (
	CRN		        INT 	PRIMARY KEY     NOT NULL	UNIQUE,
	Instructor	    TEXT,
	Course		    TEXT	NOT NULL,
	Semester    	TEXT    NOT NULL,
	SectionLetter	TEXT	NOT NULL,
	StartTime	    TEXT	NOT NULL,
	EndTime		    TEXT	NOT NULL,
	Year		    TEXT	NOT NULL,
    Location    	TEXT	NOT NULL,
	FOREIGN KEY (Course) REFERENCES Course (Code) ON
    		DELETE SET NULL ON UPDATE CASCADE,	    		
	FOREIGN KEY (Instructor) REFERENCES User (UserID) ON
    		DELETE SET NULL ON UPDATE CASCADE
	);
    
CREATE TABLE Enrollment
    	(
	CRN		    INT     NOT NULL,
	StudentID	TEXT    NOT NULL,	
	PRIMARY KEY(CRN,StudentID), 	
	FOREIGN KEY (StudentID) REFERENCES User (UserID) ON
    		DELETE SET NULL ON UPDATE CASCADE,
	FOREIGN KEY (CRN) REFERENCES Section (CRN) ON
    		DELETE SET NULL ON UPDATE CASCADE
	);
	
CREATE TABLE Grade
      	(
	CRN		    INT     NOT NULL,
	StudentID	INT     NOT NULL,
    Grade		TEXT	NOT NULL,
	PRIMARY KEY(CRN,StudentID),  		
	FOREIGN KEY (StudentID) REFERENCES User (UserID) ON
    		DELETE SET NULL ON UPDATE CASCADE,
	FOREIGN KEY (CRN) REFERENCES Section (CRN) ON
    		DELETE SET NULL ON UPDATE CASCADE
	);

CREATE TABLE Course
      	(
	Code		TEXT	PRIMARY KEY 	NOT NULL	UNIQUE,
	CourseName	TEXT	NOT NULL
	);

CREATE TABLE Role
      	(
	RoleID		INT	    PRIMARY KEY 	NOT NULL	UNIQUE,
	Role		TEXT	NOT NULL
	);


BEGIN TRANSACTION;
/*--------------User Values-----------------*/
/*---------Emails must be lowercase---------*/
/*--------UserID must be sequential---------*/
	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000000', 'admin@email.com', '1', '$HashedPasswords[0]', 'John', 'Doe', '1990-12-02', NULL, NULL, 'How many siblings do you have?', '0');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000001', 'scienceguy@email.com', '2', '$HashedPasswords[1]', 'Bill', 'Nye', '1955-11-27', NULL, 'Associate', 'Favorite Relative?', 'Charity Nye');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000002', 'gsinclair@email.com', '2', '$HashedPasswords[2]', 'George', 'Sinclair', '1955-03-08', NULL, 'Adjunct', 'Who is your best friend?', 'Marisol');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000003', 'ssether@email.com', '2', '$HashedPasswords[3]', 'Sean', 'Sether', '1951-03-09', NULL, 'Associate', 'Who is your favorite author?', 'Stephen King');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000004', 'student@email.com', '3', '$HashedPasswords[4]', 'Robert', 'Moody', '1964-04-12', '4', NULL, 'Where were you born?', 'Los Angeles, CA');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000005', 'wmain@email.com', '3', '$HashedPasswords[5]', 'Wallace', 'Main', '1975-06-20', '1', NULL, 'What is your favorite sport?', 'Soccer');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000006', 'dbarney@email.com', '3', '$HashedPasswords[6]', 'Dessie', 'Barney', '1979-01-18', '2', NULL, 'Who is your best friend?', 'Katherine');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000007', 'bcummings@email.com', '3', '$HashedPasswords[7]', 'Bernie', 'Cummings', '1958-07-27', '3', NULL, 'Who is your favorite teacher?', 'Steven Howell');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000008', 'sspangler@email.com', '3', '$HashedPasswords[8]', 'Sandra', 'Spangler', '1962-12-27', '4', NULL, 'What is your favorite sport?', 'Football');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000009', 'jhuse@email.com', '3', '$HashedPasswords[9]', 'Julie', 'Huse', '1990-10-10', '2', NULL, 'Who is your favorite teacher?', 'Dean Montoya');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000010', 'vmcdonald@email.com', '3', '$HashedPasswords[10]', 'Vilma', 'Mcdonald', '1977-03-03', '4', NULL, 'What is your favorite TV show?', 'Seinfeld');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000011', 'ccross@email.com', '3', '$HashedPasswords[11]', 'Curtis', 'Cross', '1990-07-13', '3', NULL, 'Who is your favorite teacher?', 'Rhonda Brown');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000012', 'tsanchez@email.com', '3', '$HashedPasswords[12]', 'Terrance', 'Sanchez', '1973-05-30', '4', NULL, 'What is your favorite TV show?', 'The Office');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000013', 'vmccall@email.com', '3', '$HashedPasswords[13]', 'Virginia', 'McCall', '1971-10-10', '3', NULL, 'Who is your best friend?', 'Charles');
      	
	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000014', 'eburton@email.com', '3', '$HashedPasswords[14]', 'Evelyn', 'Burton', '1981-05-21', '1', NULL, 'Who is your best friend?', 'Delores');
      	
	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000015', 'bprice@email.com', '3', '$HashedPasswords[15]', 'Bo', 'Price', '1969-05-16', '2', NULL, 'Who is your best friend?', 'Ignacio');
      	
	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000016', 'kmorales@email.com', '3', '$HashedPasswords[16]', 'Kelly', 'Morales', '1959-07-09', '2', NULL, 'Who is your favorite teacher?', 'Omar Corbin');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000017', 'whargrove@email.com', '3', '$HashedPasswords[17]', 'Wendell', 'Hargrove', '1971-08-09', '1', NULL, 'What is your favorite TV show?', 'Band of Brothers');
      	
	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000018', 'jdegreenia@email.com', '3', '$HashedPasswords[18]', 'John', 'Degreenia', '1960-01-31', '1', NULL, 'Where did you grow up?', 'Houston,TX');
      	
	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000019', 'dschubert@email.com', '3', '$HashedPasswords[19]', 'David', 'Schubert', '1967-10-20', '3', NULL, 'How many siblings do you have?', '1');
      	
	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000020', 'nsimpson@email.com', '3', '$HashedPasswords[20]', 'Nestor', 'Simpson', '1959-04-09', '1', NULL, 'What is your favorite TV show?', 'Firefly');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000021', 'jneff@email.com', '3', '$HashedPasswords[21]', 'James', 'Neff', '1954-10-18', '1', NULL, 'Who is your favorite author?', 'George Simenon');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000022', 'ejuel@email.com', '3', '$HashedPasswords[22]', 'Edith', 'Juel', '1966-10-11', '3', NULL, 'How many siblings do you have?', '5');

	INSERT INTO User (UserID, Email, AccType, Password, FName, LName, DOB, Year, Rank, SQuestion, SAnswer)
      	VALUES ('927000023', 'brivett@email.com', '3', '$HashedPasswords[23]', 'Barbara', 'Rivett', '1951-11-25', '2', NULL, 'Who is your best friend?', 'Roberto');


/*--------------Course Values-----------------*/
    INSERT INTO Course (Code, CourseName)
    VALUES ('CYBR 2200', 'Intro to CyberSecurity');

    INSERT INTO Course (Code, CourseName)
    VALUES ('CYBR 2480', 'Intermediate CyberSecurity');

    INSERT INTO Course (Code, CourseName)
    VALUES ('CYBR 3501', 'Intermediate CyberSecurity II');


/*--------------Section Values-----------------*/
	INSERT INTO Section (CRN, Instructor, Course,  Semester, SectionLetter, StartTime, EndTime, Year, Location)
      	VALUES ('123', '927000002', 'CYBR 2200' , 'Fall', 'A', '08:30:00', '09:45:00', '2030','Building A');

	INSERT INTO Section (CRN, Instructor, Course,  Semester, SectionLetter, StartTime, EndTime, Year, Location)
      	VALUES ('456', '927000001', 'CYBR 2480', 'Spring', 'A','13:30:00', '14:45:00', '2030', 'Building A');

	INSERT INTO Section (CRN, Instructor, Course,  Semester, SectionLetter, StartTime, EndTime, Year, Location)
      	VALUES ('1233', '927000002', 'CYBR 2480', 'Spring', 'B','15:30:00', '16:45:00', '2030', 'Building 51');

	INSERT INTO Section (CRN, Instructor, Course,  Semester, SectionLetter, StartTime, EndTime, Year, Location)
      	VALUES ('1113', '927000003', 'CYBR 2480', 'Spring', 'C','12:30:00', '13:45:00', '2030', 'Building C');

	INSERT INTO Section (CRN, Instructor, Course,  Semester, SectionLetter, StartTime, EndTime, Year, Location)
      	VALUES ('1343', '927000002', 'CYBR 2200' , 'Fall', 'A', '08:31:00', '09:46:00', '2030','Building X');

	INSERT INTO Section (CRN, Instructor, Course,  Semester, SectionLetter, StartTime, EndTime, Year, Location)
      	VALUES ('1453', '927000001', 'CYBR 3501', 'Spring', 'B','15:30:00', '16:45:00', '2030', 'Building 51');

	INSERT INTO Section (CRN, Instructor, Course,  Semester, SectionLetter, StartTime, EndTime, Year, Location)
      	VALUES ('113', '927000003', 'CYBR 3501', 'Spring', 'C','12:30:00', '13:45:00', '2030', 'Building C');

	INSERT INTO Section (CRN, Instructor, Course,  Semester, SectionLetter, StartTime, EndTime, Year, Location)
      	VALUES ('5000', '927000001', 'CYBR 3501' , 'Fall', 'A', '08:31:00', '09:46:00', '2030','Building X');

/*--------------CourseEnroll Values-----------------*/
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('123', '927000005');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('123', '927000014');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('123', '927000015');      	
      	     	
    INSERT INTO Enrollment (CRN, StudentID)
  	    VALUES ('456', '927000005');
    INSERT INTO Enrollment (CRN, StudentID)
  	    VALUES ('456', '927000015');
    INSERT INTO Enrollment (CRN, StudentID)
  	    VALUES ('456', '927000017');
    INSERT INTO Enrollment (CRN, StudentID)
  	    VALUES ('456', '927000021');
    INSERT INTO Enrollment (CRN, StudentID)
  	    VALUES ('456', '927000022');

	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('1233', '927000006');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('1233', '927000010');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('1233', '927000012');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('1233', '927000014');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('1233', '927000016');

	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('1113', '927000007');      	
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('1113', '927000009');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('1113', '927000018');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('1113', '927000019');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('1113', '927000020');
    
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('1343', '927000004');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('1343', '927000005');
      	
    INSERT INTO Enrollment (CRN, StudentID)
  	    VALUES ('1453', '927000007');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('1453', '927000019');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('1453', '927000008');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('1453', '927000017');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('1453', '927000014');
  	    
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('113', '927000023');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('113', '927000016');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('113', '927000009');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('113', '927000012');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('113', '927000022');

	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('5000', '927000020');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('5000', '927000010');
	INSERT INTO Enrollment (CRN, StudentID)
      	VALUES ('5000', '927000011');

/*--------------Grade Values-----------------*/
	INSERT INTO Grade (CRN, StudentID, Grade)
  	    VALUES ('456', '927000005', 'B');
	INSERT INTO Grade (CRN, StudentID, Grade)
  	    VALUES ('456', '927000015', 'C');
	INSERT INTO Grade (CRN, StudentID, Grade)
  	    VALUES ('456', '927000017', 'A');
	INSERT INTO Grade (CRN, StudentID, Grade)
  	    VALUES ('456', '927000021', 'B');
	INSERT INTO Grade (CRN, StudentID, Grade)
  	    VALUES ('456', '927000022', 'A');

	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('1233', '927000006', 'B');
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('1233', '927000010', 'F');
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('1233', '927000012', 'C');
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('1233', '927000014', 'F');
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('1233', '927000016', 'A');

	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('1113', '927000007', 'B');      	
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('1113', '927000009', 'D');
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('1113', '927000018', 'B');
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('1113', '927000019', 'A');
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('1113', '927000020', 'B');
      	
	INSERT INTO Grade (CRN, StudentID, Grade)
  	    VALUES ('1453', '927000007', 'C');
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('1453', '927000019', 'C');
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('1453', '927000008', 'B');
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('1453', '927000017', 'F');
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('1453', '927000014', 'A');
  	    
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('113', '927000023', 'A');
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('113', '927000016', 'D');
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('113', '927000009', 'C');
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('113', '927000012', 'B');
	INSERT INTO Grade (CRN, StudentID, Grade)
      	VALUES ('113', '927000022', 'F');
      	
/*--------------Role Values-----------------*/
	INSERT INTO Role (RoleID, Role)
      	VALUES ('1', 'Admin');
      	
    INSERT INTO Role (RoleID, Role)
      	VALUES ('2', 'Faculty');
      	
    INSERT INTO Role (RoleID, Role)
      	VALUES ('3', 'Student');
      	
      	END TRANSACTION;
EOF;


    $ret = $db->exec($sql);
    if (!$ret)
    {
        echo $db->lastErrorMsg();
    } else
    {
        //Tables created successfully.
    }
}
catch(Exception $e)
{
    //prepare page for content
    include_once "../src/ErrorHeader.php";

    //Display error information
    echo 'Caught exception: ',  $e->getMessage(), "<br>";
    var_dump($e->getTraceAsString());
    echo 'in '.'http://'. $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']."<br>";

    $allVars = get_defined_vars();
    debug_zval_dump($allVars);
}
?>