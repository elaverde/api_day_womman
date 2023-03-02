<?php
namespace App\Controllers\api;

use App\Models\Messages;
use Slim\Http\Request;
use Slim\Http\Response;
use App\Models\EmailNotifications;

class SendController
{
    public function store(Request $request, Response $response)
    {
        $data = $request->getParsedBody();

        $validation = $this->validate_greeting(
            $data['sender_full_name'],
            $data['recipient_full_name'],
            $data['recipient_email'],
            $data['mail_content']
        );
        if (!$validation->status) {
            return $response->withStatus(400)
                            ->withJson([
                                'message' => 'message not created',
                                'data' => $validation->log
                            ]);
        }

        $notification = new EmailNotifications();
        $resultnotification = $notification->CongratulationsByEmail(
            $data['recipient_full_name'],
            $data['recipient_email'],
            $data['mail_content']
        );

        $message = Messages::create([
            'sender_full_name'      => $data['sender_full_name'],
            'recipient_full_name'   => $data['recipient_full_name'],
            'recipient_email'       => $data['recipient_email'],
            'mail_status'           => $resultnotification->success,
            'mail_log'              => $resultnotification->log,
            'mail_content'          => $data['mail_content'],
            'created_at'            => date('Y-m-d H:i:s'),
            'updated_at'            => date('Y-m-d H:i:s')
        ]);
        if (!$resultnotification->success){
            return $response->withStatus(500)
                            ->withJson([
                                'message' => 'message not created',
                                'data' => $resultnotification->log
                            ]);
        }
        return $response->withStatus(200)
                        ->withJson([
                            'message' => 'message created successfully',
                            'data' => $message
                        ]);
    }
    function validate_greeting($sender_full_name, $recipient_full_name, $recipient_email, $mail_content) {
        // Array to store validation errors
        $errors = array();
        // Validate sender_full_name
        if (empty($sender_full_name)) {
            $errors[] = "Sender name is required.";
        } elseif (!preg_match("/^[a-zA-Z ]+$/", $sender_full_name)) {
            $errors[] = "Sender name can only contain letters and spaces.";
        }
        // Validate recipient_full_name
        if (empty($recipient_full_name)) {
            $errors[] = "Recipient name is required.";
        } elseif (!preg_match("/^[a-zA-Z ]+$/", $recipient_full_name)) {
            $errors[] = "Recipient name can only contain letters and spaces.";
        }
        // Validate recipient_email
        if (empty($recipient_email)) {
            $errors[] = "Recipient email is required.";
        } elseif (!filter_var($recipient_email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Recipient email is not valid.";
        }
        // Validate mail_content
        if (empty($mail_content)) {
            $errors[] = "Mail content is required.";
        }
        // Return validation errors or success message
        if (count($errors) > 0) {
            $result = new \stdClass();
            $result->status = false;
            $result->log = $errors;
        } else {
            $result = new \stdClass();
            $result->status = true;
            $result->log = "The greeting is valid.";
        }
        return $result;
    }
}


