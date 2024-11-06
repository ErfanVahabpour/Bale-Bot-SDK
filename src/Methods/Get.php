<?php

namespace EFive\Bale\Methods;

use EFive\Bale\Objects\User;

/**
 * Class Get.
 *
 * @mixin Http
 */
trait Get
{
    /**
     * A simple method for testing your bot's auth token.
     * Returns basic information about the bot in form of a User object.
     *
     * @link https://docs.bale.ai/#getme
     *
     * @throws BaleSDKException
     */
    public function getMe(): User
    {
        $response = $this->get('getMe');

        return new User($response->getDecodedBody());
    }
}