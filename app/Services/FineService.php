<?php

namespace app\Services;

use App\Payment;
use App\Services\SettlementService;
use App\Concept;
use App\Settlement;

class FineService
{
    protected $settlement;

    public function __construct(SettlementService $settlement)
    {
        $this->settlement = $settlement;
    }

    public function create($settlement)
    {
        $amount = $this->calculateRechargue($settlement);
        $concept = Concept::whereCode(2)->first();

        $message = $this->settlement->message($concept, $settlement->month);
        $num = $this->settlement->newNum();

        $fine = Settlement::create([
            'num' => $num,
            'object_payment' => $message,
            'amount' => $amount,
            'taxpayer_id' => $settlement->taxpayer->id,
            'month_id' => $settlement->month->id,
            'state_id' => 2,
            'user_id' => auth()->user()->id,
            'concept_id' => $concept->id
        ]);

        return $fine;
    }

    public function calculateRechargue($settlement)
    {
        $concept = $settlement->concept;

        return $settlement->amount * 0.6;
    }
}
