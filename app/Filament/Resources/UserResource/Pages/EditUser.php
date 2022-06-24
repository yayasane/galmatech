<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use App\Models\Group;
use App\Models\User;
use Closure;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class EditUser extends Page implements HasForms
{
    use InteractsWithForms;
    protected static string $resource = UserResource::class;

    protected static string $view = 'filament.resources.user-resource.pages.update-user';

    public $user;

    public $name;

    public $email;

    public $current_password;

    public $new_password;

    public $new_password_confirmation;

    public function mount(User $record)
    {
        $this->user = $record;
        // dd($record);
        $this->form->fill([
            'name' => $this->user->name,
            'email' => $this->user->email,
            'group_id' => $this->user->group_id
        ]);
    }

    public function submit()
    {
        $this->form->getState();

        $state = array_filter([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->new_password ? Hash::make($this->new_password) : null,
        ]);

        $this->user->update($state);

        $this->reset(['current_password', 'new_password', 'new_password_confirmation']);
        $this->notify('success', 'User informations has been updated.');
    }

    public function getCancelButtonUrlProperty()
    {
        return UserResource::getUrl('index');;
    }

    protected function getBreadcrumbs(): array
    {
        return [
            url()->current() => 'Edit User',
        ];
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('General')
                ->columns(2)
                ->schema([
                    TextInput::make('name')
                        ->required(),
                    TextInput::make('email')
                        ->label('Email Address')
                        ->unique(ignorable: fn (?Model $record): ?Model => $record)
                        ->required(),
                    Select::make('group_id')
                        // ->relationship('group', 'name')
                        ->label('Group')
                        ->options(Group::all()->pluck('name', 'id'))
                        ->required(),
                ]),
            Section::make('Update Password')
                ->columns(2)
                ->schema([
                    TextInput::make('current_password')
                        ->label('Current Password')
                        ->password()
                        ->rules(['required_with:new_password', function () {
                            return function (string $attribute, $value, Closure $fail) {
                                if (!Hash::check($value, $this->user->password)) {
                                    $fail("The {$attribute} is inscorrect.");
                                }
                            };
                        },])
                        ->autocomplete('off')
                        ->columnSpan(1),
                    Grid::make()
                        ->schema([
                            TextInput::make('new_password')
                                ->label('New Password')
                                ->password()
                                ->rules(['confirmed'])
                                ->autocomplete('new-password'),
                            TextInput::make('new_password_confirmation')
                                ->label('Confirm Password')
                                ->password()
                                ->rules([
                                    'required_with:new_password',
                                ])
                                ->autocomplete('new-password'),
                        ]),
                ]),
        ];
    }
}
