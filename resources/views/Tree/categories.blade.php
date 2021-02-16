<!-- <ul>
    @foreach ($categories as $category)
        <li>{{ $category->name }}</li>
        <ul>
        @foreach ($category->childrenCategories as $childCategory)
            @include('Tree.child_category', ['child_category' => $childCategory])
        @endforeach
        </ul>
    @endforeach
</ul> -->


<!-- In child_category blade -->


<!-- 
<li>{{ $child_category->name }}</li>
@if ($child_category->categories)
    <ul>
        @foreach ($child_category->categories as $childCategory)
            @include('Tree.child_category', ['child_category' => $childCategory])
        @endforeach
    </ul>
@endif -->


<!-- <option value="{{$childCategory->id}}" @if(@$procat->parent==$childCategory->id) selected @endif > <?php echo str_repeat('&nbsp;', 2) ?> {{@$childCategory->name}}</option> -->
