<?php

namespace App\Domain\Order\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\Order\BLL\Order\OrderBLLInterface;
use App\Domain\Order\Models\Order;
use App\Domain\Order\Requests\OrderRequest;

/**
 * @property OrderBLLInterface orderBLL
 */
class OrderController extends Controller
{
    public function __construct(OrderBLLInterface $orderBLL)
    {
        $this->orderBLL = $orderBLL;
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     */
    public function store(OrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Order  $order
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param OrderRequest $request
     * @param  Order  $order
     */
    public function update(OrderRequest $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     */
    public function destroy(Order $order)
    {
        //
    }
}
