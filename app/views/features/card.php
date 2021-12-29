<?php

class Card {
    public function createCard($product) {
        echo '<div class="col-sm-12 col-md-6 col-lg-4 pb-5">';
        echo '<div class="card h-100">';
        echo '<img class="card-img-top" src="' . $product->getImg() . '" alt="Card image cap">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $product->getName() . '</h5>';
        echo '<p class="card-text">' . $product->getDescription() . '</p>';
        echo '<h5 class="card-title"> € ' . $product->getPrice() . '</h5>';
        echo '</div>';
        echo '<div class="card-footer mt-auto">';
        echo '<a href="#" class="btn btn-primary">Voeg to aan winkelwagen</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
}