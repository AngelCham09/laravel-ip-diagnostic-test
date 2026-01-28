<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

   <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow sm:rounded-lg border border-gray-100">
                <div class="p-10 text-center"
                     x-data="{
                        userIp: 'Detecting...',
                        serverIp: 'Detecting...',
                        userLoading: true,
                        serverLoading: true
                     }"
                     x-init="
                        fetch('https://api.ipify.org?format=json')
                            .then(res => {
                                if (!res.ok) throw new Error();
                                return res.json();
                            })
                            .then(data => { userIp = data.ip; userLoading = false; })
                            .catch(() => { userIp = 'Failed to load'; userLoading = false; });

                        fetch('/api/current-ip')
                            .then(res => {
                                if (!res.ok) throw new Error();
                                return res.json();
                            })
                            .then(data => { serverIp = data.ip; serverLoading = false; })
                            .catch(() => { serverIp = 'Server error'; serverLoading = false; });
                     ">

                    <div class="mb-8">
                        <h3 class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">
                            Your IP Address
                        </h3>
                        <div class="inline-block px-8 py-4 bg-indigo-50 rounded-2xl border border-indigo-100">
                            <h1 class="text-5xl font-black text-indigo-700 font-mono tracking-tighter"
                                :class="userLoading && 'animate-pulse'"
                                x-text="userIp">
                            </h1>
                        </div>
                    </div>

                    <div class="flex justify-center items-center gap-6 mt-4">
                        <div class="text-center">
                            <h4 class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">System IP</h4>
                            <div class="text-md font-bold text-gray-500 font-mono"
                                 :class="serverLoading && 'animate-pulse'"
                                 x-text="serverIp">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
