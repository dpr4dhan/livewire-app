<div class="min-h-screen bg-gray-50 flex flex-col justify-center py-12">
    <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">

        <div class="bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
            <h2 class="text-2xl font-bold text-center">Sign Up</h2>
            <form wire:submit.prevent="register">
                <div>
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" wire:model="name" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded">
                    @error('name')<span class="text-red-600">{{$message}}</span>@enderror
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" wire:model="email" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded">
                    @error('email')<span class="text-red-600">{{$message}}</span>@enderror
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" wire:model.lazy="password" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded">
                    @error('password')<span class="text-red-600">{{$message}}</span>@enderror
                </div>
                <div>
                    <label for="confirmPassword">Confirm Password</label>
                    <input type="password" id="confirmPassword" name="confirmPassword" wire:model.lazy="confirmPassword" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded">
                    @error('confirmPassword')<span class="text-red-600">{{$message}}</span>@enderror
                </div>
                <div class="mt-4">
                    <button type="submit" class="bg-indigo-700 rounded p-3 text-gray-50">Submit</button>
                </div>
            </form>

        </div>
    </div>
</div>

