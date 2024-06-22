<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Category;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Filters\TrashedFilter;
use App\Filament\Resources\CategoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoryResource\RelationManagers;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Shop';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(
                        function($operation,$state, set $set){
                        //if($operation !== 'create' || $operation !== 'edit'){return;} 
                        $set('slug', Str::slug($state));
                    }),
                TextInput::make('slug')
                    ->disabled()
                    ->dehydrated()
                    ->unique(Category::class, 'slug',ignoreRecord: true),
                    
                TextInput::make('description')->required(),
                FileUpload::make('image')
                ->directory('categories')
                ->preserveFilenames()
                ->getUploadedFileNameForStorageUsing(fn (TemporaryUploadedFile $file,Get $get): string => 
                (string) str(Str::slug(now()).('_').$get('slug').('.').$file->getClientOriginalExtension()))
                //->getUploadedFileNameForStorageUsing(fn (TemporaryUploadedFile $file,Get $get): string => 
                //(string) str($file->getClientOriginalName())->prepend(now()->timestamp.'_'),) 
                ,
                TextInput::make('meta_title')->required(),
                TextInput::make('meta_description')->required(),
                TextInput::make('meta_keywords')->required(),
                Toggle::make('status')->default(true),
                Toggle::make('popular')->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('slug')->searchable(),
                TextColumn::make('description')->searchable(),
                ImageColumn::make('image')->visibility('public')->size('50px'),
                TextColumn::make('meta_title')->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('meta_description')->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('meta_keywords')->searchable()
                ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('status')->boolean(),
                IconColumn::make('popular')->boolean(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                    TrashedFilter::make(),

            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), 
                Tables\Actions\RestoreAction::make(), 
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(), 
                Tables\Actions\RestoreBulkAction::make(), 
                ]),
            ]);
    }

        public static function getEloquentQuery(): Builder
{
    return parent::getEloquentQuery()
        ->withoutGlobalScopes([
            SoftDeletingScope::class,
        ]);
}
    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
