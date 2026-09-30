function pageLoad() {
    const load = document.getElementById('loader');
    setTimeout(function () {
        load.style.animation = 'popdown .3s forwards';
        document.documentElement.style.overflow = 'auto';
        setTimeout(() => {
            const logo = document.getElementById('logo-a');
            logo.style.top = '0';
            setTimeout(() => {
                logo.style.position = 'relative';
                document.querySelector('.container').style.transform = 'scale(1)';
            }, 500);
        }, 300);
    }, 300);
}

document.getElementById('finish-load').addEventListener('click', function () {
    pageLoad();
});

window.onload = pageLoad();