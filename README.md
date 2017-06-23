定时获取读读日报文章，转发到邮箱
-----
@vestin

目地：
* 减少对手机的依赖

## install
```angular2html
git clone https://github.com/Vestin/duduribao.git
composer install
```


## config

`cp config.example.php config.php`
or
`composer run-script post-install-cmd`

edit config.php
```

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
```

## usage

定时收取，使用crontab
* `crontab -e`
* 每天9点收取 `0 9 * * * php /path/to/duduribao/script.php >> /tmp/duduribao.log`
* 每天9点和晚上9点收取 `0 9,21 * * * php /path/to/duduribao/script.php >> /tmp/duduribao.log` 