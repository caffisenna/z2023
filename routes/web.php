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
    return view('welcome');
});

Auth::routes();

Route::Redirect('/register', '/', 301);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/mypage', [App\Http\Controllers\MyPageController::class, 'index'])->name('mypage');
Route::post('/mypage', [App\Http\Controllers\MyPageController::class, 'self_checkin'])->name('self_checkin');
Route::get('/checkin_status', [App\Http\Controllers\Check_InController::class, 'status'])->name('status'); // チェックインスターテス

// 管理ユーザ用
Route::prefix('admin')->middleware('can:admin')->group(function () {
    Route::post('/search', [App\Http\Controllers\ParticipantController::class, 'search'])->name('search');
    Route::resource('participants', App\Http\Controllers\ParticipantController::class);
    Route::get('/checked_in', [App\Http\Controllers\ParticipantController::class, 'checked_in'])->name('checked_in'); // チェックイン済みリスト
    Route::get('/not_checked_in', [App\Http\Controllers\ParticipantController::class, 'not_checked_in'])->name('not_checked_in'); // 未チェックイン済みリスト
    Route::get('/absent_list', [App\Http\Controllers\ParticipantController::class, 'absent_list'])->name('absent_list'); // 欠席入力リスト
    Route::get('/reception_absent_list', [App\Http\Controllers\ParticipantController::class, 'reception_absent_list'])->name('reception_absent_list'); // 欠席入力リスト
    Route::get('/cancel_check_in/', [App\Http\Controllers\ParticipantController::class, 'cancel_check_in'])->name('cancel_check_in'); // チェックインキャンセル
    Route::get('/cancel_absent/', [App\Http\Controllers\ParticipantController::class, 'cancel_absent'])->name('cancel_absent'); // 欠席キャンセル
    Route::get('/cancel', [App\Http\Controllers\AdminCancelController::class, 'index'])->name('cancel'); // キャンセル処理
    Route::post('/cancel', [App\Http\Controllers\AdminCancelController::class, 'index'])->name('cancel'); // キャンセルリスト検索
    Route::get('/sendmail', [App\Http\Controllers\ParticipantController::class, 'sendmail'])->name('sendmail'); // 招待状送信
    Route::get('/sendmail_pref', [App\Http\Controllers\ParticipantController::class, 'sendmail_pref'])->name('sendmail_pref'); // 招待状送信(県連単位)
    Route::get('/re_send', [App\Http\Controllers\ParticipantController::class, 're_send'])->name('re_send'); // エラー再送
    Route::get('/fee_check', [App\Http\Controllers\ParticipantController::class, 'fee_check'])->name('fee_check'); // 参加費チェック
    Route::get('/absent/', [App\Http\Controllers\ParticipantController::class, 'absent'])->name('absent'); // キャンセル入力
    Route::resource('addUsers', App\Http\Controllers\add_userController::class);
});

// スタッフ用
Route::prefix('s')->middleware(['can:staff,admin'])->group(function () { // staff権限とadmin権限両方でアクセスできる
    Route::get('/check_in', [App\Http\Controllers\Check_InController::class, 'index'])->name('check_in');
    Route::get('/check_in/input', [App\Http\Controllers\Check_InController::class, 'input'])->name('input');
    Route::post('/check_in/input', [App\Http\Controllers\Check_InController::class, 'input'])->name('input');
    Route::get('/absent/input', [App\Http\Controllers\AbsentController::class, 'input'])->name('input'); // 欠席リスト
    Route::post('/absent/input', [App\Http\Controllers\AbsentController::class, 'input'])->name('input'); // 欠席リスト検索
    Route::get('/cancel', [App\Http\Controllers\CancelController::class, 'index'])->name('cancel'); // キャンセル処理
    Route::post('/cancel', [App\Http\Controllers\CancelController::class, 'index'])->name('cancel'); // キャンセルリスト検索
});
