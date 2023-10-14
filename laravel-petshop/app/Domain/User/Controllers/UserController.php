<?php

namespace App\Domain\User\Controllers;

use App\Http\Controllers\Controller;
use App\Domain\User\BLL\User\UserBLLInterface;
use App\Domain\User\Models\User;
use App\Domain\User\Requests\UserRequest;

/**
 * @property UserBLLInterface userBLL
 */
class UserController extends Controller
{
    public function __construct(UserBLLInterface $userBLL)
    {
        $this->userBLL = $userBLL;
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
     * @param UserRequest $request
     */
    public function store(UserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param  User  $user
     */
    public function update(UserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     */
    public function destroy(User $user)
    {
        //
    }
}
