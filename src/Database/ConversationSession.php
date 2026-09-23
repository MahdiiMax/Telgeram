<?php

namespace MahdiiMax\Telgeram\Database;

use Illuminate\Database\Eloquent\Model;

class ConversationSession extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'chat_id';
    protected $keyType = 'string';
    protected $guarded = [];
    protected $casts = [
        'state' => 'array',
    ];

    public function __construct(array $attributes = [])
    {
        $this->setTable((string) config('telgeram.db.table', 'conversation_sessions'));
        $this->setConnection(config('telgeram.db.connection'));
        parent::__construct($attributes);
    }
}