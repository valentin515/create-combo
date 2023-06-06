<?php

spl_autoload_register(function($class) {
    require_once $class . ".php";
});


if (!empty($_POST)) {

    $drinkName = $_POST["drink-name"];
    $drinkSize = $_POST["drink-size"];
    $drink = new Drink($drinkSize, $drinkName);

    $pizzaName = $_POST["pizza-name"];
    $pizzaDough = $_POST["pizza-dough"];
    $pizzaCheeseCrust = $_POST["pizza-cheese-crust"] ? true : false;
    $pizzaSize = $_POST["pizza-size"];
    $pizza = new Pizza($pizzaSize, $pizzaName, $pizzaDough, $pizzaCheeseCrust);

    $sauceName = $_POST["sauce-name"];
    $friesSize = $_POST["fries-size"];
    $fries = new Fries($friesSize, $sauceName);

    $iceCreamFlavor = $_POST["ice-cream-flavor"];
    $iceCreamSize = $_POST["ice-cream-size"];
    $iceCreamTopping = $_POST["ice-cream-topping"];
    $iceCream = new IceCream($iceCreamSize, $iceCreamFlavor, $iceCreamTopping);
    
    $combo = new Combo($drink, $pizza, $fries, $iceCream);

    $combo->save();    
}

$combos = json_decode(file_get_contents("database/combos/combos.json"), true);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create combo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <?php if ($combos) : ?>
        <table class="table table-secondary">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Drink</th>
                    <th scope="col">Pizza</th>
                    <th scope="col">Fries</th>
                    <th scope="col">Ice cream</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($combos as $idx => $combo) : ?>
                <tr>
                    <th scope="row"> <?= $idx + 1 ?></th>
                    <td>
                        <span>Drink: <?= $combo["drink"]["name"] ?></span><br>
                        <span>Size: <?= $combo["drink"]["size"] ?></span><br>
                    </td>
                    <td>
                        <span>Name: <?= $combo["pizza"]["name"] ?></span><br>
                        <span>Size: <?= $combo["pizza"]["size"] ?></span><br>
                        <span>Dough: <?= $combo["pizza"]["dough"] ?></span><br>
                        <span>Cheese crust: <?= $combo["pizza"]["cheeseCrust"] ? "Yes" : "none" ?></span><br>
                    </td>
                    <td>
                        <span>Size: <?= $combo["fries"]["size"] ?></span><br>
                        <span>Souce: <?= $combo["fries"]["souce"] ? $combo["fries"]["souce"] : "none"  ?></span><br>
                    </td>
                    <td>
                        <span>Flavor: <?= $combo["iceCream"]["flavor"] ?></span><br>
                        <span>Size: <?= $combo["iceCream"]["size"] ?></span><br>
                        <span>Topping: <?= $combo["iceCream"]["topping"] ? $combo["iceCream"]["topping"] : "none" ?></span><br>
                    </td>
                    <td>
                        <span><?= $combo["total"] ?></span><br>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
    <h1 class="mb-3 mt-3">Create combo</h1>
    <form method="post">
        <div class="row">
            <div class="col">
                <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">
                        <h3>Drink</h3>
                    </div>
                    <div class="card-body">
                        <label class="form-label">Drink</label>
                        <select class="form-select mb-3" name="drink-name">
                            <option value="soda">Soda</option>
                            <option value="fruit drink">Fruit drink</option>
                            <option value="juice">Juice</option>
                        </select>
                        <label class="form-label">Size</label>
                        <select class="form-select mb-3" name="drink-size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="big">Big</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">
                        <h3>Pizza</h3>
                    </div>
                    <div class="card-body">
                        <label class="form-label">Name</label>
                        <select class="form-select mb-3" name="pizza-name">
                            <option value="peperoni">Peperoni</option>
                            <option value="margarita">Margarita</option>
                            <option value="bbq">BBQ</option>
                        </select>
                        <label class="form-label">Dough</label>
                        <select class="form-select mb-3" name="pizza-dough">
                            <option value="thick">Thick</option>
                            <option value="thin">Thin</option>
                        </select>
                        <label class="form-label">Cheese crust</label>
                        <select class="form-select mb-3" name="pizza-cheese-crust">
                            <option value="">None</option>
                            <option value="yes">Yes</option>
                        </select>
                        <label class="form-label">Size</label>
                        <select class="form-select mb-3" name="pizza-size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="big">Big</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">
                        <h3>Fries</h3>
                    </div>
                    <div class="card-body">
                        <label class="form-label">Sauce</label>
                        <select class="form-select mb-3" name="sauce-name">
                            <option value="">None</option>
                            <option value="ketchup">Ketchup</option>
                            <option value="cheese">Cheese</option>
                            <option value="garlic">Garlic</option>
                        </select>
                        <label class="form-label">Size</label>
                        <select class="form-select mb-3" name="fries-size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="big">Big</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card text-bg-light mb-3" style="max-width: 18rem;">
                    <div class="card-header">
                        <h3>Ice cream</h3>
                    </div>
                    <div class="card-body">
                        <label class="form-label">Flavor</label>
                        <select class="form-select mb-3" name="ice-cream-flavor">
                            <option value="chocolate">Chocolate</option>
                            <option value="vanila">Vanila</option>
                            <option value="strawberry">Strawberry</option>
                        </select>
                        <label class="form-label">Size</label>
                        <select class="form-select mb-3" name="ice-cream-size">
                            <option value="small">Small</option>
                            <option value="medium">Medium</option>
                            <option value="big">Big</option>
                        </select>
                        <label class="form-label">Topping</label>
                        <select class="form-select mb-3" name="ice-cream-topping">
                            <option value="">None</option>
                            <option value="caramel">Caramel</option>
                            <option value="chocolate">Chocolate</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
</div>
    
</body>
</html>