<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Content\DeleteContentRequest;
use App\Http\Requests\Content\RootContentRequest;
use App\Services\Content\Actions\DeleteRootContentAction;
use App\Services\Content\Actions\IndexRootContentAction;
use App\Services\Content\Dto\DeleteContentDto;
use Illuminate\Http\JsonResponse;

class RootContentController extends Controller
{
   public IndexRootContentAction $indexRootContentAction;
   public DeleteRootContentAction $deleteRootContentAction;

    public function __construct
    (
        IndexRootContentAction $indexRootContentAction,
        DeleteRootContentAction $deleteRootContentAction
    )
    {
        $this->indexRootContentAction = $indexRootContentAction;
        $this->deleteRootContentAction = $deleteRootContentAction;
    }

    public function index(RootContentRequest $request): array
    {
        $userId = $request->getUserId();

        return $this->indexRootContentAction->index($userId);
    }

    public function delete(DeleteContentRequest $request): JsonResponse
    {
        $dto = DeleteContentDto::fromRequest($request);

        $this->deleteRootContentAction->delete($dto);

        return $this->response(['Deleted']);
    }
}
