<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Home::index');
$routes->get('/', 'Tweet::index', ['filter'=>'cekLogin']);
$routes->get('/profil/(:alphanum)', 'Profil::profil/$1', ['filter'=>'cekLogin']);
$routes->get('/profil', 'Profil::salah', ['filter'=>'cekLogin']);

$routes->get('/profil/ubah-profil/(:alphanum)', 'Profil::ubahprofils/$1', ['filter'=>'cekLogin']);
$routes->post('/profil/ubah-profil/(:num)', 'Profil::ubahprofil/$1', ['filter'=>'cekLogin']);

$routes->get('/category/(:segment)', 'Tweet::category/$1', ['filter'=>'cekLogin']);

$routes->get('/add', 'Tweet::addForm', ['filter'=>'cekLogin']);
$routes->post('/add', 'Tweet::addTweet', ['filter'=>'cekLogin']);
$routes->get('/delete/(:num)', 'Tweet::delTweet/$1', ['filter'=>'cekLogin']);

$routes->get('/edit/(:num)', 'Tweet::editForm/$1', ['filter'=>'cekLogin']);
$routes->post('/edit/(:num)', 'Tweet::editTweet/$1', ['filter'=>'cekLogin']);

$routes->get('/detail/(:num)', 'Tweet::detail/$1', ['filter'=>'cekLogin']);
$routes->get('/detail/(:num)', 'Tweet::viewsKomen/$1', ['filter'=>'cekLogin']);

$routes->get('/auth', 'Auth::index');
$routes->get('/register', 'Auth::register');
$routes->post('/add_user', 'Auth::addUser');

$routes->get('/logout', 'Auth::logout');
$routes->post('/login', 'Auth::login');

$routes->get('/addlike/(:num)/(:num)', 'Tweet::addLike/$1/$2', ['filter'=>'cekLogin']);
$routes->post('/addkomens/(:num)', 'Tweet::addKomen/$1', ['filter'=>'cekLogin']);
$routes->post('/addreply/(:num)', 'Tweet::addReply/$1', ['filter'=>'cekLogin']);
//routes->post('/addlike/(:num)/(:num)', 'Tweet::addLike/$1/$2', ['as' => 'addlike']);


//gantipassforgot
$routes->get('/lupa-password', 'Auth::lupapas');
$routes->post('/lupa-password/sendlink', 'Auth::sendResetLink');
$routes->get('/lupa-password/ganti-password/(:segment)', 'Auth::resetPass/$1');
$routes->post('/lupa-password/ganti-password', 'Auth::updatePassword');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
