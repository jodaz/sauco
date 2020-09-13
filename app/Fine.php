<?php

namespace App;

use App\Liquidation;
use App\Payment;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\PrettyAmount;
use App\Traits\PrettyTimestamps;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;

class Fine extends Model implements Auditable
{
    use SoftDeletes, PrettyAmount, Audit, PrettyTimestamps;

    protected $table = 'fines';

    protected $guarded = [];

    protected $appends = [ 'pretty_amount' ];

    protected $casts = [ 'amount' => 'float' ];  

    public function nullFine()
    {
        return $this->hasOne(NullFine::class);
    }

    public static function applyFine($payment, $concept)
    {
        $amount = $payment->liquidations()->first()->amount;
        $fineAmount = $concept->calculateAmount($amount);
        $userId = User::whereLogin('sauco')->first()->id;

        $fine = $concept->fines()->create([
            'amount' => $fineAmount,
            'active' => true,
            'taxpayer_id' => $payment->taxpayer_id,
            'user_id' => $userId
        ]);

        $fine->liquidation()->create([
            'num' => Liquidation::newNum(),
            'object_payment' => $concept->name,
            'status_id' => $payment->state_id,
            'taxpayer_id' => $payment->taxpayer_id,
            'concept_id' => $concept->id,
            'liquidation_type_id' => $concept->liquidationType->id,
            'amount' => $fineAmount,
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function concept()
    {
        return $this->belongsTo(Concept::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function payment()
    {
        return $this->belongsToMany(Payment::class, Liquidation::class);
    }

    public function liquidation()
    {
        return $this->hasOne(Liquidation::class, 'model_id')
            ->whereLiquidationTypeId(2);
    }
}
