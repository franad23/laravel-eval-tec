<?php

namespace App\Services;

use App\Models\EventRegistration;

class EventRegistrationService
{
    public function create(array $data): EventRegistration
    {
        return EventRegistration::create($data);
    }

    public function getTotalCount(): int
    {
        return EventRegistration::count();
    }

    public function getRegistrationById (int $id): ?EventRegistration
    {
        return EventRegistration::find($id);
    }
}