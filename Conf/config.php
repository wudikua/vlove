<?php
return array(
    'DB_HOST'               => 'localhost', // 服务器地址
    'DB_NAME'               => 'weimeng',          // 数据库名
    'DB_USER'               => 'root',      // 用户名
    'DB_PWD'                => '',          // 密码
    'DB_PREFIX'             => '',    // 数据库表前缀


    'APP_GROUP_LIST' => 'Home,admin',
    'DEFAULT_GROUP' => 'Home',
    'APP_GROUP_MODE' => 1,
    'APP_GROUP_PATH' => 'Modules',


    'SHOW_PAGE_TRACE'       => false,
    'SESSION_AUTO_START'    => true,    // 是否自动开启Session

    'URL_CASE_INSENSITIVE'  => true,   // 默认false 表示URL区分大小写 true则表示不区分大小写




    'LOG_RECORD'            => false,   // 默认不记录日志
    'LOG_TYPE'              => 3, // 日志记录类型 0 系统 1 邮件 3 文件 4 SAPI 默认为文件方式
    'LOG_DEST'              => '', // 日志记录目标
    'LOG_EXTRA'             => '', // 日志记录额外信息
    'LOG_LEVEL'             => 'EMERG,ALERT,CRIT,ERR',// 允许记录的日志级别
    'LOG_FILE_SIZE'         => 2097152,	// 日志文件大小限制
    'LOG_EXCEPTION_RECORD'  => false,    // 是否记录异常信息日志
);
?>
