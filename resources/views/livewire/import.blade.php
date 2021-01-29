<div class="bg-white p-10">
    <div wire:loading class="w-full h-full fixed block top-0 left-0 bg-white opacity-75 z-50">
      <span class="text-green-500 opacity-75 top-1/2 my-0 mx-auto block relative w-0 h-0" style=" top: 50%; ">
        <i class="fas fa-circle-notch fa-spin fa-5x"></i>
      </span>
    </div>
    <p class="text-center font-bold text-xl mb-10">Import/ Restore from Excel File</p>
    <div class="container  mx-auto grid">
            <div>
            @error('*') <span class="alert-message text-red-500">{{ $message }}</span> @enderror
            <div class="alert-message">
                <span class="text-green-700 font-bold text-xl">{{ $success }}</span>
            </div>
        </div>
        <!-- Cards -->
        <div class="grid gap-6 mb-8 md:grid-cols-3">
            <label class="cursor-pointer flex items-center p-4 bg-white hover:bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800 shadow-lg">
                <div class="p-3 mr-4 text-yellow-500 bg-yellow-100 rounded-full dark:text-yellow-100 dark:bg-yellow-500">
                    <svg class="h-5 w-5 stroke-current m-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-gray-600 dark:text-gray-400">
                        Academic Year
                    </p>
                    <p class="mb-2 text-xs text-gray-600 dark:text-gray-400">
                        Note: Please be informed that Academic Year should be extracted from excel book. <a href="/templates/template_academic_year.xlsx" class="text-blue-700 font-bold">Download template</a>
                    </p>
                    <input wire:model="academicYearFile" type="file" class="hidden">
                </div>

                @if($academicYearFile !== '')
                    <button wire:click="importAcademicYear" wire:loading.attr="disabled" class="flex items-center space-x-2 px-3 border border-blue-400 rounded-md bg-white text-blue-500 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-blue-200 focus:outline-none">
                        <span>Proceed</span>
                        <svg  class="h-5 w-5 stroke-current m-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif
            </label>
            <label class="cursor-pointer flex items-center p-4 bg-white hover:bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800 shadow-lg">
                <div class="p-3 mr-4 text-yellow-500 bg-yellow-100 rounded-full dark:text-yellow-100 dark:bg-yellow-500">
                    <svg class="h-5 w-5 stroke-current m-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-gray-600 dark:text-gray-400">
                        Enrollment Data
                    </p>
                    <p class="mb-2 text-xs text-gray-600 dark:text-gray-400">
                        Note: Please be informed that Enrollment Data should be extracted from excel book. <a href="/templates/template_enrollment.xlsx" class="text-blue-700 font-bold">Download template</a>
                    </p>
                    <input wire:model="enrollmentFile" type="file" class="hidden">
                </div>
                @if($enrollmentFile !== '')
                    <button wire:click="importEnrollment" wire:loading.attr="disabled" class="flex items-center space-x-2 px-3 border border-blue-400 rounded-md bg-white text-blue-500 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-blue-200 focus:outline-none">
                        <span>Proceed</span>
                        <svg  class="h-5 w-5 stroke-current m-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif
            </label>
            <label class="cursor-pointer flex items-center p-4 bg-white hover:bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800 shadow-lg">
                <div class="p-3 mr-4 text-yellow-500 bg-yellow-100 rounded-full dark:text-yellow-100 dark:bg-yellow-500">
                    <svg class="h-5 w-5 stroke-current m-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-gray-600 dark:text-gray-400">
                        Graduate Data
                    </p>
                    <p class="mb-2 text-xs text-gray-600 dark:text-gray-400">
                        Note: Please be informed that Graduate Data should be extracted from excel book. <a href="/templates/template_graduate.xlsx" class="text-blue-700 font-bold">Download template</a>
                    </p>
                    <input wire:model="graduateFile" type="file" class="hidden">
                </div>
                @if($graduateFile !== '')
                    <button wire:click="importGraduate" wire:loading.attr="disabled" class="flex items-center space-x-2 px-3 border border-blue-400 rounded-md bg-white text-blue-500 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-blue-200 focus:outline-none">
                        <span>Proceed</span>
                        <svg  class="h-5 w-5 stroke-current m-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif
            </label>
        </div>

        <div class="grid gap-6 mb-8 md:grid-cols-2">
            <label class="cursor-pointer flex items-center p-4 bg-white hover:bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800 shadow-lg">
                <div class="p-3 mr-4 text-blue-500 bg-blue-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                    <svg class="h-5 w-5 stroke-current m-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-gray-600 dark:text-gray-400">
                        HEI Profile
                    </p>
                    <p class="mb-2 text-xs text-gray-600 dark:text-gray-400">
                        Note: Please be informed that HEI Profile should be extracted from excel book. <a href="/templates/template_hei.xlsx" class="text-blue-700 font-bold">Download template</a>
                    </p>
                    <input wire:model="heiFile" type="file" class="hidden">
                </div>

                @if($heiFile !== '')
                    <button wire:click="importHei" wire:loading.attr="disabled" class="flex items-center space-x-2 px-3 border border-blue-400 rounded-md bg-white text-blue-500 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-blue-200 focus:outline-none">
                        <span>Proceed</span>
                        <svg  class="h-5 w-5 stroke-current m-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif
            </label>
            <label class="cursor-pointer flex items-center p-4 bg-white hover:bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800 shadow-lg">
                <div class="p-3 mr-4 text-green-500 bg-green-100 rounded-full dark:text-green-100 dark:bg-green-500">
                    <svg class="h-5 w-5 stroke-current m-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-gray-600 dark:text-gray-400">
                        Programs
                    </p>
                    <p class="mb-2 text-xs text-gray-600 dark:text-gray-400">
                        Note: Please be informed that Programs should be extracted from excel book. <a href="/templates/template_program.xlsx" class="text-blue-700 font-bold">Download template</a>
                    </p>
                    <input wire:model="programFile" type="file" class="hidden">
                </div>
                @if($programFile !== '')
                    <button wire:click="importProgram" wire:loading.attr="disabled" class="flex items-center space-x-2 px-3 border border-blue-400 rounded-md bg-white text-blue-500 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-blue-200 focus:outline-none">
                        <span>Proceed</span>
                        <svg  class="h-5 w-5 stroke-current m-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif
            </label>
        </div>

        <div class="grid gap-6 mb-8 md:grid-cols-3">
            <label class="cursor-pointer flex items-center p-4 bg-white hover:bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800 shadow-lg">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                    <svg class="h-5 w-5 stroke-current m-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-gray-600 dark:text-gray-400">
                        SUC Profile
                    </p>
                    <p class="mb-2 text-xs text-gray-600 dark:text-gray-400">
                        Note: Please be informed that SUC Profile should be extracted from excel book. <a href="/templates/template_suc.xlsx" class="text-blue-700 font-bold">Download template</a>
                    </p>
                    <input wire:model="sucFile" type="file" class="hidden">
                </div>

                @if($sucFile !== '')
                    <button wire:click="importSuc" wire:loading.attr="disabled" class="flex items-center space-x-2 px-3 border border-blue-400 rounded-md bg-white text-blue-500 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-blue-200 focus:outline-none">
                        <span>Proceed</span>
                        <svg  class="h-5 w-5 stroke-current m-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif
            </label>
            <label class="cursor-pointer flex items-center p-4 bg-white hover:bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800 shadow-lg">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-green-100 dark:bg-green-500">
                    <svg class="h-5 w-5 stroke-current m-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-gray-600 dark:text-gray-400">
                        LUC Profile
                    </p>
                    <p class="mb-2 text-xs text-gray-600 dark:text-gray-400">
                        Note: Please be informed that LUC Profile should be extracted from excel book. <a href="/templates/template_luc.xlsx" class="text-blue-700 font-bold">Download template</a>
                    </p>
                    <input wire:model="lucFile" type="file" class="hidden">
                </div>
                @if($lucFile !== '')
                    <button wire:click="importLuc" wire:loading.attr="disabled" class="flex items-center space-x-2 px-3 border border-blue-400 rounded-md bg-white text-blue-500 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-blue-200 focus:outline-none">
                        <span>Proceed</span>
                        <svg  class="h-5 w-5 stroke-current m-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif
            </label>
            <label class="cursor-pointer flex items-center p-4 bg-white hover:bg-gray-100 rounded-lg shadow-xs dark:bg-gray-800 shadow-lg">
                <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-green-100 dark:bg-green-500">
                    <svg class="h-5 w-5 stroke-current m-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="text-lg font-bold text-gray-600 dark:text-gray-400">
                        PHEIS Profile
                    </p>
                    <p class="mb-2 text-xs text-gray-600 dark:text-gray-400">
                        Note: Please be informed that PHEIS Profile should be extracted from excel book. <a href="/templates/template_pheis.xlsx" class="text-blue-700 font-bold">Download template</a>
                    </p>
                    <input wire:model="pheisFile" type="file" class="hidden">
                </div>
                @if($pheisFile !== '')
                    <button wire:click="importPheis" wire:loading.attr="disabled" class="flex items-center space-x-2 px-3 border border-blue-400 rounded-md bg-white text-blue-500 text-xs leading-4 font-medium uppercase tracking-wider hover:bg-blue-200 focus:outline-none">
                        <span>Proceed</span>
                        <svg  class="h-5 w-5 stroke-current m-2" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </button>
                @endif
            </label>
        </div>

    </div>
</div>

<script>
    window.livewire.on('success', function() {
        setTimeout(function () {
            $('.alert-message').fadeOut('fast');
            window.location.reload();
        }, 500);
    });
</script>
