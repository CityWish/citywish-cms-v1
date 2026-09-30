/* Vote */
if (document.getElementById('vote')) {
    document.querySelectorAll('.search').forEach((div) => {
        div.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') e.preventDefault();
        });

        div.addEventListener('keyup', (e) => {
            e.target.value = e.target.value.replace(' ', '');
            if (e.target.value !== null) searchUser(div.id.replace('search-', ''));
        });
    });

    let users = document.querySelectorAll('.user-v');
    users.forEach((userbox) => {
        userbox.addEventListener('click', (e) => {
            let contentPost = new FormData();
            contentPost.append('pseudo', userbox.children[1].children[0].innerText);
            fetch('../inc/ajax/vote/vote.php', {
                method: 'POST',
                body: contentPost
            }).then((response) => {
                return response.json();
            }).then((result) => {
                useResult(result, userbox.classList[1]);
            });
        });
    });

    function useResult(result, type) {
        if (result.correct === true) {
            if(result.type === 'success') searchUser(type);

            cleanAlert();
            addAlert(result);
        }
    }

    function searchUser(type) {
        fetch('../inc/ajax/vote/search.php?type=' + type, {
            method: 'POST',
            body: new FormData(document.getElementById(`form-search-${type}`)),
        }).then((response) => {
            return response.text();
        }).then((alert) => {
            const box = document.getElementById(`content-${type}`);
            box.innerHTML = alert;
            users = document.querySelectorAll(`.user-v.${type}`);
            users.forEach((userbox) => {
                userbox.addEventListener('click', (e) => {
                    let contentPost = new FormData();
                    contentPost.append('pseudo', userbox.children[1].children[0].innerText);
                    fetch('../inc/ajax/vote/vote.php', {
                        method: 'POST',
                        body: contentPost
                    }).then((response) => {
                        return response.json();
                    }).then((result) => {
                        useResult(result, userbox.classList[1]);
                    });
                });
            });
        });
    }
}