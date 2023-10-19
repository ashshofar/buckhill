<?php

namespace App\Domain\Order\BLL\Order;

use App\Domain\Order\DAL\Order\OrderDALInterface;
use App\Domain\Order\DAL\OrderStatus\OrderStatusDALInterface;
use App\Domain\Order\DAL\Payment\PaymentDALInterface;
use App\Domain\Order\DTO\Order\OrderDTO;
use App\Domain\Order\Models\Order;
use App\Domain\Product\DAL\Product\ProductDALInterface;
use App\Domain\User\BLL\Auth\AuthBLLInterface;
use App\Domain\User\DAL\User\UserDALInterface;
use App\DomainUtils\BaseBLL\BaseBLL;
use App\DomainUtils\BaseBLL\BaseBLLFileUtils;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @property OrderDALInterface DAL
 */
class OrderBLL extends BaseBLL implements OrderBLLInterface
{
    use BaseBLLFileUtils;

    public function __construct(
        public AuthBLLInterface $authBLL,
        public OrderDALInterface $orderDAL,
        public OrderStatusDALInterface $orderStatusDAL,
        public UserDALInterface $userDAL,
        public PaymentDALInterface $paymentDAL,
        public ProductDALInterface $productDAL
    ) {}

    /**
     * Get order list by user id
     *
     * @return LengthAwarePaginator
     */
    public function getListOrders(): LengthAwarePaginator
    {
        return $this->orderDAL->getListOrder($this->authBLL->getUserIdFromToken());
    }

    /**
     * Create order
     *
     * @param OrderDTO $order
     * @return Order
     */
    public function createOrder(OrderDTO $order, $userId = null): Order
    {
        $amount = $this->calculateAmount($order->products);

        $orderToSave = [
            'user_id' => is_null($userId) ? $this->authBLL->getUserIdFromToken() : $userId,
            'order_status_id' => $this->orderStatusDAL->findOrderStatusByUuid($order->orderStatusUuid)->id,
            'payment_id' => $this->paymentDAL->findPaymentByUuid($order->paymentUuid)->id,
            'products' => json_encode($order->products),
            'address' => json_encode($order->address),
            'delivery_fee' => $amount < Order::MIN_AMOUNT_TOTAL ? Order::DELIVERY_FEE : null,
            'amount' => $amount,
        ];

        return $this->orderDAL->create($orderToSave);
    }

    /**
     * Calculate amount price order
     *
     * @param array $products
     * @return float|int
     */
    private function calculateAmount(array $products): float|int
    {
        $amount = 0;
        foreach ($products as $product) {
            $productData = $this->productDAL->findProductByUuid($product->uuid);

            if (!is_null($productData)) {
                $amount += $product->quantity * $productData->price;
            }
        }

        return $amount;
    }
}
