<div class="space-y-1.5 py-1.5">
    <div class="space-y-1.5" x-show="open">
        <div class="flex space-x-1 items-center">
            <div class="flex items-center rounded-md ring-1 ring-inset ring-stone-700/10 font-medium text-xs text-gray-700 shadow-inner px-1.5 py-0.5 bg-stone-100">
                <p>{{$website->backlinks}}
                    <span class="text-gray-600 font-medium text-xs">
                        Backlinks
                    </span>
                </p>
            </div>
            <div class="flex space-x-0.75 items-center">
                <div class="flex items-center space-x-0.5 uppercase font-medium leading-tight text-gray-500"
                     style="font-size: 0.7rem; line-height: 0.95rem">
                    <span>|</span>
                    <p>IP: {{$website->ip_address ?: 'No IP found'}}</p>
                    @if(empty($website->ip_address))
                        <svg wire:click="findIPAddress('{{$website->domain_name}}')"
                             xmlns="http://www.w3.org/2000/svg"
                             fill="none" viewBox="0 0 24 24"
                             stroke-width="2" stroke="currentColor"
                             class="w-3.5 h-3.5 cursor-pointer hover:text-gray-700 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99"/>
                        </svg>
                    @endif
                </div>
            </div>
        </div>
        <div class="flex space-x-1 items-center">
                <p class="inline-flex items-center rounded-md bg-yellow-50 px-1.5 py-0.5 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20">
                    {{ ucwords($website->website_type) }}
                </p>
            <p class="inline-flex items-center rounded-md bg-purple-50 px-1.5 py-0.5 text-xs font-medium text-purple-700 ring-1 ring-inset ring-purple-700/10">
                Min. {{ $website->minimal_words }} words
            </p>
            <p class="inline-flex items-center rounded-md bg-indigo-50 px-1.5 py-0.5 text-xs font-medium text-indigo-700 ring-1 ring-inset ring-indigo-700/10">
                Written by {{ $website->write_content }}
            </p>
        </div>
        <div class="flex space-x-1 items-center">
                <div
                    class="inline-flex items-center gap-x-1.5 rounded-md bg-orange-100 px-2 py-0.5 text-xs border border-orange-300/75 font-semibold text-orange-800">
                    <svg class="h-1.5 w-1.5 fill-orange-500" viewBox="0 0 6 6" aria-hidden="true">
                        <circle cx="3" cy="3" r="3"/>
                    </svg>
                    {{$website->websiteZone->name ?? 'No Zone'}}
                </div>
            @if($website->follow)
                <p class="inline-flex items-center rounded-md bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                    DoFollow
                </p>
            @else
                <p class="inline-flex items-center rounded-md bg-red-50 px-1.5 py-0.5 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">
                    NoFollow
                </p>
            @endif
            @if($website->sponsored_tag)
                <p class="inline-flex items-center rounded-md bg-green-50 px-1.5 py-0.5 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">
                    Sponsored
                </p>
            @else
                <p class="inline-flex items-center rounded-md bg-red-50 px-1.5 py-0.5 text-xs font-medium text-red-700 ring-1 ring-inset ring-red-600/10">
                    Not Sponsored
                </p>
            @endif
                <p class="inline-flex items-center rounded-md bg-blue-50 px-1.5 py-0.5 text-xs font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10">
                    {{ $website->blog_duration }}
                </p>
        </div>
{{--        @if(Auth::user()->isDigitalNewsgroup())--}}
{{--            <div class="flex items-center space-x-1.5">--}}
{{--                @if($website->supplier_id)--}}
{{--                    <a href='mailto:{{$website->supplier->company_email}}'--}}
{{--                       class="inline-flex items-center rounded-md bg-gray-100 shadow-inner underline underline-offset-1 px-1.5 py-0.5 text-xs font-semibold text-gray-600 ring-1 ring-inset ring-gray-500/10">--}}
{{--                        {{$website->supplier->company_email ?? null}}--}}
{{--                    </a>--}}
{{--                @endif--}}
{{--                <div>--}}
{{--                    <div class="flex items-center space-x-1">--}}
{{--                        <input wire:model.lazy="sampleURLInput.{{$website->id}}"--}}
{{--                               wire:key="sample-url-input-{{$website->id}}"--}}
{{--                               class="w-36 bg-blue-100 @if($website->sample_url) border-emerald-500/75 @else border-gray-300/75 @endif rounded h-5 text-xs font-medium shadow-sm"--}}
{{--                               placeholder="{{$website->sample_url ?? 'Add Sample URL'}}"--}}
{{--                               type="text">--}}
{{--                        @if($website->sample_url)--}}
{{--                            <a class="group" target="_blank"--}}
{{--                               href="{{$website->sample_url}}">--}}
{{--                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                                     viewBox="0 0 24 24" stroke-width="2"--}}
{{--                                     stroke="currentColor"--}}
{{--                                     class="w-5 h-5 mb-1 text-gray-600 group-hover:text-red-700">--}}
{{--                                    <path stroke-linecap="round"--}}
{{--                                          stroke-linejoin="round"--}}
{{--                                          d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25"/>--}}
{{--                                </svg>--}}
{{--                            </a>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--        <div>--}}
{{--            @if($website->categories->count() > 0)--}}
{{--                <p class="hover:max-w-max max-w-xs hover:shadow-lg shadow-inner inline-flex items-center truncate rounded-md bg-purple-100 px-1.5 py-0.5 text-xs cursor-pointer font-medium text-purple-700 ring-1 ring-inset ring-purple-700/10">--}}
{{--                    {{--}}
{{--                        collect($website->categories->take(5))--}}
{{--                            ->map(function (Category $category) {--}}
{{--                                return __('general/categories.' . $category->translation_key);--}}
{{--                            })--}}
{{--                            ->implode(', ')--}}
{{--                    }}--}}
{{--                </p>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--        <div>--}}
{{--            @if($website->labels->count() > 0)--}}
{{--                <p class="inline-flex group items-center shadow-inner ring-1 ring-inset ring-stone-700/10 rounded px-1.5 py-0.5 text-xs font-medium bg-stone-100 text-stone-700">--}}
{{--                    {{collect($website->labels->pluck('name'))->implode(', ')}}--}}
{{--                </p>--}}
{{--            @endif--}}
{{--        </div>--}}
    </div>
</div>
