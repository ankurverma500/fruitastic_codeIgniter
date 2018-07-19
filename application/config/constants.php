<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code



/******* Site constant ***********/
define('SITE_TITLE','Fruitastic');
define("INVALID_LOGIN","Invalid username and password.");
define("WELCOME","WELCOME .");
define('DELETE_MESSAGE', 'Record(s) has been deleted successfully.');
define('ADD_MESSAGE', 'Record has been saved successfully.');
define('ADD_MESSAGE_ERROR', 'Opps sorry !. Record has been not saved successfully. Please try again');
define('UPDATE_MESSAGE', 'Record has been updated successfully.');
define('ERROR_MESSAGE', 'Record is not save.');
define("DELETE_WARN","Are you sure you want to delete this item?");
define("NO_RESULT_FOUND","No result found.");
define('COMPLETED_ANSWER_BACKGROUND_COLOR','#ffffcc');
define('UNCOMPLETED_ANSWER_BACKGROUND_COLOR','#ffcccc');	
define('UPLOAD_DIR',FCPATH."uploads/");
define("dont_permission_to_access_it","Opps sorry !. You don't have permission  to access it.");
define("CART_EMPTY","Oops Sorry!. you have not select any product.");
define("UNAUTHORISED_ACCESS","Opps sorry !. Unauthorised access.");
define("POST_CODE_EMPTY","Oops Sorry!. you have not select any post code please select post code first.");
define("DELIVERY_RUN_EMPTY","Oops Sorry!. you have not select any Run please select Run");
define("ORDER_PLACED","Congratulation your order has been generated successfully , we delivered your product as soon as 
possible, ");
/******* fro notificetion constant ***********/
define('USER','<div class="icon bg-info"> <i class="mdi mdi-account"></i> </div>',true);
define('MESSAGE','<div class="icon bg-danger"> <i class="mdi mdi-comment"></i> </div>',true);
define('SETTING','<div class="icon bg-warning"> <i class="mdi mdi-settings"></i> </div>',true);
define('ORDER','<div class="icon bg-info"> <i class="fa fa-shopping-cart"></i> </div>',true);
define('EMAIL','<div class="icon bg-info"> <i class="fa fa-envelope"></i> </div>',true);
define('DELETED','<div class="icon bg-danger"> <i class="fa fa-trash-o"></i> </div>',true);
define('RUN','<div class="icon bg-danger"> <i class="fa fa-truck"></i> </div>',true);
define('ZIP_CODE','<div class="icon bg-danger"> <i class="fa fa-map-marker"></i> </div>',true);
