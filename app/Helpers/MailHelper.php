<?php

namespace App\Helpers;

use App\Models\Mail;
use Illuminate\Support\Facades\Cache;

class MailHelper
{
    public static function getUnreadCount()
    {
        return Cache::remember('unread_mail_count', now()->addMinutes(5), function () {
            return Mail::where('is_read', false)->count();
        });
    }
}