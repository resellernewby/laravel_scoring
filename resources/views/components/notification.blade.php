<div x-data="{
        messages: [],
        remove(message) {
            this.messages.splice(this.messages.map((message) => message.message).indexOf(message), 1)
        },
    }"
    @notify.window="let type = $event.detail.type; let message = $event.detail.message; messages.push({'message': message, 'type': type}); setTimeout(() => { remove(message) }, 5000)"
    class="fixed inset-0 z-20 flex flex-col items-end px-4 py-6 pointer-events-none sm:p-6 sm:justify-start space-y-4">
    <template x-for="(message, messageIndex) in messages" :key="messageIndex">
        <div x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-y-2 opacity-0 sm:translate-y-0 sm:translate-x-2"
            x-transition:enter-end="translate-y-0 opacity-100 sm:translate-x-0"
            x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="max-w-sm w-full bg-white shadow-lg rounded-lg pointer-events-auto">
            <div class="rounded-lg shadow-lg overflow-hidden">
                <div class="p-4">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <x-icon.o-information-circle x-show="message.type == 'info'" x-cloak
                                class="h-6 w-6 text-blue-400" />

                            <x-icon.o-check-circle x-show="message.type == 'success'" x-cloak
                                class="h-6 w-6 text-green-400" />

                            <x-icon.o-x-circle x-show="message.type == 'error'" x-cloak class="h-6 w-6 text-red-400" />

                            <x-icon.o-exclamation-circle x-show="message.type == 'warning'" x-cloak
                                class="h-6 w-6 text-yellow-400" />
                        </div>
                        <div class="ml-3 w-0 flex-1 pt-0.5">
                            <p x-text="message.type" class="text-sm font-medium text-gray-900 uppercase"></p>
                            <p x-text="message.message" class="mt-1 text-sm text-gray-500"></p>
                        </div>
                        <div class="ml-4 flex-shrink-0 flex">
                            <button @click="remove(message.message)"
                                class="inline-flex text-gray-400 focus:outline-none focus:text-gray-500 transition ease-in-out duration-150">
                                <span class="sr-only">Close</span>
                                <x-icon.x class="h-5 w-5" />
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
</div>
