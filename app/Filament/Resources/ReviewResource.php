<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\Review;
use App\Models\Teacher;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationLabel = 'Отзывы';

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-ellipsis';
    protected static ?int $navigationSort = 7;


//    public static function form(Form $form): Form
//    {
//        return $form
//            ->schema([
//                Forms\Components\Select::make('teacher_id')
//                    ->label('Teacher')
//                    ->relationship('teacher', 'user_identifier')
//                    ->required(),
//                Forms\Components\Select::make('student_id')
//                    ->relationship('student', 'user_identifier')
//                    ->required(),
//                Forms\Components\TextInput::make('message')
//                    ->maxLength(255),
//                Forms\Components\TextInput::make('rating')
//                    ->numeric(),
//            ]);
//    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('teacher.fio')
                    ->label('ФИО преподавателя'),
                Tables\Columns\TextColumn::make('student.fio')
                    ->label('ФИО студента'),
                Tables\Columns\TextColumn::make('message')
                    ->label('Отзыв')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Рейтинг')
                    ->color(fn (Review $record) => $record->rating >= 4 ? 'success' : 'warning')
                    ->badge()
                    ->numeric()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListReviews::route('/'),
        ];
    }

    public static function getPluralLabel(): string
    {
        return 'Отзывы';
    }
}
