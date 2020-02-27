<?php

namespace App\Services;

use App\Concept;
use App\Settlement;
use App\Taxpayer;
use App\Services\EconomicActivitySettlementService;

class SettlementService extends ModelService 
{
    /**
     * @var Settlement Model
     */
    protected $model;

    public function __construct(Settlement $model, EconomicActivitySettlementService $activitySettlement)
    {
        $this->model = $model;
        $this->activitySettlement = $activitySettlement;
    }

    /**
     * Handle all settlements
     * @param Taxpayer $taxpayer, Concept $concept
     */
    public function make(Taxpayer $taxpayer, Concept $concept)
    {
        $settlement = $this->create($taxpayer, $concept);
        $code = $concept->code;

        if ($code == 1) {
            $this->activitySettlement->make($settlement);
        }
    }

    /**
     * Creates an economic activity settlement for a given taxpayer
     * @param Taxpayer $taxpayer
     */
    public function create($taxpayer, $concept)
    {
        $settlement = Settlement::create([
            'num' => $this->getNewNum(),
            'amount' => 0.00,
            'taxpayer_id' => $taxpayer->id,
            'month_id' => 1,
            'state_id' => 1,
            'concept_id' => $concept->id
        ]);

        return $settlement;
    }
}

