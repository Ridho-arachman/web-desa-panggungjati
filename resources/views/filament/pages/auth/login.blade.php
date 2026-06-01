<x-filament-panels::page.simple>
    <div class="w-full max-w-sm mx-auto">
        <div class="mb-6 text-center">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-20 mx-auto mb-3">
            <h1 class="text-2xl font-bold text-gray-800">Kelurahan Panggungjati</h1>
            <p class="text-gray-500 text-sm">Panel Administrasi</p>
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-filament-panels::form wire:submit="authenticate">
            {{ $this->form }}

            <div class="flex items-center justify-between mt-4 mb-4">
                <label class="flex items-center gap-2 text-sm">
                    <x-filament::input.checkbox wire:model="data.remember" />
                    <span class="text-gray-600">{{ __('filament-panels::pages/auth/login.form.remember.label') }}</span>
                </label>

                @if (\Filament\Facades\Filament::hasPasswordReset())
                    <a href="{{ \Filament\Facades\Filament::getRequestPasswordResetUrl() }}" class="text-sm text-primary-600 hover:underline">
                        {{ __('filament-panels::pages/auth/login.buttons.request_password_reset.label') }}
                    </a>
                @endif
            </div>

            <x-filament::button type="submit" class="w-full mt-2">
                {{ __('filament-panels::pages/auth/login.form.actions.login.label') }}
            </x-filament::button>
        </x-filament-panels::form>
    </div>
</x-filament-panels::page.simple>