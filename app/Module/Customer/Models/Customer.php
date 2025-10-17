<?php

namespace App\Module\Customer\Models;

use App\Module\Ticket\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $phone_number
 * @property string $email
 * @property-read Ticket|null $tickets
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Customer extends Model
{
    /** @use HasFactory<\Database\Factories\Module\Customer\Models\CustomerFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'phone_number',
        'email',
    ];

    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }
}
