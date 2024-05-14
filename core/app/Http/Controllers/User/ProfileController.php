<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    public function profile()
    {
        $pageTitle = "Profile Setting";
        $user      = auth()->user()->load('userRanking');
        $countries  = json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $info       = json_decode(json_encode(getIpInfo()), true);
        $mobileCode = @implode(',', $info['code']);
        return view($this->activeTemplate . 'user.profile_setting', compact('pageTitle', 'user', 'mobileCode','countries'));
    }

    public function submitProfile(Request $request)
    {
        $countryData  = (array) json_decode(file_get_contents(resource_path('views/partials/country.json')));
        $countryCodes = implode(',', array_keys($countryData));
        $mobileCodes  = implode(',', array_column($countryData, 'dial_code'));
        $countries    = implode(',', array_column($countryData, 'country'));

        $request->validate([
            'firstname' => 'required|string',
            'lastname'  => 'required|string',
        ], [
            'firstname.required' => 'First name field is required',
            'lastname.required'  => 'Last name field is required',
            'mobile_code' => 'required_with:mobile|in:'.$mobileCodes,
            'country_code' => 'in:'.$countryCodes,
            'country' => 'required|in:'.$countries,
        ]);

        $user = auth()->user();

        $user->firstname = $request->firstname;
        $user->lastname  = $request->lastname;
        $user->country_code = $request->country_code;
        $user->mobile       = $request->mobile_code . $request->mobile;

        $user->address = [
            'country' => @$user->address->country,
        ];

        $user->save();
        $notify[] = ['success', 'Профиль успешно обновлен!'];
        return back()->withNotify($notify);
    }

    public function changePassword()
    {
        $pageTitle = 'Change Password';
        return view($this->activeTemplate . 'user.password', compact('pageTitle'));
    }

    public function submitPassword(Request $request)
    {
        $passwordValidation = Password::min(6);
        if (gs('secure_password')) {
            $passwordValidation = $passwordValidation->mixedCase()->numbers()->symbols()->uncompromised();
        }

        $this->validate($request, [
            'current_password' => 'required',
            'password'         => ['required', 'confirmed', $passwordValidation],
        ]);

        $user = auth()->user();
        if (Hash::check($request->current_password, $user->password)) {
            $password       = Hash::make($request->password);
            $user->password = $password;
            $user->save();
            $notify[] = ['success', 'Password changes successfully'];
            return back()->withNotify($notify);
        } else {
            $notify[] = ['error', 'The password doesn\'t match!'];
            return back()->withNotify($notify);
        }
    }
}
