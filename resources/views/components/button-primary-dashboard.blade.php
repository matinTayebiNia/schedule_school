<button wire:loading.attr="disabled" {{ $targetLoading?"wire:target=$targetLoading":"" }} class="flex-shrink-0 px-4 py-2 text-base
                     font-semibold text-white bg-purple-600 rounded-lg
                      shadow-md hover:bg-purple-700 focus:outline-none
                      focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 disabled:bg-purple-400
                      focus:ring-offset-purple-200" type="submit">
                                <span>
                                {{$textButton??"ثبت"}}
                                </span>
                                {!!  $icon??""!!}
</button>
