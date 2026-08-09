<?php
use App\Http\Controller\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/employees', 
[EmployeeController::class, 'index' ]);