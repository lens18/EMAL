<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/admin', function () {
        return view('admin');
    });
});

Route::group(['middleware' => ['role:user|admin|auth|staff|superadmin']], function () {

    Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::post('/viewDetails/{user_id}', [
        'uses' => 'App\Http\Controllers\DashboardController@update_details',
        'as' => 'viewDetails.update'
    ]);

    Route::get('/approvedUser', [\App\Http\Controllers\DashboardController::class, 'approved_user']);


    Route::post('/delete-user', [\App\Http\Controllers\DashboardController::class, 'delete_user']);
    Route::get('/viewDetails/{user_id}', [\App\Http\Controllers\DashboardController::class, 'view_details']);
    Route::post('/upload-doc', [\App\Http\Controllers\DashboardController::class, 'upload_doc']);

    Route::post('/update-password',  [\App\Http\Controllers\DashboardController::class, 'update_password'])->name('update_password');

    Route::get('/viewApplication/{user_id}', [\App\Http\Controllers\ApplicationController::class, 'view_application']);

    Route::get('/material_registration', [\App\Http\Controllers\MaterialRegistrationController::class, 'materialRegistration'])->name('materialRegistration');

    Route::post('/register_material', [\App\Http\Controllers\MaterialRegistrationController::class, 'register_material']);

    Route::get('/view_material', [\App\Http\Controllers\MaterialRegistrationController::class, 'index'])->name('viewMaterial');
    Route::get('/approved_material/{item_sub}', [\App\Http\Controllers\MaterialRegistrationController::class, 'approved_material'])->name('LBarang');
    Route::get('/details_material/{item_name}', [\App\Http\Controllers\MaterialRegistrationController::class, 'details_material'])->name('Barang');
    Route::get('/info_material/{item_id}', [\App\Http\Controllers\MaterialRegistrationController::class, 'info_material']);

    Route::post('/getSubCategory', [\App\Http\Controllers\MaterialRegistrationController::class, 'getSub']);
    Route::post('/getMaterialCategory', [\App\Http\Controllers\MaterialRegistrationController::class, 'getMaterial']);


    Route::get('/view_category', [\App\Http\Controllers\MaterialController::class, 'index']);
    Route::post('/add_category', [\App\Http\Controllers\MaterialController::class, 'add_category']);
    Route::post('/remove_category', [\App\Http\Controllers\MaterialController::class, 'remove_category']);
    Route::post('/remove_subCategory', [\App\Http\Controllers\MaterialController::class, 'remove_subCategory']);
    Route::post('/remove_materialCategory', [\App\Http\Controllers\MaterialController::class, 'remove_materialCategory']);

    //Route::get('/material_registration', [\App\Http\Controllers\MaterialRegistrationController::class, 'category']);
});

Route::group(['middleware' => ['role:admin|auth|staff|superadmin']], function () {

    Route::get('/approval', [\App\Http\Controllers\ApprovalController::class, 'index'])->name('approval');
    Route::post('/delete-user', [\App\Http\Controllers\ApprovalController::class, 'delete_user']);

    Route::get('/pick-up', [\App\Http\Controllers\ApprovalController::class, 'pick_up']); // ambik request

    Route::get('/checked', [\App\Http\Controllers\ApprovalController::class, 'checked']); // semak request
    Route::post('/send-email', [\App\Http\Controllers\ApprovalController::class, 'sendEmail']);

    Route::post('/approve-attachment', [\App\Http\Controllers\ApprovalController::class, 'approve_attachment']);
    Route::post('/reject-attachment', [\App\Http\Controllers\ApprovalController::class, 'reject_attachment']);
    Route::post('/add-comment', [\App\Http\Controllers\ApprovalController::class, 'add_comment']);


    Route::get('/pending', [\App\Http\Controllers\ApprovalController::class, 'pending'])->name('pending');

});

Route::group(['middleware' => ['role:admin|auth|superadmin']], function () {

    Route::get('/adminList', [\App\Http\Controllers\AdminListController::class, 'index'])->name('adminList');
    Route::post('/addPegawai',  [\App\Http\Controllers\AdminListController::class, 'addPegawai']);
    Route::post('/addStaff',  [\App\Http\Controllers\AdminListController::class, 'addStaff']);

});


// Route::group(['middleware' => ['role:user|admin|auth']], function () {

//     Route::get('/staffList', [\App\Http\Controllers\StaffListController::class, 'index'])->name('staffList');

// });

Route::get('/viewApplication/{user_id}', [\App\Http\Controllers\ApplicationController::class, 'view_application']);

Route::get('/logout', [\App\Http\Controllers\HomeController::class, 'logout']);

Route::get('/success-register', function () {
    return view('auth.success-register');
});





require __DIR__ . '/auth.php';
