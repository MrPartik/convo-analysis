<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Thread') }}
        </h2>
    </x-slot>
        <div class='grid grid-cols-10'>
            <div class="col-span-3 py-12">
                <div class="max-w-7xl mx-auto md:block lg:block lg:px-8">
                    <div class = "bg-white overflow-hidden shadow-xl sm:rounded-lg" style = "height: 75vh" >
                        <div class="mb-1 flex max-w-md bg-white shadow-lg rounded-lg overflow-hidden">
                            <div class="w-2 bg-orange-400"></div>
                            <div class="flex items-center px-2 py-3">
                                <div class="mx-3">
                                    <h2 class="text-xl font-semibold text-gray-800">Enrollment and Graduate Data</h2>
                                    <p class="text-gray-600">You can import here. <a href="#" class="text-blue-500">import file</a>.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 flex max-w-md bg-white shadow-lg rounded-lg overflow-hidden">
                            <div class="w-2 bg-indigo-500"></div>
                            <div class="flex items-center px-2 py-3">
                                <div class="mx-3">
                                    <h2 class="text-xl font-semibold text-gray-800">Faculty</h2>
                                    <p class="text-gray-600">You can import here. <a href="#" class="text-blue-500">import file</a>.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 flex max-w-md bg-white shadow-lg rounded-lg overflow-hidden">
                            <div class="w-2 bg-green-300"></div>
                            <div class="flex items-center px-2 py-3">
                                <div class="mx-3">
                                    <h2 class="text-xl font-semibold text-gray-800">SUCS</h2>
                                    <p class="text-gray-600">You can import here. <a href="#" class="text-blue-500">import file</a>.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 flex max-w-md bg-white shadow-lg rounded-lg overflow-hidden">
                            <div class="w-2 bg-blue-300"></div>
                            <div class="flex items-center px-2 py-3">
                                <div class="mx-3">
                                    <h2 class="text-xl font-semibold text-gray-800">LUCS</h2>
                                    <p class="text-gray-600">You can import here. <a href="#" class="text-blue-500">import file</a>.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 flex max-w-md bg-white shadow-lg rounded-lg overflow-hidden">
                            <div class="w-2 bg-purple-700"></div>
                            <div class="flex items-center px-2 py-3">
                                <div class="mx-3">
                                    <h2 class="text-xl font-semibold text-gray-800">PHEIS</h2>
                                    <p class="text-gray-600">You can import here. <a href="#" class="text-blue-500">import file</a>.</p>
                                </div>
                            </div>
                        </div>
                        <div class="mb-1 flex max-w-md bg-white shadow-lg rounded-lg overflow-hidden">
                            <div class="w-2 bg-red-400"></div>
                            <div class="flex items-center px-2 py-3">
                                <div class="mx-3">
                                    <h2 class="text-xl font-semibold text-gray-800">Programs</h2>
                                    <p class="text-gray-600">You can import here. <a href="#" class="text-blue-500">import file</a>.</p>
                                </div>
                            </div>
                        </div>

                    </div >
                </div>
            </div>
            <div class="col-span-7 py-12">
                <div class="max-w-7xl mx-auto md:block lg:block lg:px-8">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg " style="height: 75vh">
                        @livewire('convo')
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
