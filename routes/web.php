<?php


use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
// use Analytics;
// use Spatie\Analytics\Period;

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

// Route::get('/', function () {
//     //$analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));
//     return view('welcome');
// });
// Route::get('/test', function () {
//   // $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));
//     return view('welcome');
// });

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () { 
    Route::get('/', function () {
       return view('company.index');
    });
    
    Route::get('/register', function () {
        return redirect('login');
     });

 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

 //Compancy
 Route::get('generatepdf/{id}', [CompanyController::class,'generatePDF'])->name('generatepdf');
 Route::post('company/edit_compancy',[CompanyController::class,'edit_compancy'])->name('company.edit_compancy');
 Route::post('company/update_compancy',[CompanyController::class,'update_compancy'])->name('company.update_compancy');
 Route::post('company/edit_logo',[CompanyController::class,'edit_logo'])->name('company.edit_logo');
 Route::post('company/edit_file',[CompanyController::class,'edit_file'])->name('company.edit_file');
 Route::post('company/delete',[CompanyController::class,'delete'])->name('company.delete');
 Route::get('company/getdata',[CompanyController::class,'getdata'])->name('company.getdata');
 Route::resource('/company',CompanyController::class);
 

//Employee
Route::get('employee/delete/{id}',[EmployeeController::class,'delete'])->name('employee.delete');
Route::get('employee/getdata',[EmployeeController::class,'getdata'])->name('employee.getdata');
Route::resource('/employee',EmployeeController::class);
 }); 
 
Route::get('/user','EmployeeController@data'); 
