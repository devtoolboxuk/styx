# Styx AntiFlood
AntiFlood Service

[![Build Status](https://api.travis-ci.org/devtoolboxuk/styx.svg?branch=master)](https://travis-ci.org/devtoolboxuk/styx)
[![Coveralls](https://coveralls.io/repos/github/devtoolboxuk/styx/badge.svg?branch=master)](https://coveralls.io/github/devtoolboxuk/styx?branch=master)
[![CodeCov](https://codecov.io/gh/devtoolboxuk/styx/branch/master/graph/badge.svg)](https://codecov.io/gh/devtoolboxuk/styx)


## Table of Contents

- [Background](#Background)
- [Usage](#Usage)
- [Maintainers](#Maintainers)
- [License](#License)

## Background

Can be used to prevent multiple submissions of forms. But to be used along side CSRF protection

## Usage

Usage of the hashing service

```sh
$ composer require devtoolboxuk/styx
```

Then include Composer's generated vendor/autoload.php to enable autoloading:

```sh
require 'vendor/autoload.php';
```

```sh
use devtoolboxuk/styx;

$this->antiFloodService = new Styx('_default',60);
```


##### Set AntiFlood Delay
By default, this is preset to 60 seconds.
```sh
$this->antiFloodService->setAntiFloodDelay('30');
```

##### Get AntiFlood Delay
```sh 
$this->antiFloodService->getAntiFloodDelay();
```

##### Detect AntiFlood

Returns a boolean if the AntiFlood item is set

```sh
$this->antiFloodService->detectAntiFlood();
```


## Maintainers

[@DevToolboxUk](https://github.com/devtoolboxuk).


## License

[MIT](LICENSE) © DevToolboxUK