<?php

namespace App\Listeners;

use App\Events\Laravel\Passport\Events\AccessTokenCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Carbon\Carbon;

class PassportAccessTokenCreated
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  AccessTokenCreated  $event
     * @return void
     */
    public function handle(AccessTokenCreated $event)
    {
        $provider = \Config::get('auth.guards.api.provider');

        DB::table('oauth_access_token_providers')->insert(
            [
                'oauth_access_token_id' => $event->tokenId,
                'provider'              => $provider,
                'created_at'            => new Carbon(),
                'uodated_at'            => new Carbon()
            ]
        );
    }
}
