<?php

namespace EFive\Bale\Methods;

use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\Objects\File;
use EFive\Bale\Objects\Message as MessageObject;
use EFive\Bale\Traits\Http;

/**
 * Class Message.
 *
 * @mixin Http
 */
trait Stickers
{
    /**
     * Use this method to send static .WEBP or animated .TGS stickers.
     *
     * <code>
     * $params = [
     *       'chat_id'                      => '',                      // int|string       - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'sticker'                      => InputFile::file($file),  // InputFile|string - Required. Sticker to send. Pass a file_id as String to send a file that exists on the Bale servers (recommended), pass an HTTP URL as a String for Bale to get a .webp file from the Internet, or upload a new one using multipart/form-data.
     *       'disable_notification'         => '',                      // bool             - (Optional). Sends the message silently. iOS users will not receive a notification, Android users will receive a notification with no sound.
     *       'protect_content'              => '',                      // bool             - (Optional). Protects the contents of the sent message from forwarding and saving
     *       'reply_to_message_id'          => '',                      // int              - (Optional). If the message is a reply, ID of the original message
     *       'allow_sending_without_reply   => '',                      // bool             - (Optional). Pass True, if the message should be sent even if the specified replied-to message is not found
     *       'reply_markup'                 => '',                      // string           - (Optional). Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * ]
     * </code>
     *
     * @link ?
     *
     * @throws BaleSDKException
     */
    public function sendSticker(array $params): MessageObject
    {
        $response = $this->uploadFile('sendSticker', $params, 'sticker');

        return new MessageObject($response->getDecodedBody());
    }

    /**
     * Upload a .png file with a sticker for later use in createNewStickerSet and addStickerToSet
     * methods (can be used multiple times).
     *
     * <code>
     * $params = [
     *       'user_id'      => '',                      // int       - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'sticker'  => InputFile::file($file),      // InputFile - Required. Png image with the sticker, must be up to 512 kilobytes in size, dimensions must not exceed 512px, and either width or height must be exactly 512px (TGS, PNG, WEBP or WEBM).
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#uploadstickerfile
     *
     * @throws BaleSDKException
     */
    public function uploadStickerFile(array $params): File
    {
        $response = $this->uploadFile('uploadStickerFile', $params, 'sticker');

        return new File($response->getDecodedBody());
    }

    /**
     * Create new sticker set owned by a user.
     *
     * <code>
     * $params = [
     *       'user_id'         => '',                           // int              - Required. User identifier of created sticker set owner
     *       'name'            => '',                           // string           - Required. Short name of sticker set, to be used in t.me/addstickers/ URLs (e.g., animals). Can contain only english letters, digits and underscores. Must begin with a letter, can't contain consecutive underscores and must end in “_by_<bot username>”. <bot_username> is case insensitive. 1-64 characters.
     *       'title'           => '',                           // string           - Required. Sticker set title, 1-64 characters
     *       'sticker'         => InputFile::file($file),       // InputFile|string - (Optional). Png image with the sticker, must be up to 512 kilobytes in size, dimensions must not exceed 512px, and either width or height must be exactly 512px. Pass a file_id as a String to send a file that already exists on the Bale servers, pass an HTTP URL as a String for Bale to get a file from the Internet, or upload a new one using multipart/form-data.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#createnewstickerset
     *
     * @throws BaleSDKException
     */
    public function createNewStickerSet(array $params): bool
    {
        return $this->uploadFile('createNewStickerSet', $params, 'png_sticker')->getResult();
    }

    /**
     * Add a new sticker to a set created by the bot.
     *
     * <code>
     * $params = [
     *       'user_id'        => '',                           // int              - Required. User identifier of sticker set owner
     *       'name'           => '',                           // string           - Required. Sticker set name
     *       'sticker'        => InputFile::file($file),       // InputFile|string - Required. Png image with the sticker, must be up to 512 kilobytes in size, dimensions must not exceed 512px, and either width or height must be exactly 512px. Pass a file_id as a String to send a file that already exists on the Bale servers, pass an HTTP URL as a String for Bale to get a file from the Internet, or upload a new one using multipart/form-data.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#addstickertoset
     *
     * @throws BaleSDKException
     */
    public function addStickerToSet(array $params): bool
    {
        return $this->uploadFile('addStickerToSet', $params, 'png_sticker')->getResult();
    }
}