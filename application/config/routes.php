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
$route['admin/agency_admin/create'] = 'AgencyAdmin/createAgencyAdmin';
$route['admin/agency_admin/edit/(:num)'] = 'AgencyAdmin/editAgencyAdmin/$1';
$route['admin/agency_admin/update'] = 'AgencyAdmin/updateAgencyAdmin';
$route['admin/agency_admin/delete/(:num)'] = 'AgencyAdmin/deleteAgencyAdmin/$1';

$route['admin/settings'] = 'SettingsAdmin/index';
$route['admin/settings/updateUser'] = 'SettingsAdmin/updateUser';

$route['member'] = 'Member/index';
$route['member/home'] = 'Member/index';
$route['member/schedules'] = 'Schedules/index';
$route['member/schedules/(:num)'] = 'Schedules/index/$1';
$route['member/schedules/add'] = 'Schedules/addSchedule';
$route['member/schedules/create'] = 'Schedules/createSchedule';
$route['member/schedules/edit/(:num)'] = 'Schedules/editSchedule/$1';
$route['member/schedules/update'] = 'Schedules/updateSchedule';
$route['member/schedules/delete/(:num)'] = 'Schedules/deleteSchedule/$1';

$route['member/buses'] = 'Buses/index';
$route['member/buses/(:num)'] = 'Buses/index/$1';
$route['member/buses/add'] = 'Buses/addBus';
$route['member/buses/create'] = 'Buses/createBus';
$route['member/buses/edit/(:num)'] = 'Buses/editBus/$1';
$route['member/buses/update'] = 'Buses/updateBus';
$route['member/buses/delete/(:num)'] = 'Buses/deleteBus/$1';

$route['member/tickets'] = 'Tickets/index';
$route['member/tickets/(:num)'] = 'Tickets/index/$1';

$route['member/settings'] = 'Settings/index';
$route['member/settings/updateUser'] = 'Settings/updateUser';

$route['member/users'] = 'Users/index';
$route['member/users/(:num)'] = 'Users/index/$1';
