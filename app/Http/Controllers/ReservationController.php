<?php

namespace App\Http\Controllers;

use App\Enums\ReservationStatus;
use App\Events\ReservationCreated;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Services\Contracts\ReservationServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ReservationController extends Controller
{
    /**
     * @param ReservationServiceInterface $reservationService
     */
    public function __construct(
        private readonly ReservationServiceInterface $reservationService,
    ) {}

    /**
     * @return JsonResponse
     */
    public function create(CreateReservationRequest $request)
    {
        $user = $request->user();

        try {
            $this->reservationService->createReservation($user, $request->book_id);
//             $this->reservationService->createReservationWithoutORM($user->id, $request->book_id);
            ReservationCreated::dispatch($user->id, $request->book_id, $this->reservationService);
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->json(['Book added successfully'], 201);
    }

    /**
     * @return JsonResponse|Response
     */
    public function update(UpdateReservationRequest $request)
    {
        try {
            if ($request->status === ReservationStatus::CANCELED->value) {
                $this->reservationService->cancelReservation($request->user_id, $request->book_id);
            } else {
                $this->reservationService->confirmReservation($request->user_id, $request->book_id);
            }
        } catch (\Throwable $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }

        return response()->noContent();
    }
}
