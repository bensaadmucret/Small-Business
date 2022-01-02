<h2>page produit</h2>


<?php foreach ($products as $product): ?>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= $product['name'] ?></h5>
            <p class="card-text"><?= $product['description'] ?></p>
            <p class="card-text"><?= $product['price'] ?></p>
            <button><a href="product/<?= $product['id'] ?>">voir</a></button>
            
        </div>
    </div>
<?php endforeach; ?>
