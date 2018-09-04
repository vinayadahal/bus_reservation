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
$route['show_ticket/(:any)'] = 'PublicUser/showTicket/$1';

$route['login'] = 'Login/index';
$route['checkLogin'] = 'Login/checkLogin';
$route['logout'] = 'Login/logout';

$route['admin'] = 'admin/index';

$route['admin/slider'] = 'Slider/index';
$route['admin/slider/edit/(:any)'] = 'Slider/editImage/$1';
$route['admin/slider/cropUploadImage'] = 'Slider/cropUploadImage';
$route['admin/slider/activeSlider'] = 'Slider/activeSlider';
$route['admin/slider/addSliderImage'] = 'Slider/addSliderImage';
$route['admin/slider/uploadSliderImage'] = 'Slider/file_uploader';
$route['admin/slider/deleteImage/(:any)'] = 'Slider/deleteImage/$1';

$route['admin/places'] = 'Places/index';
$route['admin/places/(:num)'] = 'Places/index/$1';
$route['admin/places/add'] = 'Places/addPlace';
$route['admin/places/create'] = 'Places/createPlace';
$route['admin/places/edit/(:num)'] = 'Places/editPlace/$1';
$route['admin/places/update'] = 'Places/updatePlace';
$route['admin/places/delete/(:num)'] = 'Places/deletePlace/$1';

$route['admin/travel_agencies'] = 'TravelAgency/index';
$route['admin/travel_agencies/(:num)'] = 'TravelAgency/index/$1';
$route['admin/travel_agencies/add'] = 'TravelAgency/addAgency';
$route['admin/travel_agencies/create'] = 'TravelAgency/createAgency';
$route['admin/travel_agencies/edit/(:num)'] = 'TravelAgency/editAgency/$1';
$route['admin/travel_agencies/update'] = 'TravelAgency/updateAgency';
$route['admin/travel_agencies/delete/(:num)'] = 'TravelAgency/deleteAgency/$1';

$route['admin/agency_admin'] = 'AgencyAdmin/index';
$route['admin/agency_admin/(:num)'] = 'AgencyAdmin/index/$1';
$route['admin/agency_admin/add'] = 'AgencyAdmin/addAgencyAdmin';
$route['admin/agency_admin/create'] = 'AgencyAdmin/createAgency';
$route['admin/agency_admin/edit/(:num)'] = 'AgencyAdmin/editAgency/$1';
$route['admin/agency_admin/update'] = 'AgencyAdmin/updateAgency';
$route['admin/agency_admin/delete/(:num)'] = 'AgencyAdmin/deleteAgency/$1';