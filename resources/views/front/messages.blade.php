@include ('includes/top')
<body>

@include ('routes')    

<style>
/* COLOR IMPORTANT */
.color-i-white{ color: white !important; }
.color-i-blue{ color: blue !important; }
.color-i-yellow{ color: yellow !important; }
.color-i-green{ color: green !important; }

/* ALIGN IMPORTANT */
.align-i-left{ text-align: left !important; }
.align-i-right{ text-align: right !important; }
.align-i-center{ text-align: center !important; }
.align-i-justify{ text-align: justify !important; }
.align-i-end{ text-align: end !important; }

ul.uk-nav-sub.action_icons { width: max-content;}
</style>

@php ($item = $messages)

    <table class="uk-table uk-table-middle uk-table-divider uk-table-hover">
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
          <th class="uk-width-small"></th>
        </tr>
      </thead>
      <tbody>
  @foreach ($item as $it)
        <tr>
          <td>{{ $it->id }}</td>
          <td>{{ $it->contact->fname }} {{ $it->contact->lname }}</td>
          <td>{{ $it->subject }}</td>
          <td>
              <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                <li class="uk-parent">
                    <a href="#"><span uk-icon="icon: more; ratio: 1.5"></span></a>
                    <ul class="uk-nav-sub action_icons">
                        <li><a href="#resubmit" class="uk-button uk-button-primary uk-button-small color-i-white align-i-left">
                          <span uk-icon="forward"></span> Resubmit</a>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li><a href="#edit" class="uk-button uk-button-primary uk-button-small color-i-white align-i-left">
                          <span uk-icon="file-edit"></span> Edit</a>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li><a href="#delete" class="uk-button uk-button-danger uk-button-small color-i-white align-i-left">
                          <span uk-icon="trash"></span> Delete</a>
                        </li>
                    </ul>
                </li>
              </ul>            
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