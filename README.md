Game Of Life
============

An implementation of the famous Game Of Life (Conway 1970) with Hoa\Console

Usage
=====

```sh
php bin/GameOfLife.php
```

Use `-r` to create a random world

`-x` and `-y` is used to define the size of the world at least 40 for the default world

```sh
php bin/GameOfLife.php -x 40 -y 40
```

Tests
=====

All tests are written with Atoum or Praspel

To generate praspel tests

`./vendor/bin/praspel generate -c GameOfLife\\Conway -r .`

To run all tests

`./vendor/bin/atoum -d tests`


