<?php

namespace App\Filament\Resources\GroupResource\Pages;

use App\Filament\Resources\GroupResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Str;

class CreateGroup extends CreateRecord
{
    protected static string $resource = GroupResource::class;

    public function mount(): void
    {
        abort_unless(auth()->user()->group->slug == 'super-admin', 403);
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['slug'] = Str::slug($data['name']);

        return $data;
    }
}
