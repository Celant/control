<?php

namespace App\Transformers\Internal\V1;

use App\Models\SeatingPlan;
use App\Transformers\AbstractTransformer;

class SeatingPlanTransformer extends AbstractTransformer
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'event',
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'event',
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(SeatingPlan $plan)
    {
        $data = [
            'id' => $plan->id,
            'code' => $plan->code,
            'name' => $plan->name,
            'revision' => $plan->revision,
            'order' => $plan->order,
        ];

        $data = $this->modifyForUser($data, $plan);

        return $data;
    }

    public function includeEvent(SeatingPlan $plan)
    {
        return $this->item($plan->event, new EventTransformer());
    }
}
