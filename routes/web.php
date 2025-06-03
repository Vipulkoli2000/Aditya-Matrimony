<?php
use App\Models\Page;
use App\Models\Pages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\RolesController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\admin\BlocksController;
use App\Http\Controllers\admin\CastesController;
use App\Http\Controllers\admin\CitiesController;
use App\Http\Controllers\admin\StatesController;
use App\Http\Controllers\UserProfilesController;
use App\Http\Controllers\admin\PackagesController;
use App\Http\Controllers\admin\ProfilesController;
use App\Http\Controllers\admin\subCastesController;
use App\Http\Controllers\ProfilePackagesController;
use App\Http\Controllers\admin\PermissionsController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\admin\DashboardController as Enter;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\admin\PagesController As AdminPagesController;
use App\Http\Controllers\RazorpayController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Auth\PasswordResetLinkController;


/*
 * |--------------------------------------------------------------------------
 * | Web Routes
 * |--------------------------------------------------------------------------
 * |
 * | Here is where you can register web routes for your application. These
 * | routes are loaded by the RouteServiceProvider and all of them will
 * | be assigned to the "web" middleware group. Make something great!
 * |
 */

//  foreach($pages as $page) {
//      Route::get($page->slug, function() use($page) {
//          return app('App\Http\Controllers\PagesController')->view($page->id);
//      });
//  }
 
Route::group(['namespace' => 'App\Http\Controllers'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => ['guest']], function () {
        Route::get('/admin', function () {
            return view('auth.admin_login');
        });
    });

    Route::get('/terms-and-conditions', function () {
        return view('default.view.pages.terms_and_conditions');
    })->name('terms_and_conditions');
    Route::get('/disclaimer', function () {
        return view('default.view.pages.disclaimer');
    })->name('disclaimer');
    Route::get('/privacy-policy', function () {
        return view('default.view.pages.privacy_policy');
    })->name('privacy_policy');
    Route::get('/about', function () {
        return view('default.view.pages.about_us');
    })->name('about_us');
    Route::get('/contact-us', function () {
        return view('default.view.pages.contact_us');
    })->name('contact_us');
    Route::get('/wedding-resources', [App\Http\Controllers\ListingController::class, 'weddingResources'])->name('wedding.resources');
    
    

    Route::group(['middleware' => ['auth', 'permission']], function () {
        Route::group(['prefix' => 'users', 'namespace' => 'admin'], function () {
            Route::get('/', 'UsersController@index')->name('users.index');
            Route::get('/create', 'UsersController@create')->name('users.create');
            Route::post('/users/store', 'UsersController@store')->name('users.store');
            Route::get('/{user}/show', 'UsersController@show')->name('users.show');
            Route::get('/{user}/edit', 'UsersController@edit')->name('users.edit');
            Route::patch('/{user}/update', 'UsersController@update')->name('users.update');
            Route::delete('/{user}/destroy', 'UsersController@destroy')->name('users.destroy');
        });

        Route::group(['namespace' => 'admin'], function () {
            Route::get('/user_profiles', 'ProfilesController@index')->name('user_profiles.index');
            Route::get('/user_profiles/{id}/edit', 'ProfilesController@edit')->name('user_profiles.edit');
            Route::delete('/user_profiles/{id}', 'ProfilesController@destroy')->name('user_profiles.destroy');
            Route::put('/user_profiles/{id}', 'ProfilesController@update')->name('user_profiles.update');
            Route::get('/import/user_profiles/', 'ProfilesController@import')->name('user_profiles.import');
            Route::post('import_user_profiles','ProfilesController@importUserProfilesExcel')->name('user_profiles.importUserProfilesExcel');
      
            Route::get('user_profiles/{id}/download', [App\Http\Controllers\admin\ProfilesController::class, 'download'])
    ->name('user_profiles.download');
            // Link to download invoice PDF
            Route::get('user_profiles/{id}/invoice', [App\Http\Controllers\admin\ProfilesController::class, 'downloadInvoice'])
                ->name('user_profiles.download_invoice');

         // New routes for adding a profile/user/member
    Route::get('/user_profiles/create', 'ProfilesController@create')->name('user_profiles.create');
    Route::post('/user_profiles', 'ProfilesController@store')->name('user_profiles.store');
        });

        Route::get('/user/profile/{id}', [UserProfilesController::class, 'show'])->name('user.profile');
        Route::get('/user/showProfile/{id}', [ProfilePackagesController::class, 'showProfile'])->name('user.show_profile');

        Route::get('profile/search', [UserProfilesController::class, 'search'])->name('search.create');
        // Route::post('/search', [SearchController::class, 'search']);
        Route::get('profile/view_profile', [UserProfilesController::class, 'view_profile'])->name('view_profile.create');
        Route::get('profile/user_packages', [UserProfilesController::class, 'user_packages'])->name('user_packages.create');
        Route::post('profile/purchase_packages', [ProfilePackagesController::class, 'purchasePackage'])->name('purchase_packages.store');
        Route::get('profile/basic_details', [UserProfilesController::class, 'basic_details'])->name('basic_details.index');
        Route::get('profile/religious_details', [UserProfilesController::class, 'religious_details'])->name('religious_details.create');
        Route::get('profile/family_details', [UserProfilesController::class, 'family_details'])->name('family_details.create');
        Route::get('profile/astronomy_details', [UserProfilesController::class, 'astronomy_details'])->name('astronomy_details.create');
        Route::get('profile/educational_details', [UserProfilesController::class, 'educational_details'])->name('educational_details.create');
        Route::get('profile/occupation_details', [UserProfilesController::class, 'occupation_details'])->name('occupation_details.create');
        Route::get('profile/contact_details', [UserProfilesController::class, 'contact_details'])->name('contact_details.create');
        Route::get('profile/about_life_partner', [UserProfilesController::class, 'life_partner'])->name('life_partner.create');
        Route::resource('castes', CastesController::class);
        Route::resource('sub_castes', subCastesController::class);
        Route::resource('packages', PackagesController::class);
        Route::resource('blocks', BlocksController::class);
        Route::resource('pages', AdminPagesController::class);
        Route::resource('listing-categories', App\Http\Controllers\admin\ListingCategoriesController::class);
        Route::resource('listing', App\Http\Controllers\ListingController::class);
        Route::get('/import/packages/', [PackagesController::class, 'import'])->name('packages.import');
        Route::post('/import_packages', [PackagesController::class, 'importPackagesExcel'])->name('packages.importPackagesExcel');
        Route::get('refresh_status', [UsersController::class, 'refresh_status'])->name('refresh_status.refresh');

        Route::resource('states', StatesController::class);
        Route::resource('cities', CitiesController::class);
        Route::post('/save-profile', [UserProfilesController::class, 'store'])->name('profiles.store');
        Route::post('/save-basic-details', [UserProfilesController::class, 'basic_details_store'])->name('profiles.basic_details_store');
        Route::post('/save-religious-details.', [UserProfilesController::class, 'religious_details_store'])->name('profiles.religious_details_store');
        Route::post('/save-family-details', [UserProfilesController::class, 'family_details_store'])->name('profiles.family_details_store');
        Route::post('/save-astronomy-details', [UserProfilesController::class, 'astronomy_details_store'])->name('profiles.astronomy_details_store');
        Route::post('/save-educational-details', [UserProfilesController::class, 'educational_details_store'])->name('profiles.educational_details_store');
        Route::post('/add-favorites', [UserProfilesController::class, 'add_favorite'])->name('profiles.add_favorite');
        Route::post('/remove-favorites', [UserProfilesController::class, 'remove_favorite'])->name('profiles.remove_favorite');
        Route::get('profile/view_favorites', [UserProfilesController::class, 'view_favorite'])->name('profiles.view_favorite');
        // Route::get('profile/update_password', [UserProfilesController::class, 'update_password'])->name('profiles.update_password');
        Route::get('profile/view_interested', [ProfilePackagesController::class, 'view_interested'])->name('profiles.view_interested');
        Route::post('/show_interest', [ProfilePackagesController::class, 'show_interest'])->name('profiles.show_interest');
        Route::post('/remove-interest', [UserProfilesController::class, 'remove_interest'])->name('profiles.remove_interest');

        Route::get('/dashboard/load', [DashboardController::class, 'load_users'])->name('dashboard.view_load_users');

        Route::resource('roles', RolesController::class);
        Route::resource('permissions', PermissionsController::class);

        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/admin/expiring-packages', [AdminDashboardController::class, 'showExpiringPackages'])
              ->name('admin.expiring-packages');

              Route::get('/admin/birthdays', [AdminDashboardController::class, 'showBirthdays'])
              ->name('admin.birthdays');
              
        // Reports Routes
        Route::get('/admin/reports/registrations', [ReportController::class, 'registrations'])
              ->name('admin.reports.registrations');
        Route::get('/admin/reports/payments', [ReportController::class, 'payments'])
              ->name('admin.reports.payments');
        Route::get('/admin/reports/expiring-packages', [ReportController::class, 'expiringPackages'])
              ->name('admin.reports.expiring-packages');
        Route::get('/admin/reports/bride-grooms', [ReportController::class, 'brideGrooms'])
              ->name('admin.reports.bride-grooms');
        Route::get('/admin/reports/bride-grooms/export/pdf', [ReportController::class, 'exportBrideGroomsPdf'])
              ->name('admin.reports.bride-grooms.export.pdf');
        Route::get('/admin/reports/bride-grooms/export/excel', [ReportController::class, 'exportBrideGroomsExcel'])
              ->name('admin.reports.bride-grooms.export.excel');
              
        // Report Exports
        Route::get('/admin/reports/registrations/export/pdf', [ReportController::class, 'exportRegistrationsPdf'])
              ->name('admin.reports.registrations.export.pdf');
        Route::get('/admin/reports/registrations/export/excel', [ReportController::class, 'exportRegistrationsExcel'])
              ->name('admin.reports.registrations.export.excel');
        Route::get('/admin/reports/payments/export/pdf', [ReportController::class, 'exportPaymentsPdf'])
              ->name('admin.reports.payments.export.pdf');
        Route::get('/admin/reports/payments/export/excel', [ReportController::class, 'exportPaymentsExcel'])
              ->name('admin.reports.payments.export.excel');
        Route::get('/admin/reports/expiring-packages/export/pdf', [ReportController::class, 'exportExpiringPackagesPdf'])
              ->name('admin.reports.expiring-packages.export.pdf');
        Route::get('/admin/reports/expiring-packages/export/excel', [ReportController::class, 'exportExpiringPackagesExcel'])
              ->name('admin.reports.expiring-packages.export.excel');

            // GET route to display the update password view
Route::get('profile/update_password', [UserProfilesController::class, 'update_password'])
->name('profiles.update_password');

// PUT route to process the password update
Route::put('profile/update_password', [UserProfilesController::class, 'updatePassword'])
->name('profiles.password.update');

Route::get('/generate-invoice/{package}', [UserProfilesController::class, 'generateInvoice'])->name('generate.invoice');

Route::get('/razorpay/pay/{package}', [RazorpayController::class, 'pay'])->name('razorpay.pay');
Route::post('/razorpay/payment', [RazorpayController::class, 'payment'])->name('razorpay.payment');
Route::post('/razorpay/failure', [RazorpayController::class, 'failure'])->name('razorpay.failure');

Route::get('/user/packages/all', [UserProfilesController::class, 'allPurchasedPackages'])
    ->name('all.purchased.packages')
    ->middleware(['auth']);
              
          
        //     return view('admin.dashboard');
        // })->name('admin.dashboard');
    });

    Route::group(['middleware' => ['auth']], function () {
        Route::get('profile', 'ProfileController@index');
        Route::post('profile', 'ProfileController@changePassword')->name('profile.change');
        Route::get('profile/edit/{user}', 'ProfileController@edit')->name('profile.edit');
        Route::post('profile/{user}/update', 'ProfileController@update')->name('profile.update');
    });

    
});


// API route for sending password reset link
Route::post('/api/forgot-password', [PasswordResetLinkController::class, 'sendResetLinkEmailApi'])
    ->middleware('guest') // Ensure only guests can request this, adjust if needed for your API auth
    ->name('api.password.email');

require __DIR__ . '/auth.php';