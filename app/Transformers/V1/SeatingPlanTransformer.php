<?php

namespace App\Transformers\V1;

use App\Models\SeatingPlan;
use App\Transformers\AbstractTransformer;
use App\Transformers\Internal\V1\EventTransformer;

class SeatingPlanTransformer extends AbstractTransformer
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'seats',
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'event',
        'seats',
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

        return $this->modifyForUser($data, $plan);
    }

    public function includeEvent(SeatingPlan $plan)
    {
        return $this->item($plan->event, new EventTransformer());
    }

    public function includeSeats(SeatingPlan $plan)
    {
        return $this->collection($plan->getData(), new SeatTransformer());
    }
}
