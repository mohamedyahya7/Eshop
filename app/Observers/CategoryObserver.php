<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

//php artisan make:observer CategoryObserver --model=Category

class CategoryObserver
{
    /**
     * Handle the Category "created" event. public function created(Category $category): void* Handle the Category "created" event. {* Handle the Category "created" event.     //* Handle the Category "created" event. }* Handle the Category "created" event. public function updated(Category $category): void* Handle the Category "created" event. {* Handle the Category "created" event.     //* Handle the Category "created" event. }* Handle the Category "created" event.  * Handle the Category "created" event. public function deleted(Category $category): void* Handle the Category "created" event. {* Handle the Category "created" event.     //* Handle the Category "created" event. }* Handle the Category "created" event. public function restored(Category $category): void* Handle the Category "created" event. {* Handle the Category "created" event.     * Handle the Category "created" event.
     * Handle the Category "force deleted" event.
     */
    public function forceDeleted(Category $category): void
    {
        if (!is_null($category->image)) {
            Storage::disk('public')->delete($category->image);
        }
    }

    public function saved(Category $category): void
    {
        $previousImage = $category->getOriginal('image');
        if ($category->isDirty('image') && $previousImage && Storage::disk('public')->exists($previousImage)) {
            Storage::disk('public')->delete($previousImage);
        }
    }
}
