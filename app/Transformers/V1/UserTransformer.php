<?php

namespace App\Transformers\V1;

use App\Models\SeatingPlan;
use App\Transformers\AbstractTransformer;
use App\Transformers\Internal\V1\EventTransformer;

class UserTransformer extends AbstractTransformer
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
        'accounts',
    ];

    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(object $user)
    {
        $data = [
            'id' => $user->id,
            'nickname' => $user->nickname,
            'name' => $user->name,
        ];

        return $this->modifyForUser($data, $user);
    }

    public function includeAccounts(object $user)
    {
        return $this->collection($user->accounts, new AccountTransformer());
    }
}
