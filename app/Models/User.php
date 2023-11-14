<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 *
 * @property int $id;
 * @property string $name;
 * @property string $family;
 * @property string $phone;
 * @property string $personal_code;
 * @property string $profile_image;
 * @property string $address;
 * @property string $password;
 * @property boolean $is_staff;
 *
 **/
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'family',
        'phone',
        'personal_code',
        'address',
        'profile_image',
        'password',
        "is_staff",
    ];

    protected $guarded = [
        "id",
        "is_staff",
        "is_superuser"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function isAdmin(): bool
    {
        return $this->isStaff();
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    public function isStaff(): bool
    {
        return $this->is_staff == 1;
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }

    /**
     * @param Permission $permission
     * @return bool
     */
    public function hesAllowed(Permission $permission): bool
    {

        // If the user was an employee. It is checked whether access is allowed or not.
        return $this->permissions->contains("name", $permission->name) ||
            $this->hasRole($permission->roles);
    }

    /**
     * This method specifies that the user's role is allowed access
     *
     * @param Collection $roles
     * @return bool
     */
    private function hasRole(Collection $roles): bool
    {
        return !!$roles->intersect($this->roles)->all();
    }


}
