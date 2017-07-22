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
// $route['default_controller'] = 'landing';

$route['default_controller'] = 'home';

// Load default conrtoller when have only currency from multilanguage
$route['^(\w{2})$'] = $route['default_controller'];

//Checkout
$route['checkout/successcash'] = 'checkout/successPaymentCashOnD';
$route['(\w{2})/checkout/successcash'] = 'checkout/successPaymentCashOnD';
$route['checkout/successbank'] = 'checkout/successPaymentBank';
$route['(\w{2})/checkout/successbank'] = 'checkout/successPaymentBank';
$route['checkout/paypalpayment'] = 'checkout/paypalPayment';
$route['(\w{2})/checkout/paypalpayment'] = 'checkout/paypalPayment';
$route['checkout/order-error'] = 'checkout/orderError';
$route['(\w{2})/checkout/order-error'] = 'checkout/orderError';

// Ajax called. Functions for managing shopping cart
$route['manageShoppingCart'] = 'home/manageShoppingCart';
$route['(\w{2})/manageShoppingCart'] = 'home/manageShoppingCart';
$route['clearShoppingCart'] = 'home/clearShoppingCart';
$route['(\w{2})/clearShoppingCart'] = 'home/clearShoppingCart';

// home page pagination
$route[rawurlencode('home') . '/(:num)'] = "home/index/$1";
// load javascript language file
$route['loadlanguage/(:any)'] = "Loader/jsFile/$1";
// load default-gradient css
$route['cssloader/(:any)'] = "Loader/cssStyle";

// Template Routes
$route['template/imgs/(:any)'] = "Loader/templateCssImage/$1";
$route['templatecss/imgs/(:any)'] = "Loader/templateCssImage/$1";
$route['templatecss/(:any)'] = "Loader/templateCss/$1";
$route['templatejs/(:any)'] = "Loader/templateJs/$1";

// Products urls style
$route['(:any)_(:num)'] = "home/viewProduct/$2";
$route['(\w{2})/(:any)_(:num)'] = "home/viewProduct/$3";
$route['shop-product_(:num)'] = "home/viewProduct/$3";

// blog urls style and pagination
$route['blog/(:num)'] = "blog/index/$1";
$route['blog/(:any)_(:num)'] = "blog/viewPost/$2";
$route['(\w{2})/blog/(:any)_(:num)'] = "blog/viewPost/$3";

// Shopping cart page
$route['shopping-cart'] = "ShoppingCartPage";
$route['(\w{2})/shopping-cart'] = "ShoppingCartPage";

// Textual Pages links
$route['page/(:any)'] = "page/index/$1";
$route['(\w{2})/page/(:any)'] = "page/index/$2";

// Confirm link
$route['confirm/(:any)'] = "home/confirmLink/$1";

// Site Multilanguage
$route['^(\w{2})/(.*)$'] = '$2';


// PROMOBOX
$route['promobox/(:any)'] = "Promobox/detail";
$route['p/(:any)'] = "Product/detail";
$route['partner/(:any)'] = "Partner/detail";
$route['c/(:any)'] = "Product/category";

$route['(:any)/(:num)/(:num)'] = "Product/category";



$route['(:any)/(:num)/(:num)/(:num)'] = "Product/category";
$route['(:any)/(:num)/(:num)/(:num)/(:num)'] = "Product/category";


// subscribed
$route['subscribed'] = "Product/doSend";

// subscribed
$route['subscribed'] = "Product/doSend";




// review
$route['(:any)/(:num)'] = "Product/category";

// Global Search
$route['global/search'] = "Product/globalSearch";
/*
 * Admin Controllers Route
 */
// HOME / LOGIN
$route['admin'] = "admin/home/login";
// ECOMMERCE GROUP
$route['admin/publish'] = "admin/ecommerce/publish";
$route['admin/publish/(:num)'] = "admin/ecommerce/publish/index/$1";
$route['admin/removeSecondaryImage'] = "admin/ecommerce/publish/removeSecondaryImage";
$route['admin/convertCurrency'] = "admin/ecommerce/publish/convertCurrency";
$route['admin/products'] = "admin/ecommerce/products";
$route['admin/products/(:num)'] = "admin/ecommerce/products/index/$1";
$route['admin/productStatusChange'] = "admin/ecommerce/products/productStatusChange";
$route['admin/shopcategories'] = "admin/ecommerce/ShopCategories";
$route['admin/shopcategories/(:num)'] = "admin/ecommerce/ShopCategories/index/$1";
$route['admin/editshopcategorie'] = "admin/ecommerce/ShopCategories/editShopCategorie";
$route['admin/orders'] = "admin/ecommerce/orders";
$route['admin/orders/(:num)'] = "admin/ecommerce/orders/index/$1";
$route['admin/changeOrdersOrderStatus'] = "admin/ecommerce/orders/changeOrdersOrderStatus";
$route['admin/brands'] = "admin/ecommerce/brands";
$route['admin/changePosition'] = "admin/ecommerce/ShopCategories/changePosition";
// BLOG GROUP
$route['admin/blogpublish'] = "admin/blog/BlogPublish";
$route['admin/blogpublish/(:num)'] = "admin/blog/BlogPublish/index/$1";
$route['admin/blog'] = "admin/blog/blog";
$route['admin/blog/(:num)'] = "admin/blog/blog/index/$1";
// SETTINGS GROUP
$route['admin/settings'] = "admin/settings/settings";
$route['admin/styling'] = "admin/settings/styling";
$route['admin/templates'] = "admin/settings/templates";
$route['admin/titles'] = "admin/settings/titles";
$route['admin/pages'] = "admin/settings/pages";
$route['admin/emails'] = "admin/settings/emails";
$route['admin/emails/(:num)'] = "admin/settings/emails/index/$1";
$route['admin/history'] = "admin/settings/history";
$route['admin/history/(:num)'] = "admin/settings/history/index/$1";
// ADVANCED SETTINGS
$route['admin/languages'] = "admin/advanced_settings/languages";
$route['admin/filemanager'] = "admin/advanced_settings/filemanager";
$route['admin/adminusers'] = "admin/advanced_settings/adminusers";
//DATA BANK
$route['admin/databank'] = "admin/bank/databank";
$route['admin/databank/(:num)'] = "admin/bank/databank/index/$1";

//DATA IDENTITY
$route['admin/identity'] = "admin/bank/identity";
$route['admin/identity/(:num)'] = "admin/bank/identity/index/$1";
//TYPE BUSINESS
$route['admin/business'] = "admin/business/business";
$route['admin/business/(:num)'] = "admin/business/business/index/$1";

//CITY
$route['admin/city'] = "admin/address/city";
$route['admin/city/(:num)'] = "admin/address/city/index/$1";
//PROV
$route['admin/prov'] = "admin/address/prov";
$route['admin/prov/(:num)'] = "admin/address/prov/index/$1";
//DISTRICTS
$route['admin/districts'] = "admin/address/districts";
$route['admin/districts/(:num)'] = "admin/address/districts/index/$1";
//CONFIG
$route['admin/config'] = "admin/advanced_settings/config";
$route['admin/config/(:num)'] = "admin/advanced_settings/config/index/$1";
//POULER CATEGORY
$route['admin/populerCategory'] = "admin/ecommerce/populerCategory";
$route['admin/populerCategory/(:num)'] = "admin/ecommerce/populerCategory/index/$1";
//SUBSCRIBED
$route['admin/subscribed'] = "admin/ecommerce/subscribed";
$route['admin/subscribed/(:num)'] = "admin/ecommerce/subscribed/index/$1";
//PARTNER
$route['admin/partner'] = "admin/ecommerce/partner";
$route['admin/partner/(:num)'] = "admin/ecommerce/partner/index/$1";
//DETAIL STORE
$route['admin/detailStore'] = "admin/store/detailStore";
$route['admin/detailStore/(:num)'] = "admin/store/detailStore/index/$1";
//STORE
$route['admin/store'] = "admin/store/store";
$route['admin/store/(:num)'] = "admin/store/store/index/$1";
//BANK CLIENT
$route['admin/bankclient'] = "admin/bank/bankclient";
$route['admin/bankclient/(:num)'] = "admin/bank/bankclient/index/$1";
//RIVIEW
$route['admin/riview'] = "admin/ecommerce/riview";
$route['admin/riview/(:num)'] = "admin/ecommerce/riview/index/$1";
//WISHLIST
$route['admin/wishlist'] = "admin/ecommerce/wishlist";
$route['admin/wishlist/(:num)'] = "admin/ecommerce/wishlist/index/$1";

// TEXTUAL PAGES
$route['admin/pageedit/(:any)'] = "admin/textual_pages/TextualPages/pageEdit/$1";
$route['admin/changePageStatus'] = "admin/textual_pages/TextualPages/changePageStatus";
// LOGOUT
$route['admin/logout'] = "admin/home/home/logout";


// Admin pass change ajax
$route['admin/changePass'] = "admin/home/home/changePass";
$route['admin/uploadOthersImages'] = "admin/ecommerce/publish/do_upload_others_images";
$route['admin/loadOthersImages'] = "admin/ecommerce/publish/loadOthersImages";


// LOGIN
$route['auth/login'] = "Login";
$route['auth/login/dosave'] = "Login/register";
$route['auth/login/doLogin'] = "Login/doLogin";
$route['auth/logout'] = "Login/doLogout";


$route['api/v1/promobox'] = "api/v1/promoboxs";
$route['api/v1/category'] = "api/v1/category";


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
