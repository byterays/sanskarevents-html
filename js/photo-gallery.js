class PhotoGalleryLoader {
    constructor(options) {
        this.apiUrl = options.apiUrl || 'api/PhotoGallery';
        this.container = $(options.container || '#photo-gallery');
        this.imageObserver = null;

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
                    <img class="img-responsive img-whp lazy-image" data-src="/gallery/${photo.file_path}" src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw==" alt="${photo.file_name}" loading="lazy" decoding="async">
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
        this.setupLazyLoading();
        this.initPopup();
    }

    setupLazyLoading() {
        const images = this.container.find('img.lazy-image');

        if (images.length === 0) {
            return;
        }

        const loadImage = (imgElement) => {
            const image = imgElement;
            const src = image.dataset.src;

            if (!src) {
                return;
            }

            image.src = src;
            image.removeAttribute('data-src');
            image.classList.remove('lazy-image');
        };

        if (this.imageObserver) {
            this.imageObserver.disconnect();
            this.imageObserver = null;
        }

        if (!('IntersectionObserver' in window)) {
            images.each((_, img) => loadImage(img));
            return;
        }

        this.imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach((entry) => {
                if (!entry.isIntersecting) {
                    return;
                }

                loadImage(entry.target);
                observer.unobserve(entry.target);
            });
        }, {
            root: null,
            rootMargin: '200px 0px',
            threshold: 0.01
        });

        images.each((_, img) => {
            this.imageObserver.observe(img);
        });
    }

    initPopup() {
        $(".popup-img").magnificPopup({
            type: "image",
            gallery: {
                enabled: true
            }
        });
    }
}