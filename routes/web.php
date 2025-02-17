<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\ImportExportController;

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [ContactController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');
    Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');

    Route::get('/import/xml', [ImportExportController::class, 'exportXML'])->name('contacts.export.xml');
    Route::post('/import/xml', [ImportExportController::class, 'importXML'])->name('contacts.import.xml');

});

require __DIR__.'/auth.php';


