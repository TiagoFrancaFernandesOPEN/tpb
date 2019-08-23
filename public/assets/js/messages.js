function createLine(obj){
  var actions = ''+
  '<ul class="uk-nav-default uk-nav-parent-icon" uk-nav>'+
    ' <li class="uk-parent">'+
      ' <a href="#"><span uk-icon="icon: more; ratio: 1.1"></span></a>'+
      ' <ul class="uk-nav-sub action_icons">'+
        ' <li><a href="#submit" itemrowid="' + obj.id + '" class="action-submit uk-button uk-button-primary uk-button-small color-i-white align-i-left">'+
            ' <span uk-icon="forward"></span> submit</a>'+
          ' </li>'+
        ' <li class="uk-nav-divider"></li>'+
        ' <li><a href="#edit" itemrowid="' + obj.id + '" class="action-editMessage uk-button uk-button-primary uk-button-small color-i-white align-i-left">'+
            ' <span uk-icon="file-edit"></span> Edit</a>'+
          ' </li>'+
        ' <li class="uk-nav-divider"></li>'+
        ' <li><a href="#delete" itemrowid="' + obj.id + '" class="action-deleteMessage uk-button uk-button-danger uk-button-small color-i-white align-i-left">'+
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
    UIkit.modal('.uk-modal').hide();
    clearMessageDetailModal();
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
  jQuery('#messageContentBtnDelete').attr('itemrowid','');
  // CKEDITOR.instances["messageContent"].setData('');
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
    jQuery('#messageContent').val(obj.message);
    jQuery('#messageContentBtnDelete').attr('itemrowid',obj.id);
    // CKEDITOR.instances["messageContent"].setData(obj.message);
  }
}


function clearMessageDetailModal(){
  jQuery('#messageDetailSubjectHeader').html('');
  jQuery('#messageDetailContact').html('');
  jQuery('#messageDetailSubject').html('');
  jQuery('#messageDetailEmail').html('');
  jQuery('#messageDetailMessage').html('');
  jQuery('#messageDetailBtnEdit').attr('itemrowid','');
  jQuery('#messageDetailBtnDelete').attr('itemrowid','');
}

function messageDetailModal(obj){
  if(obj.length <= 0){
    clearMessageDetailModal();
    UIkit.modal(jQuery('#modal-message-details')).hide();
    UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Fail! No data!'});
  }else{
    jQuery('#messageDetailContact').html(obj.contact_full_name);
    jQuery('#messageDetailSubject').html(obj.subject);
    jQuery('#messageDetailSubjectHeader').html(obj.subject);
    jQuery('#messageDetailEmail').html(obj.contact_email);
    jQuery('#messageDetailMessage').html(obj.message);
    jQuery('#messageDetailBtnEdit').attr('itemrowid',obj.id);
    jQuery('#messageDetailBtnDelete').attr('itemrowid',obj.id);
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
    // UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Opening message!'});
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

function updateMessage(messageId, obj)
{
  jQuery.ajax({
    type: "PUT",
    url: BASE_URL_API+"message/"+messageId,
    beforeSend: function (request) {
  // 	request.setRequestHeader("apikey", "************************");
    },
    data: JSON.stringify({
      "subject": obj.subject,
      "message": obj.message,
      "contact_id": obj.contact_id
    }),
    dataType: "json",
    contentType: "application/json",
    success: function (data, textStatus, jQxhr) {
      UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Updated successfully!'});
    },
    error: function (jqXhr, textStatus, errorThrown) {
      var errorMessage = (jqXhr.callback_message) ? jqXhr.callback_message : '';
      UIkit.notification({message: '<span uk-icon=\'icon: check\'></span>Fail to get message!' + errorMessage});
      console.log(errorThrown);
    }
  });
}

function submit()
{
  var messageId = jQuery('#messageId').val();
  if(messageId != ''){
    var obj = {
      'contact_id':jQuery('#messageRecipient').val(),
      'subject':jQuery('#messageSubject').val(),
      'message':jQuery('#messageContent').val(),
    }
    updateMessage(messageId, obj);
  }
}

// Start the click
function startAction(){
  jQuery('.action-deleteMessage').click(function(){
    var itemId = jQuery(this).attr('itemrowid');
    if (! confirm('Delete?')) { 
      return false; 
    }else{    
      deleteMessage(itemId);
    }
  });

  jQuery('.action-editMessage').click(function(){
    var itemId = jQuery(this).attr('itemrowid');
    editMessage(itemId);
  });

  jQuery('.messageDetails').click(function(){
    var itemId = jQuery(this).attr('messageId');
    getMessage(itemId);
  });

  jQuery('#messageCancelChanges').click(function(){
    clearMessageFormModal();
  });
}
startAction();