<x-app-layout>
    <x-slot name="header">
        <x-page-header title="Пользователи" description="Управление ролями и доступом" />
    </x-slot>

    @if(session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif

    @if(session('error'))
        <x-alert type="error" :message="session('error')" />
    @endif

    @php
        $roleColors = [
            'admin' => 'bg-red-100 text-red-700',
            'manager' => 'bg-indigo-100 text-indigo-700',
            'warehouse' => 'bg-slate-200 text-slate-700',
        ];
    @endphp

    <x-card class="mb-6 p-5">
        <x-heading-4 class="mb-3">Описание ролей</x-heading-4>
        <div class="grid sm:grid-cols-3 gap-4">
            <div class="flex items-center gap-3 p-3 bg-red-50 rounded-xl">
                <span class="px-3 py-1 rounded-lg text-sm font-semibold bg-red-100 text-red-700">admin</span>
                <span class="text-sm text-slate-600">Полный доступ + управление пользователями</span>
            </div>
            <div class="flex items-center gap-3 p-3 bg-indigo-50 rounded-xl">
                <span class="px-3 py-1 rounded-lg text-sm font-semibold bg-indigo-100 text-indigo-700">manager</span>
                <span class="text-sm text-slate-600">Создание и редактирование товаров</span>
            </div>
            <div class="flex items-center gap-3 p-3 bg-slate-50 rounded-xl">
                <span class="px-3 py-1 rounded-lg text-sm font-semibold bg-slate-200 text-slate-700">warehouse</span>
                <span class="text-sm text-slate-600">Только просмотр и операции</span>
            </div>
        </div>
    </x-card>


    <x-card class="hidden lg:block overflow-x-auto">
        <table class="min-w-full">
            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Пользователь</th>
                    <th class="px-6 py-4 text-left text-sm font-semibold text-slate-600">Email</th>
                    <th class="px-6 py-4 text-center text-sm font-semibold text-slate-600">Роль</th>
                    <th class="px-6 py-4 text-right text-sm font-semibold text-slate-600">Действия</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($users as $user)
                    <tr class="hover:bg-slate-50 transition {{ $user->id === auth()->id() ? 'bg-indigo-50/50' : '' }}">
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gradient-to-br from-slate-100 to-slate-200 rounded-full flex items-center justify-center">
                                    <span class="text-sm font-bold text-slate-600">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</span>
                                </div>
                                <div>
                                    <x-text-body class="font-semibold">{{ $user->name }}</x-text-body>
                                    @if($user->id === auth()->id())
                                        <x-text-caption class="text-indigo-600">Это вы</x-text-caption>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-5 text-slate-600">{{ $user->email }}</td>
                        <td class="px-6 py-5 text-center">

                            <span class="px-4 py-2 rounded-xl text-sm font-semibold {{ $roleColors[$user->role] ?? 'bg-slate-100 text-slate-600' }}">
                                {{ $user->role }}
                            </span>
                        </td>
                        <td class="px-6 py-5">
                            @if($user->id === auth()->id())
                                <div class="flex justify-end">
                                    <span class="px-4 py-2 bg-slate-100 text-slate-500 text-sm rounded-lg">
                                        Нельзя изменить свою роль
                                    </span>
                                </div>
                            @else
                            <div class="flex items-center justify-end gap-4">
                                <form action="{{ route('users.reset-password', $user) }}" method="POST" onsubmit="return confirm('Вы уверены, что хотите сбросить пароль для этого пользователя? Новый пароль будет сгенерирован автоматически.')">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-white text-slate-700 text-sm font-medium border border-slate-200 rounded-lg hover:bg-rose-50 hover:text-rose-600 hover:border-rose-200 transition shadow-sm group">
                                        <x-icons.key class="w-4 h-4 text-slate-400 group-hover:text-rose-500 transition-colors" />
                                        Сброс пароля
                                    </button>
                                </form>

                                <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Удалить пользователя {{ $user->name }} навсегда?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center w-10 h-10 bg-white text-slate-400 border border-slate-200 rounded-lg hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition shadow-sm" title="Удалить пользователя">
                                        <x-icons.trash class="w-5 h-5" />
                                    </button>
                                </form>

                                <div class="w-px h-8 bg-slate-200 hidden xl:block"></div>

                                <form action="{{ route('users.update-role', $user) }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    @method('PATCH')
                                    <x-select name="role" class="w-[130px]">
                                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>admin</option>
                                        <option value="manager" {{ $user->role === 'manager' ? 'selected' : '' }}>manager</option>
                                        <option value="warehouse" {{ $user->role === 'warehouse' ? 'selected' : '' }}>warehouse</option>
                                    </x-select>
                                    <x-primary-button>
                                        Сохранить
                                    </x-primary-button>
                                </form>
                            </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-card>


    <div class="lg:hidden space-y-4">
        @foreach($users as $user)
            <x-card class="p-5 {{ $user->id === auth()->id() ? 'ring-2 ring-indigo-500/50' : '' }}">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-slate-100 to-slate-200 rounded-full flex items-center justify-center shrink-0">
                            <span class="text-sm font-bold text-slate-600">{{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}</span>
                        </div>
                        <div>
                            <p class="font-semibold text-slate-800">{{ $user->name }}</p>
                            @if($user->id === auth()->id())
                                <p class="text-xs text-indigo-600">Это вы</p>
                            @else
                                <p class="text-xs text-slate-500 truncate max-w-[130px] sm:max-w-xs">{{ $user->email }}</p>
                            @endif
                        </div>
                    </div>
                    <div>

                        <span class="px-3 py-1.5 rounded-xl text-xs font-semibold {{ $roleColors[$user->role] ?? 'bg-slate-100 text-slate-600' }}">
                            {{ $user->role }}
                        </span>
                    </div>
                </div>

                @if($user->id === auth()->id())
                    <div class="pt-4 border-t border-slate-100 text-center">
                        <span class="text-sm text-slate-500 font-medium">Ваша учетная запись</span>
                    </div>
                @else
                    <div class="flex flex-col gap-3 mt-4 pt-4 border-t border-slate-100">
                        <form action="{{ route('users.update-role', $user) }}" method="POST" class="flex gap-2 w-full">
                            @csrf
                            @method('PATCH')
                            <x-select name="role" class="flex-1 w-full bg-slate-50">
                                <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>admin</option>
                                <option value="manager" {{ $user->role === 'manager' ? 'selected' : '' }}>manager</option>
                                <option value="warehouse" {{ $user->role === 'warehouse' ? 'selected' : '' }}>warehouse</option>
                            </x-select>
                            <x-primary-button class="shrink-0">
                                Сохранить
                            </x-primary-button>
                        </form>

                        <div class="flex gap-2">
                            <form action="{{ route('users.reset-password', $user) }}" method="POST" class="flex-1" onsubmit="return confirm('Сбросить пароль для пользователя?')">
                                @csrf
                                <x-secondary-button type="submit" class="w-full gap-2 hover:bg-rose-50 hover:text-rose-600 border-slate-200">
                                    <x-icons.key class="w-4 h-4 text-slate-400" />
                                    Пароль
                                </x-secondary-button>
                            </form>

                            <form action="{{ route('users.destroy', $user) }}" method="POST" class="flex-1" onsubmit="return confirm('Удалить пользователя навсегда?')">
                                @csrf
                                @method('DELETE')
                                <x-secondary-button type="submit" class="w-full gap-2 hover:bg-red-50 hover:text-red-600 border-slate-200">
                                    <x-icons.trash class="w-4 h-4 text-slate-400" />
                                    Удалить
                                </x-secondary-button>
                            </form>
                        </div>
                    </div>
                @endif
            </x-card>
        @endforeach
    </div>
</x-app-layout>
