<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\App;
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

App::singleton(\HillelDerish\UAadapter\UserAgentParserInterface::class, function (){
    return new \HillelDerish\UAadapter\HisorangeAdapter();
//    return new \HillelDerish\UAadapter\DonatjAdapter();
});


Route::get('/', HomeController::class)->name('home');


Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');

    Route::post('/login', [AuthController::class, 'loginCheck']);
});





Route::get('/parse', function (\HillelDerish\UAadapter\UserAgentParserInterface $uaParser) {

    $ip = '109.200.247.58';    //request()->ip();

    $uaParser->parse();

    $statistic = new \App\Models\Statistic();
    $statistic->ip = $ip;
    $statistic->browser = $uaParser->getBrowser() ?? null;
    $statistic->engine = $uaParser->getEngine() ?? null;
    $statistic->os = $uaParser->getOs() ?? null;
    $statistic->device = $uaParser->getDevice() ?? null;
    $statistic->save();
});

