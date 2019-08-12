@php ($uikit="assets/uikit")
@php ($sitename="TPB - Tiago's Phone Book")
<!DOCTYPE html>
<html>

<head>
    <title>{{ $sitename }}'</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/style.css" />
    <link rel="stylesheet" href="{{ $uikit }}/css/uikit.min.css" />
    <script src="{{ $uikit }}/js/uikit.min.js"></script>
    <script src="assets/js/jquery-3.4.1.min.js"></script>
    {{-- <script src="{{ $uikit }}/js/uikit-icons.min.js"></script> --}}
    <link rel="stylesheet" href="assets/mobiriseicons/mobirise/style.css">
    
    {{-- REMOVER --}}
    <script type="text/javascript" src="http://livejs.com/live.js"></script>
    {{-- REMOVER --}}

</head>

<body>
    <div  class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
        <nav class="uk-navbar-container uk-margin" uk-navbar>
            <div class="uk-navbar-left">
        
                <a class="uk-navbar-item uk-logo" href="#">TPB</a>
        
                <ul class="uk-navbar-nav">
                    <li>
                        <a href="#">
                            <span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
                            Features
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <span class="uk-icon uk-margin-small-right" uk-icon="icon: star"></span>
                            Features
                        </a>
                    </li>
                </ul>
        
                <div class="uk-navbar-item">
                    <form action="javascript:void(0)">
                        <input class="uk-input uk-form-width-small" type="text" placeholder="Name, phone">
                        <button class="uk-button uk-button-default">Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </div>
    <div  class="uk-container uk-container-center uk-margin-top uk-margin-large-bottom">
        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-hover uk-table-middle uk-table-divider">
                <thead>
                    <tr>
                        <th class="uk-table-shrink"></th>
                        <th class="uk-table-expand">Name</th>
                        <th class="uk-table-expand">Phone</th>
                        <th class="uk-table-expand">E-mail</th>
                        <th class="uk-table-shrink uk-text-nowrap"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><img class="uk-preserve-width uk-border-circle" src="assets/img/avatar.jpg" width="40" alt=""></td>
                        <td class="uk-table-link">
                            <a class="uk-link-reset" href="#">John Doe</a>
                        </td>
                        <td class="uk-text-justify"><a class="uk-link-reset" href="#">+55 41 99999-1234</a></td>
                        <td class="uk-text-justify">name@site.com</td>
                        <td class="uk-text-nowrap">
                            <a href="#" class="uk-icon-link uk-margin-small-right uk-text-primary actionIcon" uk-tooltip="Edit contact"><span class="mbri-edit"></span></a>
                            <a href="#" class="uk-icon-link uk-text-danger actionIcon" uk-tooltip="Delete contact"><span class="mbri-trash"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><img class="uk-preserve-width uk-border-circle" src="assets/img/avatar.jpg" width="40" alt=""></td>
                        <td class="uk-table-link">
                            <a class="uk-link-reset" href="#">John Doe</a>
                        </td>
                        <td class="uk-text-justify"><a class="uk-link-reset" href="#">+55 41 99999-1234</a></td>
                        <td class="uk-text-justify">name@site.com</td>
                        <td class="uk-text-nowrap">
                            <a href="#" class="uk-icon-link uk-margin-small-right uk-text-primary actionIcon" uk-tooltip="Edit contact"><span class="mbri-edit"></span></a>
                            <a href="#" class="uk-icon-link uk-text-danger actionIcon" uk-tooltip="Delete contact"><span class="mbri-trash"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><img class="uk-preserve-width uk-border-circle" src="assets/img/avatar.jpg" width="40" alt=""></td>
                        <td class="uk-table-link">
                            <a class="uk-link-reset" href="#">John Doe</a>
                        </td>
                        <td class="uk-text-justify"><a class="uk-link-reset" href="#">+55 41 99999-1234</a></td>
                        <td class="uk-text-justify">name@site.com</td>
                        <td class="uk-text-nowrap">
                            <a href="#" class="uk-icon-link uk-margin-small-right uk-text-primary actionIcon" uk-tooltip="Edit contact"><span class="mbri-edit"></span></a>
                            <a href="#" class="uk-icon-link uk-text-danger actionIcon" uk-tooltip="Delete contact"><span class="mbri-trash"></span></a>
                        </td>
                    </tr>
                    
                    
                    
                    
                    <tr>
                        <td><img class="uk-preserve-width uk-border-circle" src="assets/img/avatar.jpg" width="40" alt=""></td>
                        <td class="uk-table-link">
                            <a class="uk-link-reset" href="#">John Doe</a>
                        </td>
                        <td class="uk-text-justify"><a class="uk-link-reset" href="#">+55 41 99999-1234</a></td>
                        <td class="uk-text-justify">name@site.com</td>
                        <td class="uk-text-nowrap">
                            <a href="#" class="uk-icon-link uk-margin-small-right uk-text-primary actionIcon" uk-tooltip="Edit contact"><span class="mbri-edit"></span></a>
                            <a href="#" class="uk-icon-link uk-text-danger actionIcon" uk-tooltip="Delete contact"><span class="mbri-trash"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><img class="uk-preserve-width uk-border-circle" src="assets/img/avatar.jpg" width="40" alt=""></td>
                        <td class="uk-table-link">
                            <a class="uk-link-reset" href="#">John Doe</a>
                        </td>
                        <td class="uk-text-justify"><a class="uk-link-reset" href="#">+55 41 99999-1234</a></td>
                        <td class="uk-text-justify">name@site.com</td>
                        <td class="uk-text-nowrap">
                            <a href="#" class="uk-icon-link uk-margin-small-right uk-text-primary actionIcon" uk-tooltip="Edit contact"><span class="mbri-edit"></span></a>
                            <a href="#" class="uk-icon-link uk-text-danger actionIcon" uk-tooltip="Delete contact"><span class="mbri-trash"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><img class="uk-preserve-width uk-border-circle" src="assets/img/avatar.jpg" width="40" alt=""></td>
                        <td class="uk-table-link">
                            <a class="uk-link-reset" href="#">John Doe</a>
                        </td>
                        <td class="uk-text-justify"><a class="uk-link-reset" href="#">+55 41 99999-1234</a></td>
                        <td class="uk-text-justify">name@site.com</td>
                        <td class="uk-text-nowrap">
                            <a href="#" class="uk-icon-link uk-margin-small-right uk-text-primary actionIcon" uk-tooltip="Edit contact"><span class="mbri-edit"></span></a>
                            <a href="#" class="uk-icon-link uk-text-danger actionIcon" uk-tooltip="Delete contact"><span class="mbri-trash"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><img class="uk-preserve-width uk-border-circle" src="assets/img/avatar.jpg" width="40" alt=""></td>
                        <td class="uk-table-link">
                            <a class="uk-link-reset" href="#">John Doe</a>
                        </td>
                        <td class="uk-text-justify"><a class="uk-link-reset" href="#">+55 41 99999-1234</a></td>
                        <td class="uk-text-justify">name@site.com</td>
                        <td class="uk-text-nowrap">
                            <a href="#" class="uk-icon-link uk-margin-small-right uk-text-primary actionIcon" uk-tooltip="Edit contact"><span class="mbri-edit"></span></a>
                            <a href="#" class="uk-icon-link uk-text-danger actionIcon" uk-tooltip="Delete contact"><span class="mbri-trash"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><img class="uk-preserve-width uk-border-circle" src="assets/img/avatar.jpg" width="40" alt=""></td>
                        <td class="uk-table-link">
                            <a class="uk-link-reset" href="#">John Doe</a>
                        </td>
                        <td class="uk-text-justify"><a class="uk-link-reset" href="#">+55 41 99999-1234</a></td>
                        <td class="uk-text-justify">name@site.com</td>
                        <td class="uk-text-nowrap">
                            <a href="#" class="uk-icon-link uk-margin-small-right uk-text-primary actionIcon" uk-tooltip="Edit contact"><span class="mbri-edit"></span></a>
                            <a href="#" class="uk-icon-link uk-text-danger actionIcon" uk-tooltip="Delete contact"><span class="mbri-trash"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><img class="uk-preserve-width uk-border-circle" src="assets/img/avatar.jpg" width="40" alt=""></td>
                        <td class="uk-table-link">
                            <a class="uk-link-reset" href="#">John Doe</a>
                        </td>
                        <td class="uk-text-justify"><a class="uk-link-reset" href="#">+55 41 99999-1234</a></td>
                        <td class="uk-text-justify">name@site.com</td>
                        <td class="uk-text-nowrap">
                            <a href="#" class="uk-icon-link uk-margin-small-right uk-text-primary actionIcon" uk-tooltip="Edit contact"><span class="mbri-edit"></span></a>
                            <a href="#" class="uk-icon-link uk-text-danger actionIcon" uk-tooltip="Delete contact"><span class="mbri-trash"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><img class="uk-preserve-width uk-border-circle" src="assets/img/avatar.jpg" width="40" alt=""></td>
                        <td class="uk-table-link">
                            <a class="uk-link-reset" href="#">John Doe</a>
                        </td>
                        <td class="uk-text-justify"><a class="uk-link-reset" href="#">+55 41 99999-1234</a></td>
                        <td class="uk-text-justify">name@site.com</td>
                        <td class="uk-text-nowrap">
                            <a href="#" class="uk-icon-link uk-margin-small-right uk-text-primary actionIcon" uk-tooltip="Edit contact"><span class="mbri-edit"></span></a>
                            <a href="#" class="uk-icon-link uk-text-danger actionIcon" uk-tooltip="Delete contact"><span class="mbri-trash"></span></a>
                        </td>
                    </tr>
                    <tr>
                        <td><img class="uk-preserve-width uk-border-circle" src="assets/img/avatar.jpg" width="40" alt=""></td>
                        <td class="uk-table-link">
                            <a class="uk-link-reset" href="#">John Doe</a>
                        </td>
                        <td class="uk-text-justify"><a class="uk-link-reset" href="#">+55 41 99999-1234</a></td>
                        <td class="uk-text-justify">name@site.com</td>
                        <td class="uk-text-nowrap">
                            <a href="#" class="uk-icon-link uk-margin-small-right uk-text-primary actionIcon" uk-tooltip="Edit contact"><span class="mbri-edit"></span></a>
                            <a href="#" class="uk-icon-link uk-text-danger actionIcon" uk-tooltip="Delete contact"><span class="mbri-trash"></span></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="newContact">
            <a href="#" _uk-tooltip="New contact"><span class="mbri-plus"></span></a>
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
                    <label class="uk-form-label" for="form-horizontal-text">Text</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-horizontal-text" type="text" placeholder="Some text...">
                    </div>
                </div>

                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-text">Text</label>
                    <div class="uk-form-controls">
                        <input class="uk-input" id="form-horizontal-text" type="text" placeholder="Some text...">
                    </div>
                </div>
            
                <div class="uk-margin">
                    <label class="uk-form-label" for="form-horizontal-select">Select</label>
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-horizontal-select">
                            <option>Option 01</option>
                            <option>Option 02</option>
                        </select>
                    </div>
                </div>
            
                <div class="uk-margin">
                    <div class="uk-form-label">Radio</div>
                    <div class="uk-form-controls uk-form-controls-text">
                        <label><input class="uk-radio" type="radio" name="radio1"> Option 01</label><br>
                        <label><input class="uk-radio" type="radio" name="radio1"> Option 02</label>
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
                <button class="uk-button uk-button-danger" type="button">Delete</button>
                <button class="uk-button uk-button-primary" type="button">Edit</button>
                <button class="uk-button uk-button-muted uk-modal-close" type="button">Close</button>
            </div>
        </div>
    </div>
</body>

</html>