<?php

declare(strict_types=1);
/**
 * 模块A - 用户管理模块配置
 * 程序员A负责
 */

return [
    'name' => '用户管理模块',
    'version' => '1.0.0',
    'developer' => '程序员A',
    'description' => '用户管理相关功能',
    'enabled' => true,
    
    // 模块路由前缀
    'route_prefix' => '/api/module-a',
    
    // 模块命名空间
    'namespace' => 'App\\Modules\\ModuleA',
    
    // 模拟数据配置
    'mock' => [
        'enabled' => true,
        'data_file' => __DIR__ . '/../mock/data.json',
        'fallback_to_real' => false,
    ],
    
    // 模块依赖
    'dependencies' => [
        // 可以依赖其他模块的服务
        // 'module-b' => ['product_service'],
        // 'module-c' => ['order_service'],
    ],
    
    // 模块中间件
    'middlewares' => [
        // 可以添加模块特定的中间件
    ],
    
    // 模块服务
    'services' => [
        'user_service' => 'App\\Modules\\ModuleA\\Services\\UserService',
    ],
    
    // 数据库配置（如果需要）
    'database' => [
        'connection' => 'default',
        'tables' => [
            'users',
            'user_profiles',
            'user_permissions',
        ],
    ],
];
