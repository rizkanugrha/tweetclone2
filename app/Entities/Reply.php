<?php

namespace App\Entities;

use App\Models\ReplyModel;
use CodeIgniter\Entity;

class Reply extends Entity
{
    public function getReplyAt(string $format = 'd-m-Y')
    {
        // Convert to CodeIgniter\I18n\Time object
        $this->attributes['created_at'] = $this->mutateDate($this->attributes['created_at']);
        $timezone = $this->timezone ?? app_timezone();
        $this->attributes['created_at']->setTimezone($timezone);
        return $this->attributes['created_at']->format($format);
    }


}
?>