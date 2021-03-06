<?php

use Dingo\Api\Routing\Router;

/** @var Router $api */
$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'auth'], function(Router $api) {
        $api->post('signup', 'App\\Api\\V1\\Controllers\\SignUpController@signUp');
        $api->post('login', 'App\\Api\\V1\\Controllers\\LoginController@login');

        $api->post('recovery', 'App\\Api\\V1\\Controllers\\ForgotPasswordController@sendResetEmail');
        $api->post('reset', 'App\\Api\\V1\\Controllers\\ResetPasswordController@resetPassword');
    });

    $api->group(['middleware' => 'jwt.auth'], function(Router $api) {

        $api->get('protected',[
          'middleware' => 'jwt.refresh',
          function() {
            return response()->json([
                'message' =>  Illuminate\Support\Facades\Auth::user()
            ]);
        }]);

        $api->get('usuarios',[
          'middleware' => 'jwt.refresh',
          function() {
            return response()->json([
                'message' =>  Illuminate\Support\Facades\Auth::user(),
                'token' => \JWTAuth::fromUser(Auth::user())
            ]);
        }]);

        $api->get('refresh', [
            'middleware' => 'jwt.refresh',
            function() {

                return response()->json([
                    'message' => 'By accessing this endpoint, you can refresh your access token at each request. Check out this response headers!'
                ]);
            }
        ]);
    });

    $api->get('hello', function() {
        return response()->json([
            'message' => 'This is a simple example of item returned by your APIs. Everyone can see it.'
        ]);
    });
});
