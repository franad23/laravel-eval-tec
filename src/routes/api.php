<?php

use App\Http\Middleware\CheckEventId;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventRegistrationController;

Route::post('/event-registration', [EventRegistrationController::class, 'store']);
Route::get('/event-registration', [EventRegistrationController::class, 'getById'])->middleware(CheckEventId::class);