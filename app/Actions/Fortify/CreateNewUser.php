<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'names' => ['required', 'string', 'max:255'],
            'paternal' => ['required', 'string', 'max:255'],
            'maternal' => ['required', 'string', 'max:255'],
            'dni' => ['required', 'integer', 'unique:users'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'string'],
            'gender' => ['required'],
            'password' => $this->passwordRules(),
            // 'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        return User::create([
            'names' => $input['names'],
            'paternal' => $input['paternal'],
            'maternal' => $input['maternal'],
            'dni' => $input['dni'],
            'email' => $input['email'],
            'phone_number' => $input['phone'],
            'gender' => $input['gender'],
            'password' => Hash::make($input['password']),
        ]);
    }
}
