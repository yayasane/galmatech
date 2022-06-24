<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function mount(): void
    {
        abort_unless(auth()->user()->group->slug == 'super-admin', 403);
    }

    protected static function shouldRegisterNavigation(): bool
    {
        return auth()->user()->group->slug == 'super-admin';
    }
}
