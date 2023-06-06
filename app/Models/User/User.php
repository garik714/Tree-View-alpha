<?php

namespace App\Models\User;

use App\Services\User\Dto\CreateUserDto;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * @property integer $id
 * @property string $surname
 * @property string $name
 * @property string $username
 * @property string $password
 */

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Find the user instance for the given username.
     *
     * @param  string  $username
     * @return \App\Models\User
     */
    public function findForPassport($username): User
    {
        return $this->where('username', $username)->first();
    }

    protected $fillable = [
        'name',
        'surname',
        'username',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function staticCreate(CreateUserDto $dto): User
    {
        $user = new static();
        $user->setName($dto->name);
        $user->setSurname($dto->surname);
        $user->setUsername($dto->username);
        $user->setPassword($dto->password);
        return $user;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setSurname(string $surname): void
    {
        $this->surname = $surname;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setPassword(string $password): void
    {
        $this->password = bcrypt($password);
    }
}
