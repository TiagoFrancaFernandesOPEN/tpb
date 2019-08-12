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
        @php ($trId = "trId_".$it->id)
        <tr id="{{ $trId }}">
          <td>{{ $it->id }}</td>
          <td>{{ $it->contact->fname }} {{ $it->contact->lname }}</td>
          <td>{{ $it->subject }}</td>
          <td>
              <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                <li class="uk-parent">
                    <a href="#"><span uk-icon="icon: more; ratio: 1.1"></span></a>
                    <ul class="uk-nav-sub action_icons">
                        <li><a href="#resubmit" itemRowId="{{ $it->id }}" class="action-resubmit uk-button uk-button-primary uk-button-small color-i-white align-i-left">
                          <span uk-icon="forward"></span> Resubmit</a>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li><a href="#edit" itemRowId="{{ $it->id }}" class="action-edit uk-button uk-button-primary uk-button-small color-i-white align-i-left">
                          <span uk-icon="file-edit"></span> Edit</a>
                        </li>
                        <li class="uk-nav-divider"></li>
                        <li><a href="#delete" itemRowId="{{ $it->id }}" class="action-delete uk-button uk-button-danger uk-button-small color-i-white align-i-left">
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

<a class="uk-button uk-button-default" href="#modal-form" uk-toggle>Open</a>

<div id="modal-form" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Modal Title</h2>
        </div>
        <div class="uk-modal-body">
          <form>
            <fieldset class="uk-fieldset">

                <legend class="uk-legend">Legend</legend>

                <div class="uk-margin">
                    <input class="uk-input" type="text" placeholder="Input">
                </div>

                <div class="uk-margin">
                    <textarea class="uk-textarea" rows="5" placeholder="Textarea"></textarea>
                </div>

            </fieldset>
          </form>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button class="uk-button uk-button-primary" type="button">Save</button>
        </div>
    </div>
</div>


<script>
var BASE_URL_API = 'http://localhost:8000/api';

function deleteMessage(id){
  jQuery.ajax({
    url: BASE_URL_API + '/message/delete/'+ id,
    type: 'DELETE',
    dataType: 'json',
    // success: function (data) {
        // for (var i = 0 ; i < data.length; i++) {
        //     console.log(data[i]);
        // };
    // }
  })
  .done(function() {
    // console.log("success");
    UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Message deleted!'});
    jQuery('#trId_'+id).remove();
  })
  .fail(function() {
    // console.log("error");
    UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Error to delete!'})
  })
  // .always(function() {
  //   UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Complete!'})
  // });
}

function editMessage(id){
  jQuery.ajax({
    url: BASE_URL_API + '/message/'+ id,
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      UIkit.modal(jQuery('#modal-form')).show();
        // for (var i = 0 ; i < data.length; i++) {
        //     console.log(data[i]);
        // };
    }
  })
  .done(function() {
    // console.log("success");
    UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Message edited!'});
    // jQuery('#trId_'+id).remove();
  })
  .fail(function() {
    // console.log("error");
    UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Error to open!'})
  })
  // .always(function() {
  //   UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Complete!'})
  // });
}

// On click
jQuery('a.action-delete').click(function(){
  var itemId = jQuery(this).attr('itemRowId');
  if (! confirm('Delete?')) { 
    return false; 
  }else{    
    deleteMessage(itemId);
  }
});

jQuery('a.action-edit').click(function(){
  var itemId = jQuery(this).attr('itemRowId');
  editMessage(itemId);
});
</script>

</body>
</html>