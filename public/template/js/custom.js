const addFormElement = document.querySelector('#add-form');
const addAlertElement = document.querySelector('#add-alert');


addFormElement.addEventListener('submit', async function (e) {
    e.preventDefault();

    const addNameElement = document.querySelector('#add-name');

    const addNameValue = addNameElement.value;

    if (addNameValue == "" || addNameValue === undefined) {
        addAlertElement.innerHTML = alert('Provide category name!');
        addNameElement.classList.add('is-invalid');
    } else {
        addAlertElement.innerText = "";
        addNameElement.classList.remove('is-invalid');

        const data = {
            name: addNameValue,
        };

        // console.log(createRoute);

        const response = await fetch(createRoute, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            },
        });

        const result = await response.json();

        console.log(result);

    }
});

function alert(msg, cls = 'danger') {
    return `<div class="alert alert-${cls} alert-dismissible fade show" role="alert">
  ${msg}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`;
}
