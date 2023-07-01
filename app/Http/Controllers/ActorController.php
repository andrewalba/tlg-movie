<?php

namespace App\Http\Controllers;

use App\Data\StoreActorRequestData;
use App\Data\UpdateActorRequestData;
use App\Http\Resources\ActorResource;
use App\Models\Actor;
use App\Notifications\ActorCreated;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;

class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
        return ActorResource::collection(Actor::paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreActorRequestData $request
     * @return ActorResource|JsonResponse
     */
    public function store(StoreActorRequestData $request): JsonResponse|ActorResource
    {
        $actor = Actor::create($request->toArray());
        Auth::user()->notify(new ActorCreated($actor));
        return new ActorResource($actor);
    }

    /**
     * @param $id
     * @return ActorResource
     */
    public function show($id): ActorResource
    {
        return new ActorResource(Actor::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     * @param $id
     * @return ActorResource
     */
    public function edit($id): ActorResource
    {
        return new ActorResource(Actor::find($id));
    }

    /**
     * Update the specified resource in storage.
     * @param UpdateActorRequestData $request
     * @param $id
     * @return ActorResource
     */
    public function update(UpdateActorRequestData $request, $id): ActorResource
    {
        $actor = Actor::find($id);
        $actor->update($request->toArray());
        return new ActorResource($actor);

    }

    /**
     * Remove the specified resource from storage.
     * @param $id
     * @return int
     */
    public function destroy($id): int
    {
        return Actor::destroy($id);
    }
}
