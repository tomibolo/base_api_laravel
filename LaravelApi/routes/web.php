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

Route::get('reset_password/{token}', ['as' => 'password.reset', function($token)
{
    // implement your reset password route here!
}]);

Route::get('/', function () {
    return view('prueba');
});


Route::post('/session', function() {

    $client = new GuzzleHttp\Client();

    //Login
    $login = json_decode($client->request('POST', 'http://local.larapi.com/api/auth/login',
        [
            'form_params' => array( 'email' => 'caca@caca.com', 'password' => 'caca' )
        ]
    )->getBody()->getContents());

    var_dump($login);

    echo '<hr>';

    //Request
    $request = $client->request('GET', 'http://local.larapi.com/api/protected' ,

        ['headers' =>
            [
                'Authorization' => "Bearer ".$login->token
            ]
        ]
    )->getBody()->getContents();

    var_dump($request);
    sleep (1);
    echo '<hr>';


    //Request
    $refresh = $client->request('GET', 'http://local.larapi.com/api/refresh' ,

        ['headers' =>
            [
                'Authorization' => "Bearer ".$login->token
            ]
        ]
    );

    $headers = $refresh->getHeaders();

    if( isset($headers['Authorization'][0]) ) {
        $tokenBearer = $headers['Authorization'][0];
    }

    echo 'REFRESH';

    echo '<hr>';

    //Request
    $request = $client->request('GET', 'http://local.larapi.com/api/protected' ,

        ['headers' =>
            [
                'Authorization' => $tokenBearer
            ]
        ]
    )->getBody()->getContents();

    var_dump($request);

})->name('session');
