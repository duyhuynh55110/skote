// https://vuejs.org/guide/reusability/custom-directives.html
// https://nuxt.com/docs/guide/directory-structure/plugins#vue-directives

export default defineNuxtPlugin((nuxtApp) => {
    // enables v-mask in templates
    nuxtApp.vueApp.directive("mask", {
        mounted: (el: HTMLElement, binding) => {
    
        let mask = binding.value
        let first = mask.indexOf("_")
        let clean = mask.replace(/[^0-9_]/gm, "")
        let indexes: Array<number> = [];
    
        for (var i = 0; i < clean.length; i++) {
            if (!isNaN(clean[i])) {
                indexes.push(i);
            }
        }
    
        el.value = mask;
        el.clean = mask.replace(/[^0-9]/gm, "");
    
        // make replace "_" to number
        const maskIt = (event: any, start: any) => {
            let value = el.value
            let filtred = value.replace(/[^0-9]/gm, "")
            let result = ""
    
            if (value.length < first) {
                value = mask + value;
                filtred = value.replace(/[^0-9]/gm, "");
            }
    
            for (var i = 0; i < filtred.length; i++) {
                if (indexes.indexOf(i) == -1) {
                    result += filtred[i];
                }
            }
    
            value = "";
            let cursor = 0;
    
            for (let i = 0; i < mask.length; i++) {
                if (mask[i] == "_" && result) {
                    value += result[0];
                    result = result.slice(1);
                    cursor = i + 1;
                } else {
                    value += mask[i];
                }
            }
    
            if (cursor < first) {
                cursor = first;
            }
    
            el.value = value;
    
            el.clean = el.value.replace(/[^0-9]/gm, "");
    
            el.setSelectionRange(cursor, cursor);
        }
    
        el.addEventListener("focus", function (event: any) {
            event.preventDefault();
        });
    
        el.addEventListener("click", function (event: any) {
            event.preventDefault();
            var start = el.value.indexOf("_");
    
            if (start == -1) {
            start = el.value.length;
            }
    
            el.setSelectionRange(start, start);
        });
    
        el.addEventListener("paste", function (event: any) {
            var start = el.selectionStart;
    
            if (start < first) {
            el.value = "_" + el.value;
            }
        });
    
        el.addEventListener("input", function (event: any) {
            var start = el.selectionStart;
            maskIt(event, start);
        });
        },
    });

    // enable v-lazyload in template
    nuxtApp.vueApp.directive("lazy-load", {
        mounted: (el: HTMLElement) => {
            // Process onload & onerror image
            const loadImage = () => {
                const imageElement = el;

                // Only process lazy loading if was image
                if(imageElement.nodeName !== 'IMG') return;

                // if element was image
                if (imageElement) {
                    imageElement.addEventListener('load', () => {
                        setTimeout(() => el.classList.add('loaded'), 100);
                    });
                
                    // Display error image on fail
                    imageElement.addEventListener('error', () => {
                        imageElement.src = '_nuxt/assets/images/image-not-found.png';
                        setTimeout(() => el.classList.add('error'), 100);
                    });

                    // show image src
                    imageElement.src = imageElement.dataset.url;
                }
            }
          
            const handleIntersect = (entries, observer) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        loadImage();
                        observer.unobserve(el);
                    }
                });
            }
          
            const createObserver = () => {
                const options = {
                    root: null,
                    threshold: '0',
                };

                const observer = new IntersectionObserver(handleIntersect, options);
                observer.observe(el);
            }
            
            // Intersection Observe API does not support all browsers, it covers about 73%; If browser not support will replace by loadImage function
            if (window['IntersectionObserver']) {
                createObserver();
            } else {
                loadImage();
            }
        },
    });
});
