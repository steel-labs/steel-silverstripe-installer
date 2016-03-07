<?php

/* What kind of environment is this: development, test, or live (ie, production)? */
define('SS_ENVIRONMENT_TYPE', 'dev/test/live');
define('STEEL_ENVIRONMENT', 'dev/preprod/prod');

/* Database connection */
define('SS_DATABASE_SERVER', 'localhost');
define('SS_DATABASE_USERNAME', '@__DBName__'); // note: you need to use the root account to run tests!
define('SS_DATABASE_PASSWORD', '@__DBUser__');
define('SS_DATABASE_NAME', '@__DBPsw__');

//set the DB name - this provide backwards compatibility with 2.x and 3.0 sites
global $database;
$database = SS_DATABASE_NAME;

/* Configure a default username and password to access the CMS on all sites in this environment. */
define('SS_DEFAULT_ADMIN_USERNAME', 'admin');
define('SS_DEFAULT_ADMIN_PASSWORD', 'password');

/* Dev email address used to send test emails */
define('DEV_EMAIL_ADDRESS', 'your@email.address');

// Local
global $_FILE_TO_URL_MAPPING;
$_FILE_TO_URL_MAPPING['/vagrant/@__ProjectRoot__'] = 'http://localhost:8080';

// Staging / dev
//$_FILE_TO_URL_MAPPING['/path/to/dev'] = 'http://dev.project.com';

// Prod / live
//$_FILE_TO_URL_MAPPING['/path/to/prod'] = 'http://www.project.com';