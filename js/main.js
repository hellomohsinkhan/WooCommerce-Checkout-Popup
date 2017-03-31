function load_modalpopup_checkout() {

    jQuery.post(my_ajax_object.ajax_url, {action: 'load_modalpopup_checkout'}, function (data) {
        console.log(data);
        jQuery(".modal-body").html(data);
    });
}
