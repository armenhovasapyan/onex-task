<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'books' => $this->books->map(function ($book) {
                return [
                    'name' => $book->name,
                    'quantity' => $book->quantity,
//                    'status' => $book->users->status
                ];
            }),
        ];
    }
}
