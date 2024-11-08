<?php

namespace EFive\Bale\Methods;

use EFive\Bale\Objects\User;
use EFive\Bale\Objects\File;

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

    /**
     * Returns basic info about a file and prepare it for downloading.
     *
     *
     * The file can then be downloaded via the link
     * https://tapi.bale.ai/file/bot<token>/<file_path>,
     * where <file_path> is taken from the response.
     *
     * @link https://docs.bale.ai/#getfile
     *
     * <code>
     * $params = [
     *       'file_id' => '',  // string - Required. File identifier to get info about
     * ]
     * </code>
     *
     * @throws BaleSDKException
     */
    public function getFile(array $params): File
    {
        $response = $this->get('getFile', $params);

        return new File($response->getDecodedBody());
    }
}