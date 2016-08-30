<?php
/**
 * Created by PhpStorm.
 * User: Daniel
 * Date: 23.08.2016
 * Time: 11:28
 */

/**
 * Import all mapper classes and config file
 */

require_once('classes/customer.inc.php');
require_once('classes/company.inc.php');
require_once('classes/employee.inc.php');
require_once('classes/invoice.inc.php');
require_once('classes/invoicePosition.inc.php');
require_once('classes/number.inc.php');
require_once('classes/pdfArchive.inc.php');
require_once('classes/product.inc.php');
require_once('classes/productcategory.inc.php');
require_once('classes/user.inc.php');
require_once('classes/userRole.inc.php');
require_once('classes/vat.inc.php');



require_once('mapper/datamapper.inc.php');
require_once('mapper/vatmapper.inc.php');
require_once('mapper/productcategorymapper.php');
require_once('mapper/employeemapper.inc.php');
require_once('config.inc.php');
require_once('page.inc.php');


/**
 * Trying to connect to MySQL database
 */
try {
    DataMapper::init(new PDO('mysql:host=' . DB_Host . ';dbname=' . DB_Name,DB_User, DB_Password));
} catch (Exception $e)
{
    echo $e->getMessage();
    die();
}
