@include ('includes/top')
<body>

@include ('routes')    

@php ($item = $messages)

    <table class="uk-table uk-table-middle uk-table-divider">
@if(count($item) === 0 )
      <thead>
        <tr>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>You have no messages.</td>
        </tr>
      </tbody>

@else
      <thead>
        <tr>
          <th class="uk-width-small">#</th>
          <th>Contact</th>
          <th>Subject</th>
        </tr>
      </thead>
      <tbody>
  @foreach ($item as $it)
        <tr>
          <td>{{ $it->id }}</td>
          <td>{{ $it->contact->fname }} {{ $it->contact->lname }}</td>
          <td>{{ $it->subject }}</td>
          <td>
            {{-- <button class="uk-button uk-button-default" type="button">Button</button> --}}
            <div class="uk-button-group">
                <button class="uk-button uk-button-default">Dropdown</button>
                <div class="uk-inline">
                    <button class="uk-button uk-button-default" type="button"><span uk-icon="icon:  triangle-down"></span></button>
                    <div uk-dropdown="mode: click; boundary: ! .uk-button-group; boundary-align: true;">
                        <ul class="uk-nav uk-dropdown-nav">
                            <li class="uk-active"><a href="#">Active</a></li>
                            <li><a href="#">Item</a></li>
                            <li class="uk-nav-header">Header</li>
                            <li><a href="#">Item</a></li>
                            <li><a href="#">Item</a></li>
                            <li class="uk-nav-divider"></li>
                            <li><a href="#">Item</a></li>
                        </ul>
                    </div>
                </div>
            </div>
          </td>
        </tr>
    @endforeach
      </tbody>
@endif
    </table>

<script>
var BASE_URL_API = 'http://localhost:8000/api';

function deleteMessage(id){
  jQuery.ajax({
    url: BASE_URL + '/message/delete/'+ id,
    type: 'DELETE',
  })
  .done(function() {
    console.log("success");
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });
}
</script>

</body>
</html>