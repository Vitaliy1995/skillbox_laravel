<?php

namespace App\Notifications;

use Illuminate\Notifications\Messages\MailMessage;

class ArticleCreated extends ArticleNotification
{
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)->markdown('mail.article-created', [
            'article' => $this->article,
            'event' => 'Создана'
        ]);
    }
}
