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
$route['default_controller'] = 'auths';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


//For Employee
$route['employee'] = 'employees';
$route['employee/approve/(:any)'] = 'employees/approves/f_approve_$1';
$route['employee/(:any)/(:any)'] = 'employees/f_$1_$2';
$route['employee/(:any)'] = 'employees/f_$1';

//For Employee Assign
$route['employees/assign'] = 'employees/assigns';
$route['employees/assign/(:any)'] = 'employees/assigns/f_$1';

//For Department
$route['department'] = 'departments';
$route['department/approve/(:any)'] = 'departments/approves/f_approve_$1';
$route['department/(:any)/(:any)'] = 'departments/f_$1_$2';
$route['department/(:any)'] = 'departments/f_$1';

//For Profile
$route['profile'] = 'profiles';
$route['profile/approve/(:any)'] = 'profiles/approves/f_approve_$1';
$route['profile/(:any)/(:any)'] = 'profiles/f_$1_$2';
$route['profile/(:any)'] = 'profiles/f_$1';

//For Leave
$route['leave'] = 'leaves';

$route['leave/recommend'] = 'leaves/recommends';
$route['leave/recommend/(:any)'] = 'leaves/recommends/f_$1';

$route['leave/approve'] = 'leaves/approves';
$route['leave/approve/(:any)'] = 'leaves/approves/f_$1';

$route['leave/compoff'] = 'leaves/compOffs';
$route['leave/compoff/(:any)'] = 'leaves/compOffs/f_$1';

$route['leave/half'] = 'leaves/halfs';
$route['leave/half/(:any)'] = 'leaves/halfs/f_$1';

$route['leave/compoffhalf'] = 'leaves/compOffHalfs';
$route['leave/compoffhalf/(:any)'] = 'leaves/compOffHalfs/f_$1';

$route['leave/comprecommend'] = 'leaves/compRecommends';
$route['leave/comprecommend/(:any)'] = 'leaves/compRecommends/f_$1';

$route['leave/compapprove'] = 'leaves/compApproves';
$route['leave/compapprove/(:any)'] = 'leaves/compApproves/f_$1';

$route['leave/forwardleaves'] = 'leaves/forwardLeaves';
$route['leave/forwardleaves/(:any)'] = 'leaves/forwardLeaves/f_$1';

$route['leave/reject'] = 'leaves/rejects';
$route['leave/reject/(:any)'] = 'leaves/rejects/f_$1';

$route['leave/(:any)/(:any)'] = 'leaves/f_$1_$2';
$route['leave/(:any)'] = 'leaves/f_$1';

//For Payroll
$route['payroll'] = 'payrolls';

$route['payroll/payslipdetails'] = 'payrolls/f_payslipdetails';
$route['payroll/payment'] = 'payrolls/f_payment';

$route['payroll/payslipgeneration'] = 'payrolls/payslipGenerations';
$route['payroll/payslipgeneration/(:any)'] = 'payrolls/payslipGenerations/f_$1';

$route['payroll/(:any)/(:any)'] = 'payrolls/$1/f_$2';
$route['payroll/(:any)'] = 'payrolls/$1';

//For Attendance
$route['attendance'] = 'attendances';
$route['attendance/(:any)'] = 'attendances/f_$1';
$route['attendance/report/(:any)-emp'] = 'attendances/reports/f_$1_emp';

$route['attendance/(:any)/(:any)'] = 'attendances/$1/f_$2';
$route['attendance/(:any)'] = 'attendances/$1';