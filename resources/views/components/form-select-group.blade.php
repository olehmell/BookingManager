<div class="col-span-4 sm:col-span-2">
    <label for="country" class="block text-sm font-medium text-gray-700">{{ $label }}</label>
    <select id="$name" name="$name" class="mt-1 block w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-gray-900 focus:border-gray-900 sm:text-sm">
        {{ $slot }}
    </select>
</div>
