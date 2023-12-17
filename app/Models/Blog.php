<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Blog extends Model
{
    use HasFactory;

    // protected $fillable = ['title','slug','body','category_id','user_id'];
    protected $guarded = ['id'];

    public static function boot() 
    {
        parent::boot();
        
        static::deleted(function($item) {
            $item->comments()->delete();
            $item->subscribedUsers()->detach();
            File::delete(public_path($item->photo));
        }
        );
    }

    //blogs categories

    //a blog belongs to a category

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query,$filters){
        if ($filters['search'] ?? null) {
            $query
            ->where(function ($query) use($filters)
            {
                $query
                ->where('title','Like','%'. $filters['search'] .'%')
                ->orWhere('body','Like','%' . $filters['search'] . '%');
            });
        }
        if ($filters['category'] ?? null)
        {   
            $query
            ->whereHas('category',function ($catQuery) use($filters)
            {
                $catQuery->where('slug',$filters['category']);
            });
        }
    }

    //a blog belongs to a user
    public function author(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function subscribedUsers()
    {
        return $this->belongsToMany(User::class,'blogs_users');
    }

    public function isSubscribedBy($user)
    {
        return $this->subscribedUsers->contains('id',$user->id);
    }
}
