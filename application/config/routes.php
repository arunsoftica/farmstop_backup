<?php
defined('BASEPATH') OR exit('No direct script access allowed');



/*
| -------------------------------------------------------------------------
| Sample REST API Routes
| -------------------------------------------------------------------------
*/


/***  Api Routes Start  ***/
//imporvement
$route['api-getBasket'] = 'api/Product/getBasketList';

$route['api-updatedDeviceToken'] = 'api/SignupLoginApi/updateDeviceToken';
$route['api-sign-up'] = 'api/SignupLoginApi/signUp';
$route['api-login'] = 'api/SignupLoginApi/login';
$route['api-social-login'] = 'api/SignupLoginApi/socialLogin';
$route['api-sendOtp'] = 'api/SignupLoginApi/sendOtp';
$route['api-resetPass'] = 'api/SignupLoginApi/resetPassword';
$route['api-uploadProfile'] = 'api/SignupLoginApi/uploadUserImage';
$route['api-updateProfile'] = 'api/SignupLoginApi/updateProfile';
//getting product api's
$route['api-prodtype'] = 'api/Product/getProdVariation';
$route['api-product'] = 'api/Product/getProduct';
$route['api-productByKeyword'] = 'api/Product/getProductBYKeyword';
$route['api-searchByKeyword'] = 'api/Product/searchBYKeyword';
$route['api-check-delivery-loc'] = 'api/SignupLoginApi/checkDeliveryLocation';
$route['api-check-deliveryByZipcode'] = 'api/SignupLoginApi/checkDeliveryByZipcode';

//wish list
$route['api-add-in-wish'] =  'api/Product/addInWishList';
$route['api-get-wishList'] =  'api/Product/getUserWishList';

//coupon code
$route['api-validate-coupnCode/(:any)'] =  'api/Product/validateCoupon/$1';
$route['api-appartment'] = 'api/SignupLoginApi/getAppartment/';
$route['api-check-delivery-on-pincode/(:any)'] = 'api/SignupLoginApi/checkDeliveryOnPincode/$1';

$route['api-validate-coupon'] =  'api/Product/newValidateCoupon';

//cart api
$route['api-setCartItems'] = 'api/Product/setCartItems/';
$route['api-getCartItems'] = 'api/Product/getCartItems/';
$route['api-setCartItemsVariation'] = 'api/Product/setCartItemsVariation/';
$route['api-manageCartItemsQty'] = 'api/Product/manageCartItemsQty/';
$route['api-deleteCartItems'] = 'api/Product/deleteCartItems/';

//generate razor order id
$route['api-create-order-id'] = 'api/OrderController/create_razor_orderId/';
$route['api-verify-order'] = 'api/OrderController/verifyPayment/';
$route['api-place-cod-order'] ='api/OrderController/placedOrderOnCOD/';
//order list 
$route['api-getOrderList'] = 'api/OrderController/getOrderList/';
$route['api-orderDetails'] = 'api/OrderController/getOrderDetails/';

$route['api-get-notification'] = 'api/SignupLoginApi/getNotification/';
$route['api-delete-notification'] = 'api/SignupLoginApi/removeNotification/';

//User Address
$route['api-getUserAddess'] = 'api/SignupLoginApi/getUserAddess/';
$route['api-setUserAddess'] = 'api/SignupLoginApi/setUserAddess/';
$route['api-removeUserAddess'] = 'api/SignupLoginApi/removeUserAddess/';

//
$route['api-getDeliveryDate'] = 'api/SignupLoginApi/getDeliveryDate/';

/***  Api Routes End  ***/

$route['api/cart'] = 'restApiController/add_to_cart';
$route['api/getcart'] = 'restApiController/get_cart';

//$route['logout'] = "Ajaxcontroller/logout";
$route['Ajaxcontroller/(:any)'] = "Ajaxcontroller/page/$1";
$route['(:any)'] = "User/page/$1";
//$route['(:any)/(:any)'] = "User/page2/$1";
/*$route['(:any)'] = "User/page/comingsoon";
$route['(:any)/(:any)'] = "User/page2/comingsoon";*/
$route['subscription'] = "User/page/subscription";
$route['organic-mangoes'] = "User/page/organic-mangos";
$route['organic-mangoes/pre-order'] = "User/page2/organic-mangos";
$route['shop/(:any)'] = "User/page2/shop";

$route['shop'] = "User/page/shop";

$route['organic'] = "User/organic-vegetables";
//https://www.farmstop.in/shop/?c=organic-vegetables
//https://www.farmstop.in/shop/c/organic-vegetables

$route['shop/:c'] = 'shop/c';	


//$route['shop'] = "User/page/shop";
$route['shop/:c'] = 'shop/c';	

//$route['product/(:any)'] = "User/page2/product";
$route['product/(:any)/(:any)'] = "User/page3/product";
$route['cart'] = "User/page/cart";
$route['checkout'] = "User/page/checkout";
$route['my-account'] = "User/page/my-account";
$route['wishlist'] = "User/page/wishlist";
$route['order-list'] = "User/page/order-list";
$route['blog'] = "User/page/blog";
$route['userinvoice'] = "User/page/userinvoice";
$route['about'] = "User/page/about";
$route['contact'] = "User/page/contact";
$route['privacy-policy'] = "User/page/privacy-policy";
$route['fail'] = "User/page/fail";
$route['fbgo'] = "User/page/fbgo";
$route['order-details'] = "User/page/order-details";
$route['page-not-found'] = "User/page/page-not-found";
$route['razor'] = "User/page/razor";
$route['reset-password'] = "User/page/reset-password";
$route['user_invoice'] = "User/page/user_invoice";
$route['user_invoice'] = "User/page/user_invoice";



$route['blog/(:any)'] = "User/page2/blog";
$route['default_controller'] = 'User';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
/*$route['catalog/edit/(:num)'] = "product/update";
update is function product controller*/



