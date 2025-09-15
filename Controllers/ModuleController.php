<?php

declare(strict_types=1);
/**
 * 模块A - 模块信息控制器
 * 程序员A负责
 */

namespace App\Modules\ModuleA\Controllers;

class ModuleController
{
    /**
     * 获取模块信息
     */
    public function info()
    {
        $config = require __DIR__ . '/../config/config.php';
        
        return [
            'success' => true,
            'message' => '模块信息获取成功',
            'data' => [
                'name' => $config['name'],
                'version' => $config['version'],
                'developer' => $config['developer'],
                'description' => $config['description'],
                'enabled' => $config['enabled'],
                'route_prefix' => $config['route_prefix'],
                'namespace' => $config['namespace'],
                'mock_enabled' => $config['mock']['enabled'],
                'dependencies' => $config['dependencies'],
                'services' => array_keys($config['services']),
                'endpoints' => [
                    'GET /api/module-a/users' => '获取用户列表',
                    'POST /api/module-a/users' => '创建用户',
                    'GET /api/module-a/users/{id}' => '获取用户详情',
                    'PUT /api/module-a/users/{id}' => '更新用户',
                    'DELETE /api/module-a/users/{id}' => '删除用户',
                    'GET /api/module-a/users/search' => '搜索用户',
                    'PATCH /api/module-a/users/{id}/status' => '更新用户状态',
                    'GET /api/module-a/users/{id}/permissions' => '获取用户权限',
                    'POST /api/module-a/users/{id}/permissions' => '设置用户权限',
                    'GET /api/module-a/users/{id}/profile' => '获取用户资料',
                    'PUT /api/module-a/users/{id}/profile' => '更新用户资料',
                ]
            ],
            'module' => 'module-a',
            'timestamp' => time()
        ];
    }
}
