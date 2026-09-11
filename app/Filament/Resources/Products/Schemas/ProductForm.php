<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\RichEditor;
use Filament\Schemas\Schema;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Select::make('brand_id')
                    ->relationship('brand', 'name')
                    ->nullable(),
                TextInput::make('name')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(fn ($set, ?string $state) => $set('slug', \Illuminate\Support\Str::slug($state))),
                \Filament\Forms\Components\Hidden::make('slug')
                    ->required()
                    ->unique(ignoreRecord: true),
                TextInput::make('sku')
                    ->label('SKU')
                    ->required(),
                TextInput::make('barcode')
                    ->label('Barcode'),
                TextInput::make('regular_price')
                    ->required()
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('discount_price')
                    ->numeric()
                    ->prefix('$'),
                TextInput::make('stock_quantity')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('alert_stock')
                    ->numeric()
                    ->default(0),
                \Filament\Forms\Components\FileUpload::make('cover_image')
                    ->label('Primary Cover Image')
                    ->image()
                    ->disk('cloudinary')
                    ->fetchFileInformation(false)
                    ->directory('products')
                    ->getUploadedFileNameForStorageUsing(
                        fn (\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file): string => (string) str($file->hashName())->beforeLast('.')
                    )
                    ->deleteUploadedFileUsing(function ($file) {
                        try {
                            \Illuminate\Support\Facades\Storage::disk('cloudinary')->delete($file);
                        } catch (\Exception $e) {
                            // ignore exception if file not found
                        }
                    })
                    ->required()
                    ->columnSpanFull(),

                \Filament\Forms\Components\FileUpload::make('gallery_images')
                    ->label('Gallery Images')
                    ->image()
                    ->multiple()
                    ->reorderable()
                    ->maxFiles(5)
                    ->disk('cloudinary')
                    ->fetchFileInformation(false)
                    ->directory('products')
                    ->getUploadedFileNameForStorageUsing(
                        fn (\Livewire\Features\SupportFileUploads\TemporaryUploadedFile $file): string => (string) str($file->hashName())->beforeLast('.')
                    )
                    ->deleteUploadedFileUsing(function ($file) {
                        try {
                            \Illuminate\Support\Facades\Storage::disk('cloudinary')->delete($file);
                        } catch (\Exception $e) {}
                    })
                    ->panelLayout('grid')
                    ->columnSpanFull()
                    ->hintAction(
                        \Filament\Actions\Action::make('selectFromGallery')
                            ->label('Select from Gallery')
                            ->icon('heroicon-o-photo')
                            ->color('info')
                            ->modalWidth(\Filament\Support\Enums\Width::SevenExtraLarge)
                            ->modalHeading('Select Images from Gallery')
                            ->modalSubmitAction(false)
                            ->modalCancelAction(false)
                            ->modalContent(function () {
                                $media = collect();
                                $seenPaths = [];

                                // Curator table images
                                $curatorRows = \Illuminate\Support\Facades\DB::table('curator')
                                    ->select('id', 'name', 'path', 'disk', 'title', 'alt', 'ext')
                                    ->orderBy('created_at', 'desc')
                                    ->get();
                                foreach ($curatorRows as $row) {
                                    try { $url = \Illuminate\Support\Facades\Storage::disk($row->disk)->url($row->path); } catch (\Exception $e) { continue; }
                                    if (empty($url)) continue;
                                    $seenPaths[$row->path] = true;
                                    $media->push(['id' => 'c-'.$row->id, 'name' => $row->name, 'title' => $row->title ?? $row->name, 'url' => $url, 'path' => $row->path, 'disk' => $row->disk]);
                                }

                                // Product images
                                $productImages = \Illuminate\Support\Facades\DB::table('product_images')
                                    ->join('products', 'products.id', '=', 'product_images.product_id')
                                    ->select('product_images.id', 'product_images.image_path', 'products.name as product_name')
                                    ->orderBy('product_images.created_at', 'desc')
                                    ->get();
                                foreach ($productImages as $row) {
                                    if (isset($seenPaths[$row->image_path])) continue;
                                    $url = '';
                                    try { $url = \Illuminate\Support\Facades\Storage::disk('cloudinary')->url($row->image_path); } catch (\Exception $e) {}
                                    if (empty($url)) { try { $url = \Illuminate\Support\Facades\Storage::disk('public')->url($row->image_path); } catch (\Exception $e) { continue; } }
                                    if (empty($url)) continue;
                                    $seenPaths[$row->image_path] = true;
                                    $media->push(['id' => 'p-'.$row->id, 'name' => basename($row->image_path), 'title' => $row->product_name, 'url' => $url, 'path' => $row->image_path, 'disk' => 'cloudinary']);
                                }

                                return view('filament.modals.gallery-picker-for-upload', [
                                    'media' => $media->values()->toArray(),
                                ]);
                            })
                    )
                    ->extraAttributes([
                        'x-init' => '
                            $nextTick(() => {
                                setTimeout(() => {
                                    const wrp = $el.closest(`.fi-fo-field-wrp`);
                                    if (wrp) {
                                        const hint = wrp.querySelector(`.fi-fo-field-wrp-hint-action`);
                                        if (hint) {
                                            const btn = hint.querySelector(`button`);
                                            if (btn) {
                                                // Transform hint button into a full primary button
                                                btn.className = `fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50`;
                                                btn.style.setProperty(`--c-400`, `var(--primary-400)`);
                                                btn.style.setProperty(`--c-500`, `var(--primary-500)`);
                                                btn.style.setProperty(`--c-600`, `var(--primary-600)`);
                                                
                                                const icon = btn.querySelector(`svg`);
                                                if (icon) {
                                                    icon.classList.remove(`h-4`, `w-4`, `text-gray-400`, `dark:text-gray-500`);
                                                    icon.classList.add(`fi-btn-icon`, `h-5`, `w-5`);
                                                }
                                                
                                                const labelSpan = btn.querySelector(`.sr-only`);
                                                if (labelSpan) {
                                                    labelSpan.classList.remove(`sr-only`);
                                                    labelSpan.classList.add(`fi-btn-label`);
                                                }
                                            }
                                            
                                            // Move to the header next to the label
                                            const headerWrp = wrp.querySelector(`.fi-fo-field-wrp-label`)?.parentElement;
                                            if (headerWrp) {
                                                headerWrp.style.display = `flex`;
                                                headerWrp.style.justifyContent = `space-between`;
                                                headerWrp.style.alignItems = `center`;
                                                headerWrp.appendChild(hint);
                                            } else {
                                                $el.insertAdjacentElement(`beforebegin`, hint);
                                            }
                                        }
                                    }
                                }, 100);
                            });
                        '
                    ]),
                RichEditor::make('description')
                    ->fileAttachmentsDisk('cloudinary')
                    ->fileAttachmentsDirectory('products')
                    ->toolbarButtons([
                        'attachFiles',
                        'blockquote',
                        'bold',
                        'bulletList',
                        'code',
                        'codeBlock',
                        'clearFormatting',
                        'h1',
                        'h2',
                        'h3',
                        'h4',
                        'h5',
                        'h6',
                        'highlight',
                        'horizontalRule',
                        'italic',
                        'lead',
                        'link',
                        'orderedList',
                        'paragraph',
                        'redo',
                        'small',
                        'strike',
                        'subscript',
                        'superscript',
                        'table',
                        'textColor',
                        'underline',
                        'undo',
                        'alignStart',
                        'alignCenter',
                        'alignEnd',
                        'alignJustify',
                    ])
                    ->plugins([
                        \App\Filament\Plugins\CustomAttachCuratorMediaPlugin::make(),
                    ])
                    ->columnSpan('full'),
                \Filament\Forms\Components\KeyValue::make('specifications')
                    ->keyLabel('Feature')
                    ->valueLabel('Specification')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('in_stock'),
                TextInput::make('total_sold')
                    ->required()
                    ->numeric()
                    ->default(0),
                \Filament\Schemas\Components\Group::make([
                    Toggle::make('is_featured')
                        ->required(),
                    Toggle::make('is_flash_sale')
                        ->required(),
                    DateTimePicker::make('flash_sale_ends_at'),
                ])->columns(3)->columnSpanFull(),
            ]);
    }
}
