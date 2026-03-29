<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\Contracts\UserServiceInterface;

class UserController extends Controller
{
    /**
     * @param UserServiceInterface $userService
     */
    public function __construct(
        protected UserServiceInterface $userService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection($this->userService->getUsersWithReservation());
    }
}
