(function($, window) {

    // Define the JsonReader class
    class JsonReader {
        constructor(element, options) {
            this.element = $(element);
            this.settings = $.extend({
                url: null,
                method: 'GET',
                onSuccess: function(data) { console.log(data); },
                onError: function(error) { console.error('JSON Load Error:', error); }
            }, options);

            this.init();
        }

        init() {
            if (!this.settings.url) {
                console.error('URL is required');
                return;
            }
            this.fetchJson();
        }

        fetchJson() {
            const self = this;
            $.ajax({
                url: self.settings.url,
                type: self.settings.method,
                dataType: 'json',
                success: function(response) {
                    self.settings.onSuccess(response);
                },
                error: function(xhr, status, error) {
                    self.settings.onError({ xhr: xhr, status: status, error: error });
                }
            });
        }

        static renderQnaAccordion(qnaData, accordionId) {
            const accordion = $('#' + accordionId);

            // Add title
            if (qnaData.qna_title) {
                accordion.append(
                    $('<h3>').text(qnaData.qna_title).addClass('qna-heading')
                );
            }

            // Add each QnA item
            if (Array.isArray(qnaData.qna_items)) {
                $.each(qnaData.qna_items, function(index, item) {
                    const idSuffix = 'Q' + index;
                    const headingId = 'heading' + idSuffix;
                    const collapseId = 'collapse' + idSuffix;

                    const panel = $('<div>', { class: 'panel panel-default' });
                    const panelHeading = $('<div>', {
                        class: 'panel-heading',
                        role: 'tab',
                        id: headingId
                    });

                    const panelTitle = $('<h4>', { class: 'panel-title' });
                    const anchor = $('<a>', {
                        role: 'button',
                        'data-toggle': 'collapse',
                        'data-parent': '#' + accordionId,
                        href: '#' + collapseId,
                        'aria-expanded': 'false',
                        'aria-controls': collapseId
                    });

                    anchor.append('<i class="fa fa-angle-down icon-1"></i>');
                    anchor.append('<i class="fa fa-angle-up icon-2"></i>');
                    anchor.append(' ' + item.question);

                    panelTitle.append(anchor);
                    panelHeading.append(panelTitle);

                    const panelCollapse = $('<div>', {
                        id: collapseId,
                        class: 'panel-collapse collapse',
                        role: 'tabpanel',
                        'aria-labelledby': headingId
                    });

                    const panelBody = $('<div>', { class: 'panel-body' });
                    panelBody.append($('<p>').text(item.answer));
                    panelCollapse.append(panelBody);

                    panel.append(panelHeading).append(panelCollapse);
                    accordion.append(panel);
                });
            }
        }
    }

    // Expose to global scope
    window.JsonReader = JsonReader;

    // jQuery plugin wrapper
    $.fn.readJsonFromUrl = function(options) {
        return this.each(function() {
            if (!$.data(this, 'plugin_readJsonFromUrl')) {
                $.data(this, 'plugin_readJsonFromUrl', new JsonReader(this, options));
            }
        });
    };

})(jQuery, window);
