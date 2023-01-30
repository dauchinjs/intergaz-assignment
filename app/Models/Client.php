<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    use HasFactory;

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class, 'client_id', 'id');
    }

    public function deliveries(): HasMany
    {
        return $this->hasMany(Delivery::class, 'address_id', 'id');
    }
}
