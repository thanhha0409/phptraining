<?php

define('SESSION_TYPE', 'PHP'); // PHP or MYSQL

if (! defined('DOMAIN_NAME')) {
    define('DOMAIN_NAME', 'example.dev');
}

class Config
{
    static public $debug = true;
    static public $viewDirs = array("../view");

    static public $mysqlMasterCnf = array();
    static public $mysqlSlaveCnf = array();
    static public $mysqlTableMap = array();

    static public $defaultTimezone;
    static public $defaultFrontendTimezone;
    static public $defaultBackendTimezone;
    static public $defaultDateLine;

    const SALT = 'w8qywqyhfg98sytg983gdhfsoh984rasf090';



    /* @deprecated */
    static public $useMockService = false;
    /* @deprecated */
    static public $useMockModel = false;
    /* @deprecated */
    static public $clientType;

    /* @deprecated */
    const MOBILE = 1;
    /* @deprecated */
    const SMART_PHONE = 2;
    /* @deprecated */
    const PC = 3;
    /* @deprecated */
    const IPHONE = 4;
}
