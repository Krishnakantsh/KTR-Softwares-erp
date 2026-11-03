<?php

namespace App\Enums\Enums;

enum NotificationTargetType: string
{

    case USER = 'user';

    case USERS = 'users';

    case TOPIC = 'topic';

    case ALL = 'all';
}
