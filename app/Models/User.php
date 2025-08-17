<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'customer_id',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            if (empty($user->remember_token)) {
                $user->remember_token = Str::random(60);
            }
        });
    }

    public function getAuthIdentifierName()
    {
        return 'customer_id';
    }

    // Relationship to Customer model
    public function customer()
    {
        return $this->hasOne(Customer::class, 'customer_id', 'customer_id');
    }

// In User.php
public function transactions()
{
    return $this->hasMany(Transaction::class, 'customer_id', 'customer_id');
}
}
