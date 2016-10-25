<?php

namespace Liker\Units\Auth\Http\Controllers;

use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Liker\Support\Http\Controllers\Controller;
use Tymon\JWTAuth\Exceptions\JWTException;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */
    use ThrottlesLogins;

    /**
     *
     * @param Request $request
     * @return Response
     */
    public function signin(Request $request)
    {
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = app('tymon.jwt.auth')->attempt($credentials)) {
                // Increments login attempts
                $this->incrementLoginAttempts($request);

                return response()->json(['error' => app('translator')->get('auth.failed')], Response::HTTP_UNAUTHORIZED);
            }
        } catch (JWTException $e) {
            // Increments login attempts
            $this->incrementLoginAttempts($request);

            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => app('translator')->get('auth.could_not_create_token')], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // all good so return the token
        return response()->json(compact('token'), Response::HTTP_OK);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }

    /**
     * Redirect the user after determining they are locked out.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $message = app('translator')->get('auth.throttle', ['seconds' => $seconds]);
        return response()->json(['error' => $message], Response::HTTP_TOO_MANY_REQUESTS);
    }
}
