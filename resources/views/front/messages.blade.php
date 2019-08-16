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
        @php ($trId = "trId_".$it->id)
        <tr id="{{ $trId }}">
          <td class="messageDetails cursor-pointer" messageId="{{ $it->id }}">{{ $it->id }}</td>
          <td class="contactDetails cursor-pointer" contactId="{{ $it->contact->id }}">{{ $it->contact->fname }} {{ $it->contact->lname }}</td>
          <td class="messageDetails cursor-pointer" messageId="{{ $it->id }}">{{ $it->subject }}</td>
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

<div id="modal-message-inputs" uk-modal>
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

<div id="modal-message-details" uk-modal>
  <div class="uk-modal-dialog">

    <button class="uk-modal-close-default" type="button" uk-close></button>

    <div class="uk-modal-header">
      <h3 id="messageDetailSubjectHeader" class="uk-modal-title"></h3>
      <table class="uk-table uk-table-hover uk-table-divider">
        <tbody>
          <tr>
            <th class="uk-width-small">Contact:</th>
            <td id="messageDetailContact"></td>
          </tr>
          <tr>
            <th class="uk-width-small">E-mail:</th>
            <td id="messageDetailEmail"></td>
          </tr>
          <tr>
            <th class="uk-width-small">Subject:</th>
            <td id="messageDetailSubject"></td>
          </tr>
        </tbody>
      </table>
    </div>

    <div class="uk-modal-body" uk-overflow-auto>
      <h6>Message:</h6>
      <hr>   
      <div id="messageDetailMessage">
      </div>

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
                '<td class="actionsMenu">'+ actions +'</td>'+
              '</tr>';
  jQuery('#messageTable').append(line);
  startAction();
}

function deleteMessage(id){
  var ajaxContext;
  jQuery.ajax({
    url: BASE_URL_API + 'message/delete/'+ id,
    type: 'DELETE',
    success: function (data) {ajaxContext=data},
    error: function (ajaxContext) {ajaxContext=ajaxContext}
  })
  .done(function() {
    UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Message deleted!'});
    jQuery('#trId_'+id).remove();
  })
  .fail(function (ajaxContext) {
  // console.log(ajaxContext.responseText)
  var errorData = JSON.parse(ajaxContext.responseText);
  UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Failed to delete! '+errorData.callback_message});
  })
  // .always(function() {
  //   UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Complete!'})
  // });
}

function clearMessageFormModal(){
  jQuery('#messageId').val('');
  jQuery('#messageRecipient').val('');
  jQuery('#messageSubject').val('');
  jQuery('#messageContent').val('');
  CKEDITOR.instances["messageContent"].setData('');
}

function clearMessageDetailModal(){
  jQuery('#messageDetailSubjectHeader').html('');
  jQuery('#messageDetailContact').html('');
  jQuery('#messageDetailSubject').html('');
  jQuery('#messageDetailEmail').html('');
  jQuery('#messageDetailMessage').html('');
}

function messageFormModal(obj){
  if(obj.length <= 0){
    clearMessageFormModal();
    UIkit.modal(jQuery('#modal-message-inputs')).hide();
    UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Fail! No data!'});
  }else{
    jQuery('#messageId').val(obj.id);
    jQuery('#messageRecipient').val(obj.contact_id);
    jQuery('#messageSubject').val(obj.subject);
    CKEDITOR.instances["messageContent"].setData(obj.message);
  }
}


function messageDetailModal(obj){
  if(obj.length <= 0){
    clearMessageDetailModal();
    UIkit.modal(jQuery('#modal-message-details')).hide();
    UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Fail! No data!'});
  }else{
    console.log(obj);
    jQuery('#messageDetailContact').html(obj.contact_full_name);
    jQuery('#messageDetailSubject').html(obj.subject);
    jQuery('#messageDetailSubjectHeader').html(obj.subject);
    jQuery('#messageDetailEmail').html(obj.contact_email);
    jQuery('#messageDetailMessage').html(obj.message);
  }
}

function submitMessage(id){
  jQuery.ajax({
  url: BASE_URL_API + 'message/submit/'+ id,
  type: 'POST'
})
.done(function() {
  UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Message sent!'});
  jQuery('#trId_'+id).remove();
})
.fail(function() {
  UIkit.notification({message: '<span uk-icon=\'icon: ban\'></span> Failed to send message!'})
})
// .always(function() {
  // UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Complete!'})
// });
}

function editMessage(id){
  var ajaxContext;
  jQuery.ajax({
    url: BASE_URL_API + 'message/'+ id,
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      ajaxContext=data;
      messageFormModal(data);
      UIkit.modal(jQuery('#modal-message-inputs')).show();
    }
    ,error: function (ajaxContext) {
        // console.log(ajaxContext.responseText)
        var errorData = JSON.parse(ajaxContext.responseText);
        UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Error ! '+errorData.callback_message});
    }
  });
}

function getMessage(id){
  var ajaxContext;
  jQuery.ajax({
    url: BASE_URL_API + 'message/'+ id,
    type: 'GET',
    success: function (data) {
		ajaxContext=data;
    messageDetailModal(data);
    UIkit.modal(jQuery('#modal-message-details')).show();
	},
    error: function (ajaxContext) {ajaxContext=ajaxContext}
  })
  .done(function() {
    UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Opening message!'});
  })
  .fail(function (ajaxContext) {
  // console.log(ajaxContext.responseText)
  var errorData = JSON.parse(ajaxContext.responseText);
  UIkit.notification({message: '<span uk-icon=\'icon: check\'></span>Fail to get message!' + errorData.callback_message});
  })
  // .always(function() {
  //   UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Complete!'})
  // });
}


// Start the click
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

  jQuery('td.messageDetails').click(function(){
    var itemId = jQuery(this).attr('messageId');
    getMessage(itemId);
  });

  jQuery('#messageCancelChanges').click(function(){
    clearMessageFormModal();
  });
}
startAction();
</script>

</body>
</html>