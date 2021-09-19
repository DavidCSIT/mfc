<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Gate;
use App\Models\Family;
use App\Models\Recipe;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create(Request $request)
    {
        return view('auth.register');
    }

    public function invite(Request $request)
    {
        return view('auth.invite', ['family_code' => $request->family]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        if (isset($request->family)) {
            $request->validate([
                'name' => 'required|string|max:255',
                'family' => 'required|string',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $publicAccess = isset($request->public) ? true : false;

            $family = Family::create([
                'name' => $request->family,
                'public_access' => $publicAccess,
                'family_code' => Str::random(20),
            ]);

            $user = User::create([
                'name' => $request->name,
                'family_id' => $family->id,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
        } else {
            $request->validate([
                'name' => 'required|string|max:255',
                'family_code' => 'required',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ]);

            $family = Family::where('family_code', $request->family_code )->get();
    
            $user = User::create([
                'name' => $request->name,
                'family_id' => $family[0]->id,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
        }


        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function update(user $user)
    {
        if (!Gate::allows('admin-family', $user)) {
            abort(403);
        }

        Recipe::where('user_id', $user->id)->update(['user_id' => Auth::id()]);
        $user->admin =  !$user->admin;
        $user->save();
        return redirect('/familys/' . auth::user()->family_id);
    }


    public function destroy(user $user)
    {
        if (!Gate::allows('admin-family', $user)) {
            abort(403);
        }

        Recipe::where('user_id', $user->id)->update(['user_id' => Auth::id()]);
        $user->delete();
        return redirect('/familys/' . auth::user()->family_id);
    }
}
