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
Route::get('/self', [App\Http\Controllers\MyPageController::class, 'self_absent'])->name('self_absent'); // 自己欠席入力
Route::get('/self_check_in', [App\Http\Controllers\Check_InController::class, 'self_check_in'])->name('self_check_in'); // 自己チェックイン
Route::get('/receipt', [App\Http\Controllers\Check_InController::class, 'receipt'])->name('receipt'); // 記念品・クローク受領
Route::get('/checkin_status', [App\Http\Controllers\Check_InController::class, 'status'])->name('status'); // チェックインスターテス
Route::get('/staff_checkin', [App\Http\Controllers\StaffinfoController::class, 'staff_checkin'])->name('staff_checkin'); // ログインなしのチェックイン

// 管理ユーザ用
Route::prefix('admin')->middleware('can:admin')->group(function () {
    Route::post('/search', [App\Http\Controllers\ParticipantController::class, 'search'])->name('search');
    Route::resource('participants', App\Http\Controllers\ParticipantController::class);
    Route::resource('admin_staffinfos', App\Http\Controllers\AdminStaffinfoController::class);
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
    Route::get('/fee_check', [App\Http\Controllers\ParticipantController::class, 'fee_check'])->name('fee_check'); // 参加費チェック
    Route::get('/seat_number/', [App\Http\Controllers\ParticipantController::class, 'seat_number'])->name('seat_number'); // 座席一覧
    Route::post('/seat_number/', [App\Http\Controllers\ParticipantController::class, 'seat_number'])->name('seat_number'); // 座席一覧
    Route::get('/reception_seat_number/', [App\Http\Controllers\ParticipantController::class, 'reception_seat_number'])->name('reception_seat_number'); // レセ一覧
    Route::post('/reception_seat_number/', [App\Http\Controllers\ParticipantController::class, 'reception_seat_number'])->name('reception_seat_number'); // レセ一覧
    Route::get('/absent/', [App\Http\Controllers\ParticipantController::class, 'absent'])->name('absent'); // キャンセル入力
});

// スタッフ用
Route::prefix('s')->middleware('can:staff')->group(function () {
    Route::get('/check_in', [App\Http\Controllers\Check_InController::class, 'index'])->name('check_in');
    Route::get('/check_in/input', [App\Http\Controllers\Check_InController::class, 'input'])->name('input');
    Route::post('/check_in/input', [App\Http\Controllers\Check_InController::class, 'input'])->name('input');
    Route::resource('staffinfos', App\Http\Controllers\StaffinfoController::class);
    Route::get('/absent/input', [App\Http\Controllers\AbsentController::class, 'input'])->name('input'); // 欠席リスト
    Route::post('/absent/input', [App\Http\Controllers\AbsentController::class, 'input'])->name('input'); // 欠席リスト検索
    Route::get('/fever_absent/input', [App\Http\Controllers\AbsentController::class, 'fever'])->name('fever'); // 発熱リスト
    Route::post('/fever_absent/input', [App\Http\Controllers\AbsentController::class, 'fever'])->name('fever'); // 発熱リスト検索
    Route::get('/cancel', [App\Http\Controllers\CancelController::class, 'index'])->name('cancel'); // キャンセル処理
    Route::post('/cancel', [App\Http\Controllers\CancelController::class, 'index'])->name('cancel'); // キャンセルリスト検索
    Route::get('/digipass', [App\Http\Controllers\StaffinfoController::class, 'digipass'])->name('digipass');
    Route::get('/digipass/arrive', [App\Http\Controllers\StaffinfoController::class, 'arrive'])->name('arrive');
});

// 県連用
Route::prefix('pref')->middleware('can:pref')->group(function () {
    Route::get('sendmail', [App\Http\Controllers\PrefParticipantController::class, 'sendmail'])->name('pref_sendmail');
    Route::resource('pref_participants', App\Http\Controllers\PrefParticipantController::class);
});
