<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    {{-- ルート情報にショップIDを渡している。また"enctypeは画像を送信するために必要なおまじない --}}
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />
                    <form method='POST' action="{{ route('owner.images.update', ['image'=>$image->id]) }}"  >
                        @csrf
                        @method('PUT')
                        <div class="-m-2">
                          <div class="p-2 w-1/2 mx-auto">
                            <div class="relative">
                              <label for="title" class="leading-7 text-sm text-gray-600">Image</label>
                              {{-- file[][image] multiple 複数画像のバリデーション--}}
                              <input type="text" id="image" name="title" value="{{ $image->title }}" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-green-500 focus:bg-white focus:ring-2 focus:ring-green-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                            </div>
                          </div>
                          <div class="p-2 w-1/2 mx-auto">
                            <div class="relative">
                              <div class="w-32">
                                <x-thumbnail :filename="$image->filename" type="products"/>
                              </div>
                            </div>
                          </div>
                          <div class="p-2 w-full flex justify-around mt-4" >
                            <button type="button" onclick="location.href='{{ route('owner.images.index') }}' "class="text-white bg-gray-400 border-0 py-2 px-8 focus:outline-none hover:bg-gray-600 rounded text-lg">戻る</button>
                            <button type="submit" class="text-white bg-green-500 border-0 py-2 px-8 focus:outline-none hover:bg-green-600 rounded text-lg">更新する</button>
                          </div>
                        </div>
                      </form>
                      <form id="delete_{{$image->id}}" method="POST" action="{{ route('owner.images.destroy', ['image' => $image->id]) }}">
                        @csrf
                        @method('delete')
                        <div class="md:px-4 py-3">
                            <a href="#" data-id="{{ $image->id }}" onclick="deletePost(this)" class="text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded ">削除する</a>
                        </div>
                      </form>    
                </div>
            </div>
        </div>
    </div>
    <script> 
      function deletePost(e) { 
      'use strict'; 
          if (confirm('本当に削除してもいいですか?')) { 
          document.getElementById('delete_' + e.dataset.id).submit(); 
          } 
      } 
      </script>
</x-app-layout>
