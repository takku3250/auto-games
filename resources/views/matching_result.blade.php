<x-app-layout>
    
 <div class="container">
     <h1>マッチング結果</h1>
     <div class="row">
         @forelse($matching_array as $post)
          <div class="col-md-6 mb-4">
              <div class="card">
                 <a href="/room/{{$post->pivot->id}}">{{$post->pivot->id}}</a>
              </div>
          </div>
     </div>
     @empty
       <div class="col-md-12">
          <p>マッチング結果がありません。</p>
       </div>
     @endforelse
   </div>
</div>
</x-app-layout>