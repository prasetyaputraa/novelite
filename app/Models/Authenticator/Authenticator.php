<?php

namespace App\Models\Authenticator;

use Illuminate\Database\Eloquent\Model;

use RuntimeException;
use Illuminate\Hashing\HashManager;
use Illuminate\Foundation\Auth\User as Authenticable;


class Authenticator
{
    protected $hasher;

    public function __construct(HashManager $hasher)
    {
        $this->hasher = $hasher->driver();
    }

    public function attempt(
        string $username, string $password, string $provider
    ) : ?Authenticable
    {
        if (!$model = config("auth.providers.{$provider}.model")) {
            throw new RuntimeException('Unable to determine authentication model from configuration');
        }

        if (!$user = (new $model)->where('email', $username)->first()) {
            return null;
        }

        if (!$this->hasher->check($password, $user->getAuthPassword())) {
            return null;
        }

        return $user;
    }
}
