<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|    example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|    https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|    $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|    $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|    $route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:    my-controller/index    -> my_controller/index
|        my-controller/my-method    -> my_controller/my_method
 */
$route['default_controller']   = 'admin';
$route['404_override']         = '';
$route['translate_uri_dashes'] = false;

/* Admin Panel Routes */
$route['dashboard'] = 'admin/index';

# Subject
$route['subject']['get']                  = 'subject/index';
$route['subject/edit/(:num)']             = 'subject/edit/$1';
$route['subject/update/(:num)']['post']   = 'subject/update/$1';
$route['subject/delete/(:num)']['delete'] = 'subject/delete/$1';
$route['subject/new']                     = 'subject/add';
$route['subject']['post']                 = 'subject/add';

# Chapter
$route['chapter/(:num)?']['get']          = 'chapter/index/$1';
$route['chapter/edit/(:num)']             = 'chapter/edit/$1';
$route['chapter/update/(:num)']['post']   = 'chapter/update/$1';
$route['chapter/delete/(:num)']['delete'] = 'chapter/delete/$1';
$route['chapter/new']                     = 'chapter/add';
$route['chapter']['post']                 = 'chapter/add';

# Test
$route['test/(:num)?']['get']          = 'test/index/$1';
$route['test/edit/(:num)']             = 'test/edit/$1';
$route['test/update/(:num)']['post']   = 'test/update/$1';
$route['test/delete/(:num)']['delete'] = 'test/delete/$1';
$route['test/new']                     = 'test/add';
$route['test']['post']                 = 'test/add';

# Question
$route['question/(:num)?']['get']          = 'question/index/$1';
$route['question/edit/(:num)']             = 'question/edit/$1';
$route['question/update/(:num)']['post']   = 'question/update/$1';
$route['question/delete/(:num)']['delete'] = 'question/delete/$1';
$route['question/new']                     = 'question/add';
$route['question']['post']                 = 'question/add';
$route['question/imgUpload']['post']       = 'question/imgUpload';
$route['question/import']['post']          = 'question/import';

# REST API Routes
$route['subjects']['get']  = 'subject/getSubjects';
$route['chapters']['get']  = 'chapter/getChapters';
$route['tests']['get']     = 'test/getTests';
$route['questions']['get'] = 'question/getQuestions';
$route['user']['post']     = 'user/insert';
$route['user/otp']['post'] = 'user/otp';
