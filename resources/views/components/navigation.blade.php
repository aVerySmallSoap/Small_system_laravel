@php
    use App\Models\Category;
    use Illuminate\Support\Facades\Auth;
    $categories = Category::where('user_id', Auth::user()['id'])->get();
@endphp

<link rel="stylesheet" href="{{asset('/css/components/navigation.css')}}">

<div id="nav" data-collapse="false">
    <div class="nav-container">
        <div id="section-categories">
            <span class="nav-header">Categories</span>
            <div class="groups">
                @foreach($categories as $category)
                    <div class="group-item" onclick="document.location.href = '/category/{{$category['category_id']}}'">
                        <span class="group-title">{{$category['category_name']}}</span>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="nav-actions" onclick="document.location.href = '/add/category'">
            <svg id="actions-icon" xml:space="preserve" viewBox="0 0 24 24">
              <path id="act-svg-1" fill="#f3eac2"
                    d="m19.92 10.43-.91.92-1.42 1.41-5.68 5.68a8.181 8.181 0 0 1-5.2 2.37l-3.03.21a.651.651 0 0 1-.7-.7l.21-3.03a8.181 8.181 0 0 1 2.37-5.2l5.68-5.68L12.66 5l.91-.92a3.35 3.35 0 0 1 4.74 0l1.61 1.61a3.35 3.35 0 0 1 0 4.74z"
                    data-original="#f3eac2"/>
                <path id="act-svg-2" fill="#f5b461"
                      d="m19.92 10.43-.91.92-1.42 1.41-6.35-6.35L12.66 5l.91-.92a3.35 3.35 0 0 1 4.74 0l1.61 1.61a3.35 3.35 0 0 1 0 4.74z"
                      data-original="#f5b461"/>
                <path id="act-svg-3" fill="#9ad3bc" d="m19.01 11.35-1.42 1.41-6.35-6.35L12.66 5z"
                      data-original="#9ad3bc"/>
            </svg>
            <span class="navigation-text">Add a category</span>
        </div>
    </div>
</div>

<script src="{{asset('/js/UI/navigation.js')}}"></script>
