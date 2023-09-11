<?php


use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\TopicsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\IndexController;
use App\Http\Controller\Admin\SubscriberController;
use App\Http\Controllers\Admin\PermissionController;

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




Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/user/subscriber',function(){
   return view('user.subscriber');
});



//Route::post('/user/subscriber', function (Request $request) {
//    
//    $pipeline = app(Pipeline::class)->send($request->all(),)->through([     
//        CreateSubscriber::class,
//        BindToTopics::class,
 //       DispatchWelcomeNotification::class,
//    ])->thenReturn();
//
 //  
//    $pipeline();
 //   
//   
//    return response()->json(['message' => 'Subscription successful']);
//});

Route::resource('topics', TopicsController::class);

Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('index');
    Route::resource('/roles', RoleController::class);
    Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
    Route::delete('/roles/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
    Route::resource('/permissions', PermissionController::class);
    Route::post('/permissions/{permission}/roles', [PermissionController::class, 'assignRole'])->name('permissions.roles');
    Route::delete('/permissions/{permission}/roles/{role}', [PermissionController::class, 'removeRole'])->name('permissions.roles.remove');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles');
    Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
    Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('users.permissions');
    Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])->name('users.permissions.revoke');
});

Route::get('/test', function () {
    $joinQuery = DB::table('subscribers')
        ->join('subscriber_topic', 'subscribers.id', '=', 'subscriber_topic.subscriber_id')
        ->join('topics', 'subscriber_topic.topics_id', '=', 'topics.id')
        ->select('subscribers.*', 'topics.*')
        ->get();

        $list = '<ul>';

foreach ($joinQuery as $row) {
    // Access fields like $row->subscriber_field and $row->topic_field
    $list .= '<li>';
    $list .= 'Subscriber Name: ' . $row->email . '<br>';
    $list .= 'Topic Title: ' . $row->title . '<br>'; // Change this to the actual column name
    // Add more fields as needed
    $list .= '</li>';
}

$list .= '</ul>';

// Return the HTML list as a response
return $list;
});

Route::post('topics', StoreController::class)->name('topics.subscribe');
Route::post('topics/create',[TopicsController::class,'store'])->name('topics.store');
require __DIR__ . '/auth.php';