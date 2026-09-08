<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" style="background: var(--dark); border-bottom: 1px solid rgba(255,255,255,.08);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center">
                <!-- Logo -->
                <a href="{{ route('dashboard') }}" wire:navigate style="font-family:'Bebas Neue',sans-serif; font-size:1.7rem; letter-spacing:3px; color:var(--white); text-decoration:none;">
                    GYM<span style="color:var(--red);">PRO</span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" wire:navigate
                       style="font-size:.78rem; letter-spacing:2px; text-transform:uppercase; font-weight:600; text-decoration:none; color:{{ request()->routeIs('dashboard') ? 'var(--white)' : 'var(--muted)' }}; border-bottom: 2px solid {{ request()->routeIs('dashboard') ? 'var(--red)' : 'transparent' }}; padding-bottom: 4px;">
                        {{ __('Dashboard') }}
                    </a>
                    <a href="{{ route('workouts.index') }}" wire:navigate
                       style="font-size:.78rem; letter-spacing:2px; text-transform:uppercase; font-weight:600; text-decoration:none; color:{{ request()->routeIs('workouts.*') && !request()->routeIs('admin.*') ? 'var(--white)' : 'var(--muted)' }}; border-bottom: 2px solid {{ request()->routeIs('workouts.*') && !request()->routeIs('admin.*') ? 'var(--red)' : 'transparent' }}; padding-bottom: 4px;">
                        {{ __('Workouts') }}
                    </a>
                    <a href="{{ route('diets.index') }}" wire:navigate
                       style="font-size:.78rem; letter-spacing:2px; text-transform:uppercase; font-weight:600; text-decoration:none; color:{{ request()->routeIs('diets.*') && !request()->routeIs('admin.*') ? 'var(--white)' : 'var(--muted)' }}; border-bottom: 2px solid {{ request()->routeIs('diets.*') && !request()->routeIs('admin.*') ? 'var(--red)' : 'transparent' }}; padding-bottom: 4px;">
                        {{ __('Diet Plans') }}
                    </a>
                    @auth
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" wire:navigate
                               style="font-size:.78rem; letter-spacing:2px; text-transform:uppercase; font-weight:600; text-decoration:none; color:{{ request()->routeIs('admin.*') ? 'var(--white)' : 'var(--muted)' }}; border-bottom: 2px solid {{ request()->routeIs('admin.*') ? 'var(--red)' : 'transparent' }}; padding-bottom: 4px;">
                                {{ __('Admin') }}
                            </a>
                        @elseif (auth()->user()->isTrainer())
                            <a href="{{ route('trainer.dashboard') }}" wire:navigate
                               style="font-size:.78rem; letter-spacing:2px; text-transform:uppercase; font-weight:600; text-decoration:none; color:{{ request()->routeIs('trainer.*') ? 'var(--white)' : 'var(--muted)' }}; border-bottom: 2px solid {{ request()->routeIs('trainer.*') ? 'var(--red)' : 'transparent' }}; padding-bottom: 4px;">
                                {{ __('Trainer') }}
                            </a>
                        @endif
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="app-btn-ghost inline-flex items-center px-3 py-2 text-sm rounded-md focus:outline-none transition ease-in-out duration-150" style="font-family:'Barlow',sans-serif; letter-spacing:1px;">
                            <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md focus:outline-none transition duration-150 ease-in-out" style="color: var(--muted);">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background: var(--dark);">
            <div class="pt-2 pb-3 space-y-1 px-2">
                <a href="{{ route('dashboard') }}" wire:navigate class="block px-3 py-2 rounded-md text-sm font-semibold uppercase tracking-wider" style="color: {{ request()->routeIs('dashboard') ? 'var(--white)' : 'var(--muted)' }};">
                    {{ __('Dashboard') }}
                </a>
                <a href="{{ route('workouts.index') }}" wire:navigate class="block px-3 py-2 rounded-md text-sm font-semibold uppercase tracking-wider" style="color: {{ request()->routeIs('workouts.*') ? 'var(--white)' : 'var(--muted)' }};">
                    {{ __('Workouts') }}
                </a>
                <a href="{{ route('diets.index') }}" wire:navigate class="block px-3 py-2 rounded-md text-sm font-semibold uppercase tracking-wider" style="color: {{ request()->routeIs('diets.*') ? 'var(--white)' : 'var(--muted)' }};">
                    {{ __('Diet Plans') }}
                </a>
                @auth
                    @if (auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" wire:navigate class="block px-3 py-2 rounded-md text-sm font-semibold uppercase tracking-wider" style="color: {{ request()->routeIs('admin.*') ? 'var(--white)' : 'var(--muted)' }};">
                            {{ __('Admin') }}
                        </a>
                    @elseif (auth()->user()->isTrainer())
                        <a href="{{ route('trainer.dashboard') }}" wire:navigate class="block px-3 py-2 rounded-md text-sm font-semibold uppercase tracking-wider" style="color: {{ request()->routeIs('trainer.*') ? 'var(--white)' : 'var(--muted)' }};">
                            {{ __('Trainer') }}
                        </a>
                    @endif
                @endauth
            </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-3" style="border-top: 1px solid rgba(255,255,255,.08);">
            <div class="px-4">
                <div class="font-medium text-base" style="color: var(--white);" x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                <div class="font-medium text-sm" style="color: var(--muted);">{{ auth()->user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1 px-2">
                <a href="{{ route('profile') }}" wire:navigate class="block px-3 py-2 rounded-md text-sm font-semibold uppercase tracking-wider" style="color: var(--muted);">
                    {{ __('Profile') }}
                </a>

                <!-- Authentication -->
                <button wire:click="logout" class="w-full text-start block px-3 py-2 rounded-md text-sm font-semibold uppercase tracking-wider" style="color: var(--muted);">
                    {{ __('Log Out') }}
                </button>
            </div>
        </div>
    </div>
</nav>
