<?php

namespace App\Http\Controllers;

use App\Http\Resources\MessagesResource;
use App\Module\Ticket\Requests\CreateTicketRequest;
use App\Module\Ticket\Services\TicketService;

class TicketController extends Controller
{
    public function __construct(private readonly TicketService $service)
    {}

    /**
     * @OA\Post (
     *     path="/api/tickets",
     *     summary="Создать заявку",
     *     operationId="createTicket",
     *     tags={"Ticket"},
     *
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/CreateTicketRequest")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Отправлено успешно"),
     *             @OA\Property(property="data", type="object",example=null),
     *             @OA\Property(property="code", type="integer", example=200),
     *         ),
     *     ),
     * )
     */
    public function save(CreateTicketRequest $request)
    {
        $this->service->create($request->getDTO());

        return (new MessagesResource(null))
            ->setMessage(trans('widget.success'));
    }
}
