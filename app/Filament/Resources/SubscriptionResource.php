<?php

namespace App\Filament\Resources;

use App\Enums\AttendanceType;
use App\Filament\Resources\SubscriptionResource\Pages;
use App\Filament\Resources\SubscriptionResource\RelationManagers;
use App\Models\Student;
use App\Models\Subscription;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SubscriptionResource extends Resource
{
    protected static ?string $model = Subscription::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Бронированные занятии';
    protected static ?int $navigationSort = 6;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('group')
                    ->label('Группа')
                    ->maxLength(255),
                Forms\Components\Select::make('teacher_id')
                    ->label('Тренер')
                    ->options(Teacher::query()->get()->each(function ($item) {
                        $item->name = $item->fio . ' ' . $item->user->identifier;
                    })->pluck('name', 'id')->toArray())
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('student_id')
                    ->label('Студент')
                    ->options(Student::query()->get()->each(function ($item) {
                        $item->name = $item->fio . ' ' . $item->user->identifier;
                    })->pluck('name', 'id')->toArray())
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('attendance_type')
                    ->options(AttendanceType::getTypes())
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
                Tables\Columns\TextColumn::make('parse_group')
                    ->label('Группа')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lesson.title')
                    ->label('Занятие')
                    ->searchable(),
                Tables\Columns\TextColumn::make('student.fio')
                    ->label('Студент')
                    ->searchable(),
                Tables\Columns\TextColumn::make('parse_attendance_type')
                    ->label('Посещение')
                    ->badge()
                    ->color(fn (Subscription $record) => match ($record->attendance_type) {
                        'attended' => 'success',
                        'missed' => 'danger',
                        'waiting' => 'warning',
                    }),
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
            'index' => Pages\ListSubscriptions::route('/'),
            'edit' => Pages\EditSubscription::route('/{record}/edit'),
        ];
    }

    public static function getPluralLabel(): string
    {
        return 'Бронированные занятии';
    }
}
