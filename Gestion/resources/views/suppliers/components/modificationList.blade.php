@foreach ($modificationCategories as $category)
  @if ($modifications->contains('category_id', $category->id))
    <div>{{$category->category}}</div>
  @endif
  @foreach ($modifications as $modification)
    @if($modification->category_id == $category->id)
      <div>
        {{$modification->changed_attribute}} {{$modification->modification_type}} {{$modification->modification}}
      </div>
    @endif
  @endforeach
@endforeach
