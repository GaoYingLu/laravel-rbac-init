<?php

namespace Zizaco\Entrust\Contracts;

/**
 * This file is part of Entrust,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 */
interface EntrustRoleInterface
{
    /**
     * Many-to-Many relations with the user model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users();

    /**
     * Many-to-Many relations with the permission model.
     * Named "perms" for backwards compatibility. Also because "perms" is short and sweet.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function perms();

    /**
     * Save the inputted permissions.
     *
     * @param mixed $inputPermissions
     */
    public function savePermissions($inputPermissions);

    /**
     * Attach permission to current role.
     *
     * @param object|array $permission
     */
    public function attachPermission($permission);

    /**
     * Detach permission form current role.
     *
     * @param object|array $permission
     */
    public function detachPermission($permission);

    /**
     * Attach multiple permissions to current role.
     *
     * @param mixed $permissions
     */
    public function attachPermissions($permissions);

    /**
     * Detach multiple permissions from current role.
     *
     * @param mixed $permissions
     */
    public function detachPermissions($permissions);
}
