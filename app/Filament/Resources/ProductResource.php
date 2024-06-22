<?php

namespace App\Filament\Resources;

//php artisan make:filament-resource Product --generate

use Filament\Forms;
use Filament\Tables;
use App\Models\Product;
use Filament\Forms\Set;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\RestoreAction;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\RestoreBulkAction;
use App\Filament\Resources\ProductResource\Pages;
use Filament\Tables\Actions\ForceDeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Filament\Resources\ProductResource\Pages\EditProduct;
use App\Filament\Resources\ProductResource\Pages\ListProducts;
use App\Filament\Resources\ProductResource\Pages\CreateProduct;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Shop';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->required()->live(onBlur: true)->unique(Product::class, 'name',ignoreRecord: true)
                ->afterStateUpdated(function($operation,$state, Set $set){$set('slug', Str::slug($state));})->columnSpan(4),
                TextInput::make('slug')->disabled()->dehydrated()->columnSpan(2),
                Select::make('category_id')->required()->label('Category')->relationship('category', 'name')->columnSpan(2),
                TextInput::make('original_price')->required()->columnSpan(2),
                TextInput::make('selling_price')->required()->columnSpan(2),
                TextInput::make('qty')->required()->columnSpan(2),
                TextInput::make('tax')->required()->columnSpan(1),
                TextInput::make('max_to_buy')->required()->columnSpan(1),
                Toggle::make('status')->required()->columnSpan(1),
                Toggle::make('trending')->required()->columnSpan(1),
                Textarea::make('description')->required()->columnSpan(4),
                Textarea::make('small_description')->required()->columnSpan(2),
                Textarea::make('meta_title')->required()->columnSpan(2),
                Textarea::make('meta_keywords')->required()->columnSpan(2),
                Textarea::make('meta_description')->required()->columnSpan(2),
                FileUpload::make('image')->image()->required()->columnSpan(6),
            ])->columns(6);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image'),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('category.name')->sortable(),
                TextColumn::make('original_price')->label('price')->searchable()->sortable(),
                TextColumn::make('selling_price')->searchable()->sortable(),
                IconColumn::make('status')->label('active')->boolean()->sortable(),
                IconColumn::make('trending')->label('popular')->boolean()->sortable(),
                TextColumn::make('qty')->searchable()->sortable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('tax')->searchable()->sortable()->toggleable(isToggledHiddenByDefault: false),
                TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                TrashedFilter::make(),
                Filter::make('Not Active')->query(fn (Builder $query): Builder => $query->where('status', false)),
                Filter::make('Popular Products')->query(fn (Builder $query): Builder => $query->where('trending', true)),
            ])
            ->actions([ ActionGroup::make([
                EditAction::make(),
                ViewAction::make(),
                DeleteAction::make(), 
                RestoreAction::make(),]), 
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(), 
                RestoreBulkAction::make(), 
                ]),
            ]);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withoutGlobalScopes([SoftDeletingScope::class,]);
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
