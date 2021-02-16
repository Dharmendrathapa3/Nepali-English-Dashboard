@if(count($child_category)>0)

        @foreach ($child_category as $childCategory)

  
            <option value="{{$childCategory->id}}" @if(@$procat->parent==$childCategory->id) selected @endif > <?php echo str_repeat('&nbsp;', $a) ?> {{ $childCategory->name }}</option>

            @include('Tree.child_category', ['child_category' => $childCategory->childrenCategories,'a'=>$a+4])


        @endforeach
@endif