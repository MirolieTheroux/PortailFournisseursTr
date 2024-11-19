<!-- DO NOT USE DOUBLE QUOTES IN THIS DOCUMENT -->
@foreach ($modificationCategories as $category)
  @if ($modifications->contains('category_id', $category->id))
    <div class='fs-5 fw-bold'>{{$category->category}}</div>
  @endif
  @foreach ($modifications as $modification)
    @if($modification->category_id == $category->id)
      <div>
        @if(!is_null($modification->changed_attribute))
          <div class='fw-bolder'>{{$modification->changed_attribute}}</div>
        @endif
        @if(!is_null($modification->deletion))
          <div class='ms-2 txt-red'>
            - {{$modification->deletion}}
          </div>
        @endif
        @if(!is_null($modification->addition))
          <div class='ms-2 txt-green'>
            + {{$modification->addition}}
          </div>
        @endif
      </div>
    @endif
  @endforeach
@endforeach
