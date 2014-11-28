Game Of Life
============

An implementation of the famous [Game Of
Life](http://en.wikipedia.org/wiki/Conway's_Game_of_Life) (Conway 1970) with
[Hoa\Console](https://github.com/hoaproject/Console)

Installation
============

```sh
git clone git@github.com:vonglasow/game-of-life.git
composer install
```

Usage
=====

```sh
php bin/GameOfLife.php
```

Use `-r` to create a random world

`-x` and `-y` is used to define the size of the world at least 40 for the
default world

```sh
php bin/GameOfLife.php -x 40 -y 40
```

Tests
=====

All tests are written with [Atoum](https://github.com/atoum/atoum) or
[Praspel](https://github.com/hoaproject/Contributions-Atoum-PraspelExtension)

To generate praspel tests

```sh
./vendor/bin/praspel generate -c GameOfLife\\Conway -r .
```

##To run all tests##

```sh
./vendor/bin/atoum -d tests
```

##To run Atoum's test##

```sh
./vendor/bin/atoum -f tests/units/Conway.php
```

##To run Praspel's test##

```sh
./vendor/bin/atoum -f tests/praspel/GameOfLife/GameOfLife/Conway.php
```

Todo
====
Make evolve the cell regarding neighbours life with automaton
Allow to use differents automaton if we want to implement other algorithm
Use Hoa\Console to Display the result of evolution for each step in lifetime
Allow to configure the universe by console options. (GliderGun Vacant Random…)

