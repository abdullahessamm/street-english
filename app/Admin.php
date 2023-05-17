<?php

namespace App;

use App\ModelsTraits\Accounts\NameHandler;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use Notifiable, NameHandler, HasApiTokens;

    protected $table = 'admin';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'gender',
        'email',
        'password',
        'abilities'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAbilities(): array
    {
        return $this->abilities ? explode(',', $this->abilities) : [];
    }

    public function addAbility(string $ability): void
    {
        if (isset($this->abilities)) {
            if (strpos($this->abilities, $ability) === false && $this->abilities !== '*')
                $this->abilities = strlen($this->abilities) == 0 ? $ability : $this->abilities . ',' . $ability;
        }
        else
            $this->abilities = $ability;
    }

    public function removeAbility(string $ability): void
    {
        if (isset($this->abilities)) {
            $newAbilities = str_replace([
                $ability . ',',
                $ability
            ], [
                '',''
            ], $this->abilities);
            
            $this->abilities = trim($newAbilities, ',');
        }
    }
}
