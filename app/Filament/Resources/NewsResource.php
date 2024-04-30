<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NewsResource\Pages;
use App\Filament\Resources\NewsResource\RelationManagers;
use App\Models\News;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewsResource extends Resource
{
    protected static ?string $model = News::class;

    protected static ?string $navigationLabel = 'Новости';

    protected static ?string $navigationIcon = 'heroicon-o-newspaper';
    protected static ?int $navigationSort = 1;


    protected static ?string $recordTitleAttribute = 'Новости';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')
                    ->required()
                    ->label('Заголовок')
                    ->maxLength(255),
                RichEditor::make('description')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->label('Изображение')
                    ->required()
                    ->columnSpanFull(),
                Select::make('status')
                    ->required()
                    ->label('Статус')
                    ->options([
                        'Черновик' => 'Черновик',
                        'Опубликовано' => 'Опубликовано',
                    ]),
                TextInput::make('author')
                    ->label('Автор (не обязательно)')
                    ->nullable()
                    ->maxLength(255),
                Select::make('category')
                    ->label('Категория')
                    ->options([
                        'Новости' => 'Новости',
                        'Статьи' => 'Статьи',
                        'События' => 'События',
                        'Обзоры' => 'Обзоры',
                        'Конкурсы' => 'Конкурсы',
                        'Поздравления' => 'Поздравления',
                    ])
                    ->required(),
                Select::make('sections')
                ->label('Разделы')
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
                Tables\Columns\TextColumn::make('title')
                    ->wrap()
                    ->label('Заголовок')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Статус')
                    ->color(fn (string $state): string => match ($state) {
                        'Черновик' => 'gray',
                        'Опубликовано' => 'success',
                    })
                    ->searchable(),
                Tables\Columns\TextColumn::make('category')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Новости' => 'primary',
                        'Статьи' => 'info',
                        'События' => 'warning',
                        'Обзоры' => 'success',
                        'Конкурсы' => 'danger',
                        'Поздравления' => 'secondary',
                    })
                    ->label('Категория')
                    ->searchable(),
                Tables\Columns\TextColumn::make('sections.title')
                    ->label('Секции')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Дата создания')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Дата обновления')
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
            'index' => Pages\ListNews::route('/'),
            'create' => Pages\CreateNews::route('/create'),
            'edit' => Pages\EditNews::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
       return self::getModel()::count();
    }
}
