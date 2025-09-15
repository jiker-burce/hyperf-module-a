<?php

declare(strict_types=1);
/**
 * 模块A - 简化用户控制器
 * 程序员A负责
 */

namespace App\Modules\ModuleA\Controllers;

class SimpleUserController
{
    /**
     * 获取用户列表
     */
    public function index()
    {
        return [
            'success' => true,
            'message' => '获取用户列表成功',
            'data' => [
                'users' => [
                    ['id' => 1, 'name' => '张三', 'email' => 'zhangsan@example.com'],
                    ['id' => 2, 'name' => '李四', 'email' => 'lisi@example.com'],
                    ['id' => 3, 'name' => '王五', 'email' => 'wangwu@example.com'],
                ],
                'pagination' => [
                    'page' => 1,
                    'limit' => 10,
                    'total' => 3,
                    'pages' => 1
                ]
            ],
            'module' => 'module-a',
            'timestamp' => time()
        ];
    }

    /**
     * 创建用户
     */
    public function create()
    {
        return [
            'success' => true,
            'message' => '创建用户成功',
            'data' => [
                'id' => rand(1000, 9999),
                'name' => '新用户',
                'email' => 'newuser@example.com',
                'created_at' => date('Y-m-d H:i:s')
            ],
            'module' => 'module-a',
            'timestamp' => time()
        ];
    }

    /**
     * 获取用户详情
     */
    public function show($id)
    {
        return [
            'success' => true,
            'message' => '获取用户详情成功',
            'data' => [
                'id' => $id,
                'name' => '用户' . $id,
                'email' => 'user' . $id . '@example.com',
                'phone' => '1380013800' . $id,
                'status' => 'active',
                'created_at' => '2024-01-01 10:00:00'
            ],
            'module' => 'module-a',
            'timestamp' => time()
        ];
    }

    /**
     * 搜索用户
     */
    public function search()
    {
        return [
            'success' => true,
            'message' => '搜索用户成功',
            'data' => [
                'users' => [
                    ['id' => 1, 'name' => '张三', 'email' => 'zhangsan@example.com'],
                ],
                'keyword' => '张三',
                'pagination' => [
                    'page' => 1,
                    'limit' => 10,
                    'total' => 1,
                    'pages' => 1
                ]
            ],
            'module' => 'module-a',
            'timestamp' => time()
        ];
    }
}

