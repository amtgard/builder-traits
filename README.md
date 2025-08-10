# Builder Trait

Implements a Lombokish version of Builder using Traits.

Supports the following traits individually:
- Builderå
- Getter
- Setter
- ToBuilder
- Data

Example usage is in `tests/Models/` and `tests/BuilderTest.php`.

### Builder
To add builder functionality, add the Builder trait:
```php
use Builder;
```
You can then construct an object using the builder fluent interface:

```php
Gato::builder()->age(7)->name("Charlie")->build();
```

### Getter, Setter, Data
You can add getters and setters over all private members by adding the Getter or Setter traits.

Due to limitations in library design, both Getter and Setter cannot be used in the same class.

Instead, use the Data trait.

#### Getter
```php
class Gato {
    use Getter;
    private $name;
}

$catName = $gato->getName();
```

#### Setter
```php
class Gato {
    use Setter;
    private $name;
}
$name = $gato->getName();
```

#### Data
Due to trait method collision, we can't compose `Getter` and `Setter` in the same class.

Instead use the `Data` trait.

```php
class Gato {
    use Data;
    private $name;
}
$gato->setName('Charlie');
$name = $gato->getName();
```

### ToBuilder
We can mutate an existing object with the `ToBuilder` trait.

```php
class Gato {
    use ToBuilder;
    private $name;
}
$chuck = $gato->toBuilder()->name('Charlie')->build();
```

### Hooks

#### #[PostInit] Attribute
Apply the `#[PostInit]` attribute to any private method to be called during the `->build()` phase of the Builder.

```php
class PostInitGato {
    use Builder;
    private $bField;

    #[PostInit]
    private function postInit() {
        $this->bField = 'b';
    }
}
```
