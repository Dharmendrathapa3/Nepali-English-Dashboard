<table id="example1" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>{{__('S.N')}}</th>
            <th>{{__('Title')}}</th>
            <th>{{__('Description')}}</th>
            <th>{{__('Position')}}</th>
            <th>{{__('Show On')}}</th>
            <th>{{__('Publish Status')}}</th>
            <th>{{__('Feature Image')}}</th>
            <th>{{__('Parallex Image')}}</th>
            <th>{{__('Action')}}</th>
        </tr>
    </thead>
    <tbody id="datarow">
        @foreach($menu_category as $menu_categories)
        <tr>
            <td>{{ $loop->index+1 }}</td>
            <td>{{$menu_categories->title}}</td>
            <td>{!! $menu_categories->description !!}</td>
            <td>{{$menu_categories->position}}</td>
            <td>{{$menu_categories->show_on}}</td>
            <td>{{$menu_categories->status}}</td>
            <td>
                @if(isset($menu_categories->feature_img))
                <img src="{{ asset( $menu_categories->feature_img ) }}" style="object-fit:scale-down; width: 100px; height:50px;">
                @endif
            </td>

            <td>
                @if(isset($menu_categories->feature_img))
                <img src="{{ asset( $menu_categories->parallex_img ) }}" style="object-fit:scale-down; width: 100px; height:50px;">
                @endif

            </td>

            <td>
                @canany('update-Menu_Categories','delete-Menu_Categories')
                <a href="{{route('catrgories.edit',$menu_categories->id)}}" class="btn btn-primary"> <i class="fas fa-edit"></i> {{__('Edit')}} </a>
                <form id="delete-{{$menu_categories->id}}" action="{{route('catrgories.destroy',$menu_categories->id)}}" method="GET" style="display: none;">
                    @csrf
                </form>
                <a onclick="Delete('{{$menu_categories->id}}');" href="" class="btn btn-danger" style="width: max-content;"> <i class="fa fa-trash"></i> {{__('Delete')}} </a>
                @endcanany
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
        <th>{{__('S.N')}}</th>
            <th>{{__('Title')}}</th>
            <th>{{__('Description')}}</th>
            <th>{{__('Position')}}</th>
            <th>{{__('Show On')}}</th>
            <th>{{__('Publish Status')}}</th>
            <th>{{__('Feature Image')}}</th>
            <th>{{__('Parallex Image')}}</th>
            <th>{{__('Action')}}</th>
        </tr>
    </tfoot>

</table>

{{$menu_category->links()}}