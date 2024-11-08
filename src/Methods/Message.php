<?php

namespace EFive\Bale\Methods;

use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\Objects\Message as MessageObject;
use EFive\Bale\Traits\Http;

/**
 * Class Message.
 *
 * @mixin Http
 */
trait Message
{
    /**
     * Send text messages.
     *
     * <code>
     * $params = [
     *       'chat_id'                     => '',  // int|string - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'text'                        => '',  // string     - Required. Text of the message to be sent
     *       'reply_to_message_id'         => '',  // int        - (Optional). If the message is a reply, ID of the original message
     *       'reply_markup'                => '',  // object     - (Optional). One of either InlineKeyboardMarkup|ReplyKeyboardMarkup|ReplyKeyboardRemove|ForceReply for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#sendmessage
     *
     * @throws BaleSDKException
     */
    public function sendMessage(array $params): MessageObject
    {
        $response = $this->post('sendMessage', $params);

        return new MessageObject($response->getDecodedBody());
    }

    /**
     * Forward messages of any kind.
     *
     * <code>
     * $params = [
     *       'chat_id'               => '',  // int|string - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'from_chat_id'          => '',  // int        - Required. Unique identifier for the chat where the original message was sent (or channel username in the format "@channelusername")
     *       'message_id'            => '',  // int        - Required. Message identifier in the chat specified in from_chat_id
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#forwardmessage
     *
     * @throws BaleSDKException
     */
    public function forwardMessage(array $params): MessageObject
    {
        $response = $this->post('forwardMessage', $params);

        return new MessageObject($response->getDecodedBody());
    }

    /**
     * Copy messages of any kind.
     *
     * The method is analogous to the method forwardMessages, but the copied message doesn't have a link to the original message.
     *
     * <code>
     * $params = [
     *       'chat_id'                       => '',  // int|string - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'from_chat_id'                  => '',  // int        - Required. Unique identifier for the chat where the original message was sent (or channel username in the format "@channelusername")
     *       'message_id'                    => '',  // int        - Required. Message identifier in the chat specified in from_chat_id
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#copymessage
     *
     * @throws BaleSDKException
     */
    public function copyMessage(array $params): MessageObject
    {
        $response = $this->post('copyMessage', $params);

        return new MessageObject($response->getDecodedBody());
    }

    /**
     * Send Photo.
     *
     * <code>
     * $params = [
     *       'chat_id'                     => '',                      // int|string       - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'from_chat_id'                => '',                      // int              - Required. Unique identifier for the chat where the original message was sent (or channel username in the format "@channelusername")
     *       'photo'                       => InputFile::file($file),  // InputFile|string - Required. Photo to send. Pass a file_id as String to send a photo that exists on the Bale servers (recommended), pass an HTTP URL as a String for Bale to get a photo from the Internet, or upload a new photo using multipart/form-data.
     *       'caption'                     => '',                      // string           - (Optional). Photo caption (may also be used when resending photos by file_id), 0-200 characters
     *       'reply_to_message_id'         => '',                      // int              - (Optional). If the message is a reply, ID of the original message
     *       'reply_markup'                => '',                      // string           - (Optional). Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#sendphoto
     *
     * @throws BaleSDKException
     */
    public function sendPhoto(array $params): MessageObject
    {
        $response = $this->uploadFile('sendPhoto', $params, 'photo');

        return new MessageObject($response->getDecodedBody());
    }

    /**
     * Send regular audio files.
     *
     * <code>
     * $params = [
     *       'chat_id'                     => '',                      // int|string       - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'audio'                       => InputFile::file($file),  // InputFile|string - Required. Audio file to send. Pass a file_id as String to send an audio file that exists on the Bale servers (recommended), pass an HTTP URL as a String for Bale to get an audio file from the Internet, or upload a new one using multipart/form-data.
     *       'caption'                     => '',                      // string           - (Optional). Audio caption, 0-200 characters
     *       'reply_to_message_id'         => '',                      // int              - (Optional). If the message is a reply, ID of the original message
     *       'reply_markup'                => '',                      // string           - (Optional). Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * ]
     *
     * @link https://docs.bale.ai/#sendaudio
     * </code>
     *
     * @throws BaleSDKException
     */
    public function sendAudio(array $params): MessageObject
    {
        $response = $this->uploadFile('sendAudio', $params, 'audio');

        return new MessageObject($response->getDecodedBody());
    }

    /**
     * Send general files.
     *
     * <code>
     * $params = [
     *       'chat_id'                         => '',                      // int|string       - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'document'                        => InputFile::file($file),  // InputFile|string - Required. File to send. Pass a file_id as String to send a file that exists on the Bale servers (recommended), pass an HTTP URL as a String for Bale to get a file from the Internet, or upload a new one using multipart/form-data.
     *       'caption'                         => '',                      // string           - (Optional). Document caption (may also be used when resending documents by file_id), 0-200 characters
     *       'reply_to_message_id'             => '',                      // int              - (Optional). If the message is a reply, ID of the original message
     *       'reply_markup'                    => '',                      // string           - (Optional). Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#senddocument
     *
     * @throws BaleSDKException
     */
    public function sendDocument(array $params): MessageObject
    {
        $response = $this->uploadFile('sendDocument', $params, 'document');

        return new MessageObject($response->getDecodedBody());
    }

    /**
     * Send Video File, Bale clients support mp4 videos (other formats may be sent as Document).
     *
     * <code>
     * $params = [
     *       'chat_id'                     => '',                      // int|string       - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'video'                       => InputFile::file($file),  // InputFile|string - Required. Video to send. Pass a file_id as String to send a video that exists on the Bale servers (recommended), pass an HTTP URL as a String for Bale to get a video from the Internet, or upload a new video using multipart/form-data.
     *       'caption'                     => '',                      // string           - (Optional). Video caption (may also be used when resending videos by file_id), 0-200 characters.
     *       'reply_to_message_id'         => '',                      // int              - (Optional). If the message is a reply, ID of the original message
     *       'reply_markup'                => '',                      // string           - (Optional). Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#sendvideo
     * @see  sendDocument
     *
     * @throws BaleSDKException
     */
    public function sendVideo(array $params): MessageObject
    {
        $response = $this->uploadFile('sendVideo', $params, 'video');

        return new MessageObject($response->getDecodedBody());
    }

    /**
     * Send send animation files (GIF or H.264/MPEG-4 AVC video without sound).
     *
     * <code>
     * $params = [
     *       'chat_id'                       => '',                      // int|string       - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'animation'                     => InputFile::file($file),  // InputFile|string - Required. Animation to send. Pass a file_id as String to send an animation that exists on the Bale servers (recommended), pass an HTTP URL as a String for Bale to get an animation from the Internet, or upload a new animation using multipart/form-data.
     *       'reply_to_message_id'           => '',                      // int              - (Optional). If the message is a reply, ID of the original message
     *       'reply_markup'                  => '',                      // string           - (Optional). Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#sendanimation
     *
     * @throws BaleSDKException
     */
    public function sendAnimation(array $params): MessageObject
    {
        $response = $this->uploadFile('sendAnimation', $params, 'animation');

        return new MessageObject($response->getDecodedBody());
    }

    /**
     * Send voice audio files.
     *
     * <code>
     * $params = [
     *       'chat_id'                      => '',                       // int|string       - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'voice'                        => InputFile::file($file),   // InputFile|string - Required. Audio file to send. Pass a file_id as String to send a file that exists on the Bale servers (recommended), pass an HTTP URL as a String for Bale to get a file from the Internet, or upload a new one using multipart/form-data.
     *       'caption'                      => '',                       // string           - (Optional). Voice message caption, 0-200 characters
     *       'reply_to_message_id'          => '',                       // int              - (Optional). If the message is a reply, ID of the original message
     *       'reply_markup'                 => '',                       // string           - (Optional). Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#sendvoice
     *
     * @throws BaleSDKException
     */
    public function sendVoice(array $params): MessageObject
    {
        $response = $this->uploadFile('sendVoice', $params, 'voice');

        return new MessageObject($response->getDecodedBody());
    }

    /**
     * Send a group of photos, audio, documents or videos as an album.
     *
     * <code>
     * $params = [
     *       'chat_id'                       => '',  // int|string    - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'media'                         => [],  // array         - Required. A JSON-serialized array describing messages to be sent, must include 2-10 items. Array of InputMediaAudio, InputMediaDocument, InputMediaPhoto and InputMediaVideo
     *       'reply_to_message_id'           => '',  // int           - (Optional). If the message is a reply, ID of the original message
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#sendmediagroup
     *
     * @throws BaleSDKException
     */
    public function sendMediaGroup(array $params): MessageObject
    {
        $response = $this->uploadFile('sendMediaGroup', $params, 'media');

        return new MessageObject($response->getDecodedBody());
    }

    /**
     * Send phone contacts.
     *
     * <code>
     * $params = [
     *       'chat_id'                      => '',  // int|string - Required. Unique identifier for the target chat or username of the target channel (in the format "@channelusername")
     *       'phone_number'                 => '',  // string     - Required. Contact's phone number
     *       'first_name'                   => '',  // string     - Required. Contact's first name
     *       'last_name'                    => '',  // string     - Required. Contact's last name
     *       'reply_to_message_id'          => '',  // int        - (Optional). If the message is a reply, ID of the original message
     *       'reply_markup'                 => '',  // string     - (Optional). Additional interface options. A JSON-serialized object for an inline keyboard, custom reply keyboard, instructions to remove reply keyboard or to force a reply from the user.
     * ]
     * </code>
     *
     * @link https://docs.bale.ai/#sendcontact
     *
     * @throws BaleSDKException
     */
    public function sendContact(array $params): MessageObject
    {
        $response = $this->post('sendContact', $params);

        return new MessageObject($response->getDecodedBody());
    }
}