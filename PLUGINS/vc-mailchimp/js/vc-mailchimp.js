(function($) {
    $(function() {
            //On Form Submit
            $(document).on('click', '.vc_mailchimp_button', function(event) {
                event.preventDefault();
                $(this).closest('form.vc_mailchimp_form').submit();
            })
            $(document).on('submit', '.vc_mailchimp_form', function(event) {
                /* Act on the event */
                event.preventDefault();
                var form = $(this);
                form.find('.mc-success-message, .mc-error-message, .mc-email-validation-message,.vc-maichimp-debug').hide();
                var subscribe_email = form.find('.mc_email').val();
                var filter = /^\s*[\w\-\+_]+(\.[\w\-\+_]+)*\@[\w\-\+_]+\.[\w\-\+_]+(\.[\w\-\+_]+)*\s*$/;
                valid = String(subscribe_email).search(filter) != -1;
                if (subscribe_email == '' || !valid) {
                    form.find('.mc-email-validation-message').slideDown();
                    return false;
                }
                form.find('.vc-mailchimp-spinner').fadeIn();
                var form_data = form.serialize();
                data = {
                    'action': 'vc_mailchimp_form_submit',
                    formdata: form_data
                }
                $.post(vcmailhimp_ajaxurl, data, function(data, textStatus, xhr) {
                	form.find('.vc-mailchimp-spinner').fadeOut();
                    var result = JSON.parse(data);

                    if (result.debug == 'true') {

                        if (typeof result.response == 'object') {
                            var resp_string = JSON.stringify(result.response);
                        } else {
                            resp_string = result.response;
                        }
                        form.find('.vc-maichimp-debug').html(resp_string).slideDown();
                    } else {
                        if (result.response == 'success') {
                            var redirect_url = form.find('.redirect_url').val();
                            if (redirect_url != '') {
                                window.location.href = redirect_url;
                            } else {
                                //no redirect url found
                                form.find('.mc-success-message').slideDown();
                            }
                        } else {
                            form.find('.mc-error-message').slideDown();
                            //alert('Sorry but there is some error in adding your email to our subscriber list.Please try again')
                        }
                    }
                });
            })
        }) // document.ready ends here
})(jQuery)