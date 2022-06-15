const prev = document.querySelector('.prev');
const next = document.querySelector('.next');
const tbody = document.querySelector('tbody');
const index_input = document.querySelector('.index_input');
const max_length_text = document.getElementById('max_length');
const probability = document.getElementById('probability');
const max_probability = document.querySelector('.max_probability');
//block_list, prob_list는 이미 정의됨

var selected_block_list = block_list[block_index];
var null_list = Array.from({length: 7}, (v,i) => new Array(5));
const block_length = block_list.length;

if (block_length == 0){
    selected_block_list = null_list;
    block_index = -1;
}


function get_html(){
    var inner_html = '';
    for (var i = 0; i<7; i++){
        inner_html += '<tr align="center" bgcolor="white">';
        inner_html += '<td>' + (i+1) + "교시</td>";
        for (var j=0; j<5; j++){
            inner_html += '<td' + style_check(fixed_list[i][j])+ '>' + null_check(selected_block_list[i][j]) + '</td>';
        }
        inner_html += "</tr>";
    }
    return inner_html
}

function null_check(x){
    if (x == null){
        return '';
    }
    return x;
}

function style_check(x){
    if (x == 1){
        return ' style = "background-color: rgb(255, 255, 255)"';
    }
    else{
        return '';
    }
}

function set_html(){
    tbody.innerHTML = get_html();
    index_input.value = block_index + 1; //보이는건 +1
    probability.innerHTML = Math.round(prob_list[block_index]*10000) /100 + '%';
}

function process_input(){
    index_input.value = index_input.value.replace(/[^0-9]/g, '');
    if (index_input.value === '' ||block_length == 0 ) {
        selected_block_list = null_list;
    }
    else{
        if (1 <= index_input.value  && index_input.value <= block_length){
            block_index = index_input.value - 1; //실제 index는 -1
            selected_block_list = block_list[block_index];
        }
        else{
            alert('1에서 ' + block_length + '사이의 수를 입력해주세요')
            index_input.value = block_index + 1; //보이는건 +1
            selected_block_list = block_list[block_index];
        }
    }
    tbody.innerHTML = get_html();
    set_visible();
}

function update(){
    selected_block_list = block_list[block_index];
    set_html();
    set_visible();
}

function back(){
    block_index--;
    update();
}

function foward(){
    block_index++;
    update();
}

function set_max_prob(){
    block_index = max_plob_index;
    update();
}

function set_visible(){
    if (block_index <= 0) {
        prev.style.visibility = 'hidden';
    }
    else{
        prev.style.visibility = 'visible';
    }
    if (block_index >= block_length - 1) {
        next.style.visibility = 'hidden';
    }
    else{
        next.style.visibility = 'visible';
    }
}

function save_process(){
    if (index_input.value === '') {
        alert('값을 입력해주세요');
    }
    else{
        block_index = index_input.value - 1; //실제 index는 -1 

        var form = document.createElement('form');
        form.setAttribute('method', 'post');
        form.setAttribute('action', 'save_process.php');
        var hiddenField = document.createElement('input');
        hiddenField.setAttribute('type', 'hidden');
        hiddenField.setAttribute('name', 'index');
        hiddenField.setAttribute('value', block_index);
        form.appendChild(hiddenField)
        document.body.appendChild(form);
        form.submit();
    }
}

prev.addEventListener("click", back);
next.addEventListener("click", foward);
max_probability.addEventListener("click", set_max_prob);
max_length_text.innerHTML = '/ ' +  block_length;
index_input.max = block_length;
index_input.min = 1;
set_html();
set_visible();
