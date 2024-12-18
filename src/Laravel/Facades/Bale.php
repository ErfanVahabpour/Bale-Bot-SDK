<?php

namespace EFive\Bale\Laravel\Facades;

use Illuminate\Support\Facades\Facade;
use EFive\Bale\BotsManager;

/**
 * @see \EFive\Bale\BotsManager
 *
 * @method static \EFive\Bale\BotsManager setContainer(\Psr\Container\ContainerInterface $container)
 * @method static array getBotConfig(?string $name = null)
 * @method static \EFive\Bale\Api bot(?string $name = null)
 * @method static \EFive\Bale\Api reconnect(?string $name = null)
 * @method static \EFive\Bale\BotsManager disconnect(?string $name = null)
 * @method static bool hasBot(string $name)
 * @method static mixed getConfig(string $key, mixed $default = null)
 * @method static null|string getDefaultBotName()
 * @method static \EFive\Bale\BotsManager setDefaultBot(string $name)
 * @method static array getBots()
 * @method static array parseBotCommands(array $commands)
 *
 * @see \EFive\Bale\Api
 *
 * @method static \EFive\Bale\BotsManager manager(array $config)
 * @method static bool kickChatMember(array $params)
 * @method static bool banChatMember(array $params)
 * @method static string exportChatInviteLink(array $params)
 * @method static \EFive\Bale\Objects\ChatInviteLink createChatInviteLink(array $params)
 * @method static \EFive\Bale\Objects\ChatInviteLink editChatInviteLink(array $params)
 * @method static \EFive\Bale\Objects\ChatInviteLink revokeChatInviteLink(array $params)
 * @method static bool approveChatJoinRequest(array $params)
 * @method static bool declineChatJoinRequest(array $params)
 * @method static bool setChatPhoto(array $params)
 * @method static bool deleteChatPhoto(array $params)
 * @method static bool setChatTitle(array $params)
 * @method static bool setChatDescription(array $params)
 * @method static bool pinChatMessage(array $params)
 * @method static bool unpinChatMessage(array $params)
 * @method static bool unpinAllChatMessages(array $params)
 * @method static bool leaveChat(array $params)
 * @method static bool unbanChatMember(array $params)
 * @method static bool restrictChatMember(array $params)
 * @method static bool promoteChatMember(array $params)
 * @method static bool setChatAdministratorCustomTitle(array $params)
 * @method static bool banChatSenderChat(array $params)
 * @method static bool unbanChatSenderChat(array $params)
 * @method static bool setChatPermissions(array $params)
 * @method static \EFive\Bale\Objects\Chat getChat(array $params)
 * @method static array getChatAdministrators(array $params)
 * @method static int getChatMemberCount(array $params)
 * @method static \EFive\Bale\Objects\ChatMember getChatMember(array $params)
 * @method static bool setChatStickerSet(array $params)
 * @method static bool deleteChatStickerSet(array $params)
 * @method static bool setMyCommands(array $params)
 * @method static bool deleteMyCommands(array $params = [])
 * @method static array getMyCommands(array $params = [])
 * @method static \EFive\Bale\Commands\CommandBus getCommandBus()
 * @method static \EFive\Bale\Api setCommandBus(\EFive\Bale\Commands\CommandBus $commandBus)
 * @method static \EFive\Bale\Objects\Update|array commandsHandler(bool $webhook = false, ?\Psr\Http\Message\RequestInterface $request = null)
 * @method static void processCommand(\EFive\Bale\Objects\Update $update)
 * @method static mixed triggerCommand(string $name, \EFive\Bale\Objects\Update $update, ?array $entity = null)
 * @method static \EFive\Bale\Objects\Message editMessageText(array $params)
 * @method static \EFive\Bale\Objects\Message editMessageCaption(array $params)
 * @method static \EFive\Bale\Objects\Message editMessageMedia(array $params)
 * @method static \EFive\Bale\Objects\Message editMessageReplyMarkup(array $params)
 * @method static void deleteMessage(array $params)
 * @method static \EFive\Bale\Objects\Message sendGame(array $params)
 * @method static \EFive\Bale\Objects\Message setGameScore(array $params)
 * @method static array getGameHighScores(array $params)
 * @method static \EFive\Bale\Objects\User getMe()
 * @method static \EFive\Bale\Objects\UserProfilePhotos getUserProfilePhotos(array $params)
 * @method static \EFive\Bale\Objects\File getFile(array $params)
 * @method static null|\Psr\Container\ContainerInterface getContainer()
 * @method static bool hasContainer()
 * @method static void useEventDispatcher(\EFive\Bale\Events\EventDispatcherListenerContract $emitter)
 * @method static \EFive\Bale\Events\EventDispatcherListenerContract eventDispatcher()
 * @method static bool hasEventDispatcher()
 * @method static void on(string $event, callable $listener, int $priority = 0)
 * @method static \EFive\Bale\Api setAsyncRequest(bool $isAsyncRequest)
 * @method static \EFive\Bale\Api setHttpClientHandler(\EFive\Bale\HttpClients\HttpClientInterface $httpClientHandler)
 * @method static \EFive\Bale\Api setBaseBotUrl(string $baseBotUrl)
 * @method static null|\EFive\Bale\BaleResponse getLastResponse()
 * @method static string downloadFile(\EFive\Bale\Objects\File|\EFive\Bale\Objects\BaseObject|string $file, string $filename)
 * @method static string getAccessToken()
 * @method static \EFive\Bale\Api setAccessToken(string $accessToken)
 * @method static bool isAsyncRequest()
 * @method static int getTimeOut()
 * @method static \EFive\Bale\Api setTimeOut(int $timeOut)
 * @method static int getConnectTimeOut()
 * @method static \EFive\Bale\Api setConnectTimeOut(int $connectTimeOut)
 * @method static \EFive\Bale\BaleClient getClient()
 * @method static void macro($name, $macro)
 * @method static void mixin($mixin, $replace = true)
 * @method static void hasMacro($name)
 * @method static void flushMacros()
 * @method static void macroCall($method, $parameters)
 * @method static \EFive\Bale\Objects\Message sendMessage(array $params)
 * @method static \EFive\Bale\Objects\Message forwardMessage(array $params)
 * @method static \EFive\Bale\Objects\Message copyMessage(array $params)
 * @method static \EFive\Bale\Objects\Message sendPhoto(array $params)
 * @method static \EFive\Bale\Objects\Message sendAudio(array $params)
 * @method static \EFive\Bale\Objects\Message sendDocument(array $params)
 * @method static \EFive\Bale\Objects\Message sendVideo(array $params)
 * @method static \EFive\Bale\Objects\Message sendAnimation(array $params)
 * @method static \EFive\Bale\Objects\Message sendVoice(array $params)
 * @method static \EFive\Bale\Objects\Message sendMediaGroup(array $params)
 * @method static \EFive\Bale\Objects\Message sendContact(array $params)
 * @method static bool sendChatAction(array $params)
 * @method static bool setMessageReaction(array $params)
 * @method static void setPassportDataErrors(array $params)
 * @method static \EFive\Bale\Objects\Message sendInvoice(array $params)
 * @method static bool answerPreCheckoutQuery(array $params)
 * @method static bool answerCallbackQuery(array $params)
 * @method static bool answerInlineQuery(array $params)
 * @method static \EFive\Bale\Objects\Message sendSticker(array $params)
 * @method static \EFive\Bale\Objects\StickerSet getStickerSet(array $params)
 * @method static \EFive\Bale\Objects\File uploadStickerFile(array $params)
 * @method static bool createNewStickerSet(array $params)
 * @method static bool addStickerToSet(array $params)
 * @method static bool setStickerPositionInSet(array $params)
 * @method static array getUpdates(array $params = [], bool $shouldDispatchEvents = true)
 * @method static bool setWebhook(array $params)
 * @method static bool deleteWebhook()
 * @method static \EFive\Bale\Objects\WebhookInfo getWebhookInfo()
 * @method static \EFive\Bale\Objects\Update getWebhookUpdate(bool $shouldDispatchEvents = true, ?\Psr\Http\Message\RequestInterface $request = null)
 * @method static bool removeWebhook()
 */
final class Bale extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return BotsManager::class;
    }
}