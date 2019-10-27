<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

/**
 * Class PermissionTableSeeder
 */
class PermissionTableSeeder extends Seeder
{

    /**
     * @param $role_id
     * @param $controller
     * @param $method
     * @param $action
     */
    public function insert($role_id, $controller, $method, $action)
    {
        DB::table('permissions')->insert(
            [
            'role_id' => $role_id,
            'namespace' => 'App\Http\Controllers\AssetLite',
            'controller' => $controller,
            'method' => $method,
            'action' => $action,
            'allowed' => 1
            ]
        );
    }

    /**
     * Create Permissions
     * $actions
     * $role
     * $callback1
     * $callback2
     */
    public function createPermissions($actions, $role, $callback1, $callback2)
    {
        foreach ($actions as $controller => $action) {
            if ($callback1($role, $controller)) {
                foreach ($action as $method => $acts) {
                    foreach ($acts as $act) {
                        if ($callback2($role, $act)) {
                            $this->insert($role->id, $controller, $method, $act);
                        }
                    }
                }
            }
        }
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();
        $actions = array();
        $routes = Route::getRoutes();
        foreach ($routes as $route) {
            if (preg_match("/^App(.*)/i", trim($route->getActionName())) == 0
                || preg_match("/^App\\\\Http\\\\Controllers\\\\Auth(.*)/i", trim($route->getActionName())) > 0
            ) {
                continue;
            }
            $actionName = $route->getActionName();
            $method = $route->methods()[0];
            $action = substr($actionName, strpos($actionName, '@') + 1);
            $namespace = substr($actionName, 0, strrpos($actionName, '\\'));
            $controller = substr($actionName, strrpos($actionName, '\\') + 1, -(strlen($action) + 1));
            $actions[$namespace][$controller][$method][] = $action;
        }
        ksort($actions);

        if ($actions['App\Http\Controllers\CMS']) {
            unset($actions['App\Http\Controllers\CMS']);
        }

        $roles = Role::where('user_type', 'assetlite')
            ->where('alias', '!=', 'assetlite_super_admin')
            ->get();

        $callback1 = function ($role, $controller) {
            return $role->alias == 'assetlite_super_user' ||
                  ( $controller != 'UserController' &&
                    $controller != 'RolesController' &&
                    $controller != 'PermissionsController'
                  );
        };

        $callback2 = function ($role, $act) {
            return ($role->alias != 'assetlite_normal_user') ||
                   ( $act != 'edit' &&
                     $act != 'update' &&
                     $act != 'destroy' &&
                     $act != 'metaTagsEdit'
                   );
        };

        //====== Create Permissions ========
        foreach ($roles as $role) {
            $this->createPermissions(
                $actions["App\Http\Controllers\AssetLite"],
                $role,
                $callback1,
                $callback2
            );
        }
    }
}
