<?php

declare(strict_types=1);

namespace App\Module\Ticket\Services;

use App\Module\Customer\Services\CustomerService;
use App\Module\Ticket\DTO\CreateTicketDTO;
use App\Module\Ticket\Models\Ticket;
use App\Module\Ticket\Repositories\TicketRepository;

final class TicketService
{
    public function __construct(
        private readonly TicketRepository $ticketRepository,
        private readonly CustomerService $customerService,
    ) {
    }

    public function create(CreateTicketDTO $DTO): Ticket
    {
        $ticket = new Ticket();

        $ticket->title          = $DTO->subject;
        $ticket->description    = $DTO->message;

        $ticket->customer()->associate(
            $this->customerService->create($DTO->createCustomerDTO)
        );

        if ($DTO->file) {
            $ticket->addMedia($DTO->file)
                ->toMediaCollection('attachments');
        }

        $this->ticketRepository->create($ticket);

        return $ticket;
    }
}
