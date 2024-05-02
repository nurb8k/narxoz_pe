<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeacherResource\Pages;
use App\Filament\Resources\TeacherResource\RelationManagers;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\View\Components\Modal;
use Filament\Tables;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class TeacherResource extends Resource
{
    protected static ?string $model = Teacher::class;

    protected static ?string $navigationLabel = 'Тренеры';
    protected static ?int $navigationSort = 10;

//    protected static ?string $navigationGroup = 'Про Занятия';

    protected static ?string $navigationIcon = 'heroicon-o-user';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_identifier')
                    ->mask('F99999999')
                    ->placeholder('F77777777')
                    ->required()
                    ->maxLength(255)
                    ->unique(),

                Forms\Components\TextInput::make('user.name')
                    ->label('Имя')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('user.surname')
                    ->label('Фамилия')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('user.middle_name')
                    ->label('Отчество')
                    ->maxLength(255),
                Forms\Components\TextInput::make('user.password')
                    ->label('Пароль')
                    ->password()
                    ->revealable()
                    ->dehydrateStateUsing(fn($state) => Hash::make($state)),
                Forms\Components\FileUpload::make('user.avatar')
                    ->label('Аватар')
                    ->image()
                    ->columnSpanFull()
                    ->required(),
                Forms\Components\Textarea::make('short_info')
                    ->label('Краткая информация')
                    ->placeholder('Тренер по футболу')
                    ->maxLength(255)
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('about')
                    ->label('О тренере')
                    ->placeholder('Описание')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('experience_year')
                    ->numeric(),
                Select::make('sections')
                    ->label('Секции')
                    ->relationship('sections', 'title')
                    ->multiple()
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('user.avatar_path')
                    ->label('Аватар')
                    ->circular(),
                Tables\Columns\TextColumn::make('user_identifier')
                    ->label('Логин')
                    ->searchable(),
                Tables\Columns\TextColumn::make('fio')
                    ->label('Имя Фамилия')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sections.title')
                    ->label('Секция')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListTeachers::route('/'),
            'create' => Pages\CreateTeacher::route('/create'),
            'edit' => Pages\EditTeacher::route('/{record}/edit'),
        ];
    }
    public static function getPluralLabel(): string
    {
        return 'Тренеры';
    }
}
