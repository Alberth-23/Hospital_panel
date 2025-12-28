<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Atributos asignables en masa.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Atributos ocultos al serializar.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Casts de atributos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación muchos-a-muchos con roles.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'user_roles');
    }

    /**
     * Relación uno-a-uno con paciente (si este usuario es un paciente).
     */
    public function patient()
    {
        return $this->hasOne(Patient::class);
    }

    /**
     * Relación uno-a-uno con miembro de staff (si este usuario es médico/enfermería/administrativo).
     */
    public function staffMember()
    {
        return $this->hasOne(StaffMember::class);
    }

    /**
     * Helper sencillo para comprobar si el usuario tiene un rol.
     */
    public function hasRole(string $roleName): bool
    {
        return $this->roles()
        ->where('name', $roleName)
        ->exists();
    }
}
