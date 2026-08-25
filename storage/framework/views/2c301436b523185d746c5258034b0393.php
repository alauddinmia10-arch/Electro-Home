<?php if (isset($component)) { $__componentOriginal511d4862ff04963c3c16115c05a86a9d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal511d4862ff04963c3c16115c05a86a9d = $attributes; } ?>
<?php $component = Illuminate\View\DynamicComponent::resolve(['component' => $getFieldWrapperView()] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('dynamic-component'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\DynamicComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['field' => $field]); ?>
<?php \Livewire\Features\SupportCompiledWireKeys\SupportCompiledWireKeys::processComponentKey($component); ?>

    <div
        x-data="{
            state: $wire.entangle('<?php echo e($getStatePath()); ?>').live,
            isOpen: false,
            selectedPreset: 'Last 28 days',
            customStart: null,
            customEnd: null,
            flatpickrInstance: null,
            
            presets: [
                { label: 'Today', getRange: () => { const d = new Date(); return [d, d]; } },
                { label: 'Yesterday', getRange: () => { const d = new Date(); d.setDate(d.getDate() - 1); return [d, d]; } },
                { label: 'Last 7 days', getRange: () => { const end = new Date(); const start = new Date(); start.setDate(start.getDate() - 7); return [start, end]; } },
                { label: 'Last 28 days', getRange: () => { const end = new Date(); const start = new Date(); start.setDate(start.getDate() - 28); return [start, end]; } },
                { label: 'Last 90 days', getRange: () => { const end = new Date(); const start = new Date(); start.setDate(start.getDate() - 90); return [start, end]; } },
                { label: 'This week', getRange: () => { const curr = new Date(); const first = curr.getDate() - curr.getDay(); const last = first + 6; return [new Date(curr.setDate(first)), new Date(curr.setDate(last))]; } },
                { label: 'This month', getRange: () => { const date = new Date(); return [new Date(date.getFullYear(), date.getMonth(), 1), new Date(date.getFullYear(), date.getMonth() + 1, 0)]; } },
                { label: 'This year', getRange: () => { const date = new Date(); return [new Date(date.getFullYear(), 0, 1), new Date(date.getFullYear(), 11, 31)]; } },
                { label: 'Lifetime', getRange: () => { return [new Date(2020, 0, 1), new Date()]; } },
                { label: 'Custom', getRange: () => { return null; } },
            ],
            
            init() {
                if (!this.state || !this.state.startDate) {
                    const [start, end] = this.presets.find(p => p.label === 'Last 28 days').getRange();
                    this.state = {
                        startDate: this.formatValue(start),
                        endDate: this.formatValue(end),
                        label: 'Last 28 days',
                        displayDate: this.formatDate(start) + ' - ' + this.formatDate(end)
                    };
                } else if (!this.state.displayDate && this.state.startDate && this.state.endDate) {
                    const sParts = this.state.startDate.split('-');
                    const eParts = this.state.endDate.split('-');
                    const start = new Date(sParts[0], sParts[1] - 1, sParts[2]);
                    const end = new Date(eParts[0], eParts[1] - 1, eParts[2]);
                    this.state.displayDate = this.formatDate(start) + ' - ' + this.formatDate(end);
                }
                
                if (this.state && this.state.label) {
                    this.selectedPreset = this.state.label;
                }
            },
            
            formatDate(date) {
                if (!date) return '';
                // Format nicely for display: e.g. 23 Jun 2026
                const options = { day: 'numeric', month: 'short', year: 'numeric' };
                return date.toLocaleDateString('en-GB', options);
            },
            
            formatValue(date) {
                if (!date) return '';
                return date.toISOString().split('T')[0]; // Y-m-d for backend
            },
            
            selectPreset(preset) {
                this.selectedPreset = preset.label;
                if(preset.label === 'Custom') return;
                
                const [start, end] = preset.getRange();
                
                this.state = {
                    startDate: this.formatValue(start),
                    endDate: this.formatValue(end),
                    label: preset.label,
                    displayDate: this.formatDate(start) + ' - ' + this.formatDate(end)
                };
                
                if (this.flatpickrInstance) {
                    this.flatpickrInstance.setDate([start, end]);
                }
            }
        }"
        class="relative"
    >
        <!-- Button -->
        <button
            type="button"
            @click="isOpen = !isOpen"
            class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'flex items-center justify-between w-full py-2 text-sm focus:ring-2 focus:ring-primary-600 dark:text-white',
                'px-3 bg-white rounded shadow-sm border border-gray-300 dark:bg-gray-800 dark:border-gray-600' => ! $field->isBorderless(),
                'bg-transparent border-none focus:ring-0' => $field->isBorderless(),
            ]); ?>"
            <?php if(! $field->isBorderless()): ?>
            style="background-color: #ffffff; border: 1px solid #d1d5db; border-radius: 0.5rem; padding-left: 0.75rem; padding-right: 0.75rem; min-height: 36px;"
            <?php endif; ?>
        >
            <span x-text="state?.label ? state.label + ': ' + (state.displayDate || '') : 'Select Date Range'"></span>
        </button>

        <!-- Popover -->
        <div
            class="fbrp-popover"
            x-show="isOpen"
            @click.away="isOpen = false"
            x-transition
            style="display: none; position: absolute; right: 0; z-index: 50; margin-top: 0.5rem; background-color: #ffffff; border: 1px solid #e5e7eb; border-radius: 0.5rem; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); width: max-content; overflow: hidden;"
        >
            <div class="fbrp-popover-inner" style="display: flex;">
                <!-- Sidebar -->
                <div class="fbrp-sidebar" style="width: 9.5rem; padding: 0.25rem 0; border-right: 1px solid #e5e7eb; background-color: #ffffff; display: flex; flex-direction: column;">
                    <template x-for="preset in presets" :key="preset.label">
                        <button
                            type="button"
                            @click="selectPreset(preset)"
                            style="width: 100%; padding: 0.375rem 0.75rem; font-size: 0.8125rem; text-align: left; display: flex; align-items: center; cursor: pointer; border: none; background: none;"
                            :style="selectedPreset === preset.label ? { color: '#2563eb', fontWeight: '500', backgroundColor: '#eff6ff' } : { color: '#374151' }"
                        >
                            <span style="display: inline-block; width: 0.875rem; height: 0.875rem; margin-right: 0.5rem; border-radius: 9999px; flex-shrink: 0;" 
                                  :style="selectedPreset === preset.label ? { border: '4px solid #2563eb' } : { border: '1px solid #d1d5db' }"></span>
                            <span x-text="preset.label"></span>
                        </button>
                    </template>
                </div>
                
                <!-- Calendars & Actions -->
                <div style="display: flex; flex-direction: column; padding: 0.5rem 0.5rem 0.75rem 0.25rem; background-color: #ffffff;">
                    <!-- Calendar Container -->
                    <style>
                        .custom-flatpickr .flatpickr-calendar.inline {
                            border: none !important;
                            box-shadow: none !important;
                            background: transparent !important;
                        }
                        
                        /* Desktop Zoom - The user requested the calendars be slightly zoomed out on desktop so they aren't cut off */
                        @media (min-width: 1024px) {
                            .custom-flatpickr {
                                zoom: 0.85; /* Shrinks the calendar slightly on desktop */
                                width: 100% !important;
                                transform-origin: top left;
                            }
                        }

                        @media (max-width: 1023px) {
                            /* Make popover a centered modal on mobile */
                            .fbrp-popover {
                                position: fixed !important;
                                top: 50% !important;
                                left: 50% !important;
                                transform: translate(-50%, -50%) !important;
                                width: 95vw !important;
                                max-width: 450px !important;
                                max-height: 90vh !important;
                                overflow-y: auto !important;
                                z-index: 9999 !important;
                                margin-top: 0 !important;
                            }
                            /* Ensure sidebar is on the left (row direction) */
                            .fbrp-popover-inner {
                                display: flex !important;
                                flex-direction: row !important;
                                align-items: stretch;
                            }
                            /* Sidebar on the left */
                            .fbrp-sidebar {
                                width: 8.5rem !important; /* Narrower to fit mobile */
                                padding: 0.5rem 0 !important;
                                border-right: 1px solid #e5e7eb !important;
                                border-bottom: none !important;
                                display: flex !important;
                                flex-direction: column !important;
                            }
                            .fbrp-sidebar button {
                                padding: 0.5rem 0.5rem !important;
                                font-size: 0.75rem !important;
                            }
                            .fbrp-sidebar button span:first-child {
                                /* Shrink radio button icon slightly */
                                width: 0.75rem !important;
                                height: 0.75rem !important;
                                margin-right: 0.35rem !important;
                            }
                            .fbrp-popover-inner > div:nth-child(2) {
                                width: 100% !important;
                                padding: 0.25rem !important;
                                flex: 1;
                            }
                            
                            /* Zoom and Vertical Stack for Flatpickr */
                            .custom-flatpickr {
                                zoom: 0.72 !important; /* Shrink to fit beside sidebar on small screens */
                                width: 100% !important;
                                transform-origin: top left;
                            }
                            .flatpickr-calendar {
                                width: auto !important;
                                padding: 0 !important;
                            }
                            /* Advanced Vertical Stack Hack via display: contents */
                            .flatpickr-months,
                            .flatpickr-innerContainer,
                            .flatpickr-rContainer,
                            .flatpickr-weekdays,
                            .flatpickr-days {
                                display: contents !important;
                            }
                            .flatpickr-calendar.multiMonth {
                                display: grid !important;
                                grid-template-columns: 1fr !important; /* 1 Column for vertical stack */
                                gap: 5px;
                            }
                            
                            /* Month 1 (Top) */
                            .flatpickr-month:nth-child(1) { grid-row: 1; grid-column: 1; margin-top: 5px; }
                            .flatpickr-weekdaycontainer:nth-child(1) { grid-row: 2; grid-column: 1; }
                            .dayContainer:nth-child(1) { grid-row: 3; grid-column: 1; }
                            
                            /* Month 2 (Bottom) */
                            .flatpickr-month:nth-child(2) { grid-row: 4; grid-column: 1; margin-top: 15px; }
                            .flatpickr-weekdaycontainer:nth-child(2) { grid-row: 5; grid-column: 1; }
                            .dayContainer:nth-child(2) { grid-row: 6; grid-column: 1; }
                        }
                    </style>
                    <div class="custom-flatpickr" wire:ignore style="width: 100%; max-width: 700px; min-height: 250px; overflow: visible;">
                        <div>
                            <div 
                                x-init="
                                    let isInitialized = false;
                                    let loadFlatpickr = () => {
                                        return new Promise((resolve) => {
                                            if (typeof window.flatpickr !== 'undefined') {
                                                resolve(window.flatpickr);
                                                return;
                                            }
                                            const style = document.createElement('link');
                                            style.rel = 'stylesheet';
                                            style.href = 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css';
                                            document.head.appendChild(style);
                                            const script = document.createElement('script');
                                            script.src = 'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.js';
                                            script.onload = () => resolve(window.flatpickr);
                                            document.head.appendChild(script);
                                        });
                                    };

                                    $watch('isOpen', (val) => {
                                        if (val && !isInitialized) {
                                            setTimeout(() => {
                                                loadFlatpickr().then((fp) => {
                                                    flatpickrInstance = fp($el, {
                                                        mode: 'range',
                                                        inline: true,
                                                        showMonths: 2,
                                                        onChange: function(selectedDates) {
                                                            if(selectedDates.length === 2) {
                                                                customStart = selectedDates[0];
                                                                customEnd = selectedDates[1];
                                                                selectedPreset = 'Custom';
                                                            }
                                                        }
                                                    });
                                                    
                                                    if (state && state.startDate && state.endDate) {
                                                        flatpickrInstance.setDate([state.startDate, state.endDate]);
                                                    }
                                                    isInitialized = true;
                                                });
                                            }, 50);
                                        }
                                    });
                                "
                            ></div>
                        </div>
                    </div>
                    
                    <!-- Bottom Bar -->
                    <div style="display: flex; align-items: center; justify-content: space-between; padding-top: 0.75rem; margin-top: 0.5rem; border-top: 1px solid #e5e7eb;">
                        <div style="font-size: 0.8125rem; font-weight: 500; color: #374151; padding-left: 0.5rem;">
                            <span x-show="selectedPreset === 'Custom'" x-text="customStart && customEnd ? formatDate(customStart) + ' - ' + formatDate(customEnd) : 'Select custom range'"></span>
                        </div>
                        <div style="display: flex; gap: 0.5rem;">
                            <button type="button" @click="isOpen = false" style="padding: 0.375rem 0.75rem; font-size: 0.8125rem; font-weight: 500; color: #374151; background-color: #ffffff; border: 1px solid #d1d5db; border-radius: 0.375rem; cursor: pointer;">Cancel</button>
                            <button 
                                type="button" 
                                @click="
                                    if (selectedPreset === 'Custom' && customStart && customEnd) {
                                        state = { 
                                            startDate: formatValue(customStart), 
                                            endDate: formatValue(customEnd), 
                                            label: 'Custom',
                                            displayDate: formatDate(customStart) + ' - ' + formatDate(customEnd)
                                        };
                                        isOpen = false;
                                    } else if (selectedPreset !== 'Custom') {
                                        isOpen = false;
                                    }
                                " 
                                style="padding: 0.375rem 0.75rem; font-size: 0.8125rem; font-weight: 500; color: #ffffff; background-color: #2563eb; border: none; border-radius: 0.375rem; cursor: pointer;"
                            >Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $attributes = $__attributesOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__attributesOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal511d4862ff04963c3c16115c05a86a9d)): ?>
<?php $component = $__componentOriginal511d4862ff04963c3c16115c05a86a9d; ?>
<?php unset($__componentOriginal511d4862ff04963c3c16115c05a86a9d); ?>
<?php endif; ?>
<?php /**PATH C:\Users\MD ALAUDDIN\Desktop\MY Site 1\08-12-2026\ElectroHome.BD\resources\views/filament/forms/components/facebook-date-range-picker.blade.php ENDPATH**/ ?>