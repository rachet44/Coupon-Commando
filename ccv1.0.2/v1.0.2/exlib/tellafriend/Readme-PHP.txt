Introduction:

This document contains instructions on how to configure and install the downloaded ASP application. It assumes that:

1. You have some basic knowledge of server and database technologies.
2. You have a web server where the application will be deployed and if applicable, a database server as well.
3. That your web server is capable of serving the web pages of the script language in which the application is written, in this case ASP.

When you download the application, you should find the following components contained in the zip archive:
 
1. Language specific script files and html template files if you downloaded the template version.
2. A database file or a SQL script file that can be used to recreate the database.
3. A folder containing images if applicable.

Installation:

The installation process is pretty straightforward and requires minimal adjustment of the application files. Proceed as follows:

1. Unzip the files into a folder within your web server hierarchy from where the application will be served. Ensure that the folder name does not have spaces in it. During the process of unzipping, make sure that the files are unzipped to their respective folders. Don't simply open the zip archive and drag all the files to the same folders. For the application to work correctly, some files such as the image files need to be in specific folders.

2. Once you have unzipped the files, the next task is to alter the database connection string to reflect the current location/name of the database. Follow the relevant instructions below depending on the type of connection that you want to use:


Database Connection (mSQL,MSSQL,MySQL,PostgreSQL,Sybase)

(a) Open the file 'common.php' which is in the main folder of your application path.

(b) Look for the connection parameters:  DATABASE_NAME, DATABASE_USER ,DATABASE_PASSWORD , DATABASE_HOST.
! For PHP3 it can be $db->Database,$db->User,$db->Password,$db->Host

(c) Using the guidelines below, change the statement to look something like the example shown below:

//-- Database class
define("DATABASE_NAME","cce_classifieds");
define("DATABASE_USER","cce");
define("DATABASE_PASSWORD","code");
define("DATABASE_HOST","localhost");

where:

DATABASE_NAME: Refers to the database name.
DATABASE_USER and DATABASE_PASSWORD: Used to specify user authentication values. 
DATABASE_HOST: This is the name of computer where database server resides. Default value is localhost.

ODBC connection

To Configure an ODBC connection:

(a) Use the ODBC option in Control Panel to setup a system DSN for the application database. The database file is located in the main folder of the application. In the interest of security, you can and are encouraged to move the database file to a more secure location outside the web server hierarchy. Your application will work fine as long as the DSN you configure points to the correct location of the database file. Ensure that the DSN is a system DSN so that it will be available to all users.

(b) Look for the connection parameters:  DATABASE_NAME, DATABASE_USER ,DATABASE_PASSWORD , DATABASE_HOST 
! For PHP3 it can be $db->Database,$db->User,$db->Password,$db->Host

(c) Using the guidelines below, change the statement to look something like the example shown below:

//-- Database class
define("DATABASE_NAME","cce_classifieds");
define("DATABASE_USER","cce");
define("DATABASE_PASSWORD","code");
define("DATABASE_HOST","localhost");

where:

DATABASE_NAME: Refers to the system DSN.
DATABASE_USER and DATABASE_PASSWORD: Used to specify user authentication values. 
DATABASE_HOST: This is the name of computer where database server resides. Default value is localhost.

Database Connection (Oracle,OracleOCI)
(a) Open the file 'common.php' which is in the main folder of your application path.

(b) Look for the connection parameters:  DATABASE_NAME, DATABASE_USER ,DATABASE_PASSWORD , DATABASE_HOST 
! For PHP3 it can be $db->Database,$db->User,$db->Password,$db->Host

(c) Using the guidelines below, change the statement to look something like the example shown below:

//-- Database class
define("DATABASE_NAME","(DESCRIPTION =    (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = some.host.com)(PORT = 1521)))(CONNECT_DATA =      (SID = CC)))");

define("DATABASE_USER","cce");
define("DATABASE_PASSWORD","code");
define("DATABASE_HOST","");

where:

DATABASE_NAME: Refers to the Oracle connection parameters.Its basic format is:
"(DESCRIPTION =    (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = your.host)(PORT = 1521)))(CONNECT_DATA =      (SID = CC)))". 
where important parameters you have to change are:
HOST : This is the name of computer where Oracle server resides.
PORT: Used to specify port to connect to Oracle server.
SID: This is system identifier (SID). A SID is a unique name for an Oracle database instance that can be up to 64 alphanumeric characters in length.

DATABASE_USER and DATABASE_PASSWORD: Used to specify user authentication values. 
DATABASE_HOST: Leave this field blank for Oracle database.

3. For PHP for Windows do the follwing:

(a) Open php.ini (it can be found in the Windows folder)

(b) Find session.save_path parameter. E.g.:
session.save_path         = C:\Program Files\PHP\sessiondata\    ; argument passed to save_handler

(c) Verify that set as a value for this parameter exists and not a Read-Only  file for the Web-Server.
