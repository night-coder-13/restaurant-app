<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('home.index');
})->name('home');
// Route::get('/otp', function () {
//     // $user = new \App\Models\User();
//     // $user->mobile = '09902774517';
//     // $user->otp = '215487';
//     // $user->notify(new \App\Notifications\SendOtpToUser());







//     // try{
//     //     $sender = "10004346";
//     //     $message = "خدمات پیام کوتاه کاوه نگار";
//     //     $receptor = array("09361234567","09191234567");
//     //     $result = Kavenegar::Send($sender,$receptor,$message);
//     //     if($result){
//     //         foreach($result as $r){
//     //             echo "messageid = $r->messageid";
//     //             echo "message = $r->message";
//     //             echo "status = $r->status";
//     //             echo "statustext = $r->statustext";
//     //             echo "sender = $r->sender";
//     //             echo "receptor = $r->receptor";
//     //             echo "date = $r->date";
//     //             echo "cost = $r->cost";
//     //         }       
//     //     }
//     // }
//     // catch(\Kavenegar\Exceptions\ApiException $e){
//     //     // در صورتی که خروجی وب سرویس 200 نباشد این خطا رخ می دهد
//     //     echo $e->errorMessage();
//     // }
//     // catch(\Kavenegar\Exceptions\HttpException $e){
//     //     // در زمانی که مشکلی در برقرای ارتباط با وب سرویس وجود داشته باشد این خطا رخ می دهد
//     //     echo $e->errorMessage();
//     // }












// })->name('home');

Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/product/{product:slug}', [ProductController::class, 'show'])->name('product.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/login', [AuthController::class, 'loginform'])->name('auth.loginform');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/check-otp', [AuthController::class, 'checkOtp'])->name('auth.checkOtp');
