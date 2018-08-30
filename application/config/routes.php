<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'PublicUser';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['search_bus'] = 'PublicUser/showBuses';
$route['seats/(:num)'] = 'PublicUser/seats/$1';
$route['set_seat'] = 'PublicUser/setSeatSession';
$route['confirm_seat'] = 'PublicUser/confirmSeat';
$route['reserve_seat'] = 'PublicUser/bookSeat';
