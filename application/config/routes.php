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

$route['article/commenter'] = 'article/submit_comment';
$route['article/search'] = 'article/search';
$route['article/commentaire/like'] = 'article/like_comment';
$route['article/like'] = 'article/like_article';
$route['article/commentaire/delete'] = 'article/delete_comment';
$route['article/commentaire/edition'] = 'article/edit_comment';
$route['article/page/(:any)'] = 'article/search';
$route['default_controller'] = 'article';
$route['article/(:any)'] = 'article/show_article';
$route['administration/articles/page/(:any)'] = 'article/index';
$route['revue'] = 'revue/index';
$route['revue/archives/(:any)'] = 'revue/archive';
$route['inscription'] = 'login/signup_page';
$route['inscription/validation'] = 'login/signup';
$route['connexion'] = 'login/index';
$route['connexion/validation'] = 'login/login';
$route['inscription/verify/(:any)'] = 'login/email_confirmation';
$route['deconnexion'] = 'login/logout';

$route['administration/dashboard'] = 'dashboard/index';
$route['administration/users'] = 'usermanager/users';
$route['administration/users/page/(:any)'] = 'usermanager/users';
$route['administration/users/update'] = 'usermanager/update_user';
$route['administration/users/add'] = 'usermanager/create_user';
$route['administration/users/delete'] = 'usermanager/delete_user';

$route['administration/articles'] = 'articlemanager/article_list';
$route['administration/articles/page/(:any)'] = 'articlemanager/article_list';
$route['administration/articles/new'] = 'articlemanager/article_creation_page';
$route['administration/articles/create'] = 'articlemanager/create_article';
$route['administration/articles/edition/(:any)'] = 'articlemanager/edit_article_page';
$route['administration/articles/submit/(:any)'] = 'articlemanager/edit_article';
$route['administration/articles/delete'] = 'articlemanager/delete_article';

$route['administration/file-manager'] = 'filemanager/file_manager_page';
$route['administration/file-manager/upload'] = 'filemanager/upload';
$route['administration/file-manager/delete'] = 'filemanager/file_manager_delete';

$route['administration/revue-manager'] = 'filemanager/revue_manager_page';
$route['administration/revue-manager/upload'] = 'filemanager/upload_revue';
$route['administration/revue-manager/delete'] = 'filemanager/revue_manager_delete';

$route['administration/categories'] = 'categorie/category_page';
$route['administration/categories/page/(:any)'] = 'categorie/category_page';
$route['administration/categories/add'] = 'categorie/add_category';
$route['administration/categories/edit'] = 'categorie/edit_category';
$route['administration/categories/delete'] = 'categorie/delete_category';

$route['administration/hashtags'] = 'hashtags/hashtag_page';
$route['administration/hashtags/page/(:any)'] = 'hashtags/hashtag_page';
$route['administration/hashtags/add'] = 'hashtags/add_hashtag';
$route['administration/hashtags/edit'] = 'hashtags/edit_hashtag';
$route['administration/hashtags/delete'] = 'hashtags/delete_hashtag';

$route['mon-compte'] = 'compte/index';
$route['mon-compte/article/edition/(:any)'] = 'compte/edit_article_page';
$route['mon-compte/article/edition/submit/(:any)'] = 'compte/edit_article';
$route['mon-compte/article/submit'] = 'compte/article_creation_page';
$route['mon-compte/article/create'] = 'compte/create_article';
$route['mon-compte/upload'] = 'compte/upload';
$route['mon-compte/user/update'] = 'compte/edit_info';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
