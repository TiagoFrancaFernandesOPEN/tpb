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

.cursor-pointer { cursor: pointer;}
td.actionsMenu { text-align: center;}
td.actionsMenu:hover {background: #1e87f029;}
li.uk-open>a>span>svg {display: none;}
</style>

@php ($item = $messages)

    <table id="messageTable" class="uk-table uk-table-middle uk-table-divider uk-table-hover">
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
        <tr id="{{ $trId }}"class="cursor-pointer">
          <td>{{ $it->id }}</td>
          <td>{{ $it->contact->fname }} {{ $it->contact->lname }}</td>
          <td>{{ $it->subject }}</td>
          <td class="actionsMenu">
            <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                <li class="uk-parent">
                  <a href="#"><span uk-icon="icon: more; ratio: 1.1"></span></a>
                  <ul class="uk-nav-sub action_icons">
                      <li><a href="#submit" itemRowId="{{ $it->id }}" class="action-submit uk-button uk-button-primary uk-button-small color-i-white align-i-left">
                        <span uk-icon="forward"></span> submit</a>
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

<div id="modal-form" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title" id="titleModal">Message Edit</h2>
        </div>
        <div class="uk-modal-body">
          <form>
            <fieldset class="uk-fieldset">
              
                <div class="uk-margin">
                    <input id="messageId" class="uk-input" type="text" placeholder="Message Id">
                </div>

                <div class="uk-margin">
                  <div uk-form-custom="target: > * > span:last-child"> To: 
                    <select id="messageRecipient" class="uk-input">
                      <option value="">Select a Contact</option>
                      @foreach ($contacts as $c)                        
                        <option value="{{ $c->id }}">{{ $c->fname }} {{ $c->lname }} | {{ $c->email }}</option>
                      @endforeach
                    </select>
                    <span class="uk-link">
                      <span uk-icon="icon: pencil"></span>
                      <span></span>
                    </span>
                  </div>
                </div>

                <div class="uk-margin">
                    <input id="messageSubject" class="uk-input" type="text" placeholder="Subject">
                </div>

                <div class="uk-margin">
                    <textarea class="uk-textarea" name="messageContent" rows="5" placeholder="Your message here..."></textarea>
                    <script>
                            CKEDITOR.replace( 'messageContent' );
                    </script>
                </div>

            </fieldset>
          </form>
        </div>
        <div class="uk-modal-footer uk-text-right">
            <button id="messageCancelChanges" class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <button id="messageSaveChanges" class="uk-button uk-button-primary" type="button">Save</button>
        </div>
    </div>
</div>

<div id="modal-overflow" uk-modal>
  <div class="uk-modal-dialog">

    <button class="uk-modal-close-default" type="button" uk-close></button>

    <div class="uk-modal-header">
      <h2 class="uk-modal-title">Message to Contact </h2>
    </div>

    <div class="uk-modal-body" uk-overflow-auto>
      
      <table class="uk-table uk-table-hover uk-table-divider">
        <tbody>
          <tr>
            <th class="uk-width-small">Contact:</th>
            <td>Contact</td>
          </tr>
          <tr>
            <th class="uk-width-small">E-mail:</th>
            <td>email@email.com</td>
          </tr>
          <tr>
            <th class="uk-width-small">Date:</th>
            <td>Mes dd/mm/yyyy </td>
          </tr>
        </tbody>
      </table>
      <hr>

      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
        magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
        consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
        pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est
        laborum.</p>

    </div>

    <div class="uk-modal-footer uk-text-right">
      <button class="uk-button uk-button-primary" type="button">Edit</button>
      <button class="uk-button uk-button-default uk-modal-close" type="button">Close</button>
    </div>

  </div>
</div>


<script>
// var BASE_URL_API = 'http://localhost:8000/api';
var BASE_URL_API = '{{ env('API_URL') }}';

function createLine(obj){
  var actions = ''+
  '<ul class="uk-nav-default uk-nav-parent-icon" uk-nav>'+
    ' <li class="uk-parent">'+
      ' <a href="#"><span uk-icon="icon: more; ratio: 1.1"></span></a>'+
      ' <ul class="uk-nav-sub action_icons">'+
        ' <li><a href="#submit" itemRowId="' + obj.id + '" class="action-submit uk-button uk-button-primary uk-button-small color-i-white align-i-left">'+
            ' <span uk-icon="forward"></span> submit</a>'+
          ' </li>'+
        ' <li class="uk-nav-divider"></li>'+
        ' <li><a href="#edit" itemRowId="' + obj.id + '" class="action-edit uk-button uk-button-primary uk-button-small color-i-white align-i-left">'+
            ' <span uk-icon="file-edit"></span> Edit</a>'+
          ' </li>'+
        ' <li class="uk-nav-divider"></li>'+
        ' <li><a href="#delete" itemRowId="' + obj.id + '" class="action-delete uk-button uk-button-danger uk-button-small color-i-white align-i-left">'+
            ' <span uk-icon="trash"></span> Delete</a>'+
          ' </li>'+
        ' </ul>'+
      ' </li>'+
    '</ul>';

  var line = '<tr id="trId_'+obj.id+'">'+
                '<td>'+obj.id+'</td>'+
                '<td> '+obj.fname+' '+obj.lname+'</td>'+
                '<td class="cursor-pointer"> '+obj.subject+'</td>'+
                '<td>'+ actions +'</td>'+
              '</tr>';
  jQuery('#messageTable').append(line);
  startAction();
}

function deleteMessage(id){
  jQuery.ajax({
    url: BASE_URL_API + '/message/delete/'+ id,
    type: 'DELETE'
  })
  .done(function() {
    // console.log("success");
    UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Message deleted!'});
    jQuery('#trId_'+id).remove();
  })
  .fail(function() {
    // console.log("error");
    UIkit.notification({message: '<span uk-icon=\'icon: ban\'></span> Error to delete!'})
  })
  // .always(function() {
  //   UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Complete!'})
  // });
}

function clearFormModalInputs(obj){
  jQuery('#messageId').val('');
  jQuery('#messageRecipient').val('');
  jQuery('#messageSubject').val('');
  jQuery('#messageContent').val('');
  CKEDITOR.instances["messageContent"].setData('');
}
function formModalInputs(obj){
  if(obj.length <= 0){
    clearFormModalInputs();
  // }else if(){
  }else{
    jQuery('#messageId').val(obj.id);
    jQuery('#messageRecipient').val(obj.contact_id);
    jQuery('#messageSubject').val(obj.subject);
    jQuery('#messageContent').html(obj.message);
    CKEDITOR.instances["messageContent"].setData(obj.message);
  }
}

function submitMessage(id){
  jQuery.ajax({
  url: BASE_URL_API + '/message/submit/'+ id,
  type: 'POST'
})
.done(function() {
  // console.log("success");
  UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Message sent!'});
  jQuery('#trId_'+id).remove();
})
.fail(function() {
  // console.log("error");
  UIkit.notification({message: '<span uk-icon=\'icon: ban\'></span> failed to send message!'})
})
// .always(function() {
  // UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Complete!'})
// });
}

function editMessage(id){
  jQuery.ajax({
    url: BASE_URL_API + '/message/'+ id,
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      console.log(data);
      formModalInputs(data);
      UIkit.modal(jQuery('#modal-form')).show();
        // for (var i = 0 ; i < data.length; i++) {
        //     console.log(data[i]);
        // };
    }
    ,error: function (ajaxContext) {
        // console.log(ajaxContext.responseText)
        var errorData = JSON.parse(ajaxContext.responseText);
        UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Error ! '+errorData.callback_message})
    }
  });
}

// On click
function startAction(){
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

  jQuery('#messageCancelChanges').click(function(){
    clearFormModalInputs();
  });
}
startAction();
</script>

</body>
</html>