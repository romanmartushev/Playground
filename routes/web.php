<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

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
/**
 * Routes for the dark theme
 */
Route::get('/dark', function () {
    return view('dark/index');
});

/**
 * Routes for text message app (windows app)
 */
Route::get('/api/sendText','NexmoAPIController@sendText');

Route::get('/api/getText','NexmoAPIController@getText');

Route::get('/api/deleteText','NexmoAPIController@deleteText');

Route::any('/webhooks/inbound-sms', function(){
    $message = \Nexmo\Message\InboundMessage::createFromGlobals();
    if($message->isValid()){
        $text = new \App\Text();
        $text->msisdn = $message->getRequestData()["msisdn"];
        $text->to = $message->getRequestData()["to"];
        $text->messageId = $message->getRequestData()["messageId"];
        $text->text = $message->getRequestData()["text"];
        $text->type = $message->getRequestData()["type"];
        $text->keyword = $message->getRequestData()["keyword"];
        $text->message_timestamp = $message->getRequestData()["message-timestamp"];
//        $text->concat = $message->getRequestData()["concat"];
//        if($message->getRequestData()["concat"] == true){
//            $text->concat_ref = $message->getRequestData()["concat-ref"];
//            $text->concat_total = $message->getRequestData()["concat-total"];
//            $text->concat_part = $message->getRequestData()["concat-part"];
//        }
        $text->save();
    } else {
        error_log('invalid message');
    }
    return 200;
});

/**
 * Routes for messaging app
 */
Route::get('/chat', 'ChatController@index');
Route::get('/chat/new', 'ChatController@newMessages');
Route::get('/chat/add', 'ChatController@addMessage');
/**
 * Routes for form builder
 */
Route::get('/form-builder', function () {
    $file = File::get(resource_path() . '/views/form-builder/form-builder.html');
    $file = str_replace("../assets/css/style.css", "/css/form-builder/style.css", $file);
    $file = str_replace("../assets/js/form-builder.js", "/js/form-builder/form-builder.js", $file);
    return $file;
});

Route::post('/app/api/shortcode', function () {
    require_once dirname(__DIR__) . '/resources/assets/form-builder/shortcode.php';
});