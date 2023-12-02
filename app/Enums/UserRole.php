<?php

namespace App\Enums;


class UserRole
{
    const ADMIN = 'admin';
    const USER = 'user';
    const TUTOR = 'tutor';

    const TYPES = [
        self::ADMIN,
        self::USER,
        self::TUTOR
    ];

}