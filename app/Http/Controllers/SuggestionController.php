<?php

namespace App\Http\Controllers;

use App\Enums\SuggestionTypeEnum;
use App\Helpers\ApiResponse;
use App\Http\Resources\SuggestionResource;
use App\Models\Suggestion;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class SuggestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suggestion = QueryBuilder::for( Suggestion::query())->paginate();
        return ApiResponse::success(SuggestionResource::collection($suggestion->items()), 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $suggestion = new Suggestion();
        $suggestion->type = SuggestionTypeEnum::from($request->type);
        $suggestion->body = $request->body;
        $suggestion->save();
        return
            ApiResponse::success($suggestion, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
