<?php

/*
 * This file is part of the Jiannei/laravel-logger.
 *
 * (c) Jiannei <longjian.huang@foxmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Jiannei\Logger\Laravel\Repositories\Enums;

use Jiannei\Enum\Laravel\Enum;

class LogEnum extends Enum
{
    // 定义应用中的日志分类；以冒号区分层级
    const SQL = 'system:sql';
    const REQUEST = 'system:request';
}
