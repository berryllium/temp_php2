<h2>Каталог товаров</h2>
<div class="catalog">
    <button onclick="getMore()">Еще товары</button>
</div>

<script>
    let catalog = document.querySelector('.catalog')
    let limit = 3
    let start = 0
    setTimeout(() => {
        getMore()
    }, 200); 
</script>

<style>
    button {
        position: fixed;
        bottom: 100px;
        left: 40%;
    }
</style>