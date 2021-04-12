<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use App\Traits\NewValue;
use App\Traits\PrettyAmount;
use App\Traits\PrettyTimestamps;

class Movement extends Model
{
    use SoftDeletes, Audit, NewValue, PrettyAmount, PrettyTimestamps;

    protected $table = 'movements';

    protected $fillable = [
        'amount',
        'concept_id',
        'liquidation_id',
        'year_id',
        'payment_id'
    ];

    public function year()
    {
        return $this->belongsTo(Year::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function liquidation()
    {
        return $this->belongsTo(Liquidation::class);
    }
}
