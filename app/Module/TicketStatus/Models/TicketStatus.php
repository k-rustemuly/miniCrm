<?php

namespace App\Module\TicketStatus\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 */
class TicketStatus extends Model
{
    protected $fillable = [
        'name',
    ];
}
