<?php

namespace App\Transformers\V1;

use App\Models\SeatingPlan;
use App\Models\Ticket;
use App\Transformers\AbstractTransformer;
use App\Transformers\Internal\V1\EventTransformer;

class SeatTransformer extends AbstractTransformer
{
    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected array $defaultIncludes = [];

    /**
     * List of resources possible to include
     *
     * @var array
     */
    protected array $availableIncludes = [
        'ticket',
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(object $seat)
    {
        $data = [
            'id' => $seat->id,
            'x' => $seat->x,
            'y' => $seat->y,
            'class' => $seat->class,
            'label' => $seat->label,
            'row' => $seat->row,
            'number' => $seat->number,
            'disabled' => $seat->disabled,
            'description' => $seat->description,
        ];

        return $this->modifyForUser($data, $seat);
    }

    public function includeTicket(object $seat)
    {
        $ticket = Ticket::find($seat->ticketId);
        if (!$ticket) {
            return null;
        }
        return $this->item($ticket, new TicketTransformer());
    }
}
