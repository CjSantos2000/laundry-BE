<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Customer\CustomerAuthController;
use App\Http\Controllers\Customer\CustomerAccountController;
use App\Http\Controllers\Customer\CustomerCartController;
use App\Http\Controllers\Customer\CustomerTransactionController;
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CustomerFeedbackController;
use App\Http\Controllers\Customer\CustomerServiceController;
use App\Http\Controllers\Customer\CustomerAdditionalServiceController;

use App\Http\Controllers\Rider\RiderAuthController;
use App\Http\Controllers\Rider\RiderAccountController;

use App\Http\Controllers\ShopAdmin\ShopAdminAuthController;
use App\Http\Controllers\ShopAdmin\ShopAdminAccountController;
use App\Http\Controllers\ShopAdmin\ShopAdminRiderController;
use App\Http\Controllers\ShopAdmin\ShopAdminStaffController;
use App\Http\Controllers\ShopAdmin\ShopAdminMachineController;
use App\Http\Controllers\ShopAdmin\ShopAdminServiceController;
use App\Http\Controllers\ShopAdmin\ShopAdminAdditionalServiceController;

use App\Http\Controllers\Staff\StaffAuthController;
use App\Http\Controllers\Staff\StaffAccountController;
use App\Http\Controllers\Staff\StaffTransactionController;
use App\Http\Controllers\Staff\StaffCartController;
use App\Http\Controllers\Staff\StaffServiceController;
use App\Http\Controllers\Staff\StaffAdditionalServiceController;
use App\Http\Controllers\Staff\StaffInventoryController;
use App\Http\Controllers\Staff\StaffSellingItemController;

use App\Http\Controllers\SuperAdmin\SuperAdminAuthController;
use App\Http\Controllers\SuperAdmin\SuperAdminAccountController;
use App\Http\Controllers\SuperAdmin\SuperAdminShopAdminController;


Route::prefix('customers')->group(function () {
    Route::get('/test', [CustomerAuthController::class, 'test'])->name('customers.test');
    Route::post('/login', [CustomerAuthController::class, 'login'])->name('customers.login');
    Route::post('/register', [CustomerAuthController::class, 'register'])->name('customers.register');
});

Route::prefix('riders')->group(function () {
    Route::get('/test', [RiderAuthController::class, 'test'])->name('riders.test');
    Route::post('/login', [RiderAuthController::class, 'login'])->name('riders.login');
});

Route::prefix('staffs')->group(function () {
    Route::get('/test', [StaffAuthController::class, 'test'])->name('staffs.test');
    Route::post('/login', [StaffAuthController::class, 'login'])->name('staffs.login');
});

Route::prefix('shop_admins')->group(function () {
    Route::get('/test', [ShopAdminAuthController::class, 'test'])->name('shop_admins.test');
    Route::post('/login', [ShopAdminAuthController::class, 'login'])->name('shop_admins.login');
    Route::post('/register', [ShopAdminAuthController::class, 'register'])->name('shop_admins.register');
});

Route::prefix('super_admins')->group(function () {
    Route::get('/test', [SuperAdminAuthController::class, 'test'])->name('super_admins.test');
    Route::post('/login', [SuperAdminAuthController::class, 'login'])->name('super_admins.login');
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::prefix('customers')->group(function () {
        Route::get('/index', [CustomerAuthController::class, 'index'])->name('customers.index');

        Route::get('/shop_admins', [CustomerDashboardController::class, 'index'])->name('customers.shop_admins');

        Route::get('/cart', [CustomerCartController::class, 'index'])->name('customers.cart');
        Route::post('/cart/add', [CustomerCartController::class, 'add'])->name('customers.cart.add');
        Route::delete('/cart/{id}', [CustomerCartController::class, 'delete'])->name('customers.cart.delete');

        Route::get('/transactions', [CustomerTransactionController::class, 'index'])->name('customers.transactions');
        Route::post('/transactions/add', [CustomerTransactionController::class, 'add'])->name('customers.transactions.add');
        Route::get('/transactions/{id}', [CustomerTransactionController::class, 'single'])->name('customers.transactions.single');

        Route::get('/feedback', [CustomerFeedbackController::class, 'index'])->name('customers.feedback');
        Route::post('/feedback/add', [CustomerFeedbackController::class, 'add'])->name('customers.feedback.add');
        Route::delete('/feedback/{id}', [CustomerFeedbackController::class, 'delete'])->name('customers.feedback.delete');

        Route::get('/services/{id}', [CustomerServiceController::class, 'index'])->name('customers.services');
        Route::get('/additional-services/{id}', [CustomerAdditionalServiceController::class, 'index'])->name('customers.additional-services');

        Route::get('/machines/{id}', [CustomerCartController::class, 'machines'])->name('customers.machines');  

        Route::post('/edit-profile', [CustomerAccountController::class, 'editProfile'])->name('customers.edit-profile');
        Route::get('/logout', [CustomerAuthController::class, 'logout'])->name('customers.logout');
    });
    Route::prefix('riders')->group(function () {
        Route::get('/index', [RiderAuthController::class, 'index'])->name('riders.index');

        Route::post('/edit-profile', [RiderAccountController::class, 'editProfile'])->name('riders.edit-profile');
        Route::get('/logout', [RiderAuthController::class, 'logout'])->name('riders.logout');
    });
    Route::prefix('staffs')->group(function () {
        Route::get('/index', [StaffAuthController::class, 'index'])->name('staffs.index');

        Route::get('/transactions', [StaffTransactionController::class, 'index'])->name('staffs.transactions');
        Route::get('/transactions/machines', [StaffTransactionController::class, 'machines'])->name('staffs.transactions.machines');
        Route::put('/transactions/edit_machine_status/{id}', [StaffTransactionController::class, 'edit_machine_status'])->name('staffs.transactions.edit_machine_status');
        Route::get('/transactions/{id}', [StaffTransactionController::class, 'single'])->name('staffs.transactions.single');
        Route::put('/transactions/{id}', [StaffTransactionController::class, 'edit'])->name('staffs.transactions.edit');
        Route::post('/transactions/add', [StaffTransactionController::class, 'add'])->name('staffs.transactions.add');
        Route::put('/transactions/item/{id}', [StaffTransactionController::class, 'itemEdit'])->name('staffs.transactions.item-edit');
        Route::get('/transactions/item/{id}', [StaffTransactionController::class, 'itemSIngle'])->name('staffs.transactions.item-single');

        Route::get('/cart', [StaffCartController::class, 'index'])->name('staffs.cart');
        Route::post('/cart/add', [StaffCartController::class, 'add'])->name('staffs.cart.add');
        Route::delete('/cart/{id}', [StaffCartController::class, 'delete'])->name('staffs.cart.delete');

        Route::get('/inventories', [StaffInventoryController::class, 'index'])->name('staffs.inventories');
        Route::get('/inventories/{id}', [StaffInventoryController::class, 'single'])->name('staffs.inventories.single');
        Route::put('/inventories/{id}', [StaffInventoryController::class, 'edit'])->name('staffs.inventories.edit');
        Route::post('/inventories/add', [StaffInventoryController::class, 'add'])->name('staffs.inventories.add');
        Route::delete('/inventories/{id}', [StaffInventoryController::class, 'delete'])->name('staffs.inventories.delete');

        Route::get('/selling_items', [StaffSellingItemController::class, 'index'])->name('staffs.selling_items');
        Route::get('/selling_items/{id}', [StaffSellingItemController::class, 'single'])->name('staffs.selling_items.single');
        Route::put('/selling_items/{id}', [StaffSellingItemController::class, 'edit'])->name('staffs.selling_items.edit');
        Route::post('/selling_items/add', [StaffSellingItemController::class, 'add'])->name('staffs.selling_items.add');
        Route::delete('/selling_items/{id}', [StaffSellingItemController::class, 'delete'])->name('staffs.selling_items.delete');

        Route::get('/services', [StaffServiceController::class, 'index'])->name('staffs.services');
        Route::get('/additional-services/{id}', [StaffAdditionalServiceController::class, 'index'])->name('staffs.additional-services');

        Route::post('/edit-profile', [StaffAccountController::class, 'editProfile'])->name('staffs.edit-profile');
        Route::get('/logout', [StaffAuthController::class, 'logout'])->name('staffs.logout');
    });
    Route::prefix('shop_admins')->group(function () {
        Route::get('/index', [ShopAdminAuthController::class, 'index'])->name('shop_admins.index');

        Route::get('/riders', [ShopAdminRiderController::class, 'index'])->name('shop_admins.riders');
        Route::post('/riders/add', [ShopAdminRiderController::class, 'add'])->name('shop_admins.riders.add');
        Route::get('/riders/{id}', [ShopAdminRiderController::class, 'single'])->name('shop_admins.riders.single');
        Route::put('/riders/{id}', [ShopAdminRiderController::class, 'edit'])->name('shop_admins.riders.edit');
        Route::delete('/riders/{id}', [ShopAdminRiderController::class, 'delete'])->name('shop_admins.riders.delete');

        Route::get('/staffs', [ShopAdminStaffController::class, 'index'])->name('shop_admins.staffs');
        Route::post('/staffs/add', [ShopAdminStaffController::class, 'add'])->name('shop_admins.staffs.add');
        Route::get('/staffs/{id}', [ShopAdminStaffController::class, 'single'])->name('shop_admins.staffs.single');
        Route::put('/staffs/{id}', [ShopAdminStaffController::class, 'edit'])->name('shop_admins.staffs.edit');
        Route::delete('/staffs/{id}', [ShopAdminStaffController::class, 'delete'])->name('shop_admins.staffs.delete');

        Route::get('/machines', [ShopAdminMachineController::class, 'index'])->name('shop_admins.machines');
        Route::post('/machines/add', [ShopAdminMachineController::class, 'add'])->name('shop_admins.machines.add');
        Route::get('/machines/{id}', [ShopAdminMachineController::class, 'single'])->name('shop_admins.machines.single');
        Route::put('/machines/{id}', [ShopAdminMachineController::class, 'edit'])->name('shop_admins.machines.edit');
        Route::delete('/machines/{id}', [ShopAdminMachineController::class, 'delete'])->name('shop_admins.machines.delete');

        Route::get('/services', [ShopAdminServiceController::class, 'index'])->name('shop_admins.services');
        Route::post('/services/add', [ShopAdminServiceController::class, 'add'])->name('shop_admins.services.add');
        Route::get('/services/{id}', [ShopAdminServiceController::class, 'single'])->name('shop_admins.services.single');
        Route::put('/services/{id}', [ShopAdminServiceController::class, 'edit'])->name('shop_admins.services.edit');
        Route::delete('/services/{id}', [ShopAdminServiceController::class, 'delete'])->name('shop_admins.services.delete');

        Route::get('/additional-services', [ShopAdminAdditionalServiceController::class, 'index'])->name('shop_admins.additional-services');
        Route::post('/additional-services/add', [ShopAdminAdditionalServiceController::class, 'add'])->name('shop_admins.additional-services.add');
        Route::get('/additional-services/{id}', [ShopAdminAdditionalServiceController::class, 'single'])->name('shop_admins.additional-services.single');
        Route::put('/additional-services/{id}', [ShopAdminAdditionalServiceController::class, 'edit'])->name('shop_admins.additional-services.edit');
        Route::delete('/additional-services/{id}', [ShopAdminAdditionalServiceController::class, 'delete'])->name('shop_admins.additional-services.delete');

        Route::post('/edit-profile', [ShopAdminAccountController::class, 'editProfile'])->name('shop_admins.edit-profile');
        Route::get('/logout', [ShopAdminAuthController::class, 'logout'])->name('shop_admins.logout');
    });
    Route::prefix('super_admins')->group(function () {
        Route::get('/index', [SuperAdminAuthController::class, 'index'])->name('super_admins.index');

        Route::get('/shop_admins', [SuperAdminShopAdminController::class, 'index'])->name('super_admins.shop_admins.index');
        Route::post('/shop_admins/status/{id}', [SuperAdminShopAdminController::class, 'edit_shop_admin_status'])->name('super_admins.shop_admins.edit_shop_admin_status');

        Route::post('/edit-profile', [SuperAdminAccountController::class, 'editProfile'])->name('super_admins.edit-profile');
        Route::get('/logout', [SuperAdminAuthController::class, 'logout'])->name('super_admins.logout');
    });
});


