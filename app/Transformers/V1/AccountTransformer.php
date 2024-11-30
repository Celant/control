<?php

namespace App\Transformers\V1;

use App\Models\SeatingPlan;
use App\Transformers\AbstractTransformer;
use App\Transformers\Internal\V1\EventTransformer;

class AccountTransformer extends AbstractTransformer
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
    protected array $availableIncludes = [];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(object $account)
    {
        $data = [
            'id' => $account->id,
            'external_id' => $account->external_id,
        ];

        return $this->modifyForUser($data, $account);
    }
}
