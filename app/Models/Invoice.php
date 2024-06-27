<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['customer_id', 'date', 'amount', 'status'];

    public function customer()
    {
        return $this->hasOne(Customer::class, 'id', 'customer_id');
    }

    // public function getDateAttribute($value)
    // {
    //     return Carbon::parse($value)->format('d/m/Y'); // Set desired format
    // }
    // public function getAmountAttribute($value)
    // {
    //     return Carbon::parse($value)->format('d/m/Y'); // Set desired format
    // }
}
