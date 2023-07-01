<?php

namespace App\Http\Controllers;

use App\Data\StoreMovieRequestData;
use App\Data\UpdateMoiveRequestData;
use App\Http\Resources\MovieResource;
use App\Models\Movie;
use App\Notifications\MovieCreated;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return MovieResource::collection(Movie::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreMovieRequestData $request
     * @return MovieResource
     */
    public function store(StoreMovieRequestData $request): MovieResource
    {
        // create actor data
        $movie = Movie::create($request->toArray());
        Auth::user()->notify(new MovieCreated($movie));
        return new MovieResource($movie);
    }

    /**
     * Display the specified resource.
     * @param $id
     * @return MovieResource
     */
    public function show($id): MovieResource
    {
        return new MovieResource(Movie::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return MovieResource
     */
    public function edit($id): MovieResource
    {
        return new MovieResource(Movie::find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateMoiveRequestData $request
     * @param $id
     * @return MovieResource
     */
    public function update(UpdateMoiveRequestData $request, $id): MovieResource
    {
        $movie = Movie::find($id);
        $movie->update($request->toArray());
        return new MovieResource($movie);
    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return int
     */
    public function destroy($id): int
    {
        return Movie::destroy($id);
    }
}
