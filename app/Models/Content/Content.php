<?php

namespace App\Models\Content;

use App\Models\Helpers\Uuid;
use App\Models\Icon\Icon;
use App\Services\Content\Dto\CreateContentDto;
use App\Services\Content\Dto\UpdateContentDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $id
 * @property string|null $parent_id
 * @property string $icon_id
 * @property bool $droppable
 * @property bool $is_root
 * @property bool $has_child
 * @property string $name
 * @property int $user_id
 * @property string|null $value
 * @property integer $sequence
 * @property-read Content|null $parent
 * @property-read Content|null $children
 */

class Content extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'id',
        'has_child',
        'parent_id',
        'icon_id',
        'droppable',
        'is_root',
        'name',
        'user_id',
        'value',
        'sequence'
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Content::class, 'parent_id', 'id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Content::class, 'parent_id', 'id')->with('children');
    }

    public static function create(CreateContentDto $dto): self
    {
        $content = new self();

        $content->setParentId($dto->contentDto->parentId);
        $content->setIconId($dto->contentDto->iconId);
        $content->setDroppable($dto->contentDto->droppable);
        $content->setIsRoot($dto->contentDto->isRoot);
        $content->setHasChild($dto->contentDto->hasChild);
        $content->setName($dto->contentDto->name);
        $content->setValue($dto->contentDto->value);
        $content->setUserId($dto->contentDto->userId);

        return $content;
    }

    public function updateByApi(UpdateContentDto $dto)
    {
        $this->parent_id = $dto->contentDto->parentId;
        $this->icon_id = $dto->contentDto->iconId;
        $this->droppable = $dto->contentDto->droppable;
        $this->is_root = $dto->contentDto->isRoot;
        $this->has_child = $dto->contentDto->hasChild;
        $this->name = $dto->contentDto->name;
        $this->value = $dto->contentDto->value;
    }

    public function updateHasChild(bool $hasChild)
    {
        $this->has_child = $hasChild;
    }

    public function updateParentId(string $parentId)
    {
        $this->parent_id = $parentId;
    }

    public function setParentId(string|null $parentId): void
    {
        $this->parent_id = $parentId;
    }

    public function setIconId(string $iconId): void
    {
        $this->icon_id = $iconId;
    }

    public function setDroppable(bool $droppable): void
    {
        $this->droppable = $droppable;
    }

    public function setIsRoot(bool $isRoot): void
    {
        $this->is_root = $isRoot;
    }

    public function setHasChild(bool $hasChild): void
    {
        $this->has_child = $hasChild;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setValue(string|null $value): void
    {
        $this->value = $value;
    }

    public function setUserId(int $userId): void
    {
        $this->user_id = $userId;
    }

    public function icon(): BelongsTo
    {
        return $this->belongsTo(Icon::class);
    }
}
