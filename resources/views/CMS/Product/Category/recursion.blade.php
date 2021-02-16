<?php $count = '0' ?>
@foreach($childs as $child)


<?php
$count=$count+2;

$space =  str_repeat("&nbsp;", $count);

?>

<option value="{{$child->id}}" @if(@$procat->parent==$child->id) selected @endif > {{$space}} {{@$child->name}}</option>


@include('CMS.Product.Category.recursion',['childs' => $child->child])




@endforeach