<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messages extends Model
{
    protected $table = 'tracing';
    protected $fillable = ['id','sender_full_name','recipient_full_name','recipient_email', 'mail_status','mail_content1','mail_content2','mail_log','updated_at','created_at'];
}