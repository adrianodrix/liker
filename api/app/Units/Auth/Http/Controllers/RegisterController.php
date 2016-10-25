<?php

namespace Liker\Units\Auth\Http\Controllers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Liker\Domains\Users\Models\User;
use Liker\Domains\Users\Repositories\Fractal\Transformers\UserTransformer;
use Liker\Units\Auth\Http\Requests\LoginRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use Liker\Support\Http\Controllers\Controller;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    /**
     * Return User Authenticated
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function me(Request $request)
    {
        return response()->json(
            fractal()
            ->item($request->user())
            ->transformWith(new UserTransformer())
            ->toArray(), Response::HTTP_OK);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(LoginRequest $request)
    {
        try {
            $this->validator($request->all())->validate();
            event(new Registered($user = $this->create($request->all())));
            $this->guard()->login($user);
            // attempt to verify the credentials and create a token for the user
            $token = app('tymon.jwt.auth')->fromUser($user);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->validator->getMessageBag()], Response::HTTP_BAD_REQUEST);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['error' => app('translator')->get('auth.could_not_create_token')], Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }

        return response()->json(
            fractal()
            ->item($user)
            ->transformWith(new UserTransformer())
            ->addMeta(['token' => $token])
            ->toArray(), Response::HTTP_CREATED);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return app('auth')->guard();
    }
}
