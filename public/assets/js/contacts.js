function createContactLine(obj){
  if(!jQuery('#trId_'+obj.id).length){
var line = ''+
' <tr id="trId_'+obj.id+'">'+
'   <td class="uk-link-reset cursor-pointer action-contactDetails" contact_id="'+obj.id+'">'+
'       <img class="uk-preserve-width uk-border-circle" src="assets/img/avatar.jpg" width="40" alt=""></td>'+
'   <td class="uk-table-link uk-link-reset cursor-pointer action-contactDetails" contact_id="'+obj.id+'">'+
obj.contact_full_name+'</td>'+
'   <td class="uk-text-justify uk-link-reset cursor-pointer action-contactDetails" contact_id="'+obj.id+'">'+
obj.phone+'</td>'+
'   <td class="uk-text-justify uk-link-reset cursor-pointer action-contactDetails" contact_id="'+obj.id+'">'+
obj.email+'</td>'+
'   <td class="actionsMenu">'+
'     <ul class="uk-nav-default uk-nav-parent-icon uk-nav" uk-nav="">'+
'         <li class="uk-parent">'+
'             <a href="#"><span uk-icon="icon: more; ratio: 1.1" class="uk-icon"></span></a>'+
'           <ul class="uk-nav-sub action_icons" hidden="" aria-hidden="true">'+
'               <li><a class="action-contactMessageList uk-button uk-button-primary uk-button-small color-i-white align-i-left" contact_id="'+obj.id+'">'+
'                   <span uk-icon="list" class="uk-icon"></span> Message list</a>'+
'               </li>'+
'               <li class="uk-nav-divider"></li>'+
'               <li><a class="action-edit uk-button uk-button-primary uk-button-small color-i-white align-i-left cursor-pointer action-contactDetails" contact_id="'+obj.id+'">'+
'                   <span uk-icon="file-edit" class="uk-icon"></span> Edit contact</a>'+
'               </li>'+
'               <li class="uk-nav-divider"></li>'+
'               <li><a class="action-contactDelete uk-button uk-button-danger uk-button-small color-i-white align-i-left" contact_id="'+obj.id+'">'+
'                   <span uk-icon="trash" class="uk-icon"></span> Delete</a>'+
'               </li>'+
'           </ul>'+
'         </li>'+
'     </ul>'+
'     </td>'+
' </tr>';

  jQuery('#tableContactList>tbody').append(line);
  startAction();
  }
}

function deleteContact(id){
  jQuery.ajax({
    url: BASE_URL_API + 'contact/'+ id,
    type: 'DELETE',
    success: function (data) {console.log(data)},
    error: function (ajaxContext) {console.log(ajaxContext)}
  })
  .done(function() {
    UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Message deleted!'});
    jQuery('#trId_'+id).remove();
    UIkit.modal('.uk-modal').hide();
    clearContactFormModal();
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

function clearContactFormModal(){
  jQuery('#messageId').val('');
  jQuery('#messageRecipient').val('');
  jQuery('#messageSubject').val('');
  jQuery('#messageContent').val('');
  jQuery('#messageContentBtnDelete').attr('itemrowid','');
  // CKEDITOR.instances["messageContent"].setData('');
}

function messageFormModal(obj){
  if(obj.length <= 0){
    clearContactFormModal();
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

function loadContacts(){
  jQuery.ajax({
    url: BASE_URL_API + 'contacts',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
      for (i=0;i<data.length; i++){
        obj = data[i];
        createContactLine(obj);
      }
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

  // jQuery('.action-contactDelete[contact_id]').click(function(){
  jQuery('a.action-contactDelete').click(function(){
    var itemId = jQuery(this).attr('contact_id');
    if (! confirm('Delete?')) { 
      return false; 
    }else{    
      deleteContact(itemId);
    }
  });

  // jQuery('.action-editMessage').click(function(){
    // var itemId = jQuery(this).attr('itemrowid');
    // editMessage(itemId);
  // });
// 
  // jQuery('.messageDetails').click(function(){
    // var itemId = jQuery(this).attr('messageId');
    // getMessage(itemId);
  // });
// 
  // jQuery('#messageCancelChanges').click(function(){
    // clearContactFormModal();
  // });

  jQuery('.action-contactDetails').click(function(){
  var itemId = jQuery(this).attr('contact_id');
  getContact(itemId);
  });


  jQuery('.action-contactMessageList').click(function(){
  var itemId = jQuery(this).attr('contact_id');
  console.log('Messages to '+itemId);
  });

  function getContact(id){
    jQuery.ajax({
      url: BASE_URL_API + 'contact/'+ id,
      type: 'GET',
      dataType: 'json',
      success: function (data) {
        clearModalContactDetails();
        fillModalContactDetails(data);
        var phones=data.phones;
        var phonesNum = "";
        for (i=0;i<phones.length; i++){
          phonesNum +=phones[0].number+", ";
        }
        jQuery('#contactDetailPhones').html(phonesNum);      
        UIkit.modal(jQuery('#contact-modal')).show();
      }
      ,error: function (ajaxContext) {
          // console.log(ajaxContext.responseText)
          var errorData = JSON.parse(ajaxContext.responseText);
          UIkit.notification({message: '<span uk-icon=\'icon: check\'></span> Error ! '+errorData.callback_message});
      }
    });
  }

  function clearModalContactDetails(){
    jQuery('#contactDetailName').html('');
    jQuery('#contactDetailEmail').html('');
    jQuery('#contactDetailPhones').html('');
  }

  function fillModalContactDetails(data){  
    jQuery('#contactDetailName').html(data.id);
    jQuery('#contactDetailName').html(data.contact_full_name);
    jQuery('#contactDetailEmail').html(data.email);
  }

}
loadContacts();
startAction();