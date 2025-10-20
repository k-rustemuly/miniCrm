<?php

namespace App\Module\Ticket\Models;

use App\Module\Customer\Models\Customer;
use App\Module\TicketStatus\Models\TicketStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Builder;

/**
 * @property int $id
 * @property string $title
 * @property string $description
 * @property int $customer_id
 * @property int $ticket_status_id
 * @property Carbon|null $anwered_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Customer|null $customer
 * @property-read TicketStatus|null $ticketStatus
 *
 * @method static Builder|self answered()
 * @method static Builder|self pending()
 * @method static Builder|self createdBetween(Carbon $from, Carbon $to)
 * @method static Builder|self answeredBetween(Carbon $from, Carbon $to)
 */
class Ticket extends Model implements HasMedia
{
    /** @use HasFactory<\Database\Factories\Module\Ticket\Models\TicketFactory> */
    use HasFactory;

    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'description',
        'customer_id',
        'ticket_status_id',
        'anwered_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'anwered_at' => 'datetime',
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

    public function scopeAnswered(Builder $query): Builder
    {
        return $query->whereNotNull('anwered_at');
    }

    public function scopePending(Builder $query): Builder
    {
        return $query->whereNull('anwered_at');
    }

    public function scopeCreatedBetween(Builder $query, Carbon $from, Carbon $to): Builder
    {
        return $query->whereBetween('created_at', [$from->startOfDay(), $to->endOfDay()]);
    }

    public function scopeAnsweredBetween(Builder $query, Carbon $from, Carbon $to): Builder
    {
        return $query->whereBetween('anwered_at', [$from->startOfDay(), $to->endOfDay()]);
    }
}
