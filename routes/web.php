<?php


use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuditChecklistController;
use App\Http\Controllers\AuditQuestionController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\ApproveController;
use App\Http\Controllers\NcrController;
use App\Http\Controllers\AuthUser\LoginUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;


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

Route::middleware(['auth'])->get('/', [HomeController::class, 'index'])->name('index');
Route::get('/audit-checklist/create', function () {
    return 'Halaman Buat Audit Checklist';
});
Route::get('/login', [LoginUserController::class, 'index']);

Route::middleware(['auth', 'user-access:auditor'])->group(function () {
    Route::get('/audit-checklist', [AuditChecklistController::class, 'index'])->name('audit.checklist');
    Route::get('/audit-checklist/create/{id}', [HomeController::class, 'createAuditChecklist']);
    Route::get('/audit-checklist/create/question/{id}', [HomeController::class, 'createAuditQuestion']);
    Route::post('/audit-checklist/create/store', [AuditChecklistController::class, 'store']);
});



Route::get('/audit-checklist/update/{id}', [AuditChecklistController::class, 'edit'])->name('audit.checklist.edit')->where(['id' => '.*']);
Route::post('/audit-checklist/update', [AuditChecklistController::class, 'update'])->name('audit.checklist.update');
Route::get('/audit-checklist/update-question/{id}', [AuditQuestionController::class, 'edit'])->name('audit.question.edit')->where(['id' => '.*']);
Route::put('/audit-questions/update', [AuditQuestionController::class, 'update'])->name('audit.questions.update');
Route::post('/audit-checklist/update-question', [AuditQuestionController::class, 'update'])->name('audit.question.update');
Route::get('/audit-checklist/meeting/{id}', [MeetingController::class, 'edit'])->name('meeting.edit')->where(['id' => '.*']);
Route::post('/audit-checklist/meeting', [MeetingController::class, 'update'])->name('meeting.update');

Route::middleware(['auth', 'user-access:lead'])->group(function () {
    Route::get('/audit-checklist-approve', [ApproveController::class, 'index'])->name('audit.checklist.approve');
    Route::get('/audit-checklist-approve/approve/{id}', [ApproveController::class, 'approve'])->name('audit.checklist.approved')->where(['id' => '.*']);
    Route::get('/audit-checklist-approve/reject/{id}', [ApproveController::class, 'reject'])->name('audit.checklist.rejected')->where(['id' => '.*']);
});


Route::get('/data-audit-checklist', [NcrController::class, 'index'])->name('audit.checklist.ncr');
Route::get('/data-audit-checklist/create{id}', [NcrController::class, 'create'])->name('audit.checklist.create.ncr')->where(['id' => '.*']);
Route::post('/data-audit-checklist/store', [NcrController::class, 'store'])->name('audit.checklist.store.ncr');




Route::get('/db-check', function () {
    try {
        DB::connection()->getPdo();
        return "Koneksi ke PostgreSQL berhasil!";
    } catch (\Exception $e) {
        return "Gagal terhubung ke database: " . $e->getMessage();
    }
});

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
Route::post('/login', [LoginController::class, 'login'])->name('login');
// Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');