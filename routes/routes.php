<?php

declare(strict_types=1);
/**
 * 模块A - 用户管理模块路由
 * 程序员A负责
 */

use Hyperf\HttpServer\Router\Router;

// 用户管理路由
Router::addGroup('/api/module-a', function () {
    // 模块信息
    Router::get('/', 'App\\Modules\\ModuleA\\Controllers\\ModuleController@info');
    
    // 用户列表
    Router::get('/users', 'App\\Modules\\ModuleA\\Controllers\\SimpleUserController@index');
    
    // 创建用户
    Router::post('/users', 'App\\Modules\\ModuleA\\Controllers\\SimpleUserController@create');
    
    // 用户搜索 - 必须在 /users/{id} 之前定义
    Router::get('/users/search', 'App\\Modules\\ModuleA\\Controllers\\SimpleUserController@search');
    
    // 用户详情 - 变量路由放在静态路由之后
    Router::get('/users/{id}', 'App\\Modules\\ModuleA\\Controllers\\SimpleUserController@show');
    
    // 更新用户
    Router::put('/users/{id}', 'App\\Modules\\ModuleA\\Controllers\\UserController@update');
    
    // 删除用户
    Router::delete('/users/{id}', 'App\\Modules\\ModuleA\\Controllers\\UserController@delete');
    
    // 用户状态管理
    Router::patch('/users/{id}/status', 'App\\Modules\\ModuleA\\Controllers\\UserController@updateStatus');
    
    // 用户权限管理
    Router::get('/users/{id}/permissions', 'App\\Modules\\ModuleA\\Controllers\\UserController@getPermissions');
    Router::post('/users/{id}/permissions', 'App\\Modules\\ModuleA\\Controllers\\UserController@setPermissions');
    
    // 用户资料管理
    Router::get('/users/{id}/profile', 'App\\Modules\\ModuleA\\Controllers\\UserController@getProfile');
    Router::put('/users/{id}/profile', 'App\\Modules\\ModuleA\\Controllers\\UserController@updateProfile');
});
