
<div class="py-4">
    <ul role="list" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach(json_decode($getState(), true) as $index => $anchor)
            <li class="overflow-hidden rounded-xl border border-gray-200">
                <div class="flex items-center gap-x-4 border-b border-gray-900/5 p-4">
                    <div class="text-sm/6 font-medium text-gray-900">Backlink {{ $index + 1 }}</div>
                    <div class="relative ml-auto">
                    </div>
                </div>
                <dl class="-my-3 divide-y divide-gray-100 px-6 py-2 text-sm/6">
                    <div class="flex justify-between gap-x-4 py-2">
                        <dt class="text-gray-500">{{ $anchor['text'] }}</dt>
                    </div>
                    <div class="flex justify-between gap-x-4 py-2">
                        <dt class="text-gray-500">{{ $anchor['url'] }}</dt>
                    </div>
                </dl>
            </li>
        @endforeach
    </ul>
</div>
