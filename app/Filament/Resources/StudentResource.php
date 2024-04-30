<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationLabel = 'Студенты';

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?int $navigationSort = 9;


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('user_identifier')
                    ->label('Идентификатор')
                    ->mask('S99999999')
                    ->placeholder('S77777777')
                    ->required()
                    ->maxLength(30)
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

                Forms\Components\Select::make('status')
                    ->label('Статус')
                    ->default('allowed')
                    ->options([
                        'На все секции' => 'На все секции',
                        'ЛФК' => 'ЛФК',
                    ]),
                Forms\Components\TextInput::make('gpa')
                    ->maxValue('4')
                    ->minValue('0')
                    ->default('0')
                    ->numeric(),
                Forms\Components\TextInput::make('course_year')
                    ->maxValue('2')
                    ->minValue('1')
                    ->default('1')
                    ->numeric(),
                Forms\Components\Select::make('gender')
                    ->options([
                        true => 'Мужской',
                        false => 'Женский',
                    ]),
                Forms\Components\TextInput::make('attendance_count')
                    ->maxValue('15')
                    ->minValue('0')
                    ->numeric()
                    ->default(0),
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
                Tables\Columns\ImageColumn::make('user.avatar')
                    ->label('Аватар')
                    ->alignCenter()
                    ->circular(),
                Tables\Columns\TextColumn::make('user_identifier')
                    ->label('Идентификатор')
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('fio')
                    ->alignCenter()
                    ->label('ФИО')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')

                    ->label('Статус')
                    ->badge()
                    ->alignCenter()
                    ->color(fn (string $state): string => match ($state) {
                        'ЛФК' => 'warning',
                        'На все секции' => 'success',
                    })
                    ->searchable()
                ->sortable(),
                Tables\Columns\TextColumn::make('course_year')
                    ->alignCenter()
                    ->label('Курс')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('attendance_count')
                    ->label('Количество посещений')
                    ->alignCenter()
                    ->badge()
                    ->color(function (int $state): string{
                        if ($state <= 3) {
                            return 'danger';
                        } elseif ($state < 10) {
                            return 'warning';
                        } else {
                            return 'success';
                        }
                    })
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
