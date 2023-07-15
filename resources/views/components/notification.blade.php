<div class="fixed inset-0 flex items-end justify-center px-4 py-6 pointer-events-none sm:p-6 sm:items-start sm:justify-center">
    <div
        x-data="{show: false, message : ''}"
        x-show="show"
        x-on:notify.window="show=true; message=$event.detail; setTimeout(() => {show = false;}, 2500);"
        style="display: none"
        class="max-w-sm w-full shadow-lg alert alert-success text-white pointer-events-auto">
        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <span x-text="message"></span>
    </div>
</div>

