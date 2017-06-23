<?php
/**
 * Created by PhpStorm.
 * User: vestin
 * Date: 6/22/17
 * Time: 11:05 AM
 */

include __DIR__.'/vendor/autoload.php';
$config = require_once __DIR__.'/config.php';

echo date('Y-m-d H:i:s').PHP_EOL;

$client = new \GuzzleHttp\Client();
$latest = $client->get('http://news-at.zhihu.com/api/4/news/latest');
$latestData = json_decode($latest->getBody()->getContents(), true);

foreach ($latestData['stories'] as &$story) {
    $url = 'http://news-at.zhihu.com/api/4/news/'.$story['id'];
    $story['detail'] = json_decode($client->get($url)->getBody()->getContents(),true);
    $mail = new PHPMailer();
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $config['email.host'];                           // Specify main and backup SMTP servers
    $mail->SMTPAuth = $config['email.SMTPAuth'];                               // Enable SMTP authentication
    $mail->Username = $config['email.Username'];                 // SMTP username
    $mail->Password = $config['email.Password'];                           // SMTP password
    $mail->SMTPSecure = $config['email.SMTPSecure'];                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = $config['email.Port'];                              // TCP port to connect to

    $mail->setFrom($config['email.from'], $config['email.name']);
    foreach($config['recipient'] as $recipient){
        $mail->addAddress($recipient);     // Add a recipient
    }
    $mail->isHTML(true);                                  // Set email format to HTML

    $mail->Subject = $story['title'];
    $mail->Body    = $story['detail']['body'];

    if(!$mail->send()) {
        echo 'Message could not be sent.'.PHP_EOL;
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent'.PHP_EOL;
    }
}