<?php
namespace App\Notifications;

use Carbon\Carbon;
use Ghasedak\DataTransferObjects\Request\InputDTO;
use Ghasedak\DataTransferObjects\Request\ReceptorDTO;
use Ghasedaksms\GhasedaksmsLaravel\Message\GhasedaksmsVerifyLookUp;
use Ghasedaksms\GhasedaksmsLaravel\Notification\GhasedaksmsBaseNotification;
use Illuminate\Bus\Queueable;

class SendOtpToUser extends GhasedaksmsBaseNotification
{
    use Queueable;

    public function __construct()
    {
            //
    }

public function toGhasedaksms($notifiable): GhasedaksmsVerifyLookUp
   {
    $message = new GhasedaksmsVerifyLookUp();
    $message->setSendDate(Carbon::now());
    $message->setReceptors([new ReceptorDTO('09902774517' , '30005088')]);
    $message->setTemplateName('Ghasedak');
    $message->setInputs([new InputDTO('Code', $notifiable->otp)]);
    return $message;
   }
}
