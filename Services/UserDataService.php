<?php

declare(strict_types=1);

namespace App\Modules\ModuleA\Services;

use App\Interfaces\UserDataInterface;

/**
 * 模块A的用户数据服务实现
 * 程序员A负责实现
 */
class UserDataService implements UserDataInterface
{
    private array $users = [];
    
    public function __construct()
    {
        $this->loadUsers();
    }
    
    /**
     * 加载用户数据（这里可以从数据库加载）
     */
    private function loadUsers(): void
    {
        // 模拟从数据库加载的用户数据
        $this->users = [
            [
                'id' => 1,
                'name' => '张三',
                'email' => 'zhangsan@example.com',
                'phone' => '13800138001',
                'status' => 'active',
                'created_at' => '2024-01-01 00:00:00',
                'updated_at' => '2024-01-01 00:00:00'
            ],
            [
                'id' => 2,
                'name' => '李四',
                'email' => 'lisi@example.com',
                'phone' => '13800138002',
                'status' => 'active',
                'created_at' => '2024-01-01 00:00:00',
                'updated_at' => '2024-01-01 00:00:00'
            ],
            [
                'id' => 3,
                'name' => '王五',
                'email' => 'wangwu@example.com',
                'phone' => '13800138003',
                'status' => 'inactive',
                'created_at' => '2024-01-01 00:00:00',
                'updated_at' => '2024-01-01 00:00:00'
            ]
        ];
    }
    
    /**
     * 根据ID获取用户
     */
    public function getUser(int $userId): ?array
    {
        foreach ($this->users as $user) {
            if ($user['id'] == $userId) {
                return $user;
            }
        }
        return null;
    }
    
    /**
     * 获取用户列表
     */
    public function getUsers(array $filters = []): array
    {
        $users = $this->users;
        
        // 应用过滤器
        if (isset($filters['status'])) {
            $users = array_filter($users, fn($user) => $user['status'] === $filters['status']);
        }
        
        return array_values($users);
    }
    
    /**
     * 搜索用户
     */
    public function searchUsers(string $keyword): array
    {
        if (empty($keyword)) {
            return $this->users;
        }
        
        return array_filter($this->users, function($user) use ($keyword) {
            return stripos($user['name'], $keyword) !== false || 
                   stripos($user['email'], $keyword) !== false;
        });
    }
    
    /**
     * 检查用户是否存在
     */
    public function userExists(int $userId): bool
    {
        return $this->getUser($userId) !== null;
    }
}
