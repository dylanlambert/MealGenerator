<?php

namespace App\Console\Commands;

use App\Domain\Utils\Id\IdFactory;
use Illuminate\Console\Command;
use Ramsey\Uuid\UuidFactory;

class InsertIngredients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ingredients:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'insert ingredients from ingredients.json (can be populated by ingredients:get > ingredients.json)';
    /**
     * @var IdFactory
     */
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
     * @return int
     */
    public function handle()
    {
        $content = file_get_contents('storage/app/public/ingredients.json');
        if(!$content) {
            echo 'file not found';
            return 0;

        }
        \DB::table('ingredients')->delete();

        foreach (json_decode($content) as $ingredient) {
            \DB::table('ingredients')->insert(
            [
                'id' => (string) $this->idFactory->generateId(),
                'name' => $ingredient
            ]
            );
        }
        return 0;
    }
}
