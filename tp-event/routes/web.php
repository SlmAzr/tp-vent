<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipationController;
use App\Models\Event;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    $role = $user->getRoleNames()->first();
    $userCount = User::count();
    $eventCount = Event::count();

    switch ($role) {
        case 'admin':

            return view('admin.dashboard', compact('userCount', 'eventCount'));
        case 'organisateur':
            return view('dashboards.organisateur', compact('eventCount'));
        case 'user':
        default:
            return view('user.dashboard', compact('eventCount'));
    }
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'permission:manage_users'])->group(function () {
    Route::get('/dashboard/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/dashboard/users/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::post('/dashboard/users', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/dashboard/users/{id}', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('/dashboard/users/{id}', [UserController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/dashboard/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});

Route::middleware(['auth', 'permission:manage_event'])->group(function () {
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::put('/events/{id}', [EventController::class, 'updateEvent'])->name('events.update');
    Route::get('/events/{id}', [EventController::class, 'edit'])->name('events.edit');
    Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
});

Route::middleware(['auth', 'permission:manage_event|signIn_event'])->group(function () {
    Route::get('/events', [EventController::class, 'index'])->name('events.index');
});

Route::middleware(['auth', 'permission:signIn_event'])->group(function () {
    Route::get('/participe', [ParticipationController::class, 'show'])->name('participe.show');
    Route::get('/participe/create', [ParticipationController::class, 'create'])->name('participe.create');
    Route::post('/participe/{id}', [ParticipationController::class, 'store'])->name('participe.store');
    Route::delete('/participe/{id}', [ParticipationController::class, 'destroy'])->name('participe.destroy');
});
