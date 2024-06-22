<?php
namespace App\Console\Commands;
use App\Models\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

//php artisan make:command DeleteUnusedFiles
class DeleteUnusedFiles extends Command
{
    protected $signature = 'delete:unused-files';
    protected $description = 'Command description';
    public function handle(): void
    {
        $tasks = Category::pluck('image')->toArray();
        collect(Storage::disk('public')->allFiles())
            ->reject(fn (string $file) => $file === '.gitignore')
            ->reject(fn (string $file) => in_array($file, $tasks))
            ->each(fn ($file) => Storage::disk('public')->delete($file));
    }
}
