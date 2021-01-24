<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable as Auditable;
use OwenIt\Auditing\Auditable as Audit;
use Carbon\Carbon;
use App\Concept;
use App\Traits\PrettyTimestamps;
use App\Traits\PrettyAmount;
use App\Traits\MakeLiquidation;

class Affidavit extends Model implements Auditable
{
    use Audit, SoftDeletes, PrettyTimestamps, PrettyAmount, MakeLiquidation;

    protected $table = 'affidavits';

    protected $fillable = [
        'total_calc_amount',
        'total_brute_amount',
        'taxpayer_id',
        'user_id',
        'month_id'
    ];

    protected $casts = [ 'amount' => 'float' ];

    protected $with = [ 'month' ];

    protected $appends = [
        'pretty_amount',
        'brute_amount_affidavit'
    ];
    
    public static function processedByDate($firstDate, $lastDate)
    {
        return self::whereBetween('processed_at', [$firstDate->toDateString(), $lastDate->toDateString()])
            ->whereStateId(2)
            ->orderBy('processed_at', 'ASC')
            ->get();
    }

    public function shouldHaveFine()
    {
        $startPeriod = Carbon::parse($this->month->start_period_at);
        $todayDate = Carbon::now();
        $passedDays = $startPeriod->diffInDays($todayDate);

        if ($passedDays > 60) {
            return [
                Concept::whereCode(3)->first(),
                Concept::whereCode(3)->first(),
            ]; 
        } else if ($passedDays > 45) {
            return [Concept::whereCode(3)->first()]; 
        }

        return false;
    }

    public function getNull()
    {
        return $this->hasOne(NullAffidavit::class);
    }

    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    public function taxpayer()
    {
        return $this->belongsTo(Taxpayer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function economicActivityAffidavits()
    {
        return $this->hasMany(EconomicActivityAffidavit::class);
    }

    public function payment()
    {
        $liquidation = $this->liquidation;

        return $liquidation->payment()->first();
    }

    public function withholding()
    {
        return $this->belongsToMany(Withholding::class);
    }

    public function processedPayment()
    {
        return $this->belongsToMany(Payment::class, Liquidation::class)->first();
    }

    public function liquidation()
    {
        return $this->morphOne(Liquidation::class, 'liquidable')
            ->withTrashed();
    }

    public function scopeLastAffidavit($query)
    {
        return $query->latest()->first();
    }

    public function changeData($userId, $processed_at)
    {
        $date = Carbon::parse($processed_at);

        return $this->update(['user_id' => $userId, 'processed_at' => $date ]);
    }

    public function scopeFindOneByMonth($query, $taxpayer, $month)
    {
        return $query->whereTaxpayerId($taxpayer->id)
            ->whereMonthId($month->id);
    }

    public function getBruteAmountAffidavitAttribute($value)
    {
        $totalAffidavit = $this->economicActivityAffidavits->sum('brute_amount');

        return number_format($totalAffidavit, 2, ',', '.');
    }
}