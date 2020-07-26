<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
  /**
  * Get the Category for the blog post.
  */
 public function category(){
     return $this->hasOne('App\Category', 'id', 'cat_id');
 }
 /**
 * Get the User for the blog post.
 */
 public function user(){
   return $this->hasOne('App\User','id','user_id');
 }
}
