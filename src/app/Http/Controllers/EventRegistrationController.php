<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventRegistrationRequest;
use App\Jobs\SendWelcomeEmailJob;
use App\Jobs\UpdateRegistrationEventCounter;
use App\Services\EventRegistrationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class EventRegistrationController extends Controller
{
    protected EventRegistrationService $eventRegistrationService;
    public function __construct(EventRegistrationService $eventRegistrationService)
    {
        $this->eventRegistrationService = $eventRegistrationService;
    }
    public function store(StoreEventRegistrationRequest $request)
    {
        try {
            $registration = $request->validated();
            $newRegistration = $this->eventRegistrationService->create($registration);
            dispatch(new UpdateRegistrationEventCounter());
            dispatch(new SendWelcomeEmailJob($newRegistration));
            return response()->json([
                "success"=> true,
                "message"=> "Registro creado correctamente"
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "success"=> false,
                "message"=> $e->getMessage()
            ], 500);
        }
    }

    public function getById(Request $request)
    {
        try {
            $registrationEventId = $request->query('id');
            $cachedData = Redis::get('registrationEvent'.$registrationEventId);
            if ($cachedData) {
                $cachedData = json_decode($cachedData, true);
                return response()->json([
                    'success'=> true,
                    'message'=> 'Registro encontrado',
                    'data' => $cachedData
                ], 200);
            };

            $registrationFound = $this->eventRegistrationService->getRegistrationById($registrationEventId);

            if (empty($registrationFound)) {
                return response()->json([
                    'success'=> false,
                    'message'=> 'Registro no encontrado'
                ], 404);
            }
            Redis::set('registrationEvent'.$registrationEventId, $registrationFound->toJson());
            return response()->json([
                'success'=> true,
                'message'=> 'Registro encontrado',
                'data' => $registrationFound
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                "success"=> false,
                "message"=> $e->getMessage()
            ], 500);
        }
    }
}
