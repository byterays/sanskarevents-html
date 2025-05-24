class PhotoGalleryLoader {
    constructor(options) {
        this.apiUrl = options.apiUrl || 'api/PhotoGallery';
        this.container = $(options.container || '#photo-gallery');

        if (this.container.length > 0) {
            this.init();
        } else {
            console.warn(`Container "${options.container}" not found. Gallery not loaded.`);
        }
    }

    init() {
        this.fetchData();
    }

    fetchData() {
        $.getJSON(this.apiUrl, (data) => {
            console.log("Loaded Photo Gallery Data:", data);
            this.render(data);
        }).fail((jqxhr, textStatus, error) => {
            console.error("Error loading photo gallery:", textStatus, error);
            this.container.html(`<p style="color:red;">Failed to load gallery.</p>`);
        });
    }

    render(data) {
        if (!Array.isArray(data)) {
            this.container.html(`<p style="color:red;">Invalid data format.</p>`);
            return;
        }

        const html = data.map(photo => `
            <div class="isotope-item">
                <div class="gallery-thumb">
                    <img class="img-responsive img-whp" src="/gallery/${photo.file_path}" alt="${photo.file_name}">
                    <div class="overlayer">
                        <div class="lbox-caption">
                            <div class="lbox-details">
                                <ul class="list-inline">
                                    <li>
                                        <a class="popup-img" href="/gallery/${photo.file_path}" title="${photo.file_name}">
                                            <span class="flaticon-add-square-button"></span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="details text-center">
                    <h5>${photo.file_name}</h5>
                </div>
            </div>
        `).join('');

        this.container.html(html);

         $(".popup-img").magnificPopup({
            type: "image",
            gallery: {
                enabled: true
            }
        });
    }
}