<?php

namespace App\Traits;

use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRoles
{
    /**
     * The roles that belong to the user.
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Check if the user has a specific role.
     */
    public function hasRole(string $roleName): bool
    {
        return $this->roles->contains('name', $roleName);
    }

    /**
     * Check if user has ALL given roles.
     */
    public function hasRoles(array $roles): bool
    {
        return $this->roles()->whereIn('name', $roles)->count() === count($roles);
    }

    /**
     * Check if user has ANY of the given roles.
     */
    public function hasAnyRole(array|string $roles): bool
    {
        if (is_string($roles)) {
            $roles = explode('|', $roles);
        }
        
        return $this->roles()->whereIn('name', $roles)->exists();
    }

    /**
     * Assign a role to the user.
     */
    public function assignRole(string|Role $role): void
    {
        $roleToAssign = is_string($role) 
            ? Role::where('name', $role)->firstOrFail() 
            : $role;

        $this->roles()->syncWithoutDetaching($roleToAssign);
    }

    /**
     * Remove a role from the user.
     */
    public function removeRole(string|Role $role): void
    {
        $roleToRemove = is_string($role) 
            ? Role::where('name', $role)->first() 
            : $role;

        if ($roleToRemove) {
            $this->roles()->detach($roleToRemove);
        }
    }

    /**
     * Check if the user has a specific permission via their roles.
     * This connects to Laravel's Gate system.
     */
    public function hasPermission(string $permissionName): bool
    {
        // 1. Superadmin bypass (Opsional, sangat berguna)
        if ($this->hasRole('superadmin')) {
            return true;
        }

        // 2. Check roles for the permission
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('name', $permissionName)) {
                return true;
            }
        }

        return false;
    }
}
