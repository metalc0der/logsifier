<?php

namespace Metalc0der\Logsifier\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class PdLog
 */
class Log extends Model
{
    use SoftDeletes;
    protected $table = 'log';

    protected $primaryKey = 'log_id';

	public $timestamps = true;

    protected $fillable = [
        'user_id',
        'ip',
        'log_date',
        'object',
        'object_id',
        'description',
        'source'
    ];

    protected $guarded = [];
        
}