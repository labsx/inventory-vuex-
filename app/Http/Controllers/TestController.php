<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Illuminate\Database\Eloquent\Builder;

class TestController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index(Request $request)
    {
        $query = QueryBuilder::for(Item::select(['items.*']))
        ->allowedFilters([
            AllowedFilter::callback('search', function (Builder $query, $value) {
                if (is_array($value)) {
                    $value = implode(',', $value);
                }
                $query->where(function ($wrapperQuery) use ($value) {
                    $wrapperQuery->orWhere('name', 'like', "%{$value}%");
                    $wrapperQuery->orWhere('transaction_number', 'like', "%{$value}%");
                });
            }),
        ])
        ->allowedSorts('date_received')
        ->orderBy('date_received', 'desc')
        ->jsonPaginate();
        // ->paginate();
    
    return ItemResource::collection($query);
        // $query = QueryBuilder::for(Item::class)
        // ->allowedFilters([
        //     AllowedFilter::callback('name', function (Builder $query, $value) {
        //         $query->where('name', $value);
        //     })
        // ]);
    
        // return ItemResource::collection($query->get());
    }
}
