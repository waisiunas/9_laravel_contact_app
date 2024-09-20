showCategories();

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
            user_id: ID,
        };

        const response = await fetch(createRoute, {
            method: 'POST',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            },
        });

        const result = await response.json();

        if (result.errors) {
            if (result.errors.name) {
                addAlertElement.innerHTML = alert(result.errors.name);
                addNameElement.classList.add('is-invalid');
            }
        } else if (result.success) {
            addAlertElement.innerHTML = alert(result.success, 'success');
            addNameElement.value = '';
            showCategories();
        } else if (result.failure) {
            addAlertElement.innerHTML = alert(result.failure);
        } else {
            addAlertElement.innerHTML = alert();
        }
    }
});

async function showCategories() {
    const response = await fetch(indexRoute);
    const result = await response.json();

    const responseElement = document.querySelector('#response');
    let rows = '';

    console.log(result);

    if (result.categories.length > 0) {
        result.categories.forEach(function (category, index) {
            rows += `<tr>
                                        <td>${index + 1}</td>
                                        <td>${category.name}</td>
                                        <td>${category.contacts_count}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary" onclick="editCategory(${category.id})"
                                                data-bs-toggle="modal" data-bs-target="#editModal">
                                                Edit
                                            </button>

                                            <button type="button" class="btn btn-danger" onclick="deleteCategory(${category.id})"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>`;

        });
        responseElement.innerHTML = `<table class="table table-bordered m-0">
                                <thead>
                                    <tr>
                                        <th>Sr. No.</th>
                                        <th>Name</th>
                                        <th>Contacts</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                ${rows}
                                </tbody>
                            </table>`;
    } else {
        responseElement.innerHTML = `<div class="alert alert-info m-0">No record found</div>`;
    }
}

let outerID = '';
async function editCategory(id) {
    outerID = id;
    const APIURL = showRoute.replace(':id', id);

    const response = await fetch(APIURL);
    const result = await response.json();

    document.querySelector('#edit-name').value = result.category.name;
}

const editFormElement = document.querySelector('#edit-form');
const editAlertElement = document.querySelector('#edit-alert');

editFormElement.addEventListener('submit', async function (e) {
    e.preventDefault();

    const editNameElement = document.querySelector('#edit-name');

    const editNameValue = editNameElement.value;

    if (editNameValue == "" || editNameValue === undefined) {
        editAlertElement.innerHTML = alert('Provide category name!');
        editNameElement.classList.add('is-invalid');
    } else {
        editAlertElement.innerText = "";
        editNameElement.classList.remove('is-invalid');

        const data = {
            name: editNameValue,
        };

        const APIURL = editRoute.replace(':id', outerID);

        const response = await fetch(APIURL, {
            method: 'PATCH',
            body: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            },
        });

        const result = await response.json();

        if (result.errors) {
            if (result.errors.name) {
                editFormElement.innerHTML = alert(result.errors.name);
                editNameElement.classList.add('is-invalid');
            }
        } else if (result.success) {
            editAlertElement.innerHTML = alert(result.success, 'success');
            showCategories();
        } else if (result.failure) {
            editAlertElement.innerHTML = alert(result.failure);
        } else {
            editAlertElement.innerHTML = alert();
        }
    }
});

function alert(msg = 'Something went wrong!', cls = 'danger') {
    return `<div class="alert alert-${cls} alert-dismissible fade show" role="alert">
  ${msg}
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>`;
}
