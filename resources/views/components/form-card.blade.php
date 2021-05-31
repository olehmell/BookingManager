
<form {!! $attributes !!} action="$action" method="$method">
    <div class="shadow sm:rounded-md sm:overflow-hidden">
        <div class="bg-white py-6 px-4 sm:p-6">
            <div>
                <h2 id="payment_details_heading" class="text-lg leading-6 font-medium text-gray-900">{{ $title }}</h2>
                <p class="mt-1 text-sm text-gray-500">{{ $description ?? '' }}</p>
            </div>

            <div class="mt-6 grid grid-cols-4 gap-6">
                {{ $slot }}
            </div>
        </div>
        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
            {{ $button ?? '' }}
        </div>
    </div>
</form>
