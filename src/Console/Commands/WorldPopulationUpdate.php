<?php

namespace GetroXer\WorldPopulation\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class WorldPopulationUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'worldpopulation:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update database from API JSON feed';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        \GetroXer\WorldPopulation\Models\WorldPopulation::truncate();

        $response = Http::get('http://api.worldbank.org/v2/country/all/indicator/SP.POP.TOTL', [
            'format' => 'json',
        ]);

        $response = json_decode($response);

        $pages = $response[0]->pages;
        $page = $response[0]->page;

        $this->output->progressStart($pages);

        while($page <= $pages) {
            sleep(1);

            $data = array();

            $response = Http::get('http://api.worldbank.org/v2/country/all/indicator/SP.POP.TOTL', [
                'format' => 'json',
                'page' => $page,
            ]);
            $response = json_decode($response);
            foreach($response[1] as $row) {
                $data[] = array(
                    'name' => $row->country->value,
                    'code' => $row->country->id,
                    'value' => $row->value,
                    'date' => $row->date,
                );
            }

            \GetroXer\WorldPopulation\Models\WorldPopulation::insert($data);

            $this->output->progressAdvance();
        }

        $this->output->progressFinish();
    }
}
