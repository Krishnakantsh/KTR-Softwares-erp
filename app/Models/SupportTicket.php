<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
      protected $table = 'support_tickets';

      protected $fillable = [
            'ticket_no',
            'full_name',
            'email',
            'phone',
            'priority',
            'company_message',
            'client_message',
            'company_reply',
            'replied_at',
            'replied_by',
            'status',
      ];

      protected $casts = [
            'replied_at' => 'datetime',
      ];
}
