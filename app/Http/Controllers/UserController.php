<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(UserResource::collection(User::all()));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);

        return response()->json($user, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return response()->json(new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);

        return response()->json(new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(null, 204);
    }

    // public function fbSignInCallback()
    // {
    //     if (request()->error == 'access_denied') {
    //         throw new Exception('access denied');
    //     }
    //     $redirect_url = env('FB_REDIRECT');
    //     $fbUser = Socialite::driver('facebook')->fields(['name', 'email'])->redirectUrl($redirect_url)->user();
    //     $fb_email = $fbUser->rmail;
    //     if (is_null($fb_email)) {
    //         throw new Exception('位授權使用者email');
    //     }
    //     $facebook_id = $fbUser->id;
    //     $facebook_name = $fbUser->name;
    //     echo 'success';
    //
    // }
}
