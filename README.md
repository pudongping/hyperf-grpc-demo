# 使用 hyperf 框架搭建的 grpc 服务 demo

## 环境

- 开发环境使用 docker

```shell
docker run --name codes \
-v /Users/pudongping/glory/codes:/codes \
-p 9510:9510 \
-p 9511:9511 -it \
--privileged -u root \
--entrypoint /bin/sh \
hyperf/hyperf:7.4-alpine-v3.11-swoole
```

- 初始化项目

> 为了使读者更好的了解搭建过程，在初始化项目时，我除了将时区设置成了 `Asia/Shanghai` 以外，其他全部回车使用 hyperf 框架默认的配置

```shell
# 创建服务端项目
composer create-project hyperf/hyperf-skeleton server-provider

# 创建客户端项目
composer create-project hyperf/hyperf-skeleton server-consumer
```

- 安装 protobuf

```shell
# 使用 linux 包管理工具安装 protoc, 下面以 alpine 为例
apk add protobuf

# 使用 protoc 自动生成代码
protoc --php_out=grpc/ proto/*
```

> 服务提供者修改内容详见 git commit 记录为 `6748cb47434ba905b925110952eb816f1709cc55` 内容   
> 服务消费者修改内容详见 git commit 记录为 `d32cd9c1dd914f98825c9eddf153b5e3f0148c74` 内容

## 测试

> 都需要先进入 docker 环境中

- 开启服务提供者服务

```shell
# 开启服务提供者服务
cd server-provider && php bin/hyperf.php start
```

- 开启服务消费者服务

```shell
# 开启服务消费者服务
cd server-consumer && php bin/hyperf.php start
```

- 测试访问

```shell
curl 127.0.0.1:9511/index/hello
```

回到服务提供者控制台，我们可以看到有如下输出内容

```shell
string(17) "request name ==> "
string(4) "Alex"
string(16) "request sex ==> "
int(2)
```

回到服务消费者控制台，我们可以看到有如下输出内容

```shell
int(8388608)
string(20) "indexController ==> "
array(3) {
  ["code"]=>
  int(200)
  ["msg"]=>
  string(7) "Success"
  ["data"]=>
  array(2) {
    ["name"]=>
    string(17) "response ==> Alex"
    ["sex"]=>
    int(20)
  }
}
```

表示我们已经测试成功了！