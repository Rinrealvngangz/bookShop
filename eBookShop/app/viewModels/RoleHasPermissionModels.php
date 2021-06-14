<?php


namespace App\viewModels;


class RoleHasPermissionModels
{
    public $roleHasPermission =array();
    public  $roleId ;
    function setRoleId($roleId) {
        $this->roleId = $roleId;
    }
    function getRoleId() {
        return   $this->roleId;
    }

    function setPermission($roleHasPermission) {
             $this->roleHasPermission =$roleHasPermission;
    }

    function getPermission():array {
        return  $this->roleHasPermission;
    }
}
