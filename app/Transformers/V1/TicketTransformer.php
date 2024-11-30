<?php

namespace App\Transformers\V1;

use App\Models\SeatingPlan;
use App\Transformers\AbstractTransformer;
use App\Transformers\Internal\V1\EventTransformer;

class TicketTransformer extends AbstractTransformer
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [
        'user',
    ];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'user',
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(object $ticket)
    {
        $data = [
            'id' => $ticket->id,
        ];

        return $this->modifyForUser($data, $ticket);
    }

    public function includeUser(object $ticket)
    {
        return $this->item($ticket->user, new UserTransformer());
    }
}
