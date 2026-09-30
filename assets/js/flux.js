/* Flux */
const flux = document.getElementById('flux');
if (flux) {
    /// HabboCity
    document.getElementById('on-hc').addEventListener('click', function (event) {
        event.preventDefault();
        fetch('./inc/ajax/flux/loadflux.php?in=1&hc=1', {
            method: 'GET'
        }).then(function (response) {
            return response.text();
        }).then(function (fluxload) {
            document.getElementById('fluxload-hc').innerHTML = fluxload;
        });
    });
    document.getElementById('out-hc').addEventListener('click', function (event) {
        event.preventDefault();
        fetch('./inc/ajax/flux/loadflux.php?out=1&hc=1', {
            method: 'GET'
        }).then(function (response) {
            return response.text();
        }).then(function (fluxload) {
            document.getElementById('fluxload-hc').innerHTML = fluxload;
        });
    });
    document.getElementById('all-hc').addEventListener('click', function (event) {
        event.preventDefault();
        fetch('./inc/ajax/flux/loadflux.php?all=1&hc=1', {
            method: 'GET'
        }).then(function (response) {
            return response.text();
        }).then(function (fluxload) {
            document.getElementById('fluxload-hc').innerHTML = fluxload;
        });
    });
    document.getElementById('change-hc').addEventListener('click', function (event) {
        event.preventDefault();
        fetch('./inc/ajax/flux/loadflux.php?change=1&hc=1', {
            method: 'GET'
        }).then(function (response) {
            return response.text();
        }).then(function (fluxload) {
            document.getElementById('fluxload-hc').innerHTML = fluxload;
        });
    });

    function searchFlux(searchInput, searchForm, fluxBox) {
        fetch('./inc/ajax/flux/search.php?flux=hc', {
            method: 'POST',
            body: new FormData(searchForm),
        }).then(function (response) {
            return response.json();
        }).then(function (alert) {
            const box = fluxBox;
            if (alert.correct === true) {
                box.innerHTML = null;
                let date = '';
                alert.response.forEach(function (staff) {
                    let bgcolor;
                    let bgtop;
                    let typeflux;
                    let role;
                    let oldrole = '';
                    let borderposte = '';
                    if (staff.in_out === 1) {
                        bgcolor = '#2FD27B';
                        bgtop = bgcolor;
                        typeflux = 'Arrivée';
                        role = staff.poste;
                    } else {
                        if (staff.in_out === 2) {
                            bgcolor = '#E74D3D';
                            bgtop = bgcolor;
                            typeflux = 'Départ';
                            role = staff.poste;
                        } else if (staff.in_out === 3) {
                            bgcolor = '#2FD27B';
                            bgtop = '#FFC107'
                            typeflux = 'Changement';
                            role = staff.newposte;
                            borderposte = 'border-top:none;';
                            oldrole = '<div class="f-oldposte" style="border-bottom:none;">' + staff.poste + '</div>';
                        }
                    }
                    if (staff.month !== 0) {
                        if (date !== staff.month + staff.year) {
                            date = staff.month + staff.year;
                            const months = [
                                '',
                                'Janvier',
                                'Février',
                                'Mars',
                                'Avril',
                                'Mai',
                                'Juin',
                                'Juillet',
                                'Août',
                                'Septembre',
                                'Octobre',
                                'Novembre',
                                'Décembre'
                            ];
                            box.innerHTML += '<div class="f-date">' + months[staff.month] + ' ' + staff.year + '</div>';
                        }
                    }
                    box.innerHTML += '<a href="https://habbocity.me/profil/' + staff.pseudo + '" target="_blank"><div class="f-user" style="background: url(https://avatar.citywish.fr/?username=' + staff.pseudo + '&headonly=0) center 30px no-repeat #ededed;"><div class="f-top" style="background-color:' + bgtop + '">' + typeflux + '</div><div class="f-bottom"><div class="f-pseudo">' + staff.pseudo + '</div>' + oldrole + '<div class="f-poste" style="' + borderposte + 'background-color:' + bgcolor + ';">' + role + '</div></div></div></a>';
                });
            } else if (alert.correct === false) {
                box.innerHTML = '<div class="error-v" style="margin-bottom: 30px;">' + alert.response + '</div>';
            }
        });
    }

    /* Search */
    document.getElementById('search-hc').addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            searchFlux(document.getElementById('search-hc'), document.getElementById('form-search-flux-hc'), document.getElementById('fluxload-hc'));
        }
    });

    document.getElementById('search-hc').addEventListener('focusout', function () {
        searchFlux(document.getElementById('search-hc'), document.getElementById('form-search-flux-hc'), document.getElementById('fluxload-hc'));
    });

    document.getElementById('search-hc').addEventListener('keyup', function (event) {
        event.target.value = event.target.value.replace(' ', '');
    });

    document.getElementById('search-pole-hc').addEventListener('change', function () {
        searchFlux(document.getElementById('search-hc'), document.getElementById('form-search-flux-hc'), document.getElementById('fluxload-hc'));
    });

    document.getElementById('search-type-hc').addEventListener('change', function () {
        searchFlux(document.getElementById('search-hc'), document.getElementById('form-search-flux-hc'), document.getElementById('fluxload-hc'));
    });

    document.getElementById('search-dates-hc').addEventListener('change', function () {
        searchFlux(document.getElementById('search-hc'), document.getElementById('form-search-flux-hc'), document.getElementById('fluxload-hc'));
    });

    /* SendFlux */
    const sendflux = document.getElementById('send-flux');
    if (sendflux) {
        /// Ajax
        document.getElementById('sendflux-form').addEventListener('submit', function (event) {
            event.preventDefault();
            fetch('./inc/ajax/flux/addflux.php', {
                method: 'POST',
                credentials: 'include',
                body: new FormData(document.getElementById('sendflux-form'))
            }).then(function (response) {
                return response.text();
            }).then(function (fluxalert) {
                document.getElementById('sendflux-alert').innerHTML = fluxalert;
                fetch('./inc/ajax/flux/loadflux.php?all=1&hc=1', {
                    method: 'GET'
                }).then(function (response) {
                    return response.text();
                }).then(function (fluxload) {
                    document.getElementById('fluxload-hc').innerHTML = fluxload;
                });
            });
        });

        document.getElementById('sendflux-pseudo').addEventListener('focusout', function () {
            fetch('./inc/ajax/flux/apiflux.php', {
                method: 'POST',
                body: new FormData(document.getElementById('sendflux-form'))
            }).then(function (response) {
                return response.text();
            }).then(function (fluxalert) {
                document.getElementById('sendflux-alert').innerHTML = fluxalert;
            });
        });

        /// Avatar
        document.getElementById('sendflux-pseudo').addEventListener('keyup', function (event) {
            event.target.value = event.target.value.replace(' ', '');
            const userflux = event.target.value;
            if (document.getElementById('sendflux-type').value == 3) {
                document.getElementById('sendflux-avatar').style.background = 'url(https://avatar.citywish.fr/?username=' + userflux + '&headonly=1&head_direction=4&size=n) no-repeat center 15px';
            } else {
                document.getElementById('sendflux-avatar').style.background = 'url(https://avatar.citywish.fr/?username=' + userflux + '&headonly=1&head_direction=4&size=n) no-repeat center -10px';
            }
        });

        /// Changement de poste
        document.getElementById('sendflux-type').addEventListener('change', function (event) {
            if (event.target.value == 3) {
                document.getElementById('sendflux-oldposte').style.display = 'block';
                document.getElementById('sendflux-avatar').style.backgroundPositionY = '35px';
            } else {
                document.getElementById('sendflux-oldposte').style.display = 'none';
                document.getElementById('sendflux-oldposte').value = '';
                document.getElementById('sendflux-avatar').style.backgroundPositionY = '15px';
            }
        });

				const today = new Date();
				document.getElementById('sendflux-date').valueAsDate = today;

        /// Draggable 
        $('#send-flux').draggable({
            containment: 'document'
        });
    }

    const overlayFlux = document.getElementById('flux-webhook');
    let webhooksList = document.querySelectorAll('.list-webhooks');
    let submitButtons = document.querySelectorAll('.submit-btn');
    let formAction = null;

    function addEvents(btns, lists) {
        btns.forEach((btn) => {
            btn.addEventListener('click', (e) => {
                formAction = e.target.value;
            });
        });

        lists.forEach((form) => {
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                let formData = new FormData(form);
                formData.append('action', formAction);
                fetch('./inc/ajax/flux/webhook/editwebhook.php', {
                    method: 'POST',
                    credentials: 'include',
                    body: formData
                }).then((response) => {
                    return response.json();
                }).then((data) => {
                    if (data) {
                        cleanAlert();
                        addAlert(data);
                        refreshWebhooks();
                    }
                });
            });
        });
    }

    function refreshWebhooks() {
        fetch('./inc/ajax/flux/webhook/listwebhook.php', {
            method: 'POST',
            credentials: 'include'
        }).then((response) => {
            return response.text();
        }).then((list) => {
            if (list) document.getElementById('form-webhooks').innerHTML = list;
            submitButtons = document.querySelectorAll('.submit-btn');
            webhooksList = document.querySelectorAll('.list-webhooks');
            if (submitButtons && webhooksList) {
                addEvents(submitButtons, webhooksList);
            }
            opens = document.querySelectorAll('.open');
            if (opens) {
                opens.forEach((open) => {
                    open.addEventListener('click', () => {
                        initOverlay(document.getElementById(open.id.replace('open-', '')));
                    })
                });
            }
        });
    }

    if (overlayFlux) {
        const webhookForm = document.getElementById('flux-webhook-form');
        webhookForm.addEventListener('submit', (e) => {
            e.preventDefault();
            fetch('./inc/ajax/flux/webhook/addwebhook.php', {
                method: 'POST',
                credentials: 'include',
                body: new FormData(webhookForm)
            }).then((response) => {
                return response.json();
            }).then((data) => {
                if (data) {
                    cleanAlert();
                    addAlert(data);
                    refreshWebhooks();
                }
            });
        });
    }

    addEvents(submitButtons, webhooksList);
}
/* Fin Flux */