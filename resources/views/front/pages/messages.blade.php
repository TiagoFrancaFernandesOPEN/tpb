@extends('front/layout')

@section('title', 'Messages')

@section('content')

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
      <td class="contactDetails cursor-pointer" contactId="{{ $it->contact->id }}">{{ $it->contact->fname }}
        {{ $it->contact->lname }}</td>
      <td class="messageDetails cursor-pointer" messageId="{{ $it->id }}">{{ $it->subject }}</td>
      <td class="actionsMenu">
        <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
          <li class="uk-parent">
            <a href="#"><span uk-icon="icon: more; ratio: 1.1"></span></a>
            <ul class="uk-nav-sub action_icons">
              <li><a itemrowid="{{ $it->id }}"
                  class="action-submit uk-button uk-button-primary uk-button-small color-i-white align-i-left">
                  <span uk-icon="forward"></span> submit</a>
              </li>
              <li class="uk-nav-divider"></li>
              <li><a itemrowid="{{ $it->id }}"
                  class="action-editMessage uk-button uk-button-primary uk-button-small color-i-white align-i-left">
                  <span uk-icon="file-edit"></span> Edit</a>
              </li>
              <li class="uk-nav-divider"></li>
              <li><a itemrowid="{{ $it->id }}"
                  class="action-deleteMessage uk-button uk-button-danger uk-button-small color-i-white align-i-left">
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
      <form id="formMessageInputs">
        <fieldset class="uk-fieldset">

          <div class="uk-margin">
            <input id="messageId" class="uk-input" type="hidden" placeholder="Message Id">
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
                <span uk-icon="icon: user"></span>
                <span></span>
              </span>
            </div>
          </div>

          <div class="uk-margin">
            <input id="messageSubject" class="uk-input" type="text" placeholder="Subject">
          </div>

          <div class="uk-modal-footer uk-text-right">
            <button onclick="addEditor('messageContent')" class="uk-button uk-button-default uk-button-small" type="button">Visual editor</button>
            <button onclick="removeEditor('messageContent')" class="uk-button uk-button-default uk-button-small" type="button">Simple editor</button>
          </div>

          <div class="uk-margin">
            <textarea id="messageContent" name="messageContent" class="uk-textarea" rows="5" placeholder="Your message here..."></textarea>
          </div>

        </fieldset>
      </form>
    </div>
    <div class="uk-modal-footer uk-text-right">
      <button id="messageContentBtnDelete" class="action-deleteMessage uk-button uk-button-danger" type="button" itemrowid="">Delete</button>
      <button id="messageSaveChanges" class="uk-button uk-button-primary" type="button" onclick="submit()">Save</button>
      <button id="messageCancelChanges" class="uk-button uk-button-default uk-modal-close" type="button">Close</button>
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
      <div id="messageDetailMessage">
      </div>
    </div>

    <div class="uk-modal-footer uk-text-right">
      <button class="action-editMessage uk-button uk-button-primary" type="button" id="messageDetailBtnEdit" itemrowid="">Edit</button>
      <button class="action-deleteMessage uk-button uk-button-danger" type="button" id="messageDetailBtnDelete" itemrowid="">Delete</button>
      <button class="uk-button uk-button-default uk-modal-close" type="button">Close</button>
    </div>

  </div>
</div>
@endsection

@section ('scripts_before_end_body')
<script>
//to messages.js
</script>
<script src="{{ asset('') }}assets/js/messages.js"></script>
@endsection