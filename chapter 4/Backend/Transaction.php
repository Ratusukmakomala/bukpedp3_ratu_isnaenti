<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\DetailTransaction;
use MongoDB\Laravel\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_number',
        'order_name',
        'payment',
        'order_date',
        'status',
        'grand_total'
    ];

    public function details()
    {
        return $this->hasMany(DetailTransaction::class);
    }

    public function scopeToday($query)
    {
        return $query->whereOrderDate(Carbon::now()->format('Y-m-d'));
    }

    public function scopeStatus($query, $status)
    {
        return $query->whereStatus($status);
    }
}
