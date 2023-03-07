let getDetail = async (id) => {
  await new Promise(resolve => setTimeout(resolve, 1000));
  let request = new XMLHttpRequest();
  request.onreadystatechange = function() {
    if(request.readyState === 4) {
      if(request.status === 200) {
        let response = JSON.parse(request.responseText);
        document.getElementById('image').src= response[0].image;
        document.getElementById('model').innerHTML = response[0].model; 
        document.getElementById('specification').innerHTML = response[0].specification; 
        document.getElementById('price').innerHTML = response[0].price; 
        document.getElementById('amount').value = response[0].total;        
        let elementos = response.comments;
        processComment(elementos);
      } else if(request.status === 403) {
        let error = 'An error occurred during your request: ' +  request.status + ' ' + request.statusText;
        console.log('error ' + error);
      } else {
        let error = 'An error occurred during your request: ' +  request.status + ' ' + request.statusText;
        console.log('error ' + error + ' request ' +request);
      } 
    }
  }
  request.open('GET', 'http://localhost/agency/php/detail/'+id, true);
  request.setRequestHeader ('Content-Type', 'application/json;charset=UTF-8'); 
  request.send();
};

let setLike = async () => {
  randomSpinner();
  await new Promise(resolve => setTimeout(resolve, 1000));
  let request = new XMLHttpRequest();
  request.onreadystatechange = function() {
    if(request.readyState === 4) {
      if(request.status === 200) { 
        let response = JSON.parse(request.responseText); 
        randomSpinner();
      } else if(request.status === 403) {
        let error = 'An error occurred during your request: ' +  request.status + ' ' + request.statusText;
        console.log('error ' + error);
      } else {
        let error = 'An error occurred during your request: ' +  request.status + ' ' + request.statusText;
        console.log('error ' + error + ' request ' +request);
      } 
    }
  }
  let id = document.getElementById('txtLike').value;
  request.open('GET', 'http://localhost/agency/php/setlike/'+id, true);
  request.setRequestHeader ('Content-Type', 'application/json;charset=UTF-8'); 
  request.send();
};

let processComment = (elements) => {
  let html = ``;
  let rating =``;
  let count = 0;
  for(const key in elements) {
    html += `<div class='comment'>
              <div class='p_name'>${elements[key].name}</div>
              <div class='p_comment'>${elements[key].comment}</div>
              <div class='rating'>
              `;
              
              rating = getScore(elements[key].score);
              html += rating;
    html += `</div>
            <div>`;
  }
  html +=  ``;
  document.getElementById('comments').innerHTML = html; 
};

let getScore = (score) => {
  let html = ``;
  let count = 0;
  for (let i = 0; i < score; i++) {
    html += `<img src='img/star.png'>`;
    count++;
  } 
  //Agrega registros vacios
  if(count<=4){
    let ciclo = 5 - count;
    for (var j = 0; j < ciclo; j++) {
      html += `<img src='img/star_drawn.png'>`;
    }
  }
  return html;
}

let randomSpinner = () => {
  let spinner = document.getElementById('randomSpinner');
  spinner.classList.toggle('button--loading');
}

let getId = () => {
  let id = sessionStorage.getItem('id');
  document.getElementById('txtLike').value=id;
  getDetail(id);
}

let back = () => {
  window.location.href = "../";
}

let percentage = () => {
  let month = document.getElementById('month').value;
  let amount = document.getElementById('amount').value;
  let percent = 10;
  let res = (amount/100)*percent;
  let interest = res * month;
  let total = Number(amount) + Number(interest);
  document.getElementById('price').innerHTML = formatNumbers(total); 

}

let formatNumbers = (num) => { 
  return '$' + num.toFixed(2).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
}


getId();