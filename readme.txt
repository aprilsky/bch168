+----------------------------------+
 iweb Mall多用户商城平台软件简介
+----------------------------------+
iweb Mall基于iweb SI框架开发，在获得iweb SI技术平台库支持的条件下，iweb Mall可以轻松满足用户量级百万至千万级的大型电子商务网站的性能要求。站点的集群与分布式技术（分布式计算与存储/高可用性/负载均衡）被屏蔽在SI平台之内，基于iweb Mall并且按照SI平台库扩展规范开发的新增功能模块，也将同时获得这种超级计算与处理的能力。
作为开源的LAMP电子商务系统，iweb Mall提供了一套轻量级的支持库，这使iweb Mall可以轻松部署在虚拟主机上或者单台服务器上。
iweb Mall有以下特点：
1.易于集成
iweb Mall设计灵活，具有模块化架构体系和丰富的功能。易于与第三方应用系统无缝集成。
2.性能与容量扩展
SI库管理的集群支持节点热插拔，当系统需要增加集群中的Web服务节点或者数据存储节点时只需要更改SI库的配置文件，无须编写任何代码就可以轻松管理新增流量和数据。
3.多领域的应用
其面向企业级应用，可处理多方面的需求，建站者可以用iweb Mall轻松建设一个多种用途和多领域的电子商务网站。
4.国际化支持，UTF-8编码，多种语言包支持。
5.UI兼容ie6、ie7、ie8、ff等主流浏览器。

+----------------------------------+
 iweb Mall多用户商城平台软件环境需求
+----------------------------------+
1. 可用的 www 服务器，如Apache 、IIS、Lihttpd 等 
2. php 5.x 
3. MySQL 5.0.x 及以上
推荐使用环境：Apache2.2.x + php 5.2.x  + MySQL 5.1.x

+----------------------------------+
 iweb Mall多用户商城平台软件的安装
+----------------------------------+
安装前请先认真阅读license.txt文件的全部内容
1. 上传解压出来的所有文件到服务器
2. 在浏览器地址栏中输入http://yourwebsite/install/按照提示安装
        ./找不到文件时在浏览器地址栏中输入http://yourwebsite/install/index.php
3. 安装完毕，删除 ./install 目录
4. 后台管理地址：http://yourwebsite/sysadmin/login.php
	如果您需要开启[伪静态] 先把./docs/htaccess/.htaccess 这个文件拷贝到网站根目录， 再上后台里的url_rewrite开启
5. 登陆后台 -> UI设置<模板管理> -> 应用模板(default)
6. 如果连接数据库失败，请查看数据库配置文件（./iweb_mini_lib/conf/dbconf.php）是否正确。
7. 多语言接口配置在configuration.php内设置，目前只支持简体中文版语言包，用户可自行制作其他语言版本，语言包位置：./langpackage；
关于多语言支持相关问题可登录jooyea.net技术支持站点（www.jooyea.net）iwebAx产品技术论坛讨论。

要获取关于iweb SI框架的相关内容，请登录www.jooyea.net察看详情。
有其他疑问请登录iwebAx产品技术论坛。
