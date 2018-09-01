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

$route['admin'] = 'admin/index';

$route['admin/slider'] = 'Slider/index';
$route['admin/slider/edit/(:any)'] = 'Slider/editImage/$1';
$route['admin/slider/cropUploadImage'] = 'Slider/cropUploadImage';
$route['admin/slider/activeSlider'] = 'Slider/activeSlider';
$route['admin/slider/addSliderImage'] = 'Slider/addSliderImage';
$route['admin/slider/uploadSliderImage'] = 'Slider/file_uploader';
$route['admin/slider/deleteImage/(:any)'] = 'Slider/deleteImage/$1';