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
    return view('auth.login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    // if (!Auth::user()->hasPermission('dashboard-access')){
    //     Route::get('/', Client\Chats::class)->name('home');
    // }
    // else{
        Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // }
    // Route::group(['middleware' => ['role:client']], function () {
    //     Route::resource('chats', Client\Chats::class);
    // });

    Route::resource('clients', ClientsController::class);
    Route::resource('lead', InvoicesController::class);
    Route::resource('project', ProjectsController::class);
    Route::resource('task', TasksController::class);
    Route::resource('subtask', SubtaskController::class);
    Route::resource('brand', BrandsController::class);
    Route::resource('category', CategoryController::class);
    Route::resource('package', PackagesController::class);
    Route::resource('user', UserController::class);
    Route::resource('logobreif', LogoBreifController::class);
    Route::resource('webbreif', WebBreifController::class);
    Route::resource('profile', HomeController::class);
    Route::resource('targets', SalesTargetController::class);

    Route::any('create/{name}/{id}', [App\Http\Controllers\ProjectsController::class, 'asignproject']);
    Route::any('clientregister/{id}', [App\Http\Controllers\ClientsController::class, 'clientregister']);
    Route::any('{id}/lead', [App\Http\Controllers\ClientsController::class, 'lead']);
    Route::get('leadstaatus/{id}/{status}', [App\Http\Controllers\InvoicesController::class, 'leadstatus']);
    Route::get('taskproject/{id}', [App\Http\Controllers\TasksController::class, 'taskproject']);
    Route::get('tasknotify/{id}/{notify}', [App\Http\Controllers\TasksController::class, 'tasknotify']);
    Route::get('subtaskbyid/{id}', [App\Http\Controllers\SubtaskController::class, 'subtaskbyid']);


    Route::get('file-export/{id}', [App\Http\Controllers\InvoicesController::class, 'invoicebyClient'])->name('invoicebyclient');
    Route::get('invoice-export', [App\Http\Controllers\InvoicesController::class, 'invoiceExport'])->name('invoice-export');

    Route::get('sale_agents',  [App\Http\Controllers\SalesTargetController::class, 'sale_agents'])->name('sale_agents.index');
    Route::get('sale_agent/create',  [App\Http\Controllers\SalesTargetController::class, 'sale_agent_create'])->name('sale_agents.create');
    Route::post('sale_agent/store',  [App\Http\Controllers\SalesTargetController::class, 'sale_agents_store'])->name('sale_agent.store');

    Route::get('all_leads',  [App\Http\Controllers\LeadController::class, 'index'])->name('leads');
    Route::get('lead_create',  [App\Http\Controllers\LeadController::class, 'lead_create'])->name('lead_create');
    Route::post('lead_store',  [App\Http\Controllers\LeadController::class, 'lead_store'])->name('lead_store');


    Route::get('sale_target_view',  [App\Http\Controllers\SalesTargetController::class, 'sale_target_view'])->name('sale_target_view');
    Route::get('sale_target_index',  [App\Http\Controllers\SalesTargetController::class, 'sale_target_index'])->name('sale_target_index');

});


// Route::group(['middleware' => ['role:client']], function () {
    //     Route::resource('chats', Client\Chats::class);
    //     Route::any('invoice/{id}', [App\Http\Controllers\ClientsController::class, 'show']);
    //     // Route::get('lead/{id}', [App\Http\Controllers\InvoicesController::class, 'show']);
//     Route::resource('breif', Client\BreifProjectController::class);
// });
