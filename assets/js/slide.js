console.log("\n" +
    "                                                   \n" +
    " ____ ___ _______   ____        _____ ____  _   _  \n" +
    "/ ___|_ _|_   _\ \ / /\ \      / /_ _/ ___|| | | | \n" +
    "| |   | |  | |  \ V /  \ \ /\ / / | |\___ \| |_| | \n" +
    "| |___| |  | |   | |    \ V  V /  | | ___) |  _  | \n" +
    "\____|___| |_|   |_|     \_/\_/  |___|____/|_| |_| \n" +
    "CMS développé par Neal et Cold pour CITYWISH.");

/* Loader */
/*function pageLoad() {
    const load = document.getElementById('loader');
    setTimeout(function () {
        load.style.animation = 'popdown .3s forwards';
        document.documentElement.style.overflow = 'auto';
        displayScroll();
    }, 100);
}

document.getElementById('finish-load').addEventListener('click', function () {
    pageLoad();
});*/

window.addEventListener('load', () => {
        displayScroll();
});

/* Fin Loader */

/// Scroll
function displayScroll() {
    let pos = document.documentElement.scrollTop;
    const minH = document.documentElement.scrollHeight / 2;

    if (pos >= minH) {
        document.getElementById('gotop').style.display = 'inline';
    } else {
        document.getElementById('gotop').style.display = 'none';
    }

    if (pos >= minH) {
        document.getElementById('gobottom').style.display = 'none';
    } else {
        document.getElementById('gobottom').style.display = 'inline';
    }
}

document.addEventListener('scroll', () => {
    displayScroll();
});

document.getElementById('gobottom').addEventListener('click', (e) => {
    document.getElementById('footer').scrollIntoView({
        behavior: 'smooth'
    });
});

document.getElementById('gotop').addEventListener('click', (e) => {
    document.getElementById('barre').scrollIntoView({
        behavior: 'smooth'
    });
});
/// Fin Scroll

/* Alertes */

/* Ajout d'alertes */
function addAlert(contentjson, origin = undefined, permanent = false) {
    const alert = document.getElementById('alert');
    permanent === false ? permanent = 'unpermanent' : permanent = 'permanent';
    alert.innerHTML += '<div class="alert-content ' + contentjson.type + ' ' + permanent + '" style="animation: alertPop .3s forwards;"><div class="alert-img"></div><div class="alert-close">×</div><div class="alert-title">' + contentjson.title + '</div><div class="alert-msg">' + contentjson.reason + '</div></div>';

    setTimeout(() => {
        const alertcontent = document.querySelectorAll('.alert-content');
        alertcontent.forEach((divclass) => {
            divclass.style.animation = null;
            divclass.style.right = '0';
        });
        const alertclose = document.querySelectorAll('.alert-close');
        alertclose.forEach((divclass) => {
            divclass.addEventListener('click', (event) => {
                closeAlert(event.target);
            });
        });
    }, 305);
    if (origin) {
        clearInterval(origin);
    }
}

/* Suppression d'alertes */
function closeAlert(divalert) {
    if (divalert.parentElement !== null) {
        divalert.parentElement.style.animation = 'alertPop .3s forwards reverse';
        setTimeout(function () {
            divalert.parentElement.style.display = 'none';
        }, 305);
    }
}

function cleanAlert() {
    if (document.getElementById('alert')) {
        const alertcontent = document.querySelectorAll('.alert-content');
        alertcontent.forEach((alert) => {
            if (alert.classList[2] === 'unpermanent') {
                alert.remove();
            }
        });
    }
}
/* Fin alertes */

function initOverlay(openTarget) {
    if (openTarget.style.transform === 'scale(0)') {
        openTarget.style.transform = 'scale(1)';
        document.documentElement.style.overflow = 'hidden';

        setTimeout(function () {
            const overlayChilds = openTarget.children;
            overlayChilds[0].style.transform = 'scale(1)';
            overlayChilds[0].style.transition = '0s';
            overlayChilds[1].style.top = '50%';

            overlayChilds[0].addEventListener('click', function () {
                cleanAlert();
                const closeParent = overlayChilds[0].parentElement;
                overlayChilds[0].style.transition = '.3s';
                overlayChilds[0].style.transform = 'scale(0)';
                closeParent.children[1].style.top = '-25%';

                setTimeout(function () {
                    closeParent.style.transform = 'scale(0)';
                    document.documentElement.style.overflow = 'auto';
                }, 300);
            });
        }, 300);
    }
}

function changeOverlay(id) {
    cleanAlert();

    document.querySelectorAll('.overlay').forEach((overlay) => {
        if (overlay.style.transform = 'scale(1)') {
            overlay.children[1].style.top = '-25%';
            setTimeout(function () {
                overlay.style.transform = 'scale(0)';
                document.documentElement.style.overflow = 'auto';
            }, 300);
        }
    });

    setTimeout(() => {
        initOverlay(document.getElementById(id));
    }, 750);
}

let opens = document.querySelectorAll('.open');
if (opens) {
    opens.forEach(function (open) {
        open.addEventListener('click', function () {
            initOverlay(document.getElementById(open.id.replace('open-', '')));
        })
    });
}

/* Paramètres */
const settings = document.getElementById('settings-oy');
if (settings) {
    function opencontent(id) {
        const content = document.getElementById(id);
        if (content.style.transform !== 'scale(1)') {
            content.style.display = 'block';
            setTimeout(function () {
                content.style.transform = 'scale(1)';
            }, 100);
        } else {
            content.style.transform = 'scale(0)';
            setTimeout(function () {
                content.style.display = 'none';
            }, 100);
        }
    }

    document.getElementById('open-newpswrd').addEventListener('click', () => {
        opencontent('newpswrd');
    });
    document.getElementById('open-newpseudo').addEventListener('click', () => {
        opencontent('newpseudo');
    });
    document.getElementById('open-newdescp').addEventListener('click', () => {
        opencontent('newdescp');
    });
    document.getElementById('open-newimg').addEventListener('click', () => {
        addAlert({
            'type': 'warning',
            'title': 'Avertissement',
            'reason': 'Cette fonctionnalité n\'est pas encore disponible.'
        });
    });
    document.getElementById('open-discord').addEventListener('click', () => {
        opencontent('discord');
    });

    /* Ajax */
    document.getElementById('newpswrd-form').addEventListener('submit', (e) => {
        e.preventDefault();
        fetch('../inc/ajax/settings/as-newmdp.php', {
            method: "POST",
            body: new FormData(document.getElementById('newpswrd-form')),
            credentials: 'include'
        }).then((response) => {
            return response.json();
        }).then((newpswrdalert) => {
            if (newpswrdalert.correct === true) {
                cleanAlert();
                addAlert(newpswrdalert);
            }
        });
    });

    document.getElementById('newpseudo-form').addEventListener('submit', (e) => {
        e.preventDefault();
        fetch('../inc/ajax/settings/as-newpseudo.php', {
            method: "POST",
            body: new FormData(document.getElementById('newpseudo-form')),
            credentials: 'include'
        }).then((response) => {
            return response.json();
        }).then((newpseudoalert) => {
            if (newpseudoalert.correct === true) {
                cleanAlert();
                addAlert(newpseudoalert);
                if (newpseudoalert.type === 'success') {
                    setTimeout(() => {
                        location.reload();
                    }, 1000);
                }
            }
        });
    });

    document.getElementById('pseudo-input').addEventListener('keyup', (e) => {
        e.target.value = e.target.value.replace(' ', '');
        e.target.style.background = '-5px -10px url(https://avatar.citywish.fr/?username=' + e.target.value + '&headonly=1&head_direction=2) no-repeat #efefef';
    });

    document.getElementById('newdescp-form').addEventListener('submit', (e) => {
        e.preventDefault();
        fetch('../inc/ajax/settings/as-newdescp.php', {
            method: "POST",
            body: new FormData(document.getElementById('newdescp-form')),
            credentials: 'include'
        }).then((response) => {
            return response.json();
        }).then((newdescpalert) => {
            if (newdescpalert.correct === true) {
                cleanAlert();
                addAlert(newdescpalert);
            }
        });
    });

    /*document.getElementById('newimg-form').addEventListener('submit', function(event){
        event.preventDefault();
        fetch('../inc/ajax/settings/as-newimg.php', {
            method: 'POST',
            body: new FormData(document.getElementById('newimg-form')),
            credentials: 'include'
        }).then(function(response) {
            return response.json();
        }).then(function(newimgalert) {
            const alert = document.getElementById('alert-newimg');
            if (newimgalert.error === 1) {
                alert.className = 'alert-s error-s';
            } else {
                alert.className = 'alert-s success-s';
            }
            alert.innerHTML = newimgalert.content;
            document.getElementById('img-pass').value = '';
        });
    });*/

    document.getElementById('discord-form').addEventListener('submit', (e) => {
        e.preventDefault();
        fetch('../inc/ajax/settings/as-iddiscord.php', {
            method: 'POST',
            body: new FormData(document.getElementById('discord-form')),
            credentials: 'include'
        }).then((response) => {
            return response.json();
        }).then((alert) => {
            if (alert.correct === true) {
                cleanAlert();
                addAlert(alert);
                if (alert.type === 'success') {
                    setTimeout(() => {
                        location.href = 'https://discord.com/api/oauth2/authorize?client_id=472069881819430942&redirect_uri=https%3A%2F%2Fcitywish.fr%2F&response_type=code&scope=identify%20guilds';
                    }, 1000);
                }
            }
        });
    });
}
/// Fin Paramètres

/* Menu - Recherche de Profil */
document.getElementById('u-search').addEventListener('keyup', (event) => {
    const recherche = event.target.value;
    document.getElementById('u-s-avatar').src = 'https://avatar.citywish.fr/?username=' + recherche + '&head_direction=2&headonly=1';
    document.getElementById('u-s-href').href = 'https://citywish.fr/profil/' + recherche;
});
/* Fin Recherche de Profil */

/// Session
/// Check-login
let nbCheck = 1;
let session = '';
let adminSession = '';

function checkLogin() {
    fetch('../inc/ajax/session/check-login.php?nb=' + nbCheck, {
        method: 'GET',
        credentials: 'include'
    }).then((response) => {
        return response.json();
    }).then((alert) => {
        if (alert && alert.correct === true) {
            cleanAlert();
            if (nbCheck > 1) addAlert(alert, check_l, true);
            if (nbCheck < 2) clearInterval(check_l);
            if (document.getElementById('checkLoginExtand')) {
                let eventReload = setInterval(() => {
                    document.getElementById('checkLoginExtand').removeEventListener('click', () => {});
                    document.getElementById('checkLoginExtand').addEventListener('click', () => {
                        clearInterval(eventReload);
                        document.getElementById('alert').innerHTML = '';
                        addAlert({
                            'type': 'warning',
                            'title': 'Reconnexion en cours',
                            'reason': 'Veuillez patienter...'
                        });
                        fetch('../inc/ajax/session/reload.php?session=' + session + '&admin=' + adminSession, {
                            method: 'GET',
                            credentials: 'include'
                        }).then((response) => {
                            return response.json();
                        }).then((alertRe) => {
                            if (alertRe && alertRe.correct === true) {
                                cleanAlert();
                                addAlert(alertRe);
                            }
                        });
                    });
                }, 1000);
            }
        } else if (alert.correct === false) {
            nbCheck++;
            session = alert.session;
            adminSession = alert.admin;
        }
    });
}

window.onload = checkLogin();
const check_l = setInterval(checkLogin, 30000);

/// Connexion
const connect = document.getElementById('connect');
if (connect) {
    document.getElementById('connect-pseudo-input').addEventListener('keyup', (event) => {
        event.target.value = event.target.value.replace(' ', '');
        event.target.style.background = '-5px -10px url(https://avatar.citywish.fr/?username=' + event.target.value + '&headonly=1&head_direction=2) no-repeat #efefef';
    });

    document.getElementById('connect-form').addEventListener('submit', (event) => {
        event.preventDefault();
        addAlert({
            'type': 'warning',
            'title': 'Connexion en cours',
            'reason': 'Veuillez patienter...'
        });
        fetch('../inc/ajax/session/connect.php', {
            method: 'POST',
            body: new FormData(document.getElementById('connect-form')),
            credentials: 'include'
        }).then(function (response) {
            return response.json();
        }).then(function (alert) {
            if (alert && alert.correct === true) {
                cleanAlert();
                addAlert(alert);
                if (alert.type === 'success') {
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                }
            }
        });
    });
}

/// Inscription
const register = document.getElementById('register');
if (register) {
    document.getElementById('register-pseudo-input').addEventListener('keyup', function (event) {
        event.target.value = event.target.value.replace(' ', '');
        event.target.style.background = '-5px -10px url(https://avatar.citywish.fr/?username=' + event.target.value + '&headonly=1&head_direction=2) no-repeat #efefef';
    });

    document.getElementById('register-form').addEventListener('submit', function (event) {
        event.preventDefault();
        addAlert({
            'type': 'warning',
            'title': 'Inscription en cours',
            'reason': 'Veuillez patienter...'
        });
        fetch('../inc/ajax/session/register.php', {
            method: 'POST',
            body: new FormData(document.getElementById('register-form')),
            credentials: 'include'
        }).then(response => {
            if (!response.ok) {
                return addAlert({
                    'type': 'error',
                    'title': 'Erreur',
                    'reason': 'Une erreur est survenue. Veuillez contacter <a>Cold#0393</a> sur Discord.'
                });
            }
            return response.json();
        }).then(alert => {
            if (alert && alert.correct === true) {
                cleanAlert();
                addAlert(alert);
                if (alert.type === 'success') {
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                }
            } else {
                cleanAlert();
                addAlert({
                    'type': 'error',
                    'title': 'Erreur',
                    'reason': 'Une erreur est survenue. Veuillez contacter <a>Cold#0393</a> sur Discord.'
                });
            }
        }).catch(error => {
            addAlert({
                'type': 'error',
                'title': 'Erreur',
                'reason': 'Une erreur est survenue. Veuillez contacter <a>Cold#0393</a> sur Discord. ' + error
            });
        });
    });
}

/// Déconnexion
const logout = document.getElementById('log');
if (logout) {
    logout.addEventListener('click', () => {
        addAlert({
            'type': 'warning',
            'title': 'Déconnexion en cours',
            'reason': 'Veuillez patienter...'
        });
        fetch('../inc/ajax/session/logout.php', {
            method: 'GET',
            credentials: 'include'
        }).then((response) => {
            return response.json();
        }).then((alert) => {
            if (alert.correct === true) {
                cleanAlert();
                addAlert(alert);
                if (alert.type === 'success') {
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                }
            }
        });
    });
}
/// Fin Session

/// Authentification Administration
const admin = document.getElementById('admin');
if (admin) {
    const adminForm = document.getElementById('auth-admin-form');
    const codeInputs = document.querySelectorAll('.code-input');
    let firstPaste = false;
    adminForm.addEventListener('submit', (e) => e.preventDefault());

    document.getElementById('auth-admin-check').addEventListener('click', (e) => {
        codeSubmit();
    });

    document.getElementById('auth-admin-code').addEventListener('click', (e) => {
        fetch('../inc/ajax/session/a2f.php', {
            method: 'GET',
            credentials: 'include'
        }).then((response) => {
            return response.json();
        }).then((alert) => {
            cleanAlert();
            addAlert(alert);
            if (alert.type === 'success') {
                codeInputs[0].focus();
                codeInputs.forEach((input) => {
                    input.value = '';
                });
            }
        });
    });

    codeInputs.forEach((input, index) => {
        input.dataset.index = index;
        input.addEventListener('paste', handleOnPasteCode);
        input.addEventListener('keyup', handleCode);
        input.addEventListener('focus', (e) => handleOnPasteCode(e, true));
    });

    function codeSubmit() {
        let data = new FormData();
        let code = '';
        codeInputs.forEach((input) => code += input.value);
        data.append('code', code)
        fetch('../inc/ajax/session/auth_admin.php', {
            method: 'POST',
            body: data,
            credentials: 'include'
        }).then((response) => {
            return response.json();
        }).then((alert) => {
            cleanAlert();
            addAlert(alert);
            if (alert.type === 'success') {
                setTimeout(() => {
                    location.href = 'https://citywish.fr/admin/';
                }, 1000);
            }
        });
    }

    async function handleOnPasteCode(e, focus = false) {
        e.preventDefault();
        if (!navigator.clipboard) return;
        if (focus === true && firstPaste === true) return;
        const data = await navigator.clipboard.readText().then((code) => code);
        const value = data.split('');
        if (value.length === codeInputs.length && isNaN(data) !== true) {
            codeInputs.forEach((input, index) => {
                input.value = value[index];
            });
            codeSubmit();
            if (focus === true) firstPaste = true;
        }
    }

    function handleCode(e) {
        const input = e.target;
        let fieldIndex = input.dataset.index;
        let value = input.value.replace(' ', '');
        input.value = '';
        input.value = value ? value[0] : '';

        if (e.code === 'Space' && fieldIndex < codeInputs.length - 1) return input.nextElementSibling.focus();

        if (value.length > 0 && fieldIndex < codeInputs.length - 1) {
            input.nextElementSibling.focus();
        }

        if (e.key === 'Backspace' && fieldIndex > 0) {
            input.previousElementSibling.focus();
        }

        if (fieldIndex === codeInputs.length - 1) {
            codeSubmit();
        }
    }
}

/// Snowstorm
const month = new Date().getMonth();
if (month === 11) {
    snowStorm.freezeOnBlur = false;
    snowStorm.useTwinkleEffect = true;
    snowStorm.targetElement = 'snowLimit';
    snowStorm.flakeBottom = '26';
    snowStorm.autoStart = false;
    snowStorm.toggleSnow();

    let snowCookie = document.cookie
        .split('; ')
        .find(row => row.startsWith('snow'));
    let snowCookieValue;

    const snowLimit = document.getElementById('snowLimit');
    if (snowLimit) {
        if (snowCookie) {
            snowCookieValue = snowCookie.split('=')[1];
            if (snowCookieValue === 'off') {
                snowStorm.toggleSnow();
            }
        }
    }

    const snowButton = document.getElementById('snowButton');
    if (snowButton) {
        snowButton.addEventListener('click', () => {
            if (snowCookie) {
                if (snowCookieValue === 'off') {
                    document.cookie = 'snow=on; path=/; max-age= 2714400; secure; samesite=strict';
                    snowStorm.toggleSnow();
                    addAlert({
                        'type': 'success',
                        'title': 'Succès',
                        'reason': 'La neige dans l\'header est activée !'
                    });
                } else if (snowCookieValue === 'on') {
                    document.cookie = 'snow=off; path=/; max-age= 2714400; secure; samesite=strict';
                    snowStorm.toggleSnow();
                    addAlert({
                        'type': 'success',
                        'title': 'Succès',
                        'reason': 'La neige dans l\'header est désactivée !'
                    });
                }
            } else {
                document.cookie = 'snow=off; path=/; max-age= 2714400; secure; samesite=strict';
                snowStorm.toggleSnow();
                addAlert({
                    'type': 'success',
                    'title': 'Succès',
                    'reason': 'La neige dans l\'header est désactivée !'
                });
            }
            snowCookie = document.cookie
                .split('; ')
                .find(row => row.startsWith('snow'));
            snowCookieValue = snowCookie.split('=')[1];
        });
    }
}

const giveaway = document.getElementById('giveaway');
if (giveaway) {
    document.getElementById('giveaway-open').addEventListener('click', () => {
        if (giveaway.classList.contains('opened'))
            giveaway.classList.remove('opened');
        else
            giveaway.classList.add('opened');
    });

    function updateGiveAwayCountDown(start, end, id, countDown) {
        const now = start.getTime();
        const remainingTime = end.getTime();
        const timeBetween = remainingTime - now;

        const days = Math.floor(timeBetween / (1000 * 60 * 60 * 24));
        const hours = Math.floor((timeBetween % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((timeBetween % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((timeBetween % (1000 * 60)) / 1000);

        document.getElementById('giveaway-timer-' + id).innerText =
            `${days}j ${hours}h ${minutes}min et ${seconds}s`;

        if (timeBetween < 0) {
            clearInterval(countDown);
            document.getElementById('giveaway-timer-' + id).innerText = 'TERMINÉ';
            fetch('../inc/ajax/giveaways/GiveawayWinners.php?id=' + id, {
                method: 'GET'
            }).then((response) => {
                return response.text();
            }).then((data) => {
                document.getElementById('giveaway-informations-' + id).innerHTML = data;
            });
        }
    }

    function setGiveAwayCountDown() {
        document.querySelectorAll('.giveaway-item').forEach((item, key) => {
            const itemId = document.querySelectorAll('.giveaways-id')[key].value;
            const timestamp = document.getElementById('giveaway-timestamp-' + itemId).value;
            const btn = document.getElementById('giveaway-btn-' + itemId);
            if (btn) {
                btn.addEventListener('click', (e) => {
                    const data = new FormData();
                    data.append('id', itemId);
                    fetch('../inc/ajax/giveaways/GiveawayParticipate.php', {
                        method: 'POST',
                        body: data,
                        credentials: 'include'
                    }).then((response) => {
                        return response.json();
                    }).then((data) => {
                        cleanAlert();
                        addAlert(data);
                        if (data.type === 'success') {
                            if (data.participate === false) {
                                e.target.innerText = 'Participer';
                                e.target.classList.remove('deleting');
                            } else {
                                e.target.innerText = 'Retirer';
                                e.target.classList.add('deleting');
                            }
                        }
                    });
                });
            }
            let countDown = setInterval(() => {
                updateGiveAwayCountDown(new Date(), new Date(timestamp * 1000), itemId, countDown);
            }, 1000);
        });
    }

    window.addEventListener('load', () => {
        setGiveAwayCountDown();
    });

    document.getElementById('reload-giveaway').addEventListener('click', () => {
        fetch('../inc/ajax/giveaways/GiveawayList.php', {
            method: 'GET',
            credentials: 'include'
        }).then((response) => {
            return response.text();
        }).then((data) => {
            document.getElementById('giveaways').innerHTML = data;
            setGiveAwayCountDown();
        });
    });
}
