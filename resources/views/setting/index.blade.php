<x-app-layout>
    <div class="flex min-w-0 h-full flex-col overflow-hidden">
        <div class="flex flex-1 overflow-hidden">
            <div class="flex flex-1 flex-col overflow-y-auto xl:overflow-hidden">
                <!-- Breadcrumb -->
                @include('setting._breadcrumb')

                <div class="flex flex-1 xl:overflow-hidden">
                    <!-- Secondary sidebar -->
                    @include('setting._nav')

                    <!-- Main content -->
                    <div class="flex-1 xl:overflow-y-auto">
                        <livewire:setting.index />
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
