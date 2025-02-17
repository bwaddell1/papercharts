<?php

use Illuminate\Support\Facades\Route;

Route::impersonate();

Route::get('/', '\Wave\Http\Controllers\HomeController@index')->name('wave.home');
Route::get('@{username}', '\Wave\Http\Controllers\ProfileController@index')->name('wave.profile');

// Documentation routes
Route::view('docs/{page?}', 'docs::index')->where('page', '(.*)');

// Additional Auth Routes
Route::get('logout', '\Wave\Http\Controllers\Auth\LoginController@logout')->name('wave.logout');
Route::get('user/verify/{verification_code}', '\Wave\Http\Controllers\Auth\RegisterController@verify')->name('verify');
Route::post('register/complete', '\Wave\Http\Controllers\Auth\RegisterController@complete')->name('wave.register-complete');

Route::get('blog', '\Wave\Http\Controllers\BlogController@index')->name('wave.blog');
Route::get('blog/{category}', '\Wave\Http\Controllers\BlogController@category')->name('wave.blog.category');
Route::get('blog/{category}/{post}', '\Wave\Http\Controllers\BlogController@post')->name('wave.blog.post');

Route::view('install', 'wave::install')->name('wave.install');

/***** Pages *****/
Route::get('p/{page}', '\Wave\Http\Controllers\PageController@page');

/***** Pricing Page *****/
Route::view('pricing', 'theme::pricing')->name('wave.pricing');

/***** Billing Routes *****/
Route::post('paddle/webhook', '\Wave\Http\Controllers\WebhookController');
Route::post('checkout', '\Wave\Http\Controllers\SubscriptionController@checkout')->name('checkout');

Route::get('test', '\Wave\Http\Controllers\SubscriptionController@test');

Route::group(['middleware' => 'wave'], function () {
    Route::get('dashboard', '\Wave\Http\Controllers\DashboardController@index')->name('wave.dashboard');
    Route::get('templates', '\Wave\Http\Controllers\TemplateController@index')->name('wave.templates.index');
    Route::get('template/create', '\Wave\Http\Controllers\TemplateController@create')->name('wave.templates.create');
    Route::get('template/edit/{template_id}', [\Wave\Http\Controllers\TemplateController::class, 'edit'])->name('wave.templates.edit');
    Route::get('templates/samples', '\Wave\Http\Controllers\TemplateController@sample')->name('wave.templates.sample');
    Route::get('template/sample/edit/{template_id}', [\Wave\Http\Controllers\TemplateController::class, 'sample_edit'])->name('wave.templates.sample.edit');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('two-factor-challenge', '\Wave\Http\Controllers\DashboardController@twoFactorLogin')->name('wave.two-factor-login');
    Route::get('settings/{section?}', '\Wave\Http\Controllers\SettingsController@index')->name('wave.settings');

    Route::post('settings/profile', '\Wave\Http\Controllers\SettingsController@profilePut')->name('wave.settings.profile.put');
    Route::post('settings/team', '\Wave\Http\Controllers\SettingsController@teamPut')->name('wave.settings.team.put');
    Route::put('settings/security', '\Wave\Http\Controllers\SettingsController@securityPut')->name('wave.settings.security.put');

    Route::post('settings/api', '\Wave\Http\Controllers\SettingsController@apiPost')->name('wave.settings.api.post');
    Route::put('settings/api/{id?}', '\Wave\Http\Controllers\SettingsController@apiPut')->name('wave.settings.api.put');
    Route::delete('settings/api/{id?}', '\Wave\Http\Controllers\SettingsController@apiDelete')->name('wave.settings.api.delete');

    Route::get('settings/invoices/{invoice}', '\Wave\Http\Controllers\SettingsController@invoice')->name('wave.invoice');

    Route::get('notifications', '\Wave\Http\Controllers\NotificationController@index')->name('wave.notifications');
    Route::get('announcements', '\Wave\Http\Controllers\AnnouncementController@index')->name('wave.announcements');
    Route::get('announcement/{id}', '\Wave\Http\Controllers\AnnouncementController@announcement')->name('wave.announcement');
    Route::post('announcements/read', '\Wave\Http\Controllers\AnnouncementController@read')->name('wave.announcements.read');
    Route::get('notifications', '\Wave\Http\Controllers\NotificationController@index')->name('wave.notifications');
    Route::post('notification/read/{id}', '\Wave\Http\Controllers\NotificationController@delete')->name('wave.notification.read');

    /********** Checkout/Billing Routes ***********/
    Route::post('cancel', '\Wave\Http\Controllers\SubscriptionController@cancel')->name('wave.cancel');
    Route::view('checkout/welcome', 'theme::welcome');

    Route::post('subscribe', '\Wave\Http\Controllers\SubscriptionController@subscribe')->name('wave.subscribe');
    Route::view('trial_over', 'theme::trial_over')->name('wave.trial_over');
    Route::view('cancelled', 'theme::cancelled')->name('wave.cancelled');
    Route::post('switch-plans', '\Wave\Http\Controllers\SubscriptionController@switchPlans')->name('wave.switch-plans');
    Route::post('visit', '\App\Http\Controllers\VisitController@createVisit')->name('wave.add-visit');

    Route::post('dropzone/visits/store', '\App\Http\Controllers\VisitController@dropzoneStore')->name('wave.visits.dropzone.store');
    Route::get('dropzone/visits/fetch', '\App\Http\Controllers\VisitController@fetch')->name('wave.visits.dropzone.fetch');
    Route::get('dropzone/visits/delete', '\App\Http\Controllers\VisitController@delete')->name('wave.visits.dropzone.delete');
    Route::post('team/update-role', '\Wave\Http\Controllers\ProfileController@update_role')->name('wave.update-role');
    Route::get('visits/print', '\App\Http\Controllers\VisitController@print')->name('wave.visits.print');
    Route::get('visits/fill-out/{visit_id}', '\App\Http\Controllers\VisitController@fill_out')->name('wave.visits.fill_out');
    Route::get('visits/edit/{visit_id}', '\App\Http\Controllers\VisitController@edit')->name('wave.visits.edit');
    Route::view('profile', 'profile/show')->name('wave.test.profile');

});

Route::group(['middleware' => 'admin.user'], function () {
    Route::view('admin/do', 'wave::do');
});
