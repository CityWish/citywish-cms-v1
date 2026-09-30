const tiny = document.getElementById('news-text');
if (tiny) {
    tinymce.init({
        selector: "textarea#news-text",
        language: "fr_FR",
        language_url: "https://citywish.fr/assets/js/tinymce/fr_FR.js",
        min_height: 500,
        plugins: [
            "print preview searchreplace autolink directionality spellchecker autosave",
            "visualblocks visualchars fullscreen image link media template codesample",
            "table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists",
            "wordcount imagetools textpattern help save code emoticons"
        ],
        toolbar: "undo redo | formatselect | bold italic underline strikethrough forecolor | link image media | emoticons blockquote | alignleft aligncenter alignright alignjustify | numlist bullist | removeformat",
        image_advtab: true,
        branding: false,
        browser_spellcheck: true,
        relative_urls: false,
        autosave_restore_when_empty: true
    });
}