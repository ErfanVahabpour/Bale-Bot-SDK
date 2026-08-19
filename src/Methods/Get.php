<?php

namespace EFive\Bale\Methods;

use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\Objects\File;
use EFive\Bale\Objects\User;
use EFive\Bale\Traits\Http;

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

    /**
     * Use this method to send answers to callback queries sent from inline keyboards.
     *
     * <code>
     * $params = [
     *       'callback_query_id' => '',    // string - Required. Unique identifier for the query to be answered
     *       'text'              => '',    // string - (Optional). Text of the notification. If not specified, nothing will be shown to the user, 0-200 characters
     *       'show_alert'        => false, // bool   - (Optional). If True, an alert will be shown by the client instead of a notification at the top of the chat screen. Defaults to false.
     *       'url'               => '',    // string - (Optional). URL that will be opened by the user's client.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#answercallbackquery
     *
     * @throws BaleSDKException
     */
    public function answerCallbackQuery(array $params): bool
    {
        return $this->post('answerCallbackQuery', $params)->getResult();
    }

    /**
     * Use this method to ask user to review the bot.
     *
     * <code>
     * $params = [
     *       'user_id' => '',  // int - Required. Unique identifier of the target user
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#askreview
     *
     * @throws BaleSDKException
     */
    public function askReview(array $params): bool
    {
        return $this->post('askReview', $params)->getResult();
    }
}
