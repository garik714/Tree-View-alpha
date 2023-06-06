<?php

namespace App\Models\Icon;

use App\Models\Helpers\Uuid;
use App\Services\Icon\Dto\CreateIconDto;
use App\Services\Icon\Dto\UpdateIconDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Psy\Util\Str;

/**
 * @property string $id
 * @property string $source
 * @property string $name
 * @property integer $user_id
 */

class Icon extends Model
{
    use HasFactory;
    use Uuid;

    protected $fillable = [
        'id',
        'source',
        'name',
        'user_id'
    ];

    public static function create(CreateIconDto $dto): self
    {
        $content = new self();

        $content->setId();
        $content->setSource($dto->iconDto->source);
        $content->setName($dto->iconDto->name);
        $content->setUserId($dto->iconDto->userId);

        return $content;
    }

    public function updateByApi(UpdateIconDto $dto): self
    {
        $this->source = $dto->iconDto->source;
        $this->name = $dto->iconDto->name;

        return $this;
    }

    public function setSource(string $source): void
    {
        $this->source = $source;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setUserId(int $userId): void
    {
        $this->user_id = $userId;
    }

    public function setId(): void
    {
        $this->id = Uuid::generate();
    }
}
