<?php

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

use App\Models\Form;
use Illuminate\Support\Facades\Route;
use Mpociot\Versionable\Version;
use Sebdesign\SM\StateMachine\StateMachine;

Route::get('/', function () {
    return redirect()->route('form', Form::first());
});

Route::get('/form/{form}', 'FormController@show')->name('form');
Route::post('/form/{form}', 'FormController@store')->name('form.submit');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin/', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::resource('forms', 'FormController');
    Route::resource('forms/{form}/submissions', 'SubmissionsController')->only(['index', 'show', 'destroy']);
    Route::resource('forms/{form}/fields', 'FieldController')->except(['show']);
    Route::post('forms/{form}/fields/{field}/order', 'FieldOrderController@update')->name('fields.order');
    //Route::resource('forms/{form}/fields/{field}/options', 'OptionsController')->except(['show']);
});

Route::get('/_tools/version/{version}/diff', function (Version $version) {
    // get the actual model
    $model = $version->versionable;
    dd($model->currentVersion()->diff($version));
})->name('version.diff');

Route::get('/_tools/version/{version}/changes', function (Version $version) {
    // get the actual model
    $previous = $version->versionable->versions->reverse()->filter(function ($compare) use ($version) {
        return $compare->version_id < $version->version_id;
    })->first();

    dd($previous->diff($version));
})->name('version.changes');

Route::get('/_tools/version/{version}/approve', function (Version $version) {
    // get the actual model
    $version->approve();

    return redirect()->back();
})->name('version.approve');

Route::get('/_tools/version/{version}/revert', function (Version $version) {
    // get the actual model
    $version->revert();

    return redirect()->back();
})->name('version.revert');

Route::get('/_tools/permissions/check', function () {
    return json_encode(request()->user()->can('create', Form::class));
})->middleware('auth');

Route::get('/hello', function () {
    dd(Route::getCurrentRoute()->action);
});

Route::get('/_tools/state-machine', function () {
    $obj = new Form;
    $obj->state = 'new';

    $machine = [
        'graph'    => 'default',
        'metadata' => 123,
        'states'   => [
            ['name' => 'new', 'metadata' => Form::find(1)],
            ['name' => 'pending_review'],
            ['name' => 'published'],
            ['name' => 'closed'],
        ],
        'transitions' => [
            'create'  => ['from' => ['new'], 'to' => 'pending_review'],
            'abandon' => ['from' => ['new'], 'to' => 'closed'],
            'publish' => ['from' => ['pending_review'], 'to' => 'published'],
            'approve' => ['from' => ['pending_review'], 'to' => 'published'],
        ],
    ];

    $stateMachine = new StateMachine($obj, $machine, app('sm.event.dispatcher'), app('sm.callback.factory'));

    // Get the actual state of the object
    dump($stateMachine->getState());

    dump($stateMachine->metadata()->state($stateMachine->getState()));

    // Get all available transitions
    dump($stateMachine->getPossibleTransitions());

    // Check if a transition can be applied: returns true or false
    dump($stateMachine->can('create'));

    // Apply a transition: returns true or throws an SM\SMException
    //dump($stateMachine->apply('create'));

    // Get the actual state of the object
    dump($stateMachine->getState());

    // Get all available transitions
    dump($stateMachine->getPossibleTransitions());

    dump($stateMachine);

    dump($obj);
});

Route::get('/_tools/bulk/', function () {
    $items = session($this->basketSessionName);
});
