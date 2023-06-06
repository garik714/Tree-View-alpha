<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\CreateContentRequest;
use App\Http\Requests\Content\DeleteContentRequest;
use App\Http\Requests\Content\DragDropContentRequest;
use App\Http\Requests\Content\ShowContentRequest;
use App\Http\Requests\Content\UpdateContentRequest;
use App\Http\Resources\Content\ContentResource;
use App\Services\Content\Actions\CreateContentAction;
use App\Services\Content\Actions\DeleteContentAction;
use App\Services\Content\Actions\DragDropContentAction;
use App\Services\Content\Actions\ShowContentAction;
use App\Services\Content\Actions\UpdateContentAction;
use App\Services\Content\Dto\CreateContentDto;
use App\Services\Content\Dto\DeleteContentDto;
use App\Services\Content\Dto\DragDropContentDto;
use App\Services\Content\Dto\ShowContentDto;
use App\Services\Content\Dto\UpdateContentDto;
use Illuminate\Http\JsonResponse;

class ContentController extends Controller
{
    protected ShowContentAction $showContentAction;
    protected CreateContentAction $createContentAction;
    protected UpdateContentAction $updateContentAction;
    protected DeleteContentAction $deleteContentAction;
    protected DragDropContentAction $dragDropContentAction;

    public function __construct(
        ShowContentAction   $showContentAction,
        CreateContentAction $createContentAction,
        UpdateContentAction $updateContentAction,
        DeleteContentAction $deleteContentAction,
        DragDropContentAction $dragDropContentAction
    ) {
        $this->showContentAction = $showContentAction;
        $this->createContentAction = $createContentAction;
        $this->updateContentAction = $updateContentAction;
        $this->deleteContentAction = $deleteContentAction;
        $this->dragDropContentAction = $dragDropContentAction;
    }

    public function show(ShowContentRequest $request): ContentResource
    {
        $dto = ShowContentDto::fromRequest($request);

        return  $this->showContentAction->show($dto);
    }

    public function create(CreateContentRequest $request): JsonResponse
    {
        $dto = CreateContentDto::fromRequest($request);

        $result = $this->createContentAction->create($dto);

        return $this->response($result->toArray($request));
    }

    public function update(UpdateContentRequest $request): JsonResponse
    {
        $dto = UpdateContentDto::fromRequest($request);

        $result = $this->updateContentAction->update($dto);

        return $this->response($result->toArray($request));
    }

    public function delete(DeleteContentRequest $request): JsonResponse
    {
        $dto = DeleteContentDto::fromRequest($request);

        $result =  $this->deleteContentAction->delete($dto);

        return $this->response($result->toArray($request));
    }

    public function dragDrop(DragDropContentRequest $request)
    {
        $dto = DragDropContentDto::fromRequest($request);

        return $this->dragDropContentAction->dragDrop($dto);
    }
}
