class DestinationPage {
        constructor(options) {
            this.slug = options.slug;

            if (!this.slug) {
                $('#json-output').text('No destination provided.');
                return;
            }

            this.jsonUrl = `pages/${this.slug}.json`;

            this.init();
        }

        init() {
            this.fetchJsonData();
            this.highlightActiveLink();
            console.log("reached here");
        }

        fetchJsonData() {
            $('body').readJsonFromUrl({
                url: this.jsonUrl,
                onSuccess: (data) => this.renderContent(data),
                onError: (err) => console.error("Fetch Error:", err)
            });
        }

        renderContent(data) {
            console.log("Fetched Data:", data, data['search-tags']);

            $(".content-title").text(`${data.page_title}: ${data.content_title}`);
            $("#featured-image").attr("src", data.featured_image);
            $("#featured-image").attr("alt", data.page_title);
            $(".main-content").text(data.main_content);

            if (data.qna) {
                $("#faq-title").text(data.qna.qna_title);
                JsonReader.renderQnaAccordion(data.qna, 'accordion');
            }

            if (Array.isArray(data['search-tags'])) {
                const tagsList = data['search-tags']
                    .map(tag => `<li><a href="destination/${this.slug}">${tag}</a></li>`)
                    .join('');
                $(".ulockd-tag-list-details").empty().html(tagsList);
            }
        }

        highlightActiveLink() {
            $('.destinations-list a').each((_, el) => {
                const href = $(el).attr('href');
                if (href && href.includes(this.slug)) {
                    $(el).addClass('active');
                }
            });
        }
    }