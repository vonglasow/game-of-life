COMPOSER := $(shell if [ `which composer` ]; then echo 'composer'; else curl -sS https://getcomposer.org/installer | php > /dev/null 2>&1 ; echo './composer.phar'; fi;)
vendor:
	@echo 'Install dependencies';
	$(COMPOSER) install
test: vendor
	@echo 'Generate Praspel tests';
	vendor/bin/praspel generate -c GameOfLife\\Conway -r .
	@echo 'Run all tests'
	vendor/bin/atoum -d tests/units
update:
	$(COMPOSER) update
	make test
clean:
	@echo 'Remove vendor and praspel folders'
	rm -rf vendor
	rm -rf tests/praspel
.PHONY: clean
