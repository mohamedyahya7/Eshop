<?php

namespace App\Filament\Resources\ProductResource\Pages;

use Filament\Actions;
use Filament\Actions\DeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Actions\ForceDeleteAction;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ProductResource;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
            ForceDeleteAction::make(), 
            RestoreAction::make(), 
        ];
    }
    protected function getRedirectUrl(): string
    {
    return $this->getResource()::getUrl('index');
    }
}


