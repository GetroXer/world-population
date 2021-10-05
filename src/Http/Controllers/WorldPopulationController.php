<?php

namespace GetroXer\WorldPopulation\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use GetroXer\WorldPopulation\Models\WorldPopulation;

class WorldPopulationController extends Controller
{
    public function getPopulation(Request $request) {

        $sourceType = \Config::get('worldpopulation.source');
        $page = 1;
        $params = $request->all();

        if($sourceType == 'direct') {
            if(!isset($params['country'])) {
                $params['country'] = 'all';
            }

            $endpoint = 'http://api.worldbank.org/v2/country/' . $params['country'] . '/indicator/SP.POP.TOTL';

            $response = Http::get($endpoint, [
                'format' => 'json',
                'page' => $page,
                'date' => $params['date']
            ]);

            $response = json_decode($response);

            foreach($response[1] as $row) {
                $data[] = array(
                    'name' => $row->country->value,
                    'code' => $row->country->id,
                    'value' => $row->value,
                );
            }
            return response()->json($result);
        }

        $model = WorldPopulation::when(!empty($params), function($query) use ($params) {
            foreach($params as $k => $v) {
                switch($k) {
                    case 'country':
                        $query->where('code', '=', $v);
                        break;
                    case 'year':
                        $query->where('year', '=', $v);
                        break;
                    default:
                        continue 2;
                        break;
                }
            }
        })->get();

        return response()->json($model);
    }
}
