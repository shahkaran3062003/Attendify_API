<?php


// defining constant paths for project
defined("DS") ? null : define("DS", DIRECTORY_SEPARATOR);
defined("SITE_ROOT") ? null : define("SITE_ROOT", DS . 'xampp' . DS . 'htdocs' . DS . 'ATTENDIFY_API');
defined("PORJECT_PATH") ? null : define("PROJECT_PATH", '.' . DS . 'ATTENDIFY_API');
defined("INC_PATH") ? null : define("INC_PATH", SITE_ROOT . DS . 'includes');
defined("CORE_PATH") ? null : define("CORE_PATH", SITE_ROOT . DS . 'core');
defined("PROFILEPIC_DIR_PATH") ? null : define("PROFILEPIC_DIR_PATH", SITE_ROOT . DS . 'static' . DS . 'profilePic');

// load confige file first;
require_once(INC_PATH . DS . "config.php");

// load core classes;
require_once(CORE_PATH . DS . "teacher.php");
require_once(CORE_PATH . DS . "student.php");
require_once(CORE_PATH . DS . "class.php");
require_once(CORE_PATH . DS . "attendance.php");
