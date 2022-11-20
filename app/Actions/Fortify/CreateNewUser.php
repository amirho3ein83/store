<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Unique;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $userValidation = [
            'password' => [
                'required',
                'min:6',
                // 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/',
                'confirmed'
            ],
            'mobile' => ['required', 'string', 'unique:users,mobile', 'regex:/(09)[0-9]{9}/'],
            // 'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ];

        // validation with email
        $use_email = false;
        if (preg_match("/[-0-9a-zA-Z.+]+@[-0-9a-zA-Z.+]+.[a-zA-Z]{2,4}/", $input['mobile'])) {
            unset($userValidation['mobile']);
            $userValidation['mobile'] =  ['required', 'email', 'max:255', 'unique:users,email'];
            $use_email = true;
        }

        Validator::make($input, $userValidation, [
            'mobile.unique' => 'mobile has already been token',
            'email.unique' => 'email has already been token',
        ])->validate();

        $user = User::create([
            'email' => $use_email ? $input['mobile'] : null,
            'mobile' => !$use_email ? $input['mobile'] : null,
            'password' => Hash::make($input['password']),
        ]);

        Wallet::create([
            'user_id' => $user->id
        ]);

        return $user;
    }
}
