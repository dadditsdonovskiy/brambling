<?php

namespace App\Services\Word;

use Illuminate\Support\Facades\Mail;
use App\Mail\CountWordsExceeded;

/**
 * Class to compose mail template
 */
class SendEmailCountIsExceeded
{
    /**
     * @param int $dictionaryId
     * @return void
     */
    public function sendEmail(int $dictionaryId, int $wordsCount)
    {
        $supportEmail = env("SUPPORT_EMAIL");
        $adminEmail = env("ADMIN_EMAIL");
        $details = [
            'title' => $supportEmail,
            'body' => "Word count in dictionary ' . $dictionaryId . ' is exceeded . Current count of words is: '. $wordsCount"
        ];
        Mail::to($adminEmail)->send(new CountWordsExceeded($details));
    }
}
