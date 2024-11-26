<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\BillCalculationsTrait;

class Billing extends Model
{
    use HasFactory,BillCalculationsTrait;
    /**
     * Get all of the comments for the Billing
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function billedProducts()
    {
        return $this->hasMany(BilledProduct::class, 'billing_id', 'id');
    }
}
