let getRandomProducts = async () => {
  randomSpinner();
  await new Promise(resolve => setTimeout(resolve, 1000));
  let request = new XMLHttpRequest();
  request.onreadystatechange = function() {
    if(request.readyState === 4) {
      if(request.status === 200) {
        let response = JSON.parse(request.responseText); 
        processRandom(response);
        randomSpinner();
      } else if(request.status === 403) {
        let error = 'An error occurred during your request: ' +  request.status + ' ' + request.statusText;
        console.log('error ' + error);
      } else {
        let error = 'An error occurred during your request: ' +  request.status + ' ' + request.statusText;
        console.log('error ' + error + ' request ' +request.responseText);
      } 
    }
  }
  let json = new Object();
  json.type = 'random';
  request.open('POST', 'http://localhost/agency/php/products');
  request.setRequestHeader ('Content-Type', 'application/json;charset=UTF-8'); 
  request.send(JSON.stringify(json));
};


  let getCategory = () => {
    let request = new XMLHttpRequest();
    request.onreadystatechange = function() {
      if(request.readyState === 4) {
        if(request.status === 200) {
          let response = JSON.parse(request.responseText); 
          processCategory(response);
          //getByCategory();
        } else if(request.status === 403) {
          let error = 'An error occurred during your request: ' +  request.status + ' ' + request.statusText;
          console.log('error ' + error);
        } else {
          let error = 'An error occurred during your request: ' +  request.status + ' ' + request.statusText;
          console.log('error ' + error + ' request ' +request);
        } 
      }
    }

    request.open('GET', 'http://localhost/agency/php/category');
    request.setRequestHeader ('Content-Type', 'application/json;charset=UTF-8'); 
    request.send();
  };

  let getProducBySubCategory = async (id) => {
    await new Promise(resolve => setTimeout(resolve, 1000));
    let request = new XMLHttpRequest();
    request.onreadystatechange = function() {
      if(request.readyState === 4) {
        if(request.status === 200) { 
          let response = JSON.parse(request.responseText); 
          processProduct(response);
        } else if(request.status === 403) {
          let error = 'An error occurred during your request: ' +  request.status + ' ' + request.statusText;
          console.log('error ' + error);
        } else {
          let error = 'An error occurred during your request: ' +  request.status + ' ' + request.statusText;
          console.log('error ' + error + ' request ' +request);
        } 
      }
    }

    request.open('GET', 'http://localhost/agency/php/products/'+id, true);
    request.setRequestHeader ('Content-Type', 'application/json;charset=UTF-8'); 
    request.send();
  };

  let processRandom = (elements) => {
    let html = ``;
    for(const key in elements) {
      html += `<li>
                <div class='r_item'>
                  <img class='r_image' src='${elements[key].image}'>
                  <div class='r_title'>${elements[key].model}</div>
                  <div class='r_price'>${elements[key].price}</div>
                  <button class='r_btn'>Mirar</button>
                </div>
              </li>`;
    }
    html +=  ``;
    document.getElementById('random-product').innerHTML = html; 
  };

  let processCategory = (elements) => {
    let html = ``;
    let subcategory = new Array();
    for(const key in elements) {
      html += `<li><div class='category'>${elements[key].category}</div>`;
      subcategory = elements[key].subcategory;
      html += `<ul>`;
      for(const key1 in subcategory) {
        html += `<li><div class='category' onclick='getProducBySubCategory(${subcategory[key1].id_subcategory});'>${subcategory[key1].subcategory}</div></li>`;
      }
      html += `</ul></li>`;
    }
    html +=  ``;
    document.getElementById('nav').innerHTML = html; 
  };

  let processProduct = (elements) => {
    let html = ``;
    for(const key in elements) {
      html +=  `<div class='product'>
      <img class='p_image' src='${elements[key].image}'>
      <div class='p_title'>${elements[key].model}</div>
      <div class='p_short'>${elements[key].specification}</div>
      <div class='p_price'>${elements[key].price}</div>
      <button class='p_btn' onclick='showProduct(${elements[key].id_product});'>Detalle</button>
        </div>`;
    }
    html +=  ``;
    document.getElementById('shop').innerHTML = html; 
  };

  let randomSpinner = () => {
    let spinner = document.getElementById('randomSpinner');
    spinner.classList.toggle('button--loading');
  }

  let categorySpinner = () => {
    let spinner = document.getElementById('categorySpinner');
    spinner.classList.toggle('button--loading');
  }

  let showProduct = (id) => {
    sessionStorage.id = id;
    window.location.href = 'detail.php';
  }

  getRandomProducts();
  getCategory();