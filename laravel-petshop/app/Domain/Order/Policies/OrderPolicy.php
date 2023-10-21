<?php

namespace App\Domain\Order\Policies;

use App\Domain\Order\Models\Order;
use App\Domain\User\BLL\Auth\AuthBLLInterface;
use App\Domain\User\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrderPolicy
{
    use HandlesAuthorization;

    public function __construct(public AuthBLLInterface $authBLL)
    {}

    /**
     * Determine whether the user can view the model.
     *
     * @return boolean
     */
    public function viewOrder(?User $user, Order $order)
    {
        if ($this->authBLL->getUserIdFromToken() !== $order->user_id) {
            return false;
        }

        return true;
    }
}
