<?php

namespace App\Filament\Resources\CategoryResource\Pages;

use Filament\Actions;
use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\CategoryResource;

class EditCategory extends EditRecord
{
    protected static string $resource = CategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            ForceDeleteAction::make(), 
            RestoreAction::make(), 
        ];
    }
        protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}

