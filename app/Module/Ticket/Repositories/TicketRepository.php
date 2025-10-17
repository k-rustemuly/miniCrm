<?php

declare(strict_types=1);

namespace App\Module\Ticket\Repositories;

use App\Module\Ticket\Models\Ticket;
use Throwable;

final class TicketRepository
{
    /**
     * @throws Throwable
     */
    public function create(Ticket $ticket): void
    {
        $ticket->saveOrFail();
    }
}
