function getMore() {
  $.ajax({
      type: "POST",
      url: "model/api.php",
      data: {
          start: start,
          limit: limit
      },
      success: function(msg) {
          try {
          msg = JSON.parse(msg)
          console.log(msg)
          msg.forEach(item => catalog.insertAdjacentHTML("beforeEnd",
              `<div class="catalog-product">
                  <a href="?page=product&id=${item.id}">
                   <img src="${item.path_small}" alt="${item.title}">
                  </a><br>
                  ${item.title}
                  </div>`
          ))
          window.scrollTo(0, document.body.scrollHeight);
          start+=limit
          }
          catch {
              alert('больше товаров нет')
          }
          
      }
  });
}