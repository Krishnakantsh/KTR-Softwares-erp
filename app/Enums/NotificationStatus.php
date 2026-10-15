<?php

namespace App\Enums\Enums;

enum NotificationStatus: string
{
    case PROCESSING = 'processing';

    case DISPATCHED = 'dispatched';

    case SENT = 'sent';

    case FAILED = 'failed';
}
