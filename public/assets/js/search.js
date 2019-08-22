 var easyAutocompleteVarOptions = {
  url: function(phrase) {
    return BASE_URL_API+"contacts/search";
  },
  getValue: function(element) {
    var stringComplete = element.fname+' '+element.lname+' | '+element.number+' | '+element.email;
    return stringComplete;
  },
  ajaxSettings: {
    dataType: "json",
    method: "POST",
    data: {
      dataType: "json"
    }
  },
  preparePostData: function(data) {
    data.phrase = $("#search-ajax-post").val();
    return data;
  },
  template: {
    type: "links",
    fields: {
    link: 'profile_url'
    }
  },
  requestDelay: 400
};
jQuery(window).on('load', function(){
  jQuery("#search-ajax-post").easyAutocomplete(easyAutocompleteVarOptions);
});