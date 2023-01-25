"use strict";


// append(`
//                 <option id = "${id_data++}" value = ${element.id}> ${element.title}</option>
//                 `);
//! fetch all contacts and show in the tabel

$.ajax({
    type: "get",
    url: "http://pos.project:8080/list/contactapi",
    success: function (response) {
        var id_data = 1;
        response.body.forEach(element => {

            $('#contacts-message').append(`
            <tr>
            <td>
                <div class="d-flex align-items-center justify-content-center">
                    <div class="ms-1">
                        <p class="fw-bold mb-1 p-contact">${id_data++}</p>
                    </div>
                </div>
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="ms-3">
                        <p class="fw-bold text-center mt-2 p-contact">${element.Email}</p>
                    </div>
                </div>
            </td>

            <td class="text-center pt-2"><span style="font-weight: bold;">${element.message_contact}</span></td>

            <td class="text-center test1">
                <a href="/message/replay?id=${element.id}&user_contact=${element.user_id}" <i style="text-decoration: none; color:green;" class="fa-solid fa-reply pe-3"></a></i>
                <a href="/delete/message?id=${element.id}" <i style="text-decoration: none; color:red;" class="fa-solid fa-trash"></a></i>
            </td>
        </tr>
            `);
        });
    }
});


const link = window.location.href;
const active = document.querySelectorAll("ul li a").forEach((item) => {
    if (item.href == link) {
        item.classList.add("active-5");
        return;
    }
});

const add_title = () => {
    let title_page = document.createElement('title');
    title_page.textContent = `${document.location.pathname.slice(1).replace('/', ' ')}`;
    document.head.appendChild(title_page)
};


add_title()




const one = document.getElementById('Card-1');
const two = document.getElementById('Card-2');
const three = document.getElementById('Card-3');
const four = document.getElementById('Card-4');
const five = document.getElementById('Card-5');
const sex = document.getElementById('Card-6');

const arr = [
    'Users', 'Total Items', 'Total Sales', 'Total Transaction', 'Total quantity', 'Clear profit'
];

let num = 0;

function border() {
    if (arr[num] === "Users") {
        sex.classList.remove("card-scale");
        one.classList.add("card-scale");
        num = 1;
    } else if (arr[num] === "Total Items") {
        one.classList.remove("card-scale");
        two.classList.add("card-scale");
        num = 2;
    } else if (arr[num] === "Total Sales") {
        two.classList.remove("card-scale");
        three.classList.add("card-scale");
        num = 3;
    } else if (arr[num] === "Total Transaction") {
        three.classList.remove("card-scale");
        four.classList.add("card-scale");
        num = 4;
    } else if (arr[num] === "Total quantity") {
        four.classList.remove("card-scale");
        five.classList.add("card-scale");
        num = 5;
    } else if (arr[num] === "Clear profit") {
        five.classList.remove("card-scale");
        sex.classList.add("card-scale");
        num = 0;
    } else {
        return;
    }
}


if (window.location.href === "http://pos.project:8080/dashboard") {

    setInterval(() => {
        border();
    }, 1800)
}
