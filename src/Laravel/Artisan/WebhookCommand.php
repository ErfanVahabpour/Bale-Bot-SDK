<?php

namespace EFive\Bale\Laravel\Artisan;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Helper\TableCell;
use EFive\Bale\Api;
use EFive\Bale\BotsManager;
use EFive\Bale\Exceptions\BaleBotNotFoundException;
use EFive\Bale\Exceptions\BaleSDKException;
use EFive\Bale\Objects\WebhookInfo;

class WebhookCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bale:webhook {bot? : The bot name defined in the config file}
                {--all : To perform actions on all your bots.}
                {--setup : To declare your webhook on Bale servers. So they can call you.}
                {--remove : To remove your already declared webhook on Bale servers.}
                {--info : To get the information about your current webhook on Bale servers.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ease the Process of setting up and removing webhooks.';

    protected Api $bale;

    protected BotsManager $botsManager;

    /** @var array Bot Config */
    protected array $config = [];

    /**
     * Execute the console command.
     *
     * @throws BaleSDKException
     */
    public function handle(BotsManager $botsManager): void
    {
        $this->botsManager = $botsManager;
        $bot = $this->argument('bot');

        $this->resolveBaleBot($bot);

        $this->config = $this->botsManager->getBotConfig($bot);

        if ($this->option('setup')) {
            $this->setupWebhook();
        }

        if ($this->option('remove')) {
            $this->removeWebhook();
        }

        if ($this->option('info')) {
            $this->getInfo();
        }
    }

    /**
     * Setup Webhook.
     *
     * @throws BaleSDKException
     */
    private function setupWebhook(): void
    {
        $this->info('Setting up webhook...');
        $this->newLine();

        $webhookUrl = data_get($this->config, 'webhook_url');

        if (! Str::startsWith($webhookUrl, 'https://')) {
            $this->error('Your webhook url must start with https://');

            return;
        }

        $params = ['url' => $webhookUrl];
        $certificatePath = data_get($this->config, 'certificate_path', false);

        if ($certificatePath && $certificatePath !== 'YOUR-CERTIFICATE-PATH') {
            $params['certificate'] = $certificatePath;
        }

        $allowedUpdates = data_get($this->config, 'allowed_updates');
        if ($allowedUpdates) {
            $params['allowed_updates'] = $allowedUpdates;
        }

        $response = $this->bale->setWebhook($params);
        if ($response) {
            $this->info('Success: Your webhook has been set!');

            return;
        }

        $this->error('Your webhook could not be set!');
    }

    /**
     * Remove Webhook.
     *
     * @throws BaleSDKException
     */
    private function removeWebhook(): void
    {
        if ($this->confirm(sprintf('Are you sure you want to remove the webhook for %s?', $this->config['bot']))) {
            $this->info('Removing webhook...');

            if ($this->bale->removeWebhook()) {
                $this->info('Webhook removed successfully!');

                return;
            }

            $this->error('Webhook removal failed');
        }
    }

    /**
     * Get Webhook Info.
     *
     * @throws BaleSDKException
     */
    private function getInfo(): void
    {
        $this->alert('Webhook Info');

        $bots = collect($this->botsManager->getConfig('bots'));

        if (! $this->option('all')) {
            $bots = $bots->only($this->config['bot']);
        }

        $bots->each(function ($bot, $botName): void {
            $response = $this->botsManager->bot($botName)->getWebhookInfo();

            $this->makeWebhookInfoResponse($response, $botName);
        });
    }

    /**
     * Make WebhookInfo Response for console.
     */
    private function makeWebhookInfoResponse(WebhookInfo $response, string $bot): void
    {
        $rows = $response->map(function ($value, $key): array {
            $key = Str::title(str_replace('_', ' ', $key));
            $value = is_bool($value) ? $this->mapBool($value) : (is_array($value) ? implode("\n", $value) : $value);

            return ['key' => $key, 'value' => $value];
        })->toArray();

        $this->table([
            [new TableCell('Bot: '.$bot, ['colspan' => 2])],
            ['Key', 'Info'],
        ], $rows);
    }

    /**
     * Map Boolean Value to Yes/No.
     */
    private function mapBool(bool $value): string
    {
        return $value ? 'Yes' : 'No';
    }

    private function resolveBaleBot(?string $bot): void
    {
        try {
            $this->bale = $this->botsManager->bot($bot);
        } catch (BaleBotNotFoundException $e) {
            $this->warn($e->getMessage());
            $this->warn('You must specify a proper bot name or configure one.');
            $this->newLine();
            $this->info('💡Omitting the bot name will fallback to the default bot.');

            exit(1);
        }
    }
}