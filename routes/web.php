<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SkillController;
use App\Http\Livewire\SkillManager;
use App\Http\Controllers\JobPostingController;
use App\Http\Livewire\JobPostings;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Panel (Inertia + Vue.js)
    Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');
    Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
    Route::put('/skills/{skill}', [SkillController::class, 'update'])->name('skills.update');
    Route::delete('/skills/{skill}', [SkillController::class, 'destroy'])->name('skills.destroy');
    Route::get('/jobpostings', [JobPostingController::class, 'index'])->name('job-postings.index');
    Route::post('/job-postings', [JobPostingController::class, 'store'])->name('job-postings.store');
    Route::delete('/job-postings/{id}', [JobPostingController::class, 'destroy'])->name('skills.destroy');
    
    // Admin Panel (Livewire + AlpineJS)
    Route::get('/admin/skills', SkillManager::class)->name('admin.skills');
    Route::get('/job-postings', JobPostings::class)->name('admin.job-postings');

});



require __DIR__.'/auth.php';
