const giveaways = document.getElementById('giveaways');
if (giveaways) {
  const items = document.querySelectorAll('.box-giveaways');
  items.forEach(item => {
    item.addEventListener('click', (e) => {
      if (e.target.classList.contains('create')) {
        document.getElementById('form-ga-title').innerHTML = 'Créer un giveaways';
        document.getElementById('giveaways-lots').value = '';
        document.getElementById('giveaways-nbwinners').value = '';
        document.getElementById('giveaways-date').value = '';
        document.getElementById('giveaways-id').value = 'create';
        document.getElementById('giveaways-date').disabled = false;
      } else {
        const element = e.target;
        const id = e.target.id.replace('item-', '');
        const lots = element.querySelector('.title-giveaways').innerText;
        const nb_winners = element.querySelector('.nbwinners-giveaways').innerText.replace('gagnant(s)', '').replaceAll(' ', '');
        const date = formatDate(element.querySelector('.time-giveaways').innerText);

        document.getElementById('giveaways-id').value = id;
        document.getElementById('form-ga-title').innerHTML = `Modifier le giveaways <i style="font-size:26px">(Giveaways créé
        le ${date.replace('T', ' ')})</i>`;
        document.getElementById('giveaways-lots').value = lots;
        document.getElementById('giveaways-nbwinners').value = nb_winners;
        document.getElementById('giveaways-date').value = date;
        document.getElementById('giveaways-date').disabled = true;
      }
    });
  });

  const send_giveaways = document.getElementById('send-giveaways');
  send_giveaways.addEventListener('submit', (e) => {
    e.preventDefault();
    let formdata = new FormData(send_giveaways);
    if(document.getElementById('giveaways-date').disabled) {
      formdata.append('date', document.getElementById('giveaways-date').value);
    }
    fetch('./inc/ajax/Giveaways/GiveawayCreate.php', {
      method: 'POST',
      body: formdata,
      credentials: 'include'
    }).then((response) => {
      return response.json();
    }).then((data) => {
      addAlert(data);
    });
  });
}