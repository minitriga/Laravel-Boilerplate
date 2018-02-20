<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\User;
use App\TwoFactor\TwoFactor;

class ValidTwoFactorToken implements Rule
{

    protected $user;

    protected $twofactor;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(User $user, TwoFactor $twofactor)
    {
        $this->user = $user;
        $this->twofactor = $twofactor;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return $this->twofactor->validateToken($this->user, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid two factor authentication token.';
    }
}
