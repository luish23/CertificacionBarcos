<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

/**
 * PARA PRUEBAS
 */

$route['welcome']['GET']      = 'Welcome/index';

/*
* ROUTES LOGIN
*/
$route['index']['GET']        = 'Login/index';
$route['login']['POST']       = 'Login/login';
$route['logout']['GET']       = 'Login/logout';

/* 
* ROUTES USERS
*/

$route['listUsers']['GET']          = 'Users/listUsers';
$route['formUsers']['GET']          = 'Users/formUsers';
$route['registerUsers']['POST']     = 'Users/registerUsers';
$route['modalUser']['GET']          = 'Users/modalUser';
$route['modalUserUp']['GET']        = 'Users/modalUserUp';
$route['modalUserDel']['GET']       = 'Users/modalUserDel';
$route['updateUsers']['POST']       = 'Users/updateUsers';
$route['deleteUser']['POST']        = 'Users/deleteUser';

/*
* ROUTES DASHBOARD 
*/

$route['dashboard']['GET']    = 'Dashboard/index';

/*
* ROUTES SHIPOWNER 
*/

$route['shipowner']['GET']           = 'Shipowner/index';
$route['formShipowner']['GET']       = 'Shipowner/formShipowner';
$route['listShipowner']['GET']       = 'Shipowner/listShipowner';
$route['modalShipownerUp']['GET']    = 'Shipowner/modalShipownerUp';
$route['updateShipowner']['POST']    = 'Shipowner/updateShipowner';
$route['registerShipowner']['POST']  = 'Shipowner/registerShipowner';



/* 
* ROUTES EMPLOYEES
*/

$route['listEmployee']['GET']          = 'Employee/listEmployee';
$route['formEmployee']['GET']          = 'Employee/formEmployee';
$route['registerEmployee']['POST']     = 'Employee/registerEmployee';
$route['modalEmployee']['GET']         = 'Employee/modalEmployee';
$route['modalEmployeeUp']['GET']       = 'Employee/modalEmployeeUp';
$route['modalEmployeeDel']['GET']      = 'Employee/modalEmployeeDel';
$route['updateEmployee']['POST']       = 'Employee/updateEmployee';
$route['deleteEmployee']['POST']       = 'Employee/deleteEmployee';

/* 
* ROUTES BOATS
*/
$route['listBoats']['GET']          = 'Boats/listBoat';
$route['formBoat']['GET']           = 'Boats/formBoat';
$route['registerBoat']['POST']      = 'Boats/registerBoat';
$route['modalBoat']['GET']          = 'Boats/modalBoats';
$route['modalBoatUp']['GET']        = 'Boats/modalBoatsUp';
$route['modalBoatDel']['GET']       = 'Boats/modalBoatsDel';
$route['updateBoat']['POST']        = 'Boats/updateBoat';
$route['deleteBoat']['POST']        = 'Boats/deleteBoat';
$route['checkIMO']['POST']          = 'Boats/checkIMO';



/* 
* ROUTES ORDERS
*/
$route['listOrders']['GET']          = 'Orders/listOrder';
$route['formOrder']['GET']           = 'Orders/formOrder';
$route['registerOrder']['POST']      = 'Orders/registerOrder';
$route['modalOrder']['GET']          = 'Orders/modalOrder';
$route['modalOrderUp']['GET']        = 'Orders/modalOrderUp';
$route['modalOrderDel']['GET']       = 'Orders/modalOrderDel';
$route['updateOrder']['POST']        = 'Orders/updateOrder';
$route['deleteOrder']['POST']        = 'Orders/deleteOrder';
$route['veriffOrder']['POST']        = 'Orders/veriffOrder';
$route['checkOrders']['GET']         = 'Orders/checkOrders';
$route['modalValidOrder']['GET']     = 'Orders/modalValidOrder';
$route['processOrder']['POST']       = 'Orders/processOrder';
$route['getVerifications']['POST']   = 'Orders/getVerifications';
$route['updateOrderNS01']['POST']    = 'Orders/updateOrderNS01';
$route['updateOrderNS02']['POST']    = 'Orders/updateOrderNS02';
$route['updateOrderNS03']['POST']    = 'Orders/updateOrderNS03';


/* 
* ROUTES DOWNLOAD
*/
$route['download/(:num)']['GET']          = 'Download/index/$1';


/*
* CERTIFICATIONS 
*/

$route['modalCertificado']['GET']            = 'Certifications/modalCertificado';
$route['generateCertificate']['POST']        = 'Certifications/index';
$route['configCert']['GET']                  = 'Certifications/configCert';
$route['listCerts']['GET']                   = 'Certifications/listCerts';

/**
 * BUSINESS
 */

$route['business']['GET']               = 'Business/index';
$route['listBusiness']['GET']           = 'Business/listBusiness';


/**
 * CRONS
 */

$route['crons']                          = 'Cron/index';
$route['updateExpiration']               = 'Cron/updateExpiration';
