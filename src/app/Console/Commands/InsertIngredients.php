<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Domain\Utils\Id\IdFactory;
use Illuminate\Console\Command;
use DB;

use function file_get_contents;
use function json_decode;

final class InsertIngredients extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $signature = 'ingredients:insert';

    /**
     * The console command description.
     * @var string
     * @phpcsSuppress SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
     */
    protected $description =
        'insert ingredients from ingredients.json (can be populated by ingredients:get > ingredients.json)';
    private IdFactory $idFactory;


    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(IdFactory $idFactory)
    {
        $this->idFactory = $idFactory;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     */
    public function handle(): int
    {
        $content = file_get_contents('storage/app/public/ingredients.json');
        if (!$content) {
            echo 'file not found';
            return 0;
        }
        DB::table('ingredients')->delete();

        foreach (json_decode($content) as $ingredient) {
            DB::table('ingredients')->insert(
                [
                'id' => $this->idFactory->generateId()->toString(),
                'name' => $ingredient
                ]
            );
        }
        return 0;
    }
}
