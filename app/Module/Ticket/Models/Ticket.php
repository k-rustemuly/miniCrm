<?php

namespace App\Module\Ticket\Models;

use App\Module\Customer\Models\Customer;
use App\Module\TicketStatus\Models\TicketStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $customer_id
 * @property int $ticket_status_id
 * @property Carbon|null $answered_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Customer|null $customer
 * @property-read TicketStatus|null $ticketStatus
 */
class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'customer_id',
        'ticket_status_id',
        'answered_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'answered_at' => 'datetime',
        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function ticketStatus(): BelongsTo
    {
        return $this->belongsTo(TicketStatus::class);
    }
}
