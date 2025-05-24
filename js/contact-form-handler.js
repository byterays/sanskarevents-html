


class ContactFormHandler {
    constructor({ form, subject, url }) {
        this.form = $(form);
        this.subject = subject || 'No Subject';
        this.endpoint = url;

        if (!this.form.length) {
            console.error('Form not found:', form);
            return;
        }

        this.bindSubmitEvent();
    }

    bindSubmitEvent() {
        this.form.on('submit', (e) => this.handleSubmit(e));
    }

    handleSubmit(e) {
        e.preventDefault();

       let submitBtn = this.form.find('button[type="submit"]');
     
        submitBtn.text(submitBtn.data('loading-text') || 'Sending...');
        //submitBtn.addClass('disabled');
        const formData = this.form.serialize() + '&form_subject=' + encodeURIComponent(this.subject);

        $.ajax({
            url: this.endpoint,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: (response) => this.handleSuccess(response),
            complete: () => {
                this.form.trigger("reset"); // Uncomment if needed
                submitBtn.prop('disabled', false);
                submitBtn.text('Submit');
               // submitBtn.removeClass('disabled');
            },
            error: () => this.handleError()
        });

        return false;
    }

    handleSuccess(response) {
        $('.messages').html('<div style="color:green;"> Your message has been sent successfully.</div>');

    }

    handleError() {
        $('.messages').html('<div style="color:red;">An error occurred.</div>');
    }
}
