export async function sendRequest(url, input) {
    const response = await fetch(url);
    if (response.ok) {
        const data = await response.json();

        const textVisibiliity = input.closest('.card').querySelector('.text-visibility');

        if (data.visibility) {
            textVisibiliity.classList.add('text-success');
            textVisibiliity.classList.remove('text-danger');
            textVisibiliity.innerHTML = textVisibiliity.innerHTML.replace(' (brouillon)', '');
        } else {
            textVisibiliity.classList.add('text-danger');
            textVisibiliity.classList.remove('text-success');
            textVisibiliity.innerHTML = textVisibiliity.innerHTML + ' (brouillon)';
        }
    } else {
        console.error('Erreur lors de la requête : ', await response.json());
    }
}