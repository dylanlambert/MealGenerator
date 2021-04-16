<?php

declare(strict_types=1);

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Psr\Http\Message\ResponseInterface;
use Throwable;

use function GuzzleHttp\Promise\all;
use function array_map;
use function preg_match_all;
use function dump;
use function array_merge;
use function ucfirst;
use function trim;
use function json_encode;

final class GetIngredients extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $signature = 'ingredients:get';

    /**
     * The console command description.
     * @var string
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $description = 'Snif ingredients list from marmiton';
    private Client $client;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle(): int
    {
        $alphabet = ['w','x','y','z'];
        $marmitonUrl = 'https://www.marmiton.org/recettes/index/ingredient/';

        $promiseList = [];
        foreach ($alphabet as $letter) {
            for ($i = 1; $i <= 20; $i++) {
                $promiseList[] = $this->client->requestAsync('get', $marmitonUrl . $letter . '/' . $i);
            }
        }

        $responseList = all($promiseList)->wait();

        $bodies = array_map(fn (ResponseInterface $response) => (string) $response->getBody(), $responseList);
        $ingredients = [];

        try {
            $ingredients = array_map(function (string $body) {
                preg_match_all('/<div class="index-item-card-name">([\s\S]*?)<\/div>/', $body, $matches);
                return $matches[1];
            }, $bodies);
        } catch (Throwable $exception) {
            dump($exception);
        }

        $ingredients = array_merge([], ...$ingredients);
        $ingredients = array_map(fn (string $ingredient) => ucfirst(trim($ingredient)), $ingredients);

        echo json_encode($ingredients);

        return 0;
    }
}
