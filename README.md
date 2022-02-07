# ext-php-rs-example

```sh
docker build .docker -t ext-php-rs-example
```

```sh
docker run --rm -it -v `pwd`:/app -w /app ext-php-rs-example bash
```

```sh
php -dextension=./target/debug/libext_php_rs_example.so src-php/example.php
```
