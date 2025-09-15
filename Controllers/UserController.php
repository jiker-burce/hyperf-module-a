<?php

declare(strict_types=1);
/**
 * 模块A - 用户管理控制器
 * 程序员A负责
 */

namespace App\Modules\ModuleA\Controllers;

use App\Modules\ModuleA\Services\UserService;
use Hyperf\Di\Annotation\Inject;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;

class UserController
{
    protected UserService $userService;
    protected RequestInterface $request;
    protected ResponseInterface $response;

    public function __construct()
    {
        $this->userService = new UserService();
        $this->request = make(RequestInterface::class);
        $this->response = make(ResponseInterface::class);
    }

    /**
     * 获取用户列表
     */
    public function index()
    {
        $page = $this->request->input('page', 1);
        $limit = $this->request->input('limit', 10);
        $status = $this->request->input('status', '');

        $users = $this->userService->getUsers($page, $limit, $status);

        return $this->success('获取用户列表成功', $users);
    }

    /**
     * 创建用户
     */
    public function create()
    {
        $data = $this->request->all();
        
        $user = $this->userService->createUser($data);

        return $this->success('创建用户成功', $user);
    }

    /**
     * 获取用户详情
     */
    public function show($id)
    {
        $user = $this->userService->getUserById($id);

        if (!$user) {
            return $this->error('用户不存在');
        }

        return $this->success('获取用户详情成功', $user);
    }

    /**
     * 更新用户
     */
    public function update($id)
    {
        $data = $this->request->all();
        
        $user = $this->userService->updateUser($id, $data);

        if (!$user) {
            return $this->error('用户不存在');
        }

        return $this->success('更新用户成功', $user);
    }

    /**
     * 删除用户
     */
    public function delete($id)
    {
        $result = $this->userService->deleteUser($id);

        if (!$result) {
            return $this->error('用户不存在');
        }

        return $this->success('删除用户成功');
    }

    /**
     * 搜索用户
     */
    public function search()
    {
        $keyword = $this->request->input('keyword', '');
        $page = $this->request->input('page', 1);
        $limit = $this->request->input('limit', 10);

        $users = $this->userService->searchUsers($keyword, $page, $limit);

        return $this->success('搜索用户成功', $users);
    }

    /**
     * 更新用户状态
     */
    public function updateStatus($id)
    {
        $status = $this->request->input('status', '');

        $user = $this->userService->updateUserStatus($id, $status);

        if (!$user) {
            return $this->error('用户不存在');
        }

        return $this->success('更新用户状态成功', $user);
    }

    /**
     * 获取用户权限
     */
    public function getPermissions($id)
    {
        $permissions = $this->userService->getUserPermissions($id);

        if ($permissions === null) {
            return $this->error('用户不存在');
        }

        return $this->success('获取用户权限成功', $permissions);
    }

    /**
     * 设置用户权限
     */
    public function setPermissions($id)
    {
        $permissions = $this->request->input('permissions', []);

        $result = $this->userService->setUserPermissions($id, $permissions);

        if (!$result) {
            return $this->error('用户不存在');
        }

        return $this->success('设置用户权限成功');
    }

    /**
     * 获取用户资料
     */
    public function getProfile($id)
    {
        $profile = $this->userService->getUserProfile($id);

        if ($profile === null) {
            return $this->error('用户不存在');
        }

        return $this->success('获取用户资料成功', $profile);
    }

    /**
     * 更新用户资料
     */
    public function updateProfile($id)
    {
        $data = $this->request->all();

        $profile = $this->userService->updateUserProfile($id, $data);

        if (!$profile) {
            return $this->error('用户不存在');
        }

        return $this->success('更新用户资料成功', $profile);
    }

    /**
     * 成功响应
     */
    protected function success(string $message, $data = null)
    {
        return [
            'success' => true,
            'message' => $message,
            'data' => $data,
            'module' => 'module-a',
            'timestamp' => time()
        ];
    }

    /**
     * 错误响应
     */
    protected function error(string $message, int $code = 400)
    {
        return [
            'success' => false,
            'message' => $message,
            'code' => $code,
            'module' => 'module-a',
            'timestamp' => time()
        ];
    }
}
