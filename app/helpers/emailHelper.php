<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Aws\Ses\SesClient;
use Aws\Exception\AwsException;

function sendEmail($to, $subject, $bodyHtml, $bodyText = '')
{
    $client = new SesClient([
        'version' => 'latest',
        'region'  => $_ENV['AWS_REGION'],
        'credentials' => [
            'key'    => $_ENV['AWS_ACCESS_KEY_ID'],
            'secret' => $_ENV['AWS_SECRET_ACCESS_KEY'],
        ],
    ]);

    try {
        $result = $client->sendEmail([
            'Destination' => [
                'ToAddresses' => [$to],
            ],
            'Message' => [
                'Body' => [
                    'Html' => [
                        'Charset' => 'UTF-8',
                        'Data' => $bodyHtml,
                    ],
                    'Text' => [
                        'Charset' => 'UTF-8',
                        'Data' => $bodyText ?: strip_tags($bodyHtml),
                    ],
                ],
                'Subject' => [
                    'Charset' => 'UTF-8',
                    'Data' => $subject,
                ],
            ],
            'Source' => $_ENV['SES_FROM_EMAIL'],
        ]);
        return true;
    } catch (AwsException $e) {
        error_log("SES Error: " . $e->getMessage());
        return false;
    }
}
