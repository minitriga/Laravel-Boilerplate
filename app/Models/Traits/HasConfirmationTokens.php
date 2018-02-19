<?php

namespace App\Models\Traits;

use App\Models\ConfirmationToken;


trait HasConfirmationTokens
{
    public function generateConfirmationToken()
    {
        $this->confirmationToken()->create([
            'token' => $token = str_random(200),
            'expires_at' => $this->getConfirmationTokenExpiry()
        ]);

        return $token;
    }

    public function confirmationToken()
    {
        return $this->hasOne(ConfirmationToken::class);
    }

    public function getConfirmationTokenExpiry()
    {
        return $this->freshTimestamp()->addMinutes(10);
    }
}