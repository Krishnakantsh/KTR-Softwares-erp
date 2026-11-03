<?php

namespace App\Enums;

enum NotificationChannel: string
{
    case PUSH = 'push';

    case SMS = 'sms';

    case WHATSAPP = 'whatsapp';

    case EMAIL = 'email';
}
