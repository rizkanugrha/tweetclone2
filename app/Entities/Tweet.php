<?php

namespace App\Entities;

use App\Models\TweetModel;
use CodeIgniter\Entity;

class Tweet extends Entity
{
    public function getCreatedAt(string $format = 'd-m-Y')
    {
        // Convert to CodeIgniter\I18n\Time object
        $this->attributes['created_at'] = $this->mutateDate($this->attributes['created_at']);
        $timezone = $this->timezone ?? app_timezone();
        $this->attributes['created_at']->setTimezone($timezone);
        return $this->attributes['created_at']->format($format);
    }

    public function getUpdatedAt(string $format = 'd-m-Y')
    {
        // Convert to CodeIgniter\I18n\Time object
        $this->attributes['updated_at'] = $this->mutateDate($this->attributes['updated_at']);
        $timezone = $this->timezone ?? app_timezone();
        $this->attributes['updated_at']->setTimezone($timezone);
        return $this->attributes['updated_at']->format($format);
    }
}
?>