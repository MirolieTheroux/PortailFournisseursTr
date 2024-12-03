<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailModel extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'object',
        'headerBackgroundUrl',
        'logoUrl',
        'logoSize',
        'titleText',
        'titleSize',
        'titleColor',
        'buttonUrl',
        'buttonText',
        'buttonTextColor',
        'buttonBackgroundColor',
        'descriptionText',
        'descriptionSize',
        'descriptionColor',
        'subtitleText',
        'subtitleSize',
        'subtitleColor',
        'iconUrl',
        'iconSize',
        'importantInfoText',
        'importantInfoSize',
        'importantInfoColor',
        'passwordResetButtonText',
        'passwordResetButtonColor',
        'passwordResetButtonBackgroundColor',
        'messageText',
        'messageSize',
        'messageColor',
        'footerText',
        'footerSize',
        'footerColor',
        'footerBackgroundUrl',
    ];
}
