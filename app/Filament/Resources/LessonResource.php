<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LessonResource\Pages;
use App\Filament\Resources\LessonResource\RelationManagers;
use App\Models\Lesson;
use App\Models\Teacher;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LessonResource extends Resource
{
    protected static ?string $model = Lesson::class;

    protected static ?string $navigationLabel = 'Занятии';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?int $navigationSort = 4;


    //i need icon by heroicon for lesson

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('section_id')
                    ->label('Секция')
                    ->relationship('section', 'title')
                    ->required(),
                Forms\Components\Select::make('teacher_id')
                    ->label('Преподаватель')
                    ->options(Teacher::query()->get()->each(function ($item) {
                        $item->name = $item->fio . ' ' . $item->user->identifier;
                    })->pluck('name', 'id')->toArray())
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('title')
                    ->label('Название занятия')
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->label('Описание')
                    ->columnSpanFull(),
                Forms\Components\Select::make('status')
                    ->label('Статус')
                    ->options([
                        'active' => 'Активный',
                        'inactive' => 'Неактивный',
                    ])
                    ->required(),
                Forms\Components\TimePicker::make('start_time')
                    ->label('Время начала')
                    ->required(),
                Forms\Components\TimePicker::make('end_time')
                    ->label('Время окончания')
                    ->required(),
                Forms\Components\TextInput::make('capacity')
                    ->label('Вместимость')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(30)
                    ->default(1),
                Forms\Components\Select::make('day_of_week')
                    ->label('День недели')
                    ->options([
                        'monday' => 'Понедельник',
                        'tuesday' => 'Вторник',
                        'wednesday' => 'Среда',
                        'thursday' => 'Четверг',
                        'friday' => 'Пятница',
                        'saturday' => 'Суббота',
                        'sunday' => 'Воскресенье',
                    ])
                    ->required(),
                Forms\Components\Select::make('place_id')
                    ->label('Место проведения')
                    ->relationship('place', 'title')
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
                Tables\Columns\TextColumn::make('section.title')
                    ->label('Секция')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('teacher.fio')
                    ->label('Преподаватель'),
                /*Tables\Columns\TextColumn::make('title')
                    ->label('Название')
                    ->searchable(),*/
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'gray',
                    })
                    ->label('Статус')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Время начала')
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_time')
                ->label('Время окончания')
                    ->sortable(),
                Tables\Columns\TextColumn::make('capacity')
                    ->label('Вместимость')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('day_of_week')
                    ->label('День недели')
                    ->searchable(),
                Tables\Columns\TextColumn::make('place.title')
                    ->label('Место проведения')
                    ->numeric()
                    ->sortable(),
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
            ])->paginated();
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
            'index' => Pages\ListLessons::route('/'),
            'create' => Pages\CreateLesson::route('/create'),
            'edit' => Pages\EditLesson::route('/{record}/edit'),
        ];
    }
    public static function getPluralLabel(): string
    {
        return 'Занятии';
    }
}
