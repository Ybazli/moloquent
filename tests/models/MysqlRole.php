<?php

use Illuminate\Support\Facades\Schema;
use Moloquent\Eloquent\HybridRelations;
use Illuminate\Database\Eloquent\Model as Eloquent;

class MysqlRole extends Eloquent
{
    use HybridRelations;

    protected $connection = 'mysql';
    protected $table = 'roles';
    protected static $unguarded = true;

    public function user()
    {
        return $this->belongsTo('User');
    }

    public function mysqlUser()
    {
        return $this->belongsTo('MysqlUser');
    }

    /**
     * Check if we need to run the schema.
     */
    public static function executeSchema()
    {
        $schema = Schema::connection('mysql');

        if (!$schema->hasTable('roles')) {
            Schema::connection('mysql')->create('roles', function ($table) {
                $table->string('type');
                $table->string('user_id');
                $table->timestamps();
            });
        }
    }
}
