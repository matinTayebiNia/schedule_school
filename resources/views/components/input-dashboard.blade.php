<input id="{{$name}}" type="{{$type??"text"}}"
       class="    rounded-lg  flex-1
                                                   appearance-none border
                                                   w-full md:w-1/2 py-2 px-4 bg-white
                                                    text-gray-700 placeholder-gray-400
                                                    shadow-sm text-base focus:outline-none
                                                    focus:ring-2 focus:ring-purple-600
                                                    focus:border-transparent {{$class??""}}
           "
       value="{{old($name,($value??""))}}" name="{{$name}}" {{$livewireModel?"wire:model=$livewireModel":""}}
       placeholder="{{$placeholder}}">
