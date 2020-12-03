<?php

require_once 'vendor/autoload.php';
Requests::register_autoloader();

// var_dump($argv);
// var_dump($_ENV);

echo "::debug ::Sending a request to Slack\n";

$response = Requests::post(
  $_ENV['INPUT_SLACK_WEBHOOK'],
  array(
    'Content-type' => 'application/json'
  ),
  json_encode(array(
    'blocks' => array(
      array(
        "type" => "actions",
        "elements" => array(
          array(
            "type" => "button",
            "text" => array(
              "type" => "plain_text",
              "emoji" => true,
              "text" => "Approve"
            ),
            "style" => "primary",
            "value" => "click_me_123"
          ),
          array(
            "type" => "button",
            "text" => array(
              "type" => "plain_text",
              "emoji" => true,
              "text" => "Deny"
            ),
            "style" => "danger",
            "value" => "click_me_123"
          )
        ),
      ),
      array(
        "type" => "section",
        "fields" => array(
          array(
            "type" => "mrkdwn",
            "text" => "*Repository:*\n{$_ENV['GITHUB_REPOSITORY']}"
          ),
          array(
            "type" => "mrkdwn",
            "text" => "*Event:*\n{$_ENV['GITHUB_EVENT_NAME']}"
          ),
          array(
            "type" => "mrkdwn",
            "text" => "*Ref:*\n{$_ENV['GITHUB_REF']}"
          ),
          array(
            "type" => "mrkdwn",
            "text" => "*SHA:*\n{$_ENV['GITHUB_SHA']}"
          )
        )
      ),
      array(
        "type" => "section",
        "text" => array(
          "type" => "mrkdwn",
          "text" => $_ENV['INPUT_MESSAGE']
        )
      )
    )
  ))
);

echo "::group::Slack Response\n";
var_dump($response);
echo "::endgroup::\n";

if (!$response->success) {
  echo $response->body;
  exit(1);
}
