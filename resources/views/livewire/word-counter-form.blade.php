<div>
    <div class="w-[800px] mx-w-full bg-white rounded shadow p-5 mb-10">
        <h2 class="block font-bold text-xl mb-5">Simple Word Counter Form</h2>

        <div class="mb-5">
            <label for="urls" class="block text-gray-700 font-medium mb-2">Enter URLS ( One URL per line, and a max URLs of 5 )</label>
            <textarea placeholder="https://google.com" id="urls" wire:model="urls" rows="5" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
            @error('urls')
            <p class="block text-red-600 text-sm">{{$message}}</p>
            @enderror
        </div>


        <div class="text-right">
            <button wire:click="getWordCount" class="gap-5 inline-flex justify-center items-center bg-blue-500 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded focus:outline-none focus:shadow-outline">Get Word Count
                <div wire:loading>
                    <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 38 38" stroke="#fff">
                        <g fill="none" fill-rule="evenodd">
                            <g transform="translate(1 1)" stroke-width="2">
                                <circle stroke-opacity=".5" cx="18" cy="18" r="18"/>
                                <path d="M36 18c0-9.94-8.06-18-18-18">
                                    <animateTransform attributeName="transform" type="rotate" from="0 18 18" to="360 18 18" dur="1s" repeatCount="indefinite"/>
                                </path>
                            </g>
                        </g>
                    </svg>
                </div>
            </button>
        </div>

    </div>

    @if ($wordCounts)
        <div class="w-[800px] mx-w-full bg-white rounded shadow p-5">
            <h2 class="block font-bold text-xl mb-5">Results</h2>
            <div class="flex flex-col mb-5">
                @foreach($wordCounts as $url => $count)
                    <div class="flex gap-5">
                        <div class="w-full overflow-ellipsis whitespace-nowrap overflow-hidden" title="{{$url}}">{{$url}}</div>
                        <div class="w-full text-right font-bold text-sm">
                            @if ($count == 0)
                                No content found, website could be JS driven.
                            @else
                                {{$count}}
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

