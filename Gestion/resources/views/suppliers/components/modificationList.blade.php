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
        @foreach ($modification->deletions as $deletion)
          <div class='d-flex flex-row ms-2 txt-red'>
            <div class='me-2'>-</div>
            <div>{{$deletion->deletion}}</div>
          </div>
        @endforeach
        @foreach ($modification->additions as $addition)
          <div class='d-flex flex-row ms-2 txt-green'>
            <div class='me-2'>+</div>
            <div>{{$addition->addition}}</div>
          </div>
        @endforeach
      </div>
    @endif
  @endforeach
@endforeach
