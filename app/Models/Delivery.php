<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Delivery extends Model
{
    use HasFactory;

    public function client(): belongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function address(): HasOne
    {
        return $this->hasOne(Address::class, 'address_id');
    }

    public function deliveryLines(): HasMany
    {
        return $this->hasMany(DeliveryLine::class, 'delivery_id');
    }
}
