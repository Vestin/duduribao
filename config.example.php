<?php
/**
 * Created by PhpStorm.
 * User: vestin
 * Date: 6/22/17
 * Time: 11:07 AM
 */

return [
    //发件邮箱配置
    'email.host' => 'smtp.163.com',
    'email.SMTPAuth' => true,
    'email.Username' => '***@163.com',
    'email.Password' => '***********',
    'email.SMTPSecure' => 'ssl',
    'email.Port' => '465',
    'email.from' => "***@163.com",
    'email.name' => '知乎日报',
    //收取信息的人
    'recipient' => 'user@user.com'
];