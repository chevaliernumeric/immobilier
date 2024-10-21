<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\Backend\PropertyController;
use App\Http\Controllers\Backend\PropertyTypeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\RedirectIfAuthenticated;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', [UserController::class, 'index']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'UserProfile'])->name('user.profile');
    Route::post('/user/profile/store', [UserController::class, 'UserProfileStore'])->name('user.profile.store');
    Route::get('/user/logout',[UserController::class,'UserLogout'])->name('user.logout');
    Route::get('/user/change/password',[UserController::class,'UserChangePassword'])->name('user.change.password');
    Route::post('/user/password/update',[UserController::class,'UserPasswordUpdate'])->name('user.password.update');


    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin/dashboard',[AdminController::class,'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/logout',[AdminController::class,'AdminLogout'])->name('admin.logout');
    Route::get('/admin/profile',[AdminController::class,'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store',[AdminController::class,'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password',[AdminController::class,'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password',[AdminController::class,'AdminUpdatePassword'])->name('admin.update.password');




});//Fin du group mideleware Admin

Route::middleware(['auth','role:agent'])->group(function(){
    Route::get('/agent/dashboard',[AgentController::class,'AgentDashboard'])->name('agent.dashboard');
    Route::get('/agent/logout',[AgentController::class,'AgentLogout'])->name('agent.logout');
    Route::get('/agent/profile',[AgentController::class,'AgentProfile'])->name('agent.profile');
    Route::post('/agent/profile/store',[AgentController::class,'AgentProfileStore'])->name('agent.profile.store');
    Route::get('/agent/change/password',[AgentController::class,'AgentChangePassword'])->name('agent.change.password');
    Route::post('/agent/update/password',[AgentController::class,'AgentUpdatePassword'])->name('agent.update.password');






});//Fin de la methode du madeleware

Route::get('/agent/login',[AgentController::class,'AgentLogin'])->name('agent.login')->middleware(RedirectIfAuthenticated::class);
Route::post('/agent/register',[AgentController::class,'AgentRegister'])->name('agent.register');


Route::get('/admin/login',[AdminController::class,'Adminlogin'])->name('admin.login')->middleware(RedirectIfAuthenticated::class);
//Admin Groupe Middleware
Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(PropertyTypeController::class)->group(function(){
        Route::get('/all/type',[PropertyTypeController::class,'AllType'])->name('all.type');
        Route::get('/add/type',[PropertyTypeController::class,'AddType'])->name('add.type');
        Route::post('/store/type',[PropertyTypeController::class,'StoreType'])->name('store.type');
        Route::get('/edit/type/{id}',[PropertyTypeController::class,'EditType'])->name('edit.type');
        Route::post('/update/type',[PropertyTypeController::class,'UpdateType'])->name('update.type');
        Route::get('/delete/type/{id}',[PropertyTypeController::class,'DeleteType'])->name('delete.type');
    });

});//End Admin Group Middleware

//All Route Amenities
Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(PropertyTypeController::class)->group(function(){
        Route::get('/all/amenitie',[PropertyTypeController::class,'AllAmenitie'])->name('all.amenitie');
        Route::get('/add/amenitie',[PropertyTypeController::class,'AddAmenitie'])->name('add.amenitie');
        Route::post('/store/amenitie',[PropertyTypeController::class,'StoreAmenitie'])->name('store.amenitie');
        Route::get('/edit/amenitie/{id}',[PropertyTypeController::class,'EditAmenitie'])->name('edit.amenitie');
        Route::post('/update/amenitie',[PropertyTypeController::class,'UpdateAmenitie'])->name('update.amenitie');
        Route::get('/delete/amenitie/{id}',[PropertyTypeController::class,'DeleteAmenitie'])->name('delete.amenitie');
    });
});//End All route Amenities

    //All Route Property
Route::middleware(['auth','role:admin'])->group(function(){
    Route::controller(PropertyController::class)->group(function(){
        Route::get('/all/property',[PropertyController::class,'AllProperty'])->name('all.property');
        Route::get('/add/property',[PropertyController::class,'AddProperty'])->name('add.property');
        Route::post('/store/property',[PropertyController::class,'StoreProperty'])->name('store.property');
        Route::get('/edit/property/{id}',[PropertyController::class,'EditProperty'])->name('edit.property');
        Route::post('/update/property',[PropertyController::class,'UpdateProperty'])->name('update.property');
        Route::post('/update/property/thambnail',[PropertyController::class,'UpdatePropertyThambnail'])->name('update.property_thambnail');
        Route::post('/update/property/multiimage',[PropertyController::class,'UpdatePropertyMultiimage'])->name('update.property.multiimage');
        Route::get('/property/multiimg/delete/{id}',[PropertyController::class,'PropertyMultiimgDelete'])->name('property.multiimg.delete');
        Route::post('/store/new/multiimage',[PropertyController::class,'StoreNewMultiimage'])->name('store.new.multiimage');
        Route::post('/update/property/facilities',[PropertyController::class,'UpdatePropertyFacilities'])->name('update.property.facilities');
        Route::get('/delete/property/{id}',[PropertyController::class,'DeleteProperty'])->name('delete.property');
        Route::get('/details/property/{id}',[PropertyController::class,'DetailsProperty'])->name('details.property');
        Route::post('/inactive/property',[PropertyController::class,'InactiveProperty'])->name('inactive.property');
        Route::post('/active/property',[PropertyController::class,'ActiveProperty'])->name('active.property');












       
    });

});//End All Route property
