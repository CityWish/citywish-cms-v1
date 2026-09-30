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

const page = window.location.pathname.split('/')[2].replace('.php', '');
const write_form = document.getElementById('write-news');
if(write_form){
    const previewBtn = document.getElementById('previewsend');
    const draftBtn = document.getElementById('draftsend');
    const finalBtn = document.getElementById('finalsend');

    write_form.addEventListener('submit', (e) => e.preventDefault());

    if(previewBtn && draftBtn && finalBtn){
        previewBtn.addEventListener('click', (e) => {
            sendFetch('preview', page);
        });

        draftBtn.addEventListener('click', (e) => {
            sendFetch('draft', page);
        });

        finalBtn.addEventListener('click', (e) => {
            sendFetch('final', page);
        });
    }
}

function sendFetch(type, page){
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id') !== null ? '&id=' + urlParams.get('id') : '';
    fetch('./inc/ajax/Redaction/' + page + '_process.php?type=' + type + id, {
        method: 'POST',
        credentials: 'include',
        body: new FormData(write_form)
    }).then((response) => {
        return response.json();
    }).then((result) => {
        addAlert(result);
        document.querySelectorAll('input, select').forEach((element) => {
            element.style.borderBottom = '2px solid #4CAF50';
        });
        if(result.type === 'success') {
            setTimeout(() => {
                window.location.href = './list';
            }, 2000);
        } else if (result.type === 'error') {
            result.missing.forEach((name) => {
                const missing = document.querySelector('*[name="' + name + '"]');
                if(missing){
                    missing.style.borderBottom = '2px solid #EF5350';
                }
            });
        }
    });
}