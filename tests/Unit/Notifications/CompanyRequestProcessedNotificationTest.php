<?php

namespace Tests\Unit\Notifications;

use App\Models\CompanyRequest;
use App\Notifications\CompanyRequestProcessedNotification;
use Illuminate\Notifications\Messages\MailMessage;
use PHPUnit\Framework\TestCase;

class CompanyRequestProcessedNotificationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testToEmail()
    {
        $request = new CompanyRequest();

        $notification = new CompanyRequestProcessedNotification($request);
        $message = $notification->toMail();

        $this->assertInstanceOf(MailMessage::class, $message);
        $this->assertSame('Company Request Processed Notification', $message->subject);
        $this->assertSame('You are receiving this email because we processed a company request that you submitted.', $message->introLines[0]);
    }
}
