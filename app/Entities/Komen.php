<?php

namespace App\Entities;

use App\Models\KomenModel;
use CodeIgniter\Entity;

class Komen extends Entity
{
    public function getTanggalAt(string $format = 'd-m-Y')
    {
        // Convert to CodeIgniter\I18n\Time object
        $this->attributes['created_at'] = $this->mutateDate($this->attributes['created_at']);
        $timezone = $this->timezone ?? app_timezone();
        $this->attributes['created_at']->setTimezone($timezone);
        return $this->attributes['created_at']->format($format);
    }


}
?>