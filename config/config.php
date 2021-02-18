<?php

   class MyDB extends SQLite3 
   {
	   /*The first part of the constructor is filename. When it is empty, it creates a temp database.*/
      function __construct( string $filename , int $flags = SQLITE3_OPEN_READWRITE | SQLITE3_OPEN_CREATE , string $encryptionKey = "" )
	  {}
   }
   $db = new MyDB();


   if(!$db) 
   {
      echo $db->lastErrorMsg();
   } 
   else 
   {
      echo "Opened database successfully\n";
   }
   /*Initializing the database*/
   $sql =<<<EOF
      CREATE TABLE USER
      (USERNAME 	TEXT PRIMARY KEY     NOT NULL,
      FNAME           TEXT	    	NOT NULL,
      LNAME           TEXT    	  	NOT NULL,
      DOB	       	 TEXT			NOT NULL,
      PASSWORD        TEXT			NOT NULL,
	  SANSWER		  TEXT			NOT NULL,
	  TYPE			  TEXT			NOT NULL
	  );
	 
      INSERT INTO USER (USERNAME, FNAME, LNAME, DOB, PASSWORD, SANSWER, TYPE)
      VALUES ('Admin', 'John', 'Hoolagan', '2001-05-10 00:00:00', 'Password', 'Bobsmyuncle', 'Admin' );
EOF;


   $ret = $db->exec($sql);
   if(!$ret)
   {
      echo $db->lastErrorMsg();
   } 
   else 
   {
      echo "Config completed successfully\n";
   }
?>