<?php

use App\Http\Controllers\Backend\AdvertisorSliderController;
use App\Http\Controllers\Backend\BackendController;
use App\Http\Controllers\Backend\CardCategoriesController;
use App\Http\Controllers\Backend\CardCodeController;
use App\Http\Controllers\Backend\CardController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CommonQuestionController;
use App\Http\Controllers\Backend\CompanyMenuController;
use App\Http\Controllers\Backend\CountryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CourseCategoriesController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\CurrenciesController;
use App\Http\Controllers\Backend\CustomerAddressController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\LecturersController;
use App\Http\Controllers\Backend\LocaleController;
use App\Http\Controllers\Backend\MainSliderController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\PaymentCategoriesController;
use App\Http\Controllers\Backend\PaymentMethodController;
use App\Http\Controllers\Backend\PaymentMethodOfflineController;
use App\Http\Controllers\Backend\ProductCategoriesController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductReviewController;
use App\Http\Controllers\Backend\ShippingCompanyController;
use App\Http\Controllers\Backend\SiteSettingsController;
use App\Http\Controllers\Backend\StateController;
use App\Http\Controllers\Backend\SupervisorController;
use App\Http\Controllers\Backend\SupportMenuController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\TopicsMenuController;
use App\Http\Controllers\Backend\TracksMenuController;
use App\Http\Controllers\Backend\WebMenuController;
use App\Http\Controllers\Backend\WebMenuHelpController;
use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CustomerController as FrontendCustomerController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\InstructorController;
use App\Models\News;
use Illuminate\Support\Facades\auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['verify' => true]);

// لايقاف الديباجر نضيف هذا الكود
app('debugbar')->disable();

//Frontend 
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/index', [FrontendController::class, 'index'])->name('frontend.index');
Route::get('/home', [FrontendController::class, 'home'])->name('frontend.home');
Route::get('/courses/{slug?}', [FrontendController::class, 'courses'])->name('frontend.courses');
Route::get('/course-single/{course?}', [FrontendController::class, 'course_single'])->name('frontend.course_single');

Route::get('/terms-of-service', [FrontendController::class, 'service'])->name('frontend.service');



Route::group(['middleware' => 'web'], function () {
    Route::get('/card-category/{slug?}', [FrontendController::class, 'card_category'])->name('frontend.card_category');
    Route::get('/card/{slug?}', [FrontendController::class, 'card'])->name('frontend.card');
});
Route::get('/cart', [FrontendController::class, 'cart'])->name('frontend.cart');
Route::get('/wishlist', [FrontendController::class, 'wishlist'])->name('frontend.wishlist');

// Route::get('/checkout',[FrontendController::class,'checkout'])->name('frontend.checkout');


Route::get('/blog', [BlogController::class, 'blog'])->name('frontend.blog');
Route::get('/blog/post/{slug?}', [BlogController::class, 'post'])->name('frontend.blog.post');

// start blog tag
Route::get('/blog/tags/{slug?}', [BlogController::class, 'blog_tag'])->name('frontend.blog_tag');
// end blog tag 

Route::post('currency_load', [CurrenciesController::class, 'currencyLoad'])->name('currency.load');



// this routes is only for customers whom are loged  in my websige
// we add middlewire verified to prefent user to enter his profile and orders before verification email 
Route::group(['middleware' => ['roles', 'role:customer', 'verified']], function () {


    //route for customer profile 
    Route::get('/dashboard', [FrontendCustomerController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/profile', [FrontendCustomerController::class, 'profile'])->name('customer.profile');
    Route::patch('/profile', [FrontendCustomerController::class, 'update_profile'])->name('customer.update_profile');
    Route::get('/profile/remove-image', [FrontendCustomerController::class, 'remove_profile_image'])->name('customer.remove_profile_image');
    Route::get('/addresses', [FrontendCustomerController::class, 'addresses'])->name('customer.addresses');

    Route::get('/orders', [FrontendCustomerController::class, 'orders'])->name('customer.orders');

    Route::group(['middleware' => 'check_cart'], function () {
        Route::get('/checkout', [PaymentController::class, 'checkout'])->name('frontend.checkout');
        Route::post('/checkout/payment', [PaymentController::class, 'checkout_now'])->name('checkout.payment');

        Route::get('/checkout/{order_id}/cancelled', [PaymentController::class, 'cancelled'])->name('checkout.cancel');
        Route::get('/checkout/{order_id}/completed', [PaymentController::class, 'completed'])->name('checkout.complete');
        Route::get('/checkout/webhook/{order?}/{env?}', [PaymentController::class, 'webhook'])->name('checkout.webhook.ipn');

        Route::post('/checkout/paymentIn', [PaymentController::class, 'checkout_in'])->name('checkout.payment_in');
    });
});

//Backend
Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

    //guest to website 
    Route::group(['middleware' => 'guest'], function () {
        Route::get('/login', [BackendController::class, 'login'])->name('login');
        Route::get('/register', [BackendController::class, 'register'])->name('register');
        Route::get('/lock-screen', [BackendController::class, 'lock_screen'])->name('lock-screen');
        Route::get('/recover-password', [BackendController::class, 'recover_password'])->name('recover-password');
    });

    Route::post('/cookie/create/update', [BackendController::class, 'create_update_theme'])->name('create_update_theme');


    //uthenticate to website 
    Route::group(['middleware' => ['roles', 'role:admin|supervisor']], function () {
        Route::get('/', [BackendController::class, 'index'])->name('index2');
        Route::get('/index', [BackendController::class, 'index'])->name('index');


        Route::get('account_settings', [BackendController::class, 'account_settings'])->name('account_settings');
        Route::post('admin/remove-image', [BackendController::class, 'remove_image'])->name('remove_image');
        Route::patch('account_settings', [BackendController::class, 'update_account_settings'])->name('update_account_settings');



        Route::post('product_categories/remove-image', [ProductCategoriesController::class, 'remove_image'])->name('product_categories.remove_image');
        Route::resource('product_categories', ProductCategoriesController::class);


        Route::post('products/remove-image', [ProductController::class, 'remove_image'])->name('products.remove_image');
        Route::resource('products', ProductController::class);

        // Route::post('main_sliders/remove-image', [MainSliderController::class, 'remove_image'])->name('main_sliders.remove_image');
        // Route::resource('main_sliders', MainSliderController::class);


        // Route::post('advertisor_sliders/remove-image', [AdvertisorSliderController::class, 'remove_image'])->name('advertisor_sliders.remove_image');
        // Route::resource('advertisor_sliders', AdvertisorSliderController::class);

        Route::resource('tags', TagController::class);

        Route::post('card_categories/remove-image', [CardCategoriesController::class, 'remove_image'])->name('card_categories.remove_image');
        Route::resource('card_categories', CardCategoriesController::class);

        Route::post('course_categories/remove-image', [CourseCategoriesController::class, 'remove_image'])->name('course_categories.remove_image');
        Route::resource('course_categories', CourseCategoriesController::class);

        Route::post('cards/remove-image', [CardController::class, 'remove_image'])->name('cards.remove_image');
        Route::resource('cards', CardController::class);

        Route::post('courses/remove-image', [CourseController::class, 'remove_image'])->name('courses.remove_image');
        Route::resource('courses', CourseController::class);

        Route::resource('coupons', CouponController::class);


        Route::post('customers/remove-image', [CustomerController::class, 'remove_image'])->name('customers.remove_image');
        Route::get('customers/get_customers', [CustomerController::class, 'get_customers'])->name('customers.get_customers');
        Route::resource('customers', CustomerController::class);

        Route::post('supervisors/remove-image', [SupervisorController::class, 'remove_image'])->name('supervisors.remove_image');
        Route::resource('supervisors', SupervisorController::class);

        Route::post('lecturers/remove-image', [LecturersController::class, 'remove_image'])->name('lecturers.remove_image');
        Route::resource('lecturers', LecturersController::class);


        Route::resource('customer_addresses', CustomerAddressController::class);

        Route::resource('countries', CountryController::class);

        Route::get('states/get_states', [StateController::class, 'get_states'])->name('states.get_states');
        Route::resource('states', StateController::class);

        Route::get('cities/get_cities', [CityController::class, 'get_cities'])->name('cities.get_cities');
        Route::resource('cities', CityController::class);

        Route::resource('shipping_companies', ShippingCompanyController::class);

        Route::resource('product_reviews', ProductReviewController::class);

        Route::post('payment_methods/remove-image', [PaymentMethodController::class, 'remove_image'])->name('payment_methods.remove_image');
        Route::resource('payment_methods', PaymentMethodController::class);

        Route::resource('orders', OrderController::class);

        Route::resource('common_questions', CommonQuestionController::class);

        Route::post('news/remove-image', [NewsController::class, 'remove_image'])->name('news.remove_image');
        Route::resource('news', NewsController::class);

        Route::post('payment_categories/remove-image', [PaymentCategoriesController::class, 'remove_image'])->name('payment_categories.remove_image');
        Route::resource('payment_categories', PaymentCategoriesController::class);

        Route::post('payment_method_offlines/remove-image', [PaymentMethodOfflineController::class, 'remove_image'])->name('payment_method_offlines.remove_image');
        Route::resource('payment_method_offlines', PaymentMethodOfflineController::class);



        // Route::group(['middleware' => 'web'], function (){

        // Route::get('/web_menus/{web_menus}/edit',    [WebMenuController::class, 'edit'])->name('web_menus.edit');
        Route::resource('web_menus', WebMenuController::class);

        // Route::get('/web_menu_helps/{web_menu_helps}/edit',    [WebMenuHelpController::class, 'edit'])->name('web_menu_helps.edit');
        Route::resource('web_menu_helps', WebMenuHelpController::class);

        //company menu 
        Route::resource('company_menus', CompanyMenuController::class);

        //Topics menu 
        Route::resource('topics_menus', TopicsMenuController::class);

        //Topics menu 
        Route::resource('tracks_menus', TracksMenuController::class);

        //Topics menu 
        Route::resource('support_menus', SupportMenuController::class);

        Route::post('main_sliders/remove-image', [MainSliderController::class, 'remove_image'])->name('main_sliders.remove_image');
        Route::resource('main_sliders', MainSliderController::class);

        Route::post('instructor/remove-image', [InstructorController::class, 'remove_image'])->name('instructors.remove_image');
        Route::resource('instructors', InstructorController::class);


        Route::post('advertisor_sliders/remove-image', [AdvertisorSliderController::class, 'remove_image'])->name('advertisor_sliders.remove_image');
        // Route::get('advertisor_sliders/{advertisor_slider}/edit', [AdvertisorSliderController::class, 'edit'])->name('advertisor_sliders.edit');
        Route::resource('advertisor_sliders', AdvertisorSliderController::class);



        // });

        Route::resource('card_codes', CardCodeController::class);
        Route::post('card_codes/custom_codes', [CardCodeController::class, 'store_custom_codes'])->name('card_codes.store_custom_codes');
        Route::post('card_codes/custom_group_codes', [CardCodeController::class, 'store_custom_group_codes'])->name('card_codes.store_custom_group_codes');





        // Route::resource('site_infos' , SiteSettingsController::class);
        Route::get('site_setting/site_infos', [SiteSettingsController::class, 'show_main_informations'])->name('settings.site_main_infos.show');
        Route::post('site_setting/update_site_info/{id?}', [SiteSettingsController::class, 'update_main_informations'])->name('settings.site_main_infos.update');
        Route::post('site_setting/site_infos/remove-image', [SiteSettingsController::class, 'remove_image'])->name('site_infos.remove_image');


        Route::get('site_setting/site_contacts', [SiteSettingsController::class, 'show_contact_informations'])->name('settings.site_contacts.show');
        Route::post('site_setting/update_site_contact/{id?}', [SiteSettingsController::class, 'update_contact_informations'])->name('settings.site_contacts.update');

        Route::get('site_setting/site_socials', [SiteSettingsController::class, 'show_socail_informations'])->name('settings.site_socials.show');
        Route::post('site_setting/update_site_social/{id?}', [SiteSettingsController::class, 'update_social_informations'])->name('settings.site_socials.update');

        Route::get('site_setting/site_metas', [SiteSettingsController::class, 'show_meta_informations'])->name('settings.site_meta.show');
        Route::post('site_setting/update_site_meta/{id?}', [SiteSettingsController::class, 'update_meta_informations'])->name('settings.site_meta.update');

        Route::get('site_setting/site_payment_methods', [SiteSettingsController::class, 'show_payment_method_informations'])->name('settings.site_payment_methods.show');
        Route::post('site_setting/update_site_payment_method/{id?}', [SiteSettingsController::class, 'update_payment_method_informations'])->name('settings.site_payment_methods.update');

        Route::get('site_setting/site_counters', [SiteSettingsController::class, 'show_site_counter_informations'])->name('settings.site_counters.show');
        Route::post('site_setting/update_site_counter/{id?}', [SiteSettingsController::class, 'update_site_counter_informations'])->name('settings.site_counters.update');

        Route::resource('currencies', CurrenciesController::class);
        Route::post('update-currency-status', [CurrenciesController::class, 'updateCurrencyStatus'])->name('currencies.update_currency_status');
    });
});



Route::get('/change-language/{locale}',     [LocaleController::class, 'switch'])->name('change.language');

// Route::post('/cookie/create/update',[BackendController::class , 'create_update_theme'])->name('create_update_theme');
