<?php

namespace App\Http\Controllers\Icon;

use App\Http\Controllers\Controller;
use App\Http\Requests\Icon\CreateIconRequest;
use App\Http\Requests\Icon\DeleteIconRequest;
use App\Http\Requests\Icon\IndexIconRequest;
use App\Http\Requests\Icon\UpdateIconRequest;
use App\Services\Icon\Actions\CreateIconAction;
use App\Services\Icon\Actions\DeleteIconAction;
use App\Services\Icon\Actions\IndexIconAction;
use App\Services\Icon\Actions\UpdateIconAction;
use App\Services\Icon\Dto\CreateIconDto;
use App\Services\Icon\Dto\IndexIconDto;
use App\Services\Icon\Dto\UpdateIconDto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IconController extends Controller
{
    protected IndexIconAction $indexIconAction;
    protected CreateIconAction $createIconAction;
    protected UpdateIconAction $updateIconAction;
    protected DeleteIconAction $deleteIconAction;

    public function __construct(
        IndexIconAction $indexIconAction,
        CreateIconAction $createIconAction,
        UpdateIconAction $updateIconAction,
        DeleteIconAction $deleteIconAction
    ) {
        $this->indexIconAction = $indexIconAction;
        $this->createIconAction = $createIconAction;
        $this->updateIconAction = $updateIconAction;
        $this->deleteIconAction = $deleteIconAction;
    }

    public function index(IndexIconRequest $request): AnonymousResourceCollection
    {
        $dto = IndexIconDto::fromRequest($request);

        return $this->indexIconAction->index($dto);
    }

    public function create(CreateIconRequest $request): JsonResponse
    {
        $dto = CreateIconDto::fromRequest($request);

        $result = $this->createIconAction->create($dto);

        return $this->response($result->toArray($request), statusCode: JsonResponse::HTTP_CREATED);
    }

    public function update(UpdateIconRequest $request): JsonResponse
    {
        $dto = UpdateIconDto::fromRequest($request);

        $result = $this->updateIconAction->update($dto);

        return $this->response($result->toArray($request));
    }

    public function delete(DeleteIconRequest $request): bool
    {
        return $this->deleteIconAction->delete($request->getId());
    }
}
