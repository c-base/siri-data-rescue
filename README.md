# Siri Data Rescue Modul


## Setup

* Clone this repo `git clone https://github.com/c-base/siri-data-rescue.git siri-data-rescue`
* Go into project-dir: `cd siri-data-rescue`
* Run `./composer.phar install` to install dependencies
* Run `./vendor/bin/phpunit` to check that everything works

## Run

Run `php -S localhost:9000 -t www/` and open the app in your browser: [http://localhost:9000/](http://localhost:9000/)

## What else

There is a command line interface:

Run
```
./console
```

It will output

```
Console Tool

Usage:
  [options] command [arguments]

Options:
  --help           -h Display this help message.
  --quiet          -q Do not output any message.
  --verbose        -v|vv|vvv Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
  --version        -V Display this application version.
  --ansi              Force ANSI output.
  --no-ansi           Disable ANSI output.
  --no-interaction -n Do not ask any interactive question.

Available commands:
  help                       Displays help for a command
  list                       Lists commands
siri
  siri:info                  SIRI show system info
  siri:storage:directories   SIRI show list of storages saved
  siri:storage:files         SIRI show list of files in each storage
  siri:storage:id            SIRI show current storageId
  siri:storage:info          SIRI show list of storages saved
```
