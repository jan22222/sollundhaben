<?php

use App\Imports\TabulaImport;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TableController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SendMailController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\TableExportController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\user\UserTaskController;
use App\Http\Controllers\user\UserTableController;
use App\Http\Controllers\admin\AdminTaskController;
use App\Http\Controllers\admin\AdminUserController;
use App\Http\Controllers\admin\AdminTableController;
use App\Http\Controllers\Admin\createTaskController;
use App\Http\Controllers\user\UserProfileController;
use App\Http\Controllers\Admin\createTableController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\user\UserDashboardController;
use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminCreateTaskController;
use App\Http\Controllers\admin\AdminEnterpriseController;
use App\Http\Controllers\Auth\RegisterCoworkerController;

//Diese Route leitet nach login entweder zum user oder admin dashboard
Route::get('/', function () {
    if(!auth()->user()){
        return view('home');
    }
    if(auth()->user()->is_admin){
        return view('admin.home');
    }
    if(auth()->user()){
        return view('user.home');
    }
})->name('home');

Route::get('/tasks', function(){dd('tasklist');})->name('tasklist');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);
Route::get('/coworker-register', [RegisterCoworkerController::class, 'index'])->name('registercoworker');
Route::post('/coworker-register', [RegisterCoworkerController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');

Route::group(['middleware'=>'auth'], function(){

    Route::group(['prefix'=>'admin', 'middleware'=>'is_admin', 'as'=>'admin.'], function(){ 
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
        ->name('dashboard');
        Route::get('/', [AdminDashboardController::class, 'home'])
        ->name('home');
        Route::get('/enterprise', [AdminEnterpriseController::class, 'index'])->name('enterprise');
        
        //Users
        Route::get('/user/{user:id}', [AdminUserController::class, 'show'])->name('user');
        Route::post('/user/{user:id}', [AdminUserController::class, 'upload'])->name('user.upload');
        Route::get('/users', [AdminUserController::class, 'index'])->name('userlist');
        Route::delete('/user/{user}',[AdminUserController::class, 'delete'])->name('user.delete');

        //Tasks
        Route::get('/tasks', [AdminTaskController::class, 'index'])->name('tasklist');
        Route::get('/task/{id}', [AdminTaskController::class, 'show'])->name('task');
        Route::get('/task-create', [createTaskController::class, 'index'])->name('task.create');
        Route::post('/task-create', [createTaskController::class, 'store']);
        Route::delete('/task/{id}', [AdminTaskController::class, 'delete'])->name('task.delete');
        //tables aka tabulas
        Route::get('/tabledata', [AdminTableController::class, 'index'])->name('tabledata');
        Route::get('/tables', [AdminTableController::class, 'index'])->name('tables');

        
        Route::get('/table-create', [createTableController::class, 'index'])->name('table.create');
        Route::post('/table-create', [createTableController::class, 'store']);
        Route::get('/table-export/{id}', [TableExportController::class, 'export']);
        Route::delete('/table/delete/{id}',[AdminTableController::class, 'delete'])->name('table.delete');
        //email
        Route::get('invite', [SendMailController::class, 'show'] )->name('invite');
        Route::post('invite', [SendMailController::class, 'invite'] );
        //dashboard updates
        Route::get('/new', [UpdateController::class, 'new'] )->name('updates.new');
        Route::get('updates', [UpdateController::class,'index'] )->name('updates');
        Route::get('check', [UpdateController::class,'check'] );
        //ProfileController
        Route::get('/profile', [AdminProfileController::class, 'show'])->name('profile');
        Route::post('/profile', [AdminProfileController::class, 'upload'])->name('profile.upload');
        
    }); 

    Route::group(['prefix'=>'user', 'middleware'=>'is_user', 'as'=>'user.'], function(){

        Route::get('/', [UserDashboardController::class, 'home'])->name('home');
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        
        Route::get('/tasks', [UserTaskController::class, 'index'])->name('tasklist');
        Route::get('/tables', [UserTableController::class, 'index'])->name('tablelist');
        Route::get('/table/{id}', [UserTableController::class, 'edit'])->name('table');
        Route::post('/update-table', [UserTableController::class, 'update']);
        Route::get('/task/{id}', [UserTaskController::class, 'show'])->name('task');
        Route::get('/task_completion/{task}', [UserTaskController::class, 'show_completion'])->name('completion');
        Route::post('/task_completion/{task}', [UserTaskController::class, 'make_completion']);
       
        Route::get('/new', [UserUpdateController::class, 'new'] )->name('updates.new');
        Route::get('updates', [UserUpdateController::class,'index'] )->name('updates');
        Route::get('check', [UserUpdateController::class,'check'] );
        //ProfileController
        Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
        Route::post('/profile', [UserProfileController::class, 'upload'])->name('profile.upload');
        
    });
});
