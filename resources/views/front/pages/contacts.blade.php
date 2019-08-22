@extends('front/layout')
@section ('title', 'Contacts')
@section ('content')
<div class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
  <div class="uk-overflow-auto">    
    <table id="tableContactList" class="uk-table uk-table-hover uk-table-middle uk-table-divider">
      <thead>
        <tr>
          <th class="uk-table-shrink"></th>
          <th class="uk-table-expand">Name</th>
          <th class="uk-table-expand">Phone</th>
          <th class="uk-table-expand">E-mail</th>
          <th class="uk-table-expand uk-text-nowrap">
            <a class="" onclick="loadContacts()"  uk-icon="icon: refresh">
              Refresh list
            </a>
          </th>
        </tr>
      </thead>
      <tbody>
        {{-- <tr>
          <td class="uk-link-reset cursor-pointer action-contactDetails" contact_id="1" oldMod>
              <img class="uk-preserve-width uk-border-circle" src="{{ asset('') }}assets/img/avatar.jpg" width="40" alt=""></td>
          <td class="uk-table-link uk-link-reset cursor-pointer action-contactDetails" contact_id="1" oldMod>
              John Doe
          </td>
          <td class="uk-text-justify uk-link-reset cursor-pointer action-contactDetails" contact_id="1" oldMod>
              +55 41 99999-1234</td>
          <td class="uk-text-justify uk-link-reset cursor-pointer action-contactDetails" contact_id="1" oldMod>
              name@site.com</td>
          <td class="actionsMenu">
            <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                <li class="uk-parent">
                    <a href="#"><span uk-icon="icon: more; ratio: 1.1"></span></a>
                <ul class="uk-nav-sub action_icons">
                    <li><a class="action-contactMessageList uk-button uk-button-primary uk-button-small color-i-white align-i-left" contact_id="1">
                        <span uk-icon="list"></span> Message list</a>
                    </li>
                    <li class="uk-nav-divider"></li>
                    <li><a class="action-edit uk-button uk-button-primary uk-button-small color-i-white align-i-left cursor-pointer action-contactDetails" contact_id="1" oldMod>
                        <span uk-icon="file-edit"></span> Edit contact</a>
                    </li>
                    <li class="uk-nav-divider"></li>
                    <li><a class="action-contactDelete uk-button uk-button-danger uk-button-small color-i-white align-i-left" contact_id="1">
                        <span uk-icon="trash"></span> Delete</a>
                    </li>
                </ul>
            </li>
            </ul>
            </td>
        </tr> --}}
      </tbody>
    </table>
  </div>
</div>
<div class="newContact">
  {{-- <a href="javascript:void(0)" _uk-tooltip="New contact"><span uk-icon="plus-circle"></span></a> --}}
  <div class="uk-inline">
    <button id="addRecordDrop" class="uk-button uk-button-default" type="button">+</button>
    <div uk-drop="pos: top-right; mode: click">
      <div class="uk-card uk-card-body uk-card-default" id="addRecordDropItens">
        <ul class="uk-nav uk-dropdown-nav">
          <li class="uk-margin-small">
            <a href="#" class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom uk-button-small addRecordButton"><span uk-icon="user">+</span> Create new contact</a></li>
          <li class="uk-margin-small">
            <a href="#" class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom uk-button-small addRecordButton"><span uk-icon="receiver">+</span> Add to a contact</a></li>
          <li class="uk-margin-small">
            <a href="#" class="uk-button uk-button-primary uk-width-1-1 uk-margin-small-bottom uk-button-small addRecordButton"><span uk-icon="mail">+</span> Add new message</a></li>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="toTop">
  <a href="#" uk-totop uk-scroll></a>
</div>

<a class="uk-button uk-button-default" href="#modal_form" uk-toggle>Add/Edit</a>
<a class="uk-button uk-button-default" href="#modal_details" uk-toggle>Details</a>

<div id="modal_form" class="uk-modal-container" uk-modal>
  <div class="uk-modal-dialog uk-modal-body" uk-overflow-auto>
    <button class="uk-modal-close-default" type="button" uk-close></button>
    <div class="uk-modal-header">
      <h2 class="uk-modal-title">Modal Title</h2>
    </div>
    <form class="uk-form-horizontal uk-margin-large">

      <div class="uk-margin">
        <label class="uk-form-label" for="form-horizontal-text">Text</label>
        <div class="uk-form-controls">
          <input class="uk-input" id="form-horizontal-text" type="text" placeholder="Some text...">
        </div>
      </div>

      <div class="uk-margin">
        <div class="uk-form-label">Apps</div>
        <div class="uk-margin uk-grid-small uk-child-width-auto uk-grid">
          <label><input class="uk-checkbox" type="checkbox" checked> A</label>
          <label><input class="uk-checkbox" type="checkbox"> B</label>
        </div>
      </div>

    </form>

    <div class="uk-modal-footer uk-text-right">
      <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
      <button class="uk-button uk-button-primary" type="button">Save</button>
    </div>
  </div>
</div>

<div id="modal_details" class="uk-modal-container" uk-modal>
  <div class="uk-modal-dialog uk-modal-body" uk-overflow-auto>
    <button class="uk-modal-close-default" type="button" uk-close></button>
    <div class="uk-modal-header">
      <h2 class="uk-modal-title">Modal Details</h2>
    </div>

    <table class="uk-table uk-table-divider">
      <thead>
        <tr>
          <th class="uk-width-small"></th>
          <th class="uk-table-expand"></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Table Data</td>
          <td>Table Data</td>
        </tr>
        <tr>
          <td>Table Data</td>
          <td>Table Data</td>
        </tr>
      </tbody>
    </table>

    <div class="uk-modal-footer uk-text-right">
      <button class="uk-button uk-button-danger action-contactDelete" type="button">Delete</button>
      <button class="uk-button uk-button-primary" type="button">Edit</button>
      <button class="uk-button uk-button-muted uk-modal-close" type="button">Close</button>
    </div>
  </div>
</div>
@endsection

@section('scripts_before_end_body')

@php ($modalBody = '
<table class="uk-table uk-table-divider">
  <tbody>
    <tr>
      <th>Name</th>
      <td id="contactDetailName">Nome Fugd</td>
    </tr>
    <tr>
      <th>E-mail</th>
      <td id="contactDetailEmail">nome@site.com</td>
    </tr>
    <tr>
      <th>Phones</th>
      <td id="contactDetailPhones">41 98779-6545</td>
    </tr>
  </tbody>
</table>

<span id="phoneNumberModal"></span>')

@component ('front/component/modal', [
  'id'=>'contact-modal','header'=>'Contact Details','body'=>$modalBody,
  'buttons'=>
    [
      ['text'=>'New message'],
      ['text'=>'Edit','classColor'=>'primary'],
      ['text'=>'Delete','class'=>'action-contactDelete','type'=>'button',
      'classColor'=>'danger', 'attrName'=>'itemrowid']
    ]
  ])
@endcomponent

<script>
 

</script>
<script src="{{ asset('') }}assets/js/contacts.js"></script>
@endsection