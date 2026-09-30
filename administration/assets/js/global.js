/// Alert
/// Ajout d'alertes
function addAlert(contentjson, origin = undefined) {
    const alert = document.getElementById('alert');
    alert.innerHTML += '<div class="alert-content ' + contentjson.type + '" style="animation: alertPop .3s forwards;"><div class="alert-img"></div><div class="alert-close">×</div><div class="alert-title">' + contentjson.title + '</div><div class="alert-msg">' + contentjson.reason + '</div></div>';

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

/// Suppression d'alertes
function closeAlert(divalert) {
    if (divalert.parentElement !== null) {
        divalert.parentElement.style.animation = 'alertPop .3s forwards reverse';
        setTimeout(function () {
            divalert.parentElement.style.display = 'none';
        }, 305);
    }
}

/// Fin Alert

/// Check-login
let nbCheck = 1;
let session = '';

function checkLogin() {
    fetch('https://citywish.fr/inc/ajax/session/check-login.php?nb=' + nbCheck, {
        method: 'GET',
        credentials: 'include'
    }).then((response) => {
        return response.json();
    }).then((alert) => {
        if (alert && alert.correct === true) {
            document.getElementById('alert').innerHTML = '';
            if (nbCheck > 1) addAlert(alert, check_l);
            if (nbCheck < 2) clearInterval(check_l);
            document.getElementById('checkLoginExtand').addEventListener('click', () => {
                document.getElementById('alert').innerHTML = '';
                addAlert({'type': 'warning', 'title': 'Reconnexion en cours', 'reason': 'Veuillez patienter...'});
                fetch('../../inc/ajax/session/reload.php?session=' + session, {
                    method: 'GET',
                    credentials: 'include'
                }).then((response) => {
                    return response.json();
                }).then((alertRe) => {
                    if (alertRe && alertRe.correct === true) {
                        document.getElementById('alert').innerHTML = '';
                        addAlert(alertRe);
                    }
                });
            });
        } else if (alert.correct === false) {
            nbCheck++;
            session = alert.session;
        }
    });
}

window.onload = checkLogin();
const check_l = setInterval(checkLogin, 60000);
/// Fin Check-login

function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear(),
        hours = d.getHours(),
        minutes = d.getMinutes();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;
    if (hours === 0)
        hours = '00'
    if (minutes === 0)
        minutes = '00'
    
    let datefinal = `${year}-${month}-${day}T${hours}:${minutes}`;
    return datefinal;
}