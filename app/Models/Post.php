<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;

class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [ 'title', 'description', 'content','category_id', 'image', 'published_at' ,'category_id','user_id'];
    protected $dates = ['published_at'];
    public function deleteImage(){
        Storage::delete($this->image);
    }
    public function category()
    {
        return $this->belongsTo(Category::class); 
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
    public function hasTag($tagId){
       return in_array( $tagId,$this->tags->pluck('id')->toArray());
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function scopeSearched($query){
        $search = request()->query('search');
        if (!$search) {
            return $query->published()->simplePaginate(2);
        }
        return $query->published()->where('title','like',"%{$search}%")->simplePaginate(2);
    }
     public function scopePublished($query){
        return $query->where('published_at','<=',now());
    }
}



