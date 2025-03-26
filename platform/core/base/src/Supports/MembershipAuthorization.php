<?php

namespace Botble\Base\Supports;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Throwable;

class MembershipAuthorization
{
    protected string $url;

    public function __construct()
    {
        $this->url = rtrim(url('/'), '/');
    }

    public function authorize(): bool
    {
        return true;
    }

    protected function isInvalidDomain(): bool
    {
        if (filter_var($this->url, FILTER_VALIDATE_IP)) {
            return true;
        }

        $blacklistDomains = [
            'localhost',
            '.local',
            '.test',
            '127.0.0.1',
            '192.',
            'mail.',
            '8000',
        ];

        foreach ($blacklistDomains as $blacklistDomain) {
            if (Str::contains($this->url, $blacklistDomain)) {
                return true;
            }
        }

        return false;
    }

    protected function processAuthorize(): bool
    {
        return true;
    }
}
