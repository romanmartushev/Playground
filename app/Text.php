<?php
/**
 * Created by PhpStorm.
 * User: romanmartushev
 * Date: 4/23/18
 * Time: 12:48 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
class Text extends Model
{
    protected $fillable = [
        'msisdn', 'to', 'messageId', 'text', 'type', 'keyword', 'message_timestamp', 'concat', 'concat_ref','concat_total', 'concat_part'
    ];
}