<?php
// ovoa se kreira avtomatski so php artisan make:model Post -m, t.e krerianje na model so migracii kade so moze da se najde u database/migrations/create_post_table
namespace App;

use Illuminate\Database\Eloquent\Model;



class Post extends Model
{
    //Table name
    protected $table='posts';
    //Primary key
    public $primaryKey='id';
    //Timestamp
    public $timestamps=true;
    // function if post belongs to this user
    public function user(){
        return $this->belongsTo('App\User');
    }

}

