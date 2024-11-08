<?php

namespace EFive\Bale\Methods;

use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\Objects\BotCommand;
use EFive\Bale\Traits\Http;

/**
 * Class Commands.
 *
 * @mixin Http
 */
trait Commands
{
    /**
     * Change the list of the bots commands.
     *
     * <code>
     * $params = [
     *      'commands'      => '',  // array           - Required. A JSON-serialized list of bot commands to be set as the list of the bot's commands. At most 100 commands can be specified.
     *      'scope'         => '',  // BotCommandScope - (Optional). A JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to BotCommandScopeDefault.
     * ]
     * </code>
     *
     * @link ?
     *
     * @param  array  $params  Where "commands" key is required, where value is a serialized array of commands.
     *
     * @throws BaleSDKException
     */
    public function setMyCommands(array $params): bool
    {
        $params['commands'] = is_string($params['commands'])
            ? $params['commands']
            : json_encode($params['commands'], JSON_THROW_ON_ERROR);

        return $this->post('setMyCommands', $params)->getResult();
    }

    /**
     * Delete the list of the bot's commands for the given scope and user language
     *
     * <code>
     * $params = [
     *      'scope'         => '',  // BotCommandScope - (Optional). A JSON-serialized object, describing scope of users for which the commands are relevant. Defaults to BotCommandScopeDefault.
     * ]
     * </code>
     *
     * @link ?
     *
     * @param  mixed[]  $params
     */
    public function deleteMyCommands(array $params = []): bool
    {
        return $this->post('deleteMyCommands', $params)->getResult();
    }

    /**
     * Get the current list of the bot's commands.
     *
     * <code>
     * $params = [
     *      'scope'         => '',  // BotCommandScope - (Optional). A JSON-serialized object, describing scope of users. Defaults to BotCommandScopeDefault.
     * ]
     * </code>
     *
     * @link ?
     *
     * @return BotCommand[]
     *
     * @throws BaleSDKException
     */
    public function getMyCommands(array $params = []): array
    {
        return collect($this->get('getMyCommands', $params)->getResult())
            ->mapInto(BotCommand::class)
            ->all();
    }
}