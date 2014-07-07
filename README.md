Game Of Life
=======

An implementation of the famous Game Of Life (Conway 1970) with Hoa\Console

Tests
=====

All tests are written with Atoum or Praspel

To generate praspel tests

`./vendor/bin/praspel generate -c GameOfLife\\Conway -r .`

To run all tests

`./vendor/bin/atoum -d tests`
