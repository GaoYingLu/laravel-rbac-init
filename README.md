# Larval 5.2 Rbac 示例

## 说明

这只是一个基于Laravel5.2 和 [zizaco/entrust](https://github.com/Zizaco/entrust)实现的RBAC的简单示例应用，通过路由名来控制权限，当然你也可以扩展一下应用到实际项目中。



## 截图

## ![laravel rbac](http://7bv7rl.com1.z0.glb.clouddn.com/536EDDB1-A462-4E60-A912-6429340BE429.png)



![rbac](http://7bv7rl.com1.z0.glb.clouddn.com/4EFB5F11-E0AD-46ED-A800-7D07A4587924.png)



![rbac](http://7bv7rl.com1.z0.glb.clouddn.com/A0BBACE4-B4D1-4FCF-AE69-B7F0014495E9.png)

## 安装

- git clone 到本地
- cd laravel-rbac-init
- 执行 `git clone https://github.com/Laradock/laradock.git`
- cp env-example .env
- 执行 `docker-compose up -d nginx mysql redis`
- 如果你想安装更多服务，https://github.com/Laradock/laradock.git 这里面有全部的，按需安装；默认的我使用了http://dev.laravel-rbac.com 这个域名，如果你要更换，请在laradock/nginx/sites/default.conf 修改 server_name;（记得添加你本地的 host 记录指向）
- 查看是否启动了至少4个容器。php nginx  mysql redis 还有一个工作空间(laradock_workspace_1);
- 进入容器，执行 `docker exec -it laradock_workspace_1` 这个容器其实就是你的项目目录
- 配置 **.local.env** 中数据库连接信息
---
```
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=laravel_rbac
DB_USERNAME=root
DB_PASSWORD=root
```
---
- 执行 `php artisan db:seed`
- 访问: http://dev.laravel-rbac.com/admin/login
- 默认后台账号:admin@admin.com 密码:admin
