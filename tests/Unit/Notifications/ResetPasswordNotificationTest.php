<?php

namespace Tests\Unit\Notifications;

use App\Notifications\ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;
use PHPUnit\Framework\TestCase;

class ResetPasswordNotificationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testToEmail()
    {
        $notification = new ResetPasswordNotification('test_url');
        $message = $notification->toMail();

        $this->assertInstanceOf(MailMessage::class, $message);
        $this->assertSame('Reset Password Notification', $message->subject);
        $this->assertSame('You are receiving this email because we received a password reset request for your account.', $message->introLines[0]);
        $this->assertSame('Thank you for using our application!', $message->outroLines[0]);
    }
}
