<?php

declare(strict_types=1);
/**
 * 模块A - 用户服务
 * 程序员A负责
 */

namespace App\Modules\ModuleA\Services;

class UserService
{
    protected array $mockData = [];

    public function __construct()
    {
        // $this->loadMockData();
    }

    /**
     * 加载模拟数据
     */
    protected function loadMockData()
    {
        $config = require __DIR__ . '/../config/config.php';
        $dataFile = $config['mock']['data_file'];
        
        if (file_exists($dataFile)) {
            $this->mockData = json_decode(file_get_contents($dataFile), true) ?? [];
        }
    }

    /**
     * 获取用户列表
     */
    public function getUsers(int $page = 1, int $limit = 10, string $status = ''): array
    {
        $users = $this->mockData['users'] ?? [];
        
        // 状态过滤
        if ($status) {
            $users = array_filter($users, fn($user) => $user['status'] === $status);
        }
        
        // 分页
        $total = count($users);
        $offset = ($page - 1) * $limit;
        $users = array_slice($users, $offset, $limit);
        
        return [
            'users' => $users,
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $total,
                'pages' => ceil($total / $limit)
            ]
        ];
    }

    /**
     * 创建用户
     */
    public function createUser(array $data): array
    {
        $newUser = [
            'id' => rand(1000, 9999),
            'name' => $data['name'] ?? '',
            'email' => $data['email'] ?? '',
            'phone' => $data['phone'] ?? '',
            'status' => $data['status'] ?? 'active',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ];
        
        return $newUser;
    }

    /**
     * 根据ID获取用户
     */
    public function getUserById(int $id): ?array
    {
        $users = $this->mockData['users'] ?? [];
        
        foreach ($users as $user) {
            if ($user['id'] == $id) {
                return $user;
            }
        }
        
        return null;
    }

    /**
     * 更新用户
     */
    public function updateUser(int $id, array $data): ?array
    {
        $user = $this->getUserById($id);
        
        if (!$user) {
            return null;
        }
        
        // 更新字段
        foreach ($data as $key => $value) {
            if (isset($user[$key])) {
                $user[$key] = $value;
            }
        }
        
        $user['updated_at'] = date('Y-m-d H:i:s');
        
        return $user;
    }

    /**
     * 删除用户
     */
    public function deleteUser(int $id): bool
    {
        $user = $this->getUserById($id);
        return $user !== null;
    }

    /**
     * 搜索用户
     */
    public function searchUsers(string $keyword, int $page = 1, int $limit = 10): array
    {
        $users = $this->mockData['users'] ?? [];
        
        if ($keyword) {
            $users = array_filter($users, function($user) use ($keyword) {
                return stripos($user['name'], $keyword) !== false || 
                       stripos($user['email'], $keyword) !== false;
            });
        }
        
        $total = count($users);
        $offset = ($page - 1) * $limit;
        $users = array_slice($users, $offset, $limit);
        
        return [
            'users' => $users,
            'keyword' => $keyword,
            'pagination' => [
                'page' => $page,
                'limit' => $limit,
                'total' => $total,
                'pages' => ceil($total / $limit)
            ]
        ];
    }

    /**
     * 更新用户状态
     */
    public function updateUserStatus(int $id, string $status): ?array
    {
        $user = $this->getUserById($id);
        
        if (!$user) {
            return null;
        }
        
        $user['status'] = $status;
        $user['updated_at'] = date('Y-m-d H:i:s');
        
        return $user;
    }

    /**
     * 获取用户权限
     */
    public function getUserPermissions(int $id): ?array
    {
        $user = $this->getUserById($id);
        
        if (!$user) {
            return null;
        }
        
        $permissions = $this->mockData['user_permissions'] ?? [];
        
        foreach ($permissions as $permission) {
            if ($permission['user_id'] == $id) {
                return $permission['permissions'];
            }
        }
        
        return [];
    }

    /**
     * 设置用户权限
     */
    public function setUserPermissions(int $id, array $permissions): bool
    {
        $user = $this->getUserById($id);
        return $user !== null;
    }

    /**
     * 获取用户资料
     */
    public function getUserProfile(int $id): ?array
    {
        $user = $this->getUserById($id);
        
        if (!$user) {
            return null;
        }
        
        $profiles = $this->mockData['user_profiles'] ?? [];
        
        foreach ($profiles as $profile) {
            if ($profile['user_id'] == $id) {
                return $profile;
            }
        }
        
        return [
            'user_id' => $id,
            'avatar' => '',
            'bio' => '',
            'location' => ''
        ];
    }

    /**
     * 更新用户资料
     */
    public function updateUserProfile(int $id, array $data): ?array
    {
        $user = $this->getUserById($id);
        
        if (!$user) {
            return null;
        }
        
        $profile = $this->getUserProfile($id);
        
        foreach ($data as $key => $value) {
            if (isset($profile[$key])) {
                $profile[$key] = $value;
            }
        }
        
        return $profile;
    }
}
