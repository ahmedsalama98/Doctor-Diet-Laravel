let addProductButtons = Array.from(document.querySelectorAll('.add_food'));

addProductButtons.forEach((butt) => {


    butt.addEventListener('click', function(event) {
        event.preventDefault()

        let data = event.target.dataset;
        event.target.classList.add('disabled');


        let row_1 = `<<tr>

        <td> ${data.food_name}</td>
        <td><input type="number" name="foods[${data.food_id}][quantity]" ></input> </td>
        <td>${data.food_unit} </td>
        <td><button <button type="button" id="${data.food_id}" class="delete_food btn btn-danger" data-parent_id="${data.food_id}">   <i class="fas fa-trash-alt"></i>  </button></td>
        </tr>`


        let row = document.createElement('tr');
        let td_1 = document.createElement('td');
        let td_2 = document.createElement('td');
        let td_3 = document.createElement('td');
        let td_4 = document.createElement('td');

        td_1.textContent = data.food_name;
        td_2.innerHTML = `<input type="number" name="foods[${data.food_id}][quantity]" >`;
        td_3.textContent = data.food_unit;
        td_4.innerHTML = ` <button <button type="button" id="${data.food_id}" class="delete_food btn btn-danger" data-parent_id="${data.food_id}">   <i class="fas fa-trash-alt"></i>  </button>`;


        row.appendChild(td_1);
        row.appendChild(td_2);
        row.appendChild(td_3);
        row.appendChild(td_4);



        document.getElementById('foods_table').appendChild(row);
        checkButtons();
    })
})


function checkButtons() {
    let deleteButtons = Array.from(document.querySelectorAll('.delete_food'));



    deleteButtons.forEach((butt) => {


        butt.addEventListener('click', function(event) {
            event.preventDefault();

            document.getElementById('add_food_' + event.currentTarget.dataset.parent_id).classList.remove('disabled');
            butt.parentElement.parentElement.remove();

        })
    })
}
checkButtons()