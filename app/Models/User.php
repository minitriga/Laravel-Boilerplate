<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Traits\HasConfirmationTokens;
use App\Models\Traits\HasSubscriptions;
use App\Models\Traits\HasTwoFactorAuthentication;
use App\Models\Traits\HasRoles;
use Laravel\Cashier\Billable;
use Laravel\Cashier\Subscription;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TwoFactor;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,
    HasConfirmationTokens, 
    HasRoles, 
    Billable, 
    HasSubscriptions, 
    HasTwoFactorAuthentication, 
    SoftDeletes,
    HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'activated',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function hasActivated()
    {
        return $this->activated;
    }

    public function hasNotActivated()
    {
        return !$this->hasActivated();
    }

    public function team()
    {
        return $this->hasOne(Team::class);
    }

    public function plan()
    {
        return $this->plans->first();
    }

    public function getPlanAttribute()
    {
        return $this->plan();
    }

    public function plans()
    {
        return $this->hasManyThrough(
            Plan::class, Subscription::class, 'user_id', 'gateway_id', 'id', 'stripe_plan'
        )->orderBy('subscriptions.created_at', 'desc');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }
}
